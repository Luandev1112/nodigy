import React, { useMemo, useState, useEffect } from 'react';
import Sidebar from '../common/header/Sidebar';
import { Link } from "react-router-dom";
import HeaderTopBar from '../common/header/HeaderTopBar';
import { Accordion, Card, Button, Dropdown, Modal } from 'react-bootstrap';
import DotsVerticalImage from "../assets/img/dots-vertical.png";
import IconCopyGreyImage from "../assets/img/icon-copy-grey.png";
import IconCloseModalImage from '../assets/img/icon-close-modal.png';
import DropdownImage from '../assets/img/dropdown-img1.png';
import networkList from '../data/wallet/networkList.json';
import walletList from '../data/wallet/walletList.json';
import networkWallets from '../data/wallet/networkWallets.json';
import { BraavosConnector } from '@web3-starknet-react/braavos-connector'

// Phantom
import {Connection} from "@solana/web3.js";
import Wallet from '@project-serum/sol-wallet-adapter';
import { PhantomWalletAdapter } from '@solana/wallet-adapter-phantom';
import { WalletProvider, useWallet } from '@solana/wallet-adapter-react';
const PHANTOM_WALLET_PUBLIC_KEY = "https://cdn.jsdelivr.net/npm/@solana/wallet-adapter-phantom@1.0.4/dist/esm";

import Web3 from 'web3';
// ether web3 libraries
import Web3Modal, { local, providers } from 'web3modal';
import { ethers } from 'ethers';
import { fstat } from 'fs';
import { stringify } from 'querystring';


const WalletDetail = () => {
    const [tabType, setTabType] = useState('opera');
    const [selectedId, setSelectedId] = useState(0);
    const [show, setShow] = useState(false);
    const [walletAddresses, setWalletAddresses] = useState(walletList);

    // get chain wallets from sessionStorage
    const [evmNet, setEvmNet] = useState(JSON.parse(sessionStorage.getItem('evm')));
    const [solanaNet, setSolanaNet] = useState(JSON.parse(sessionStorage.getItem('solana')));
    const [cosmosNet, setCosmosNet] = useState(JSON.parse(sessionStorage.getItem('cosmos')));
    const [starkNet, setStarkNet] = useState(JSON.parse(sessionStorage.getItem('starknet')));

    // add wallet modal
    const [selectedNetworkIndex, setSelectedNetworkIndex] = useState(-1);
    const [modalWalletList, setModalWalletList] = useState([]);
    const [selectedWallet, setSelectedWallet] = useState(null);
    const [loading, setLoading] = useState(false);
    const [connectionStatus, setConnectionStatus] = useState(false);
    const [walletName, setWalletName] = useState('');

    const web3Modal = typeof window !== 'undefined' && new Web3Modal({ cacheProvider: true });
    const braavosWalletConnector = new BraavosConnector({ supportedChainIds: [1, 5] });

    const handleClose = () => {
        setShow(!show);
    }
    const selectNetwork = (idx) => {
        const networkId = networkList[idx].id;
        setSelectedId(networkId);
        const networkName = networkList[idx].name;
        switch (networkName) {
            case 'EVM':
                initWallets(evmNet);
                break;
            case 'Solana':
                initWallets(solanaNet);
                break;
            case 'Cosmos':
                initWallets(cosmosNet);
                break;
            case 'StarkNet':
                initWallets(starkNet);
                break;
        }
    }

    const initWallets = (net) => {
        const objKeys = Object.keys(net);
        let _wallets = []
        if(objKeys.length == 0){
            setWalletAddresses([]);
        }else{
            objKeys.map((key) => {
                switch (key){
                    case 'metamask':
                        initMetamask();
                    break;
                    case 'phantom':
                        initPhantom();
                    break;
                }
                const wallet = {
                    "id": 1,
                    "name": net[key].name,
                    "image": "/assets/images/"+key+".png",
                    "address": net[key].address,
                    "type" : key,
                    "tokens": [
                        {
                            "id": 1,
                            "name": "Forta",
                            "image": "/assets/images/logo-icon 1.png",
                            "count": 2
                        },
                        {
                            "id": 1,
                            "name": "NYM",
                            "image": "/assets/images/logo-icon 1.png",
                            "count": 3
                        }
                    ]
                };
                _wallets.push(wallet);
                setWalletAddresses(_wallets);
            });
        }
    }

    const onInputChange = (e) => {
        e.preventDefault();
        if(e.target.name == 'wallet-name'){
            setWalletName(e.target.value);
        }
        console.log(e.target.name);
    }

    const checkWallets = () => {
        if(evmNet && evmNet.metamask) {
            initMetamask();
        }
    }

    const getBalance = async (provider, walletAddress) => {
        const walletBalance = await provider.getBalance(walletAddress);
        const balanceInEth = ethers.utils.formatEther(walletBalance);
        console.log("balance in eth :", balanceInEth);
    }

    const disconnectMetaMask = () => {
        // setWalletAddresses([]);
        web3Modal && web3Modal.clearCachedProvider();

        const evm = sessionStorage.getItem('evm');
        if(evm){
            let _evm = JSON.parse(evm);
            delete _evm.metamask;
            sessionStorage.setItem('evm', JSON.stringify(_evm));
            setEvmNet(_evm);
            initWallets(_evm);
        }
    }

    const subscribeProvider = async (connection) => {
        console.log("Connection", connection);
        connection.on('close', () => {
            disconnectMetaMask();
        });
        connection.on('accountsChanged', async (accounts) => {
            if (accounts.length) {
                console.log(accounts[0]);
                const evm = sessionStorage.getItem('evm');
                if(evm){
                    let _evm = JSON.parse(evm);
                    _evm.metamask.address = accounts[0];
                    sessionStorage.setItem('evm', JSON.stringify(_evm));
                    setEvmNet(_evm);
                    initWallets(_evm);
                }
                const provider = new ethers.providers.Web3Provider(connection);
                getBalance(provider, accounts[0]);
            } else {
                disconnectMetaMask();
            }
        })
    }

    const disconnectWallet = (type) => {
        switch (type) {
            case 'metamask':
                disconnectMetaMask();
                break;
            case 'phantom':
                disconnectPhantom();
                break;   
            case 'keplr':
                disconnectKeplr();
                break;   
            case 'braavos':
                disconnectBraavos();
                break;   
        }
    }

    const initMetamask = async () => {
        const web3 = new Web3(window.ethereum);
        const accounts = await web3.eth.getAccounts();
        console.log("Init Metamask =============");
        web3.eth.getChainId().then(chainId => {
            console.log(`Chain ID: ${chainId}`);
        }).catch(error => {
            console.error(error);
        });
        if (accounts.length > 0) {
            const connection = web3Modal && (await web3Modal.connect());
            const provider = new ethers.providers.Web3Provider(connection);
            const signer = provider.getSigner();
            if (signer) {
                const web3Address = await signer.getAddress();
                await subscribeProvider(connection);
                getBalance(provider, web3Address);
            }
        } else {
            setWalletAddresses([]);
        }
    };

    const connection = new Connection('https://api.mainnet-beta.solana.com');
    const wallet = new Wallet(window.solana);
    const checkConnection = async () => {
        await wallet.connect();
        const publicKey = wallet.publicKey;
        const balance = await connection.getBalance(publicKey);
        const isConnected = wallet.connected;

        console.log(`Wallet balance: ${balance}`);
        console.log(`Wallet connected: ${isConnected}`);
    }

    const initPhantom = async () => {
        if (window.solana && window.solana.isPhantom) {
            const { solana } = window;
            const web3 = new Web3(window.solana);
            console.log("Init Solana =============");
            console.log(window.solana);
            // web3.eth.getChainId().then(chainId => {
            //     console.log(`Chain ID: ${chainId}`);
            // }).catch(error => {
            //     console.error(error);
            // });
            try {
                const response = await solana.connect({ onlyIfTrusted: true });
                const pubKey = response.publicKey.toString();
                console.log(pubKey);
            } catch (error) {
                console.log(error);
                disconnectPhantom();
            }
        } else {
            console.log('Phantom wallet not detected');
        }
    }

    const disconnectPhantom = () => {
        const solana = sessionStorage.getItem('solana');
        if(solana){
            let _solana = JSON.parse(solana);
            delete _solana.phantom;
            sessionStorage.setItem('solana', JSON.stringify(_solana));
            setSolanaNet(_solana);
            initWallets(_solana);
        }
    }

    const disconnectKeplr = () => {
        const cosmos = sessionStorage.getItem('cosmos');
        if(cosmos){
            let _cosmos = JSON.parse(cosmos);
            delete _cosmos.keplr;
            sessionStorage.setItem('cosmos', JSON.stringify(_cosmos));
            setCosmosNet(_cosmos);
            initWallets(_cosmos);
        }
    }

    const disconnectBraavos = () => {
        const starknet = sessionStorage.getItem('starknet');
        if(starknet){
            let _starknet = JSON.parse(starknet);
            delete _starknet.braavos;
            sessionStorage.setItem('starknet', JSON.stringify(_starknet));
            setStarkNet(_starknet);
            initWallets(_starknet);
        }
    }

    const initKeplr = async () => {
        if (window.keplr) {
            const keplrOfflineSigner = window.keplr.getOfflineSigner("cosmoshub-3");
            try {
                const accounts = await keplrOfflineSigner.getAccounts();
                console.log(accounts);
            } catch (error) {
                console.log(error);
            }
        } else {
            console.error("Please install Keplr wallet extension");
        }
    }

    const initBraavos = async () => {
        if (window.starknet && window.starknet.id == 'braavos') {
            const auth = await braavosWalletConnector.isAuthorized();
            if (auth) {
                await braavosWalletConnector.activate();
                const walletAddress = braavosWalletConnector.getConnectedAddress();
            } else {

            }
        } else {
            console.log('please install braavos wallet');
        }
    }

    const phantomCheck = async() => {
        const provider = new WalletProvider(PHANTOM_WALLET_PUBLIC_KEY, "mainnet-beta");

        if (provider.publicKey) {
            console.log('public key : ', provider.publicKey);
        }

        provider.on("connect", () => {
            console.log('public key : ', provider.publicKey);
        });

        provider.on("disconnect", () => {
            console.log('public key : ', provider.publicKey);
        });

        return () => {
            provider.disconnect();
        }
    }

    const selectModalNetwork = (indexId) => {
        setSelectedNetworkIndex(indexId);
        const networkId = networkList[indexId].id;
        const selectedNetwork = networkWallets.find(nWallet => nWallet.networkId === networkId);
        setModalWalletList(selectedNetwork.wallets);
        setSelectedWallet(null);
    }

    const selectModalWallet = (indexId) => {
        if(modalWalletList.length == 0){
            setSelectedWallet(null);
        }else{
            setSelectedWallet(modalWalletList[indexId]);
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
        setShow(false);
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
    };

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
    };

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
    };

    useEffect(() => {
        setSelectedId(networkList[0].id);
        initWallets(evmNet);
        // phantomCheck();
    }, []);
    return (
        <div className="wrapper wallets">
            <Sidebar menu="wallets" />
            <div className="wrapper-content">
                <HeaderTopBar menu="wallets" />
                <div className="wallets-details">
                    <div className="box">
                        <div className="wrapp">
                            <div className="networkpanel">
                                <div className="head">Networks</div>
                                <div className="n_p_scroll">
                                    {networkList.map((network, i) => {
                                        return (
                                            <div className={selectedId == network.id ? "items active" : "items"} key={i} onClick={() => selectNetwork(i)}>
                                                <div className="img"><img src={network.image} /></div>
                                                <div className="text">
                                                    <p><strong>{network.name}({network.counts})</strong> {network.description}</p>
                                                </div>
                                            </div>
                                        )
                                    })}
                                </div>
                            </div>
                            <div className="connectedwallets">
                                <div className="head">
                                    <span>Connected Wallets</span>
                                    <a className="btn-add-new-wallet" onClick={handleClose}>Add New</a>
                                    {/*Add New Wallet Modal*/}
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
                                                                    <Dropdown.Item onClick={()=>selectModalNetwork(i)} ><span className="img"><img src={network.image} /></span> {network.name}</Dropdown.Item>
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
                                                    {modalWalletList.map((wallet, i) => {
                                                        return(
                                                            <li key={i}>
                                                                <Dropdown.Item onClick={()=>selectModalWallet(i)} ><span className="img"><img className="max-width-20" src={wallet.image} /></span> {wallet.name}</Dropdown.Item>
                                                            </li>
                                                        )
                                                    })}
                                                    </Dropdown.Menu>
                                                </Dropdown>
                                            </div>
                                            <div className="form-group">
                                                <label>Name wallet</label>
                                                <input type="text" name="wallet-name" className="form-control" value={walletName} onChange={onInputChange} />
                                            </div>
                                            <div className="btn-container">
                                                <a className="btn btn-primary w-100" onClick={walletConnectConfirm}>Confirm</a>
                                            </div>
                                        </Modal.Body>
                                    </Modal>
                                </div>
                                <ul className="nav nav-tabs" role="tablist">
                                    <li role="presentation" className={tabType == 'opera' ? "active" : ""} >
                                        <a onClick={() => setTabType('opera')}>Opera(3)</a>
                                    </li>
                                    <li role="presentation" className={tabType == 'bitpie' ? "active" : ""} >
                                        <a onClick={() => setTabType('bitpie')}>Bitpie(1)</a>
                                    </li>
                                    <li role="presentation" className={tabType == 'brave' ? "active" : ""} >
                                        <a onClick={() => setTabType('brave')}>brave(1)</a>
                                    </li>
                                    <li role="presentation" className={tabType == 'coinBase-dapp' ? "active" : ""}>
                                        <a onClick={() => setTabType('coinBase-dapp')}>CoinBase Dapp(1)</a>
                                    </li>
                                    <li role="presentation" className={tabType == 'Metamask' ? "active" : ""}>
                                        <a href="#Metamask" onClick={() => setTabType('Metamask')}>Metamask(3)</a>
                                    </li>
                                    <li role="presentation" className={tabType == 'wallet3' ? "active" : ""}>
                                        <a href="#wallet3" onClick={() => setTabType('wallet3')}>Wallet3(1)</a>
                                    </li>
                                </ul>
                                <div className="tab-content">
                                    <div className={tabType == 'opera' ? "tab-pane active" : "tab-pane"} id="opera" role="tabpanel" aria-labelledby="opera-tab">
                                        {walletAddresses.map((wallet, i) => {
                                            return (
                                                <div className="items" key={i}>
                                                    <div className="action">
                                                        <Dropdown className="">
                                                            <Dropdown.Toggle variant="" id="">
                                                                <img src={DotsVerticalImage} />
                                                            </Dropdown.Toggle>
                                                            <Dropdown.Menu>
                                                                <li className="edit"><Dropdown.Item href="#">Edit</Dropdown.Item></li>
                                                                <li className="delete"><Dropdown.Item onClick={() => disconnectWallet(wallet.type)}>Disconnect</Dropdown.Item></li>
                                                            </Dropdown.Menu>
                                                        </Dropdown>
                                                    </div>
                                                    <div className="row1">
                                                        <div className="img"><img src={wallet.image} /></div>
                                                        <p>
                                                            <span className="text1">{wallet.name}</span>
                                                            <span className="text2">{wallet.address} <a href="#"><img src={IconCopyGreyImage} /></a></span>
                                                        </p>
                                                    </div>
                                                    <div className="row2">
                                                        {wallet.tokens.map((token, t) => {
                                                            return (
                                                                <a href="#" key={t}><img src={token.image} /> {token.name}({token.count})</a>
                                                            )
                                                        })}
                                                    </div>
                                                </div>
                                            )
                                        })}
                                    </div>
                                    <div className={tabType == 'bitpie' ? "tab-pane active" : "tab-pane"} id="bitpie" role="tabpanel" aria-labelledby="bitpie-tab">2</div>
                                    <div className={tabType == 'brave' ? "tab-pane active" : "tab-pane"} id="brave" role="tabpanel" aria-labelledby="brave-tab">3</div>
                                    <div className={tabType == 'coinBase-dapp' ? "tab-pane active" : "tab-pane"} id="coinBase-dapp" role="tabpanel" aria-labelledby="coinBase-dapp-tab">...</div>
                                    <div className={tabType == 'metamask' ? "tab-pane active" : "tab-pane"} id="metamask" role="tabpanel" aria-labelledby="metamask-tab">...</div>
                                    <div className={tabType == 'wallet3' ? "tab-pane active" : "tab-pane"} id="wallet3" role="tabpanel" aria-labelledby="wallet3-tab">...</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default WalletDetail
