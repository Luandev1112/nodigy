import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import Sidebar from '../common/header/Sidebar';
import HeaderTopBar from '../common/header/HeaderTopBar';
import { Button, Dropdown, Modal } from 'react-bootstrap';
import WalletsBlankImage from '../assets/img/wallets-blank-img.png';
import IconCloseModalImage from '../assets/img/icon-close-modal.png';
import networkList from '../data/wallet/networkList.json';
import networkWallets from '../data/wallet/networkWallets.json';

import { Connection, PublicKey, SystemProgram, Transaction } from '@solana/web3.js';
import { SigningStargateClient, makeSignDoc } from "@cosmjs/stargate";
// Braavos Wallet
import { BraavosConnector } from '@web3-starknet-react/braavos-connector';

// import Web3 from 'web3';
import Web3Modal, { providers } from 'web3modal';
import {ethers} from 'ethers';
const Wallets = () => {
    const [show, setShow] = useState(false);
    const [selectedNetworkIndex, setSelectedNetworkIndex] = useState(-1);
    const [walletList, setWalletList] = useState([]);
    const [selectedWallet, setSelectedWallet] = useState(null);
    const [loading, setLoading] = useState(false);
    const [connectionStatus, setConnectionStatus] = useState(false);
    const web3Modal = typeof window !== 'undefined' && new Web3Modal({ cacheProvider: true });
    const [walletName, setWalletName] = useState('');
    //Phantom wallet 
    const [signer, setSigner] = useState(null);
    const [connected, setConnected] = useState(false);
    const [braavosWallet, setBraavosWallet] = useState(null);
    // braavos wallet
    const braavosWalletConnector = new BraavosConnector({ supportedChainIds: [1,5] });
    const handleClose = () => {
        setShow(!show);
    }

    const selectNetwork = (indexId) => {
        setSelectedNetworkIndex(indexId);
        const networkId = networkList[indexId].id;
        const selectedNetwork = networkWallets.find(nWallet => nWallet.networkId === networkId);
        setWalletList(selectedNetwork.wallets);
        setSelectedWallet(null);
    }

    const onInputChange = (e) => {
        e.preventDefault();
        if(e.target.name == 'wallet-name'){
            setWalletName(e.target.value);
        }
        console.log(e.target.name);
    }

    const selectWallet = (indexId) => {
        if(walletList.length == 0){
            setSelectedWallet(null);
        }else{
            setSelectedWallet(walletList[indexId]);
        }
    }

    const walletConnectConfirm = async () => {
        if(selectedWallet)
        {
            const walletName = selectedWallet.name;
            switch(walletName){
                case 'MetaMask':
                    await metamaskConnect();
                break;
                case 'Phantom':
                    await connectPhantomWallet();
                break;
                case 'Keplr':
                    await connectToKeplr();
                break;
                case 'Braavos':
                    await connectBraavosWallet();
                break;
            }
        }else{
            console.log("There is not selected wallet");
        }
    }

    const checkIfExtensionIsAvailable = () => {
        if (
            (window && window.web3 === undefined) ||
            (window && window.ethereum === undefined)
        ) {
            setError(true);
            web3Modal && web3Modal.toggleModal();
        }
    }; 

    const metamaskConnect = async () => {
        try {
            setLoading(true);
            checkIfExtensionIsAvailable();
            const connection = web3Modal && (await web3Modal.connect());
            const provider = new ethers.providers.Web3Provider(connection);
            await subscribeProvider(connection);
            setWalletAddress(provider);
            setLoading(false);
            setConnectionStatus(true);
        } catch (error) {
            console.log(error);
            setLoading(false);
            setConnectionStatus(false);
            // console.log("Got this error on connectToWallet catch block while connecting the wallet");
        }
    };

    const setWalletAddress = async (provider) => {
        try {
            const signer = provider.getSigner();
            if(signer) {
                const web3Address = await signer.getAddress();
                getBalance(provider, web3Address);
                const evm = sessionStorage.getItem('evm');
                if(evm){
                    let _evm = JSON.parse(evm);
                    _evm.metamask = {
                        address: web3Address,
                        name: walletName
                    };
                    sessionStorage.setItem('evm', JSON.stringify(_evm));
                }else{
                    let _evm = {
                        metamask: {
                            address: web3Address,
                            name: walletName
                        }
                    };
                    sessionStorage.setItem('evm', JSON.stringify(_evm));
                }
            }
        } catch (error) {
            setConnectionStatus(false);
            console.log("Account not connected; logged from setWalletAddress function");
        }
    }

    const getBalance = async (provider, walletAddress) => {
        const walletBalance = await provider.getBalance(walletAddress);
        const balanceInEth = ethers.utils.formatEther(walletBalance);
    }

    const subscribeProvider = async (connection) => {
        connection.on('close', () => {
            disconnectWallet();
        });
        connection.on('accountsChanged', async (accounts) => {
            if(accounts.length) {
                console.log("accounts", accounts[0])
                const provider = new ethers.providers.Web3Provider(connection);
                getBalance(provider, accounts[0]);
            }else{
                disconnectWallet();
            }
        })
    }

    const disconnectWallet = () => {
        web3Modal && web3Modal.clearCachedProvider();
    }

    const connectPhantomWallet = async () => {
        if (window.solana && window.solana.isPhantom) {
            try{
                const provider = window.solana;
                console.log("solana - ", provider);
                await provider.connect();
                const connection = new Connection('https://api.mainnet-beta.solana.com');
                const publicKey = await provider.publicKey;
                console.log("public key:", publicKey);

                const solana = sessionStorage.getItem('solana');
                if(solana){
                    let _solana = JSON.parse(solana);
                    _solana.phantom = {
                        name: walletName,
                        address: publicKey
                    };
                    sessionStorage.setItem('solana', JSON.stringify(_solana));
                }else{
                    let _solana = {
                        phantom: {
                            name: walletName,
                            address: publicKey
                        }
                    };
                    sessionStorage.setItem('solana', JSON.stringify(_solana));
                }

                const signer = {
                    publicKey,
                    signTransaction: async (transaction) => {
                        const signedTransaction = await provider.signTransaction(transaction);
                        return signedTransaction;
                    },
                };
                setConnected(true);   
                setConnectionStatus(true);
            }catch(error){
                setConnectionStatus(false);
                console.log("Phantom wallet connect error: ",error);
            }
        } else {
          console.log('Phantom wallet not detected');
        }
    };

    const connectToKeplr = async() => {
        if (window.keplr) {
            try {
                await window.keplr.enable("cosmoshub-3");
                const keplrOfflineSigner = window.getOfflineSigner("cosmoshub-3");
                const accounts = await keplrOfflineSigner.getAccounts();
                const [{ address }] = accounts;
                const keplrSigner = {
                    async sign(signBytes) {
                        const { signature } = await keplrOfflineSigner.sign(address, makeSignDoc(signBytes));
                        return signature;
                    },
                    async getAccounts() {
                        return accounts;
                    },
                    async getAddress() {
                        return address;
                    },
                };
                const kpWallet = await keplrSigner.getAddress();
                const cosmos = sessionStorage.getItem('cosmos');
                if(cosmos){
                    let _cosmos = JSON.parse(cosmos);
                    _cosmos.keplr = {
                        name: walletName,
                        address: kpWallet
                    };
                    sessionStorage.setItem('cosmos', JSON.stringify(_cosmos));
                }else{
                    let _cosmos = {
                        keplr: {
                            name: walletName,
                            address: kpWallet
                        }
                    };
                    sessionStorage.setItem('cosmos', JSON.stringify(_cosmos));
                }
                setConnectionStatus(true);
            } catch (error) {
                setConnectionStatus(false);
                console.error(error);
            }
        } else {
            console.error("Please install Keplr wallet extension");
        }
    }

    const connectBraavosWallet = async () => {
        try {
            await braavosWalletConnector.activate();
            const braavosWallet = braavosWalletConnector.getConnectedAddress();
            if(!braavosWallet){
                return;
            }
            setBraavosWallet(braavosWallet);
            const starknet = sessionStorage.getItem('starknet');
            if(starknet){
                let _starknet = JSON.parse(starknet);
                _starknet.braavos = {
                    name: walletName,
                    address: braavosWallet
                };
                sessionStorage.setItem('starknet', JSON.stringify(_starknet));
            }else{
                let _starknet = {
                    braavos: {
                        name: walletName,
                        address: braavosWallet
                    }
                };
                sessionStorage.setItem('starknet', JSON.stringify(_starknet));
            }
            setConnectionStatus(true);
        } catch (error) {
            setConnectionStatus(false);
            console.error(error);
        }
    }

    useEffect(()=>{

        if(connectionStatus){
            window.location.href = "/admin/wallet-details";
        }
    }, [connectionStatus]);

    return (
        <div className="wrapper wallets">
            <Sidebar  menu="wallets" />

            <div className="wrapper-content">
                <HeaderTopBar menu="wallets" />
                <div className="wallets-blank">
                    <div className="box">
                        <div className="img"><img src={WalletsBlankImage} /></div>
                        <div className="title">Nam accumsan nunc sed accumsan</div>
                        <p>Vestibulum auctor facilisis urna, a vulputate ipsum tempus in mattis nibh, sed convallis mauris </p>
                        <div className="btn-container"><a onClick={handleClose} className="btn btn-primary">Add wallet</a></div>
                        <Modal show={show} onHide={handleClose} id="add-new-wallet-modal ">
                            <Modal.Header>
                                <h4 className="modal-title w-100 text-center" id="myModalLabel">Connect Wallet</h4>
                                <button type="button" className="close" onClick={handleClose}>
                                    <img src={IconCloseModalImage} />
                                </button>
                            </Modal.Header>
                            <Modal.Body>
                                <p className="text">Vestibulum auctor facilisis urna, a vulputate ipsum tempus in mattis nibh, sed convallis mauris</p>
                                <div className="form-group">
                                    <label>Select Network</label>
                                    <Dropdown className="">
                                        <Dropdown.Toggle variant="default" id="connectedwalletsaction1">
                                            {selectedNetworkIndex == -1 ? <span>Select Network</span> : <React.Fragment><span className="img"><img src={networkList[selectedNetworkIndex].image} /></span> {networkList[selectedNetworkIndex].name}</React.Fragment>}
                                        </Dropdown.Toggle>
                                        <Dropdown.Menu>
                                            {networkList.map((network, i) => {
                                                return(
                                                    <li key={i}>
                                                        <Dropdown.Item onClick={()=>selectNetwork(i)} ><span className="img"><img src={network.image} /></span> {network.name}</Dropdown.Item>
                                                    </li>
                                                )
                                            })}
                                        </Dropdown.Menu>
                                    </Dropdown>
                                </div>
                                <div className="form-group">
                                    <label>Select the wallet</label>
                                    <Dropdown className="">
                                        <Dropdown.Toggle variant="default" id="connectedwalletsaction1">
                                            {selectedWallet? <React.Fragment><span className="img"><img className="max-width-20" src={selectedWallet.image} /></span> {selectedWallet.name} </React.Fragment>: <span>Select Wallet</span>}
                                        </Dropdown.Toggle>
                                        <Dropdown.Menu>
                                        {walletList.map((wallet, i) => {
                                                return(
                                                    <li key={i}>
                                                        <Dropdown.Item onClick={()=>selectWallet(i)} ><span className="img"><img className="max-width-20" src={wallet.image} /></span> {wallet.name}</Dropdown.Item>
                                                    </li>
                                                )
                                            })}
                                        </Dropdown.Menu>
                                    </Dropdown>
                                </div>
                                <div className="form-group">
                                    <label>Name wallet</label>
                                    <input type="text" className="form-control" name="wallet-name" value={walletName} onChange={onInputChange} />
                                </div>
                                <div className="btn-container">
                                    <a onClick={walletConnectConfirm} className="btn btn-primary w-100">Confirm</a>
                                </div>
                            </Modal.Body>
                        </Modal>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default Wallets

