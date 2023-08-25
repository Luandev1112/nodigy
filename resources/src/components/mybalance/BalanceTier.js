import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import { Button, Dropdown, Form, Modal } from 'react-bootstrap';
import Graphimage from "../../assets/img/stats.png";
import TierIcon1 from "../../assets/img/dashboard-tier1-icon1.png";
import IconCopyImage from "../../assets/img/icon-copy.png";
import IconAddFundsImage from "../../assets/img/icon-add-funds.svg";
import IconWithdrawImage from "../../assets/img/icon-withdraw.svg";
import IconExportExlsImage from "../../assets/img/icon-export-to-exls.svg";
import IconCloseModalImage from '../../assets/img/icon-close-modal.png';
import IconCopy from '../../assets/img/icon-copy.png';
import AddFundsImage from '../../assets/img/add-funds-img.png';
import WithdrawSecondImage from '../../assets/img/withdrawsecond-img.png';
import { TronLinkAdapter } from '@tronweb3/tronwallet-adapter-tronlink';
import TronWeb from 'tronweb';
import Http from "../../utils/Http";

import Web3 from 'web3';
// ether web3 libraries
import Web3Modal from 'web3modal';
import { ethers } from 'ethers';

const BalanceTier = ({changeBalance}) => {
    const [funds, setFunds] = useState(false);
    const [withdraw, setWithdraw] = useState(false);
    const [fundSuccess, setFundSuccess] = useState(false);
    const [withdrawSuccess, setWithdrawSuccess] = useState(false);
    const [tronWeb, setTronWeb] = useState(null);
    const [walletName, setWalletName] = useState("TronLink");
    const [walletAddress, setWalletAddress] = useState('');
    const [amount, setAmount] = useState(0);
    const [addressAmount, setAddresAmount] = useState(0);
    const [transactionStatus, setTransactionStatus] = useState(false);
    const [balanceAddress, setBalanceAddress] = useState("");
    const [transactionId, setTransactionId] = useState("");
    const web3Modal = typeof window !== 'undefined' && new Web3Modal({ cacheProvider: true });
    // const contractWalletAddress = "TR7NHqjeKQxGTCi8q8ZY4pL8otSzgjLj6t";
    const contractWalletAddress = "TXYZopYRdj2D9XRtbG411XZZ3kM5VkAeBf";
    
    const receiverAddress = "TJ4jSwMBREYysPQcjATTy52AXdXrdVXhM2";
    // const receiverAddress = "TCPnqhNozXMaY4gFxvLWKS26FmPhDHvWvD";
    const transactionUrl = "https://nile.tronscan.io/#/transaction/";


    const getUser = async () => {
        const user = await Http("/admin/getuser");
        if(user.data) {
            // setLoggedUser(user.data);
            setAddresAmount(user.data.balance);
        }
    }

    const handleFunds = async() => {
        setFunds(!funds);
        if(!funds){
            await selectTronLink();
        }
    }
    const handleWithdraw = async() => {
        setWithdraw(!withdraw);
        if(!withdraw){
            await selectTronLink();
        }
    }

    const handleAddFunds = async() => {
        if(walletAddress == '')
        {
            return;
        }
        if(!fundSuccess) {
            if(amount*1 > 0) {
                console.log(amount);
                try {
                    const { abi } = await tronWeb.trx.getContract(contractWalletAddress);
                    console.log("abi :=>", abi);
                    const usdtContract = tronWeb.contract(abi.entrys, contractWalletAddress);
                    const balance = await usdtContract.methods.balanceOf(walletAddress).call();
                    const walletBalance = Number(balance) / 1000000;
                    console.log("balance : ", walletBalance);
                    if(amount*1 > walletBalance) {
                        alert("Wallet balance hasn't enough money");
                        return;
                    }

                    var senderAddress = walletAddress;
                    var _amount = amount * 1000000;

                    var parameter = [{type:'address',value:receiverAddress},{type:'uint256',value:_amount}];
                    var options = {
                        feeLimit:100000000                    
                    };

                    const transactionObject = await tronWeb.transactionBuilder.triggerSmartContract(
                        tronWeb.address.toHex(contractWalletAddress), 
                        "transfer(address,uint256)", 
                        options, 
                        parameter,
                        tronWeb.address.toHex(senderAddress)
                    );

                    var signedTransaction = await tronWeb.trx.sign(transactionObject.transaction);
                    var broadcastTransaction = await tronWeb.trx.sendRawTransaction(signedTransaction);
                    console.log("broadcast transaction: ", broadcastTransaction);
                    if(broadcastTransaction.result){
                        const _transactionId = broadcastTransaction.txid;
                        console.log("transaction time : ", broadcastTransaction.transaction.raw_data.timestamp);
                        setTransactionId(_transactionId);
                        const formData = new FormData();
                        formData.append('wallet_name', walletName);
                        formData.append('amount', amount*1);
                        formData.append('wallet_address', walletAddress);
                        formData.append('transaction_id', _transactionId);
                        formData.append('success', 1);
                        formData.append('date', broadcastTransaction.transaction.raw_data.timestamp);
                        const result = await Http.post('admin/api/walletPayment', formData);
                        if(result.data.user){
                            const _addressAmount = result.data.user.balance;
                            setAddresAmount(_addressAmount);
                            changeBalance(_addressAmount);
                            setFundSuccess(true);
                            setTransactionStatus(true);
                        }
                    }else{
                        setFundSuccess(true);
                        setTransactionStatus(false);
                    }
                } catch (error) {
                    console.log("error",error);
                    setFundSuccess(true);
                    setTransactionStatus(false);
                }
            }
        }else{
            setFunds(false);
            setAmount(0);
            setWalletAddress("");
            setWalletName("TronLink");
            setFundSuccess(false);
        }
    }

    const handleAddWithdraw = async() => {
        if(walletAddress == '')
        {
            return;
        }
        if(!withdrawSuccess) {   
            if(amount*1 < addressAmount*1 && amount*1 > 0) {
                const token = 'token';
                const additionalUrl = 'wallet='+walletAddress+'&amount='+amount+'&token='+token;
                const res = await Http.get('https://w3api.nodigy.com/getAdminData?'+additionalUrl);

                if(res.data.result == 0) {
                    setWithdrawSuccess(true);
                    setTransactionStatus(false);
                } else if(res.data.result == 1) {
                    const transaction = res.data.transaction;
                    console.log("transaction : ", transaction);
                    const _transactionId = transaction.id;
                    setTransactionId(_transactionId);
                    const formData = new FormData();
                    formData.append('wallet_name', walletName);
                    formData.append('amount', -1*amount);
                    formData.append('wallet_address', walletAddress);
                    formData.append('transaction_id', _transactionId);
                    formData.append('date', transaction.blockTimeStamp);
                    if(transaction.receipt.result == 'SUCCESS') {
                        formData.append('success', 1); 
                        const result = await Http.post('admin/api/walletPayment', formData); 
                        setWithdrawSuccess(true);
                        setTransactionStatus(true);
                        if(result.data.user){
                            const _addressAmount = result.data.user.balance;
                            setAddresAmount(_addressAmount); 
                            changeBalance(_addressAmount);
                        }     
                    } else if(transaction.result == 'FAILED') {
                        formData.append('success', 2);
                        const result = await Http.post('admin/api/walletPayment', formData);
                        setWithdrawSuccess(true);
                        setTransactionStatus(false);  
                    }
                }
            }else{
                console.log("there is not enough money.");
            }
        } else {
            setWithdraw(false);
            setAmount(0);
            setWalletAddress("");
            setWalletName("TronLink");
            setWithdrawSuccess(false);
        }
    }

    const selectTronLink = async() => {
        if(window.tronWeb){
            const _tronWeb = window.tronWeb;
            setTronWeb(_tronWeb);
            
            const adapter = new TronLinkAdapter();
            // connect
            await adapter.connect();
            try {
                const message = 'Wallet connection';
                await adapter.signMessage(message);
                if(window.tronWeb.ready) {
                    console.log("Tron adapter:", _tronWeb);
                    _tronWeb.setAddress(adapter.address);
                    const _walletAddress = adapter.address;
                    setWalletAddress(_walletAddress);
                }
            } catch (error) {
                
            }
        }else{
            alert("Please install TronLink Wallet");
        }

    }

    const initMetamask = async () => {
        const web3 = new Web3(window.ethereum);
        const accounts = await web3.eth.getAccounts();
        console.log("Init Metamask =============", accounts);
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
                setWalletAddress(web3Address);
                await subscribeProvider(connection);
                getBalance(provider, web3Address);
            }
        } else {

        }
    };

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

    const handleInputChange = (e) => {
        e.preventDefault();
        const targetName = e.target.name;
        const targetValue = e.target.value;
        switch(targetName){
            case 'amount':
                setAmount(targetValue);
                break;
            
        }
    }

    const selectWallet = async(wallet) => {
        switch(wallet){
            case 'metamask':
                setWalletName("MetaMask");
                await initMetamask();
                break;
            case 'tronlink':
                setWalletName("TronLink");
                await selectTronLink();
                break;
        }
    }

    const shortenAddress = (address) => {
        if(address == '' || address == null){
            return "";
        }
        let newString = address.substr(0 , 5) + "..." + address.substr(-5, 5);
        return newString;
    }

    const paymentByWallet = async() => {
        const formData = new FormData();
        formData.append('wallet_name', connectedWallet.name);
        formData.append('amount', walletPrice);
        formData.append('wallet_address', connectedWallet.address);
        const result = await Http.post('admin/api/walletPayment', formData);
        if(result.data.user){
            const _myBalance = result.data.user.balance;
            setMyBalance(_myBalance);
        }
    }

    const initTronlink = async() => {
        let status = true;
        if(window.tronWeb){
            const wallet = window.tronWeb.defaultAddress;
            console.log("tron wallet: ", wallet);
            if(!wallet.base58){
                
            }else{
                setBalanceAddress(wallet.base58);
            }
        }
    }

    const conpyLink = async(address) => {
        if(address != "") {
            await navigator.clipboard.writeText(address);
        }
    }

    useEffect(() => {
        getUser();
        initTronlink();
    }, []);

    return (
        <div className="mybalance-tier1">
            <div className="row">
                <div className="col-sm-5">
                    <div className="items item1">
                        <div className="text1">Total Balance</div>
                        <div className="text2">{ addressAmount }<sub>$USDT</sub></div>
                        <div className="text3">
                            <span>Account <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2" r="2" fill="#2A313C"/></svg>
                            </span> 
                            <div className="coprlink">{shortenAddress(balanceAddress)} 
                                <a onClick={()=>conpyLink(balanceAddress)} role="button"><img src={IconCopyImage} /></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div className="col-sm-7">
                    <div className="quicklinks">
                        <h4>Quick Links</h4>
                        <div className="row">
                            <div className="col-sm-4">
                                <div className="items item2">
                                    <a onClick={handleFunds} className="btn-add-new-wallet">
                                        <div className="icon"><img src={IconAddFundsImage} /></div>
                                        <div className="text">Add Funds</div>
                                    </a>
                                    {/*Add Funds Modal*/}
                                    <Modal show={funds} onHide={handleFunds} id="add-funds-modal">
                                        <Modal.Header>
                                            <h4 className="modal-title w-100" id="add-funds-modal">Add Funds</h4>
                                            <button type="button" className="close" onClick={handleFunds}>
                                                <img src={IconCloseModalImage} />
                                            </button>
                                        </Modal.Header>
                                        <Modal.Body>
                                            {!fundSuccess && 
                                                <div className="addfundsfirst">
                                                    <div className="form-group">
                                                        <label>Amount</label>
                                                        <div className="fields">
                                                            <span>$USDT</span>
                                                            <input type="text" className="form-control" placeholder="1000" name="amount" value={amount} onChange={handleInputChange} />
                                                        </div>
                                                    </div>
                                                    <div className="form-group">
                                                        <label>Source wallet</label>
                                                        <Dropdown className="">
                                                            <Dropdown.Toggle id="connectedwalletsaction1">
                                                                { walletName }
                                                            </Dropdown.Toggle>
                                                            <Dropdown.Menu>
                                                            <li><Dropdown.Item onClick={()=>selectWallet('tronlink')}>TronLink</Dropdown.Item></li>
                                                            </Dropdown.Menu>
                                                        </Dropdown>
                                                    </div>
                                                    <div className="form-group">
                                                        <label>Source account</label>
                                                        <input type="text" className="form-control" value={walletAddress} onChange={handleInputChange} />
                                                    </div>
                                                    <div className="btn-container">
                                                        <button type="button" className="btn btn-primary" onClick={handleAddFunds} >Confirm</button>
                                                    </div>
                                                </div>
                                            }

                                            {fundSuccess && !transactionStatus &&
                                                <div className="withdrawsecond">
                                                    <div className="img"><img src={WithdrawSecondImage} /></div>
                                                    <div className="text1">Oh No! :(</div>
                                                    <p>Your transaction failed. Please try again later</p>
                                                    <div className="btn-container">
                                                        <button type="button" className="btn btn-primary" onClick={handleAddFunds} >OK Got it!</button>
                                                    </div>
                                                </div>
                                            }

                                            {fundSuccess && transactionStatus &&
                                                <div className="addfundssecond">
                                                    <div className="img"><img src={AddFundsImage} /></div>
                                                    <div className="text1">Congratulations!</div>
                                                    <p>Your transaction was successful. See in explorer:</p>
                                                    <div className="row">
                                                        <div className="col-sm-4"><label>TXH:</label></div>
                                                        <div className="col-sm-8">
                                                            <div className="key">
                                                                <a href={transactionId==""?"#":transactionUrl+transactionId} target='_'>{shortenAddress(transactionId)}</a>
                                                                <span><img src={IconCopy} onClick={()=>conpyLink(transactionId)} /></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div className="btn-container">
                                                        <button type="button" className="btn btn-primary" onClick={handleAddFunds}>OK Got it!</button>
                                                    </div>
                                                </div>
                                            }
                                        </Modal.Body>
                                    </Modal>
                                </div>
                            </div>
                            <div className="col-sm-4">
                                <div className="items item2">
                                    <a onClick={handleWithdraw} className="btn-add-new-wallet">
                                        <div className="icon"><img src={IconWithdrawImage} /></div>
                                        <div className="text">Withdraw</div>
                                    </a>
                                    {/*Add Funds Modal*/}
                                    <Modal show={withdraw} onHide={handleWithdraw} id="withdraw-modal">
                                        <Modal.Header>
                                            <h4 className="modal-title w-100">Withdraw</h4>
                                            <button type="button" className="close" onClick={handleWithdraw}>
                                                <img src={IconCloseModalImage} />
                                            </button>
                                        </Modal.Header>
                                        <Modal.Body>
                                            {!withdrawSuccess && 
                                                <div className="withdrawfirst">
                                                    <div className="form-group">
                                                        <label>Amount</label>
                                                        <div className="fields">
                                                            <span>$USDT</span>
                                                            <input type="text" className="form-control" placeholder="1000" name="amount" value={amount} onChange={handleInputChange} />
                                                        </div>
                                                    </div>
                                                    <div className="row2">
                                                        <div><strong>Balance</strong> <span>{addressAmount}</span></div>
                                                    </div>
                                                    <div className="form-group">
                                                        <label>Destination wallet:</label>
                                                        <Dropdown className="">
                                                            <Dropdown.Toggle id="connectedwalletsaction1">
                                                                { walletName }
                                                            </Dropdown.Toggle>
                                                            <Dropdown.Menu>
                                                                {/* <li><Dropdown.Item onClick={()=>selectWallet('metamask')}>MetaMask</Dropdown.Item></li> */}
                                                                <li><Dropdown.Item onClick={()=>selectWallet('tronlink')}>TronLink</Dropdown.Item></li>
                                                            </Dropdown.Menu>
                                                        </Dropdown>
                                                    </div>
                                                    <div className="form-group">
                                                        <label>Destination account:</label>
                                                        <input type="text" className="form-control" value={walletAddress} onChange={handleInputChange} />
                                                    </div>
                                                    <div className="btn-container">
                                                        <button type="button" className="btn btn-primary" onClick={handleAddWithdraw}>Sign Transaction</button>
                                                    </div>
                                                </div>
                                            }

                                            {withdrawSuccess && !transactionStatus &&
                                                <div className="withdrawsecond">
                                                    <div className="img"><img src={WithdrawSecondImage} /></div>
                                                    <div className="text1">Oh No! :(</div>
                                                    <p>Your transaction failed. Please try again later</p>
                                                    <div className="btn-container">
                                                        <button type="button" className="btn btn-primary" onClick={handleAddWithdraw} >OK Got it!</button>
                                                    </div>
                                                </div> 
                                            }

                                            {withdrawSuccess && transactionStatus &&
                                                <div className="addfundssecond">
                                                    <div className="img"><img src={AddFundsImage} /></div>
                                                    <div className="text1">Congratulations!</div>
                                                    <p>Your transaction was successful. See in explorer:</p>
                                                    <div className="row">
                                                        <div className="col-sm-4"><label>TXH:</label></div>
                                                        <div className="col-sm-8">
                                                            <a href={transactionId==""?"#":transactionUrl+transactionId} target='_'>{shortenAddress(transactionId)}</a>
                                                            <span><img src={IconCopy} onClick={()=>conpyLink(transactionId)} /></span>
                                                        </div>
                                                    </div>
                                                    <div className="btn-container">
                                                        <button type="button" className="btn btn-primary" onClick={handleAddWithdraw}>OK Got it!</button>
                                                    </div>
                                                </div>
                                            }

                                        </Modal.Body>
                                    </Modal>
                                </div>
                            </div>
                            <div className="col-sm-4">
                                <div className="items item2">
                                    <a href="#" className="btn-add-new-wallet">
                                        <div className="icon"><img src={IconExportExlsImage} /></div>
                                        <div className="text">Export to EXLS</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default BalanceTier
