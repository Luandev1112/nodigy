import React, {useState, useEffect} from 'react';
import { Button, Dropdown, Form, Modal } from 'react-bootstrap';
import IconCopyImage from "../../assets/img/icon-copy.png";
import CheckCircleImage from "../../assets/img/icon-check-bullet.svg";
import IconAddFundsImage from "../../assets/img/icon-add-funds.svg";
import IconWithdrawImage from "../../assets/img/icon-withdraw.svg";
import IconExportExlsImage from "../../assets/img/icon-export-to-exls.svg";
import IconCloseModalImage from '../../assets/img/icon-close-modal.png';
import AddFundsImage from '../../assets/img/add-funds-img.png';
import WithdrawSecondImage from '../../assets/img/withdrawsecond-img.png';
import { TronLinkAdapter } from '@tronweb3/tronwallet-adapter-tronlink';
import LoadingSpinner from '../LoadingSpinner';
import Http from "../../utils/Http";
import { sendTrc20, shortenAddress, validNumber } from "../../utils/script";
import ErrorModal from "../ErrorModal";

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
    const [loadingStatus, setLoadingStatus] = useState(false);
    const [gasFee, setGasFee] = useState(2);
    const [handleError, setHandleError] = useState(false);
    const [errorContent, setErrorContent] = useState('');
    const [errorStatus, setErrorStatus] = useState(false);
    const [copyContent, setCopyContent] = useState('');
    const transactionUrl = "https://nile.tronscan.io/#/transaction/";

    const getUser = async () => {
        const user = await Http.get("/admin/getuser");
        if(user.data) {
            setAddresAmount(user.data.balance);
        }
    }

    const handleFunds = async() => {
        setHandleError(false);
        if(!funds){
            const walletStatus = await selectTronLink();
            if(!walletStatus) {
                setErrorStatus(true);
                return;
            }
        }
        setFunds(!funds);
    }
    const handleWithdraw = async() => {
        setHandleError(false);
        if(!withdraw){
            const walletStatus = await selectTronLink();
            if(!walletStatus) {
                setErrorStatus(true);
                return;
            }
        }
        setWithdraw(!withdraw);
    }

    const handleAddFunds = async() => {
        if(walletAddress == '')
        {
            setHandleError(true);
            return;
        }
        setLoadingStatus(true);
        if(!fundSuccess) {
            if(amount*1 > 0) {
                console.log("Tron Web: ", tronWeb.trx);
                try {
                    let broadcastTransaction = await sendTrc20(amount, walletAddress);
                    console.log("broadcast transaction - 77: ", broadcastTransaction);
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
            }else{
                setHandleError(true);
                setErrorContent("Mimimum amount is bigger than 0 $USDT");
            }
        }else{
            setFunds(false);
            setAmount(0);
            setWalletAddress("");
            setWalletName("TronLink");
            setFundSuccess(false);
        }
        setLoadingStatus(false);
    }

    const handleAddWithdraw = async() => {
        if(walletAddress == '')
        {
            return;
        }
        setLoadingStatus(true);
        if(!withdrawSuccess) {   
            if(amount*1 <= (addressAmount - gasFee) && amount*1 > gasFee) {
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
                    formData.append('amount', (-1*amount-gasFee));
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
                setHandleError(true);
                if(amount*1 > addressAmount - gasFee) {
                    setErrorContent("Maximum withdrawal amount is " + (addressAmount-gasFee) + "$USDT");
                }else if(amount*1 < gasFee){
                    setErrorContent("Minimum withdrawal amount is " + gasFee + "$USDT");
                }
            }
        } else {
            setWithdraw(false);
            setAmount(0);
            setWalletAddress("");
            setWalletName("TronLink");
            setWithdrawSuccess(false);
        }
        setLoadingStatus(false);
    }

    const selectTronLink = async() => {
        let _status = true;
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
                _status = true;
            } catch (error) {
                _status = false;
                setErrorContent("Please connect wallet address");
            }
        }else{
            _status = false;
            setErrorContent("Please install Tronlink wallet");
        }
        return _status;
    }

    const handleInputChange = (e) => {
        e.preventDefault();
        const targetName = e.target.name;
        const targetValue = e.target.value;
        setHandleError(false);
        switch(targetName){
            case 'amount':
                if(validNumber(targetValue)) {
                    setAmount(targetValue);
                }
                break;
            
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

    const conpyLink = async(address, type) => {
        if(address != "") {
            setCopyContent(type);
            await navigator.clipboard.writeText(address);
        }
    }

    useEffect(() => {
        getUser();
        initTronlink();
    }, []);

    return (
        <div className="mybalance-tier1">
            {loadingStatus && <LoadingSpinner />}
            <div className="row">
                <div className="col-sm-5">
                    <div className="items item1">
                        <div className="text1">Total Balance</div>
                        <div className="text2">{ Number(addressAmount).toFixed(2)  }<sub>$USDT</sub></div>
                        <div className="text3">
                            <span>Account <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="2" cy="2" r="2" fill="#2A313C"/></svg>
                            </span> 
                            <div className="coprlink">{shortenAddress(balanceAddress)} 
                                <a onClick={()=>conpyLink(balanceAddress, 'balance')} role="button"><img src={copyContent=='balance'?CheckCircleImage:IconCopyImage} /></a>
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
                                    <a onClick={handleFunds} className="btn-add-new-wallet" role='button'>
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
                                                            <input type="text" className={handleError?"form-control error": "form-control"} placeholder="1000" name="amount" value={amount} onChange={handleInputChange} />
                                                        </div>
                                                        {handleError&&<span className="error">{errorContent}</span>}
                                                    </div>
                                                    <div className="form-group">
                                                        <label>Source wallet</label>
                                                        <Dropdown className="">
                                                            <Dropdown.Toggle id="connectedwalletsaction1">
                                                                { walletName }
                                                            </Dropdown.Toggle>
                                                            <Dropdown.Menu>
                                                            <li><Dropdown.Item>TronLink</Dropdown.Item></li>
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
                                                                <span><img src={copyContent=='fund'?CheckCircleImage:IconCopyImage} onClick={()=>conpyLink(transactionId, 'fund')} /></span>
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
                                                    <div className="row2">
                                                        <div><strong>Balance</strong> <span>{Number(addressAmount).toFixed(2)}</span></div>
                                                    </div>
                                                    <div className="row2">
                                                        <div><label>Gas fee:</label> <span className="fee">{gasFee} $USDT</span></div>
                                                    </div>
                                                    <div className="row2">
                                                        <div><label className="widthdrawal">Minimum withdrawal amount is</label> <span className="fee">{gasFee} $USDT.</span></div>
                                                    </div>
                                                    <div className="form-group">
                                                        <label>Amount</label>
                                                        <div className="fields">
                                                            <span>$USDT</span>
                                                            <input type="text" className={handleError?"form-control error":"form-control"} placeholder="1000" name="amount" value={amount} onChange={handleInputChange} />
                                                        </div>
                                                        {handleError && <span className="error">{errorContent}</span>}
                                                    </div>
                                                    <div className="form-group">
                                                        <label>Destination wallet:</label>
                                                        <Dropdown className="">
                                                            <Dropdown.Toggle id="connectedwalletsaction1">
                                                                { walletName }
                                                            </Dropdown.Toggle>
                                                            <Dropdown.Menu>
                                                                <li><Dropdown.Item>TronLink</Dropdown.Item></li>
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
                                                            <span><img src={copyContent=='withdraw'?CheckCircleImage:IconCopyImage} onClick={()=>conpyLink(transactionId, 'withdraw')} /></span>
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
            <ErrorModal errorContent={errorContent} status={errorStatus} setStatus={setErrorStatus}/>
        </div>
    )
}
export default BalanceTier
