import React, {useState, useEffect} from 'react';
import { useNavigate } from 'react-router-dom';
import Http from "../utils/Http";
import Sidebar from '../common/header/Sidebar';
import HeaderTopBar from '../common/header/HeaderTopBar';
import { Button, Dropdown, Modal } from 'react-bootstrap';
import WalletsBlankImage from '../assets/img/wallets-blank-img.png';
import IconCloseModalImage from '../assets/img/icon-close-modal.png';

import { Connection, PublicKey, SystemProgram, Transaction } from '@solana/web3.js';
import { SigningStargateClient, makeSignDoc } from "@cosmjs/stargate";
// Braavos Wallet
import { BraavosConnector } from '@web3-starknet-react/braavos-connector';
// import Web3 from 'web3';
import Web3Modal, { providers } from 'web3modal';
// Tron
import TronWeb from 'tronweb';
import { TronLinkAdapter } from '@tronweb3/tronwallet-adapter-tronlink';

const Wallets = ({setPath}) => {
    const [show, setShow] = useState(false);
    const [selectedNetworkIndex, setSelectedNetworkIndex] = useState(-1);
    const [networkList, setNetworkList] = useState([]);
    const [walletList, setWalletList] = useState([]);
    const [selectedWallet, setSelectedWallet] = useState(null);
    const [loading, setLoading] = useState(false);
    const [connectionStatus, setConnectionStatus] = useState(false);
    const web3Modal = typeof window !== 'undefined' && new Web3Modal({ cacheProvider: true });
    const [walletName, setWalletName] = useState('');
    const [walletAddress, setWalletAddress] = useState();
    //Phantom wallet 
    const [connected, setConnected] = useState(false);
    const [braavosWallet, setBraavosWallet] = useState(null);
    // braavos wallet
    const ethers = require("ethers");
    const braavosWalletConnector = new BraavosConnector({ supportedChainIds: [1,5] });
    const mediaUrl = "https://static.nodigy.com/";

    const navigate = useNavigate();

    const handleClose = () => {
        setShow(!show);
    }

    const checkInstalledWallets = async() => {
        const res = await Http.get('/admin/api/checkeInstalledWallets');
        console.log("user wallet data : ", res.data);
        if(res.data.result == 1) {
            navigate('/admin/wallet-details');
        }else{
            console.log("this page");
        }
    }
    checkInstalledWallets();

    const selectNetwork = async (indexId) => {
        setSelectedNetworkIndex(indexId);
        const networkId = networkList[indexId].id;
        try{
            const res = await Http.get('/admin/api/getNetworkWallets/'+networkId);
            if(res.data.length > 0){
                console.log(res.data);
                setWalletList(res.data);
                setSelectedWallet(null);
                setWalletName('');
            }
        }catch(err){
            
        }
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
            console.log('wallet list : ', walletList);
            setSelectedWallet(walletList[indexId]);
        }
    }

    const walletConnectConfirm = async () => {
        if(selectedWallet)
        {
            const walletName = selectedWallet.supp_wallet_name.toLowerCase();
            switch(walletName){
                case 'metamask':
                    await metamaskConnect();
                break;
                case 'phantom':
                    await connectPhantomWallet();
                break;
                case 'keplr':
                    await connectToKeplr();
                break;
                case 'braavos':
                    await connectBraavosWallet();
                break;
                case 'tronlink':
                    await connectTronLink();
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
            if(window.ethereum.isConnected()){
                await window.ethereum.request({
                    method: "wallet_requestPermissions",
                    params: [
                      { eth_accounts: {} }, // Empty permissions to disconnect the wallet
                    ],
                });
            }
            const connection = web3Modal && (await web3Modal.connect());
            const provider = new ethers.providers.Web3Provider(connection);
            await subscribeProvider(connection);
            setMetamaskAddress(provider);
            setLoading(false);
            setConnectionStatus(true);
        } catch (error) {
            console.log(error);
            setLoading(false);
            setConnectionStatus(false);
            console.log("Got this error on connectToWallet catch block while connecting the wallet");
        }
    };

    const setMetamaskAddress = async (provider) => {
        try {
            const signer = provider.getSigner();
            if(signer) {
                const web3Address = await signer.getAddress();
                setWalletAddress(web3Address);
                getBalance(provider, web3Address);
                saveUserWallet(web3Address);
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
                await provider.connect();
                const connection = new Connection('https://api.mainnet-beta.solana.com');
                const publicKey = provider.publicKey;
                console.log("Phantom Public Key : " + publicKey);

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
                saveUserWallet(kpWallet);
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
            saveUserWallet(braavosWallet);
            setConnectionStatus(true);
        } catch (error) {
            setConnectionStatus(false);
            console.error(error);
        }
    }

    const connectTronLink = async() => {
        if(window.tronWeb){
            const tronWeb = new TronWeb({
                fullHost: 'https://api.trongrid.io',
                headers: { 'TRON-PRO-API-KEY': 'your api key' },
            });
            
            const adapter = new TronLinkAdapter();
            // connect
            await adapter.connect();
            console.log("Ready:", window.tronWeb.ready);
            if(window.tronWeb.ready) {
                const _walletAddress = adapter.address;
                saveUserWallet(_walletAddress);
                setConnectionStatus(true);
            }else{
                setConnectionStatus(false);
            }
        }else{
            setConnectionStatus(false);
            alert("Please install TronLink Wallet");
        }
    }

    const getNetwork = async () => {
        try{
            const res = await Http.get('/admin/api/getNetworks');
            if(res.data.length > 0){
                console.log(res.data);
                setNetworkList(res.data);
            }
        }catch(err){
            
        }
    }

    const saveUserWallet = async (addr) => {
        const formData = new FormData();
        formData.append('wallet_id', selectedWallet.id);
        formData.append('network_id', selectedWallet.network_id);
        formData.append('wallet_name', walletName);
        formData.append('wallet_address', addr);
        const result = await Http.post('/admin/api/saveUserWallet', formData);
        console.log('Result ::: ', result);
    };

    useEffect(()=>{
        setPath('wallets');
        getNetwork();
        if(connectionStatus){
            navigate("/admin/wallet-details");
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
                                            {selectedNetworkIndex == -1 ? <span>Select Network</span> : <React.Fragment><span className="img"><img src={mediaUrl+"network_logo/"+networkList[selectedNetworkIndex].network_logo} /></span> {networkList[selectedNetworkIndex].network_name}</React.Fragment>}
                                        </Dropdown.Toggle>
                                        <Dropdown.Menu>
                                            {networkList.map((network, i) => {
                                                return(
                                                    <li key={i}>
                                                        <Dropdown.Item onClick={()=>selectNetwork(i)} ><span className="img"><img src={mediaUrl+"network_logo/"+network.network_logo} /></span> {network.network_name}</Dropdown.Item>
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
                                            {selectedWallet? <React.Fragment><span className="img"><img className="max-width-20" src={mediaUrl+"wallet_logo/"+selectedWallet.wallet_logo} /></span> {selectedWallet.supp_wallet_name} </React.Fragment>: <span>Select Wallet</span>}
                                        </Dropdown.Toggle>
                                        <Dropdown.Menu>
                                            {walletList.map((wallet, i) => {
                                                return(
                                                    <li key={i}>
                                                        <Dropdown.Item onClick={()=>selectWallet(i)} ><span className="img"><img className="max-width-20" src={mediaUrl+"wallet_logo/"+wallet.wallet_logo} /></span> {wallet.supp_wallet_name}</Dropdown.Item>
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

