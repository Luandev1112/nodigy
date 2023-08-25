import React, { useMemo, useState, useEffect } from 'react';
import Sidebar from '../common/header/Sidebar';
import Http from "../utils/Http";
import HeaderTopBar from '../common/header/HeaderTopBar';
import { Accordion, Card, Button, Dropdown, Modal } from 'react-bootstrap';
import DotsVerticalImage from "../assets/img/dots-vertical.png";
import IconCopyGreyImage from "../assets/img/icon-copy-grey.png";
import IconCloseModalImage from '../assets/img/icon-close-modal.png';
import { BraavosConnector } from '@web3-starknet-react/braavos-connector'

// Phantom
import {Connection} from "@solana/web3.js";
import Wallet from '@project-serum/sol-wallet-adapter';
import { WalletProvider, useWallet } from '@solana/wallet-adapter-react';
const PHANTOM_WALLET_PUBLIC_KEY = "https://cdn.jsdelivr.net/npm/@solana/wallet-adapter-phantom@1.0.4/dist/esm";

import Web3 from 'web3';
// ether web3 libraries
import Web3Modal from 'web3modal';
import { ethers } from 'ethers';
import TronWeb from 'tronweb';
import { TronLinkAdapter } from '@tronweb3/tronwallet-adapter-tronlink';
import {
    assertIsBroadcastTxResult,
    LcdClient,
    makeSignDoc,
    setupAuthExtension,
    StdFee,
    StdTx,
} from "@cosmjs/launchpad";

const WalletDetail = () => {
    const [tabType, setTabType] = useState('');
    const [tabs, setTabs] = useState([]);
    const [selectedId, setSelectedId] = useState(0);
    const [show, setShow] = useState(false); 
    const [walletAddresses, setWalletAddresses] = useState([]);

    // add wallet modal
    const [selectedNetworkIndex, setSelectedNetworkIndex] = useState(-1);
    const [modalWalletList, setModalWalletList] = useState([]);
    const [selectedWallet, setSelectedWallet] = useState(null);
    const [loading, setLoading] = useState(false);
    const [connectionStatus, setConnectionStatus] = useState(false);
    const [walletName, setWalletName] = useState('');
    const [networkList, setNetworkList] = useState([]);
    const [braavosWallet, setBraavosWallet] = useState('');
    const [editShow, setEditShow] = useState(false);

    const [editTab, setEditTab] = useState('');
    const [editIndex, setEditIndex] = useState(0);

    const web3Modal = typeof window !== 'undefined' && new Web3Modal({ cacheProvider: true });
    const braavosWalletConnector = new BraavosConnector({ supportedChainIds: [1, 5] });
    const mediaUrl = "https://static.nodigy.com/";

    const handleClose = () => {
        setShow(!show);
    }
    const selectNetwork = (idx) => {
        const networkId = networkList[idx].id;
        setSelectedId(networkId);
        initWallets(networkList[idx]);
    }

    const handleEditShow = () => {
        setEditShow(!editShow);
    }

    const initWallets = async (net) => {
        if(!net){
            return;
        }
        const res = await Http.get('/admin/api/getUserNetworkWallets/'+net.id);
        const walletData = res.data.user_wallets;
        const _tabs = res.data.tabs;
        if(_tabs.length > 0) {
            setTabType(_tabs[0]);
        }
        if(walletData.length == 0){
            setWalletAddresses([]);
        }else{
            let _walletAddresses = {};
            walletData.map((wal, i) => {
                _walletAddresses[wal.s_name.toLowerCase()] = [];
                wal.user_wallets.map((userWal, j) => {
                    const wallet = {
                        "id": userWal.id,
                        "name": userWal.wallet_name,
                        "image": userWal.image,
                        "address": userWal.address,
                        "type" : userWal.key,
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
                    _walletAddresses[wal.s_name.toLowerCase()].push(wallet);
                });
            });
            setWalletAddresses(_walletAddresses);
        }
        setTabs(_tabs);
    }


    const selectModalNetwork = async (indexId) => {
        setSelectedNetworkIndex(indexId);
        const networkId = networkList[indexId].id;
        try{
            const res = await Http.get('/admin/api/getNetworkWallets/'+networkId);
            if(res.data.length > 0){
                console.log(res.data);
                setModalWalletList(res.data);
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

    const getBalance = async (provider, walletAddress) => {
        const walletBalance = await provider.getBalance(walletAddress);
        const balanceInEth = ethers.utils.formatEther(walletBalance);
        console.log("balance in eth :", balanceInEth);
    }

    const disconnectMetaMask = () => {
        // setWalletAddresses([]);
        web3Modal && web3Modal.clearCachedProvider();
    }

    const subscribeProvider = async (connection) => {
        connection.on('close', () => {
            disconnectMetaMask();
        });
        connection.on('accountsChanged', async (accounts) => {
            if (accounts.length) {
                console.log(accounts[0]);
                const provider = new ethers.providers.Web3Provider(connection);
                getBalance(provider, accounts[0]);
            } else {
                disconnectMetaMask();
            }
        })
    }

    const disconnectWallet = async (tab, idx) => {
        const address = walletAddresses[tab.toLowerCase()][idx];
        console.log("address => ", address);
        switch (tab.toLowerCase()) {
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
        const res = await Http.get('/admin/api/deleteUserWallet/'+address.id);

        const _network = networkList.find(network => network.id == selectedId);
        initWallets(_network);
    }

    const initMetamask = async () => {
        console.log(window);
        let status = true;
        const web3 = new Web3(window.ethereum);
        const accounts = await web3.eth.getAccounts();
        web3.eth.getChainId().then(chainId => {
            console.log(`Chain ID: ${chainId}`);
        }).catch(error => {
            console.error(error);
        });
        if (accounts.length == 0) {
            status = false;
        } 
        return status;
    };
    const connection = new Connection('https://api.mainnet-beta.solana.com');
    const checkConnection = async () => {
        const wallet = new Wallet(window.solana);
        await wallet.connect();
        const publicKey = wallet.publicKey;
        const balance = await connection.getBalance(publicKey);
        const isConnected = wallet.connected;

        console.log(`Wallet balance: ${balance}`);
        console.log(`Wallet connected: ${isConnected}`);
    }

    const initPhantom = async () => {
        let status = true;
        if (window.solana && window.solana.isPhantom) {
            console.log("Solana:::", window.solana.isConnected);
            if(window.solana.isConnected == true){
                status = true;
            }else{
                status = false;
            }
        } else {
            status = false;
            console.log('Phantom wallet not detected');
        }
        return status;
    }
    
    const disconnectPhantom = () => {
        console.log("Phantom Disconnect:::");
        const provider = window.solana;
        provider.on("disconnect", () => {
            
        });
    }

    const disconnectKeplr = () => {
    }

    const disconnectBraavos = () => {
        
    }

    const initKeplr = async () => {
        let status = true;
        if (window.keplr) {
            const keplrOfflineSigner = window.keplr.getOfflineSigner("cosmoshub-3");
            try {
                const accounts = await keplrOfflineSigner.getAccounts();
                console.log("keplor accounts::: ", accounts);
                status = true;
            } catch (error) {
                status = false;
            }
        } else {
            status = false;
        }
        return status;
    }

    const initBraavos = async () => {
        let status = true;
        if (window.starknet && window.starknet.id == 'braavos') {
            // if(window.starknet.isConnected == true){
            //     status = true;
            // }else{
            //     status = false;
            // }
            status = true;
        } else {
            status = false;
            console.log('please install braavos wallet');
        }
        return status;
    }

    const initTronlink = async() => {
        let status = true;
        if(window.tronWeb){
            const wallet = window.tronWeb.defaultAddress;
            if(!wallet.hex){
                status = false;
            }else{
                status = true;
            }
        }else{
            status = false;
        }
        console.log(status);
        return status;
    }

    const phantomCheck = async() => {
        const provider = new WalletProvider(PHANTOM_WALLET_PUBLIC_KEY, "mainnet-beta");
        console.log("Phantom key : ", provider.pubKey);
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

    // const selectModalNetwork = (indexId) => {
    //     setSelectedNetworkIndex(indexId);
    //     const networkId = networkList[indexId].id;
    //     const selectedNetwork = networkWallets.find(nWallet => nWallet.networkId === networkId);
    //     setModalWalletList(selectedNetwork.wallets);
    //     setSelectedWallet(null);
    // }

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
                    await connectTron();    
                break;
            }
        }else{
            console.log("There is not selected wallet");
        }
        setShow(false);
    }

    const walletEditConfirm = async () => {
        const _wallet = walletAddresses[editTab.toLowerCase()][editIndex];
        let _walletAddresses = walletAddresses;
        _walletAddresses[editTab.toLowerCase()][editIndex].name = walletName;
        const formData = new FormData();
        formData.append('wallet_id', _wallet.id);
        formData.append('wallet_name', walletName);
        const result = await Http.post('admin/api/userWallet/edit', formData);
        if(result.status == 200) {
            setWalletAddresses(_walletAddresses);
            setEditShow(false);
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
            setMetamaskWalletAddress(provider);
            setLoading(false);
            setConnectionStatus(true);
        } catch (error) {
            console.log(error);
            setLoading(false);
            setConnectionStatus(false);
            // console.log("Got this error on connectToWallet catch block while connecting the wallet");
        }
    };

    const connectTron = async() => {
        if(window.tronWeb){
            const tronWeb = new TronWeb({
                fullHost: 'https://api.trongrid.io',
                headers: { 'TRON-PRO-API-KEY': '68aef670-cce7-4035-a985-803332cd7284' },
            });
                        
            const adapter = new TronLinkAdapter();
            // connect
            await adapter.connect();
            const message = 'Wallet connection';
            await adapter.signMessage(message);
            // Prompt the user to sign the hexadecimal message
            // const signedMessage = await tronWeb.trx.sign(messageHex);

            console.log("Ready:", window.tronWeb.ready);
            if(window.tronWeb.ready) {
                const _walletAddress = adapter.address;
                saveUserWallet(_walletAddress);
            }
        }else{
            alert("Please install TronLink Wallet");
        }
        
        // const targetAddress = "TCPnqhNozXMaY4gFxvLWKS26FmPhDHvWvD";
        // // create a send TRX transaction
        // const unSignedTransaction = await tronWeb.transactionBuilder.sendTrx(targetAddress, 10, adapter.address);
        // // using adapter to sign the transaction
        // const signedTransaction = await adapter.signTransaction(unSignedTransaction);
        // // broadcast the transaction
        // const transactionResult = await tronWeb.trx.sendRawTransaction(signedTransaction);
        // console.log(transactionResult);

    }

    const setMetamaskWalletAddress = async (provider) => {
        try {
            const signer = provider.getSigner();
            if(signer) {
                const web3Address = await signer.getAddress();
                getBalance(provider, web3Address);
                saveUserWallet(web3Address);
            }
            
        } catch (error) {
            setConnectionStatus(false);
            console.log("Account not connected; logged from setWalletAddress function");
        }
    };

    const saveUserWallet = async (addr) => {
        const formData = new FormData();
        formData.append('wallet_id', selectedWallet.id);
        formData.append('network_id', selectedWallet.network_id);
        formData.append('wallet_name', walletName);
        formData.append('wallet_address', addr);
        const result = await Http.post('/admin/api/saveUserWallet', formData);
        if(result.data.status == 'success') {
            const _network_id = result.data.wallet.network_id;
            const _network = networkList.find(network => network.id == _network_id);
            console.log("_network", _network);
            initWallets(_network);
        }
        console.log('Result ::: ', result);
    };

    const connectPhantomWallet = async () => {
        console.log("window::", window);
        if (window.solana && window.solana.isPhantom) {
            try{
                const provider = window.solana;
                console.log("solana - ", provider);
                await provider.connect();
                const publicKey = provider.publicKey;
                console.log("public key:", publicKey);

                const message = 'Wallet connection';
                const encodedMessage = new TextEncoder().encode(message);
                const signedMessage = await provider.signMessage(encodedMessage, "utf8");

                saveUserWallet(publicKey);
                const signer = {
                    publicKey,
                    signTransaction: async (transaction) => {
                        const signedTransaction = await provider.signTransaction(transaction);
                        return signedTransaction;
                    },
                };
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
                console.log("Keplr Offline Signer : ", keplrOfflineSigner);
                const accounts = await keplrOfflineSigner.getAccounts();
                const [{ address }] = accounts;
                const keplrSigner = {
                    async sign(signBytes) {
                        console.log("sign direct ...");
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

                const memo = "Time for action";


                saveUserWallet(kpWallet);
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
            const signer = braavosWalletConnector.getAccount();
            // console.log("BraavosWallet Signer : ", braavosWallet, signer);
            // const message = 'Wallet connection';
            // const messageData = JSON.stringify(message);
            // const signedMessage = await signer.signMessage(message, braavosWallet);
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
    };

    const checkLockedWallets = async () => {
        try {
            const res = await Http.get('/admin/api/getAddedUserWallets');
            const _addedWallets = res.data.wallets;
            if(_addedWallets.length > 0) {
                _addedWallets.map(async (wallet, i)=>{
                    let walletStatus = true;
                    switch(wallet.supp_wallet_name.toLowerCase()) {
                        case 'metamask':
                            walletStatus = await initMetamask();
                        break;
                        case 'phantom':
                            walletStatus = await initPhantom();
                            break;
                        case 'braavos':
                            walletStatus = await initBraavos();
                            break;
                        case 'keplr':
                            walletStatus = await initKeplr();
                            break;
                        case 'tronlink':
                            walletStatus = initTronlink();    
                            break;
                    }
                    if (walletStatus) {
                        return wallet;
                    } else {
                        console.log("Wallet:::", wallet);
                        const res = await Http.get('/admin/api/deleteUserWallet/' + wallet.id);
                        return null;
                    }
                });
            }
        } catch{

        }
    }

    const getNetworks = async () => {
        try{
            const res = await Http.get('/admin/api/getNetworks');
            if(res.data.length > 0){
                setNetworkList(res.data);  
                initWallets(res.data[0]);
                setSelectedId(res.data[0].id);
            }
        }catch(err){
            console.log("Network List error");
        }
    }

    const getNetworkWallets = async () => {
        try {
            const res = await Http.get('/admin/api/getUserNetworkWallets');
            
        }catch{

        }
    }

    const showEditModal = (tab, idx) => {
        setEditIndex(idx);
        setEditTab(tab);
        const _address = walletAddresses[tab.toLowerCase()][idx];
        setWalletName(_address.name);
        setEditShow(true);
    }


    useEffect(() => {
        checkLockedWallets();
        getNetworks();
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
                                            <div className={selectedId == network.id ? "items active" : "items"} key={i} role="button" onClick={() => selectNetwork(i)}>
                                                <div className="img"><img src={mediaUrl+"network_logo/" + network.network_logo} /></div>
                                                <div className="text">
                                                    <p><strong>{network.network_name}({network.counts})</strong> {network.network_description}</p>
                                                </div>
                                            </div>
                                        )
                                    })}
                                </div>
                            </div>
                            <div className="connectedwallets">
                                <div className="head">
                                    <span>Connected Wallets</span>
                                    <a className="btn-add-new-wallet" role="button" onClick={handleClose}>Add New</a>
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
                                                    {selectedNetworkIndex == -1 ? <span>Select Network</span> : <React.Fragment><span className="img"><img src={mediaUrl+"network_logo/"+networkList[selectedNetworkIndex].network_logo} /></span> {networkList[selectedNetworkIndex].network_name}</React.Fragment>}
                                                    </Dropdown.Toggle>
                                                    <Dropdown.Menu>
                                                    {networkList.map((network, i) => {
                                                        return(
                                                            <li key={i}>
                                                                <Dropdown.Item onClick={()=>selectModalNetwork(i)} ><span className="img"><img src={mediaUrl+"network_logo/"+network.network_logo} /></span> {network.network_name}</Dropdown.Item>
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
                                                    {modalWalletList.map((wallet, i) => {
                                                        return(
                                                            <li key={i}>
                                                                <Dropdown.Item onClick={()=>selectModalWallet(i)} ><span className="img"><img className="max-width-20" src={mediaUrl+"wallet_logo/"+wallet.wallet_logo} /></span> {wallet.supp_wallet_name}</Dropdown.Item>
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
                                
                                <Modal show={editShow} onHide={handleEditShow} id="add-new-wallet-modal ">
                                    <Modal.Header>
                                        <h4 className="modal-title w-100 text-center" id="myModalLabel">Edit Wallet</h4>
                                        <button type="button" className="close" onClick={handleEditShow}>
                                            <img src={IconCloseModalImage} />
                                        </button>
                                    </Modal.Header>
                                    <Modal.Body>
                                        <div className="form-group">
                                            <label>Change wallet name</label>
                                            <input type="text" name="wallet-name" className="form-control" value={walletName} onChange={onInputChange} />
                                        </div>
                                        <div className="btn-container">
                                            <a className="btn btn-primary w-100" onClick={walletEditConfirm}>Confirm</a>
                                        </div>
                                    </Modal.Body>
                                </Modal>

                                <ul className="nav nav-tabs" role="tablist">
                                {
                                    tabs.map((tab, i) => {
                                        return (
                                            <li key={i} role="presentation" className={tabType == tab ? "active" : ""} >
                                                <a onClick={() => setTabType(tab)} role="button">{tab}({walletAddresses[tab.toLowerCase()]?.length})</a>
                                            </li>
                                        )
                                    })
                                }
                                </ul>
                                <div className="tab-content">
                                {
                                    Object.keys(walletAddresses).length > 0 &&
                                    tabs.map((tab, i) => {
                                        return(
                                            <div className={tabType == tab ? "tab-pane active" : "tab-pane"} id="bitpie" role="tabpanel" aria-labelledby="bitpie-tab" key={i}>
                                                {
                                                    walletAddresses.hasOwnProperty(tab.toLowerCase()) &&
                                                    walletAddresses[tab.toLowerCase()].length > 0 && 
                                                    walletAddresses[tab.toLowerCase()].map((wallet, j)=>{
                                                        return (
                                                            <div className="items" key={j}>
                                                                <div className="action">
                                                                    <Dropdown className="">
                                                                        <Dropdown.Toggle variant="" id="">
                                                                            <img src={DotsVerticalImage} />
                                                                        </Dropdown.Toggle>
                                                                        <Dropdown.Menu>
                                                                            <li className="edit"><Dropdown.Item onClick={()=>showEditModal(tab, j)}>Edit</Dropdown.Item></li>
                                                                            <li className="delete"><Dropdown.Item onClick={() => disconnectWallet(tab, j)}>Disconnect</Dropdown.Item></li>
                                                                        </Dropdown.Menu>
                                                                    </Dropdown>
                                                                </div>
                                                                <div className="row1">
                                                                    <div className="img"><img src={mediaUrl+"wallet_logo/"+wallet.image} /></div>
                                                                    <p>
                                                                        <span className="text1">{wallet.name}</span>
                                                                        <span className="text2">{wallet.address} <a href="#"><img src={IconCopyGreyImage} /></a></span>
                                                                    </p>
                                                                </div>
                                                                <div className="row2">
                                                                    {wallet.tokens.map((token, t) => {
                                                                        return (
                                                                            <a role="button" key={t}><img src={token.image} /> {token.name}({token.count})</a>
                                                                        )
                                                                    })}
                                                                </div>
                                                            </div>
                                                        )
                                                    })
                                                    
                                                }
                                            </div>
                                        )                                        
                                    })
                                }
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
