import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import { Button, Dropdown, Modal } from 'react-bootstrap';
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

const BalanceTier = ({url, id, title}) => {
    const [funds, setFunds] = useState(false);
    const [withdraw, setWithdraw] = useState(false);
    const [fundSuccess, setFundSuccess] = useState(false);
    const [withdrawSuccess, setWithdrawSuccess] = useState(false);

    const handleFunds = () => {
        setFunds(!funds);
    }
    const handleWithdraw = () => {
        setWithdraw(!withdraw);
    }

    const handleAddFunds = () => {
        setFundSuccess(!fundSuccess);
    }

    const handleAddWithdraw = () => {
        setWithdrawSuccess(!withdrawSuccess);
    }

    return (
        <div className="mybalance-tier1">
            <div className="row">
                <div className="col-sm-5">
                    <div className="items item1">
                        <div className="text1">Total Balance</div>
                        <div className="text2">$10 350 752<sub>$USDC</sub></div>
                        <div className="text3"><span>Account <svg width="4" height="4" viewBox="0 0 4 4" fill="none" xmlns="http://www.w3.org/2000/svg"><circle cx="2" cy="2" r="2" fill="#2A313C"/></svg></span> <div className="coprlink">5uzgAJuCN...fC4f4h <a href="#"><img src={IconCopyImage} /></a></div></div>
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
                                            {fundSuccess ? 
                                                <div className="addfundssecond">
                                                    <div className="img"><img src={AddFundsImage} /></div>
                                                    <div className="text1">Congratulations!</div>
                                                    <p>Your transaction was successful. See in explorer:</p>
                                                    <div className="row">
                                                        <div className="col-sm-4"><label>Contract:</label></div>
                                                        <div className="col-sm-8">
                                                            <div className="key"><span>5uzgAJ5uCN...Z2hCff4h</span> <a href="#"><img src={IconCopy} /></a></div>
                                                        </div>
                                                    </div>
                                                    <div className="btn-container">
                                                        <button type="button" className="btn btn-primary" onClick={handleAddFunds}>OK Got it!</button>
                                                    </div>
                                                </div> :
                                                <div className="addfundsfirst">
                                                    <div className="form-group">
                                                        <label>Amount</label>
                                                        <div className="fields">
                                                            <span>$USDC</span>
                                                            <input type="text" className="form-control" placeholder="1000" />
                                                        </div>
                                                    </div>
                                                    <div className="form-group">
                                                        <label>Source wallet</label>
                                                        <Dropdown className="">
                                                            <Dropdown.Toggle id="connectedwalletsaction1">
                                                                MetaMask
                                                            </Dropdown.Toggle>
                                                            <Dropdown.Menu>
                                                               <li><Dropdown.Item to="#">MetaMask 1</Dropdown.Item></li>
                                                               <li><Dropdown.Item to="#">MetaMask 2</Dropdown.Item></li>
                                                            </Dropdown.Menu>
                                                        </Dropdown>
                                                    </div>
                                                    <div className="form-group">
                                                        <label>Source account</label>
                                                        <input type="text" className="form-control" defaultValue="0xdfdfgr45kjr55nke5jngkk4r5jnwlker5jngkkejn54e" />
                                                    </div>
                                                    <div className="btn-container">
                                                        <button type="button" className="btn btn-primary" onClick={handleAddFunds} >Confirm</button>
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
                                            {withdrawSuccess ? 
                                                <div className="withdrawsecond">
                                                    <div className="img"><img src={WithdrawSecondImage} /></div>
                                                    <div className="text1">Oh No! :(</div>
                                                    <p>Your transaction failed. Please try again later</p>
                                                    <div className="btn-container">
                                                        <button type="button" className="btn btn-primary" onClick={handleAddWithdraw} >OK Got it!</button>
                                                    </div>
                                                </div> :
                                                <div className="withdrawfirst">
                                                    <div className="form-group">
                                                        <label>Amount</label>
                                                        <div className="fields">
                                                            <span>$USDC</span>
                                                            <input type="text" className="form-control" placeholder="1000" />
                                                        </div>
                                                    </div>
                                                    <div className="row2">
                                                        <div><strong>Balance</strong> <span>53.45</span></div>
                                                    </div>
                                                    <div className="form-group">
                                                        <label>Destination wallet:</label>
                                                        <Dropdown className="">
                                                            <Dropdown.Toggle id="connectedwalletsaction1">
                                                                MetaMask
                                                            </Dropdown.Toggle>
                                                            <Dropdown.Menu>
                                                               <li><Dropdown.Item to="#">MetaMask 1</Dropdown.Item></li>
                                                               <li><Dropdown.Item to="#">MetaMask 2</Dropdown.Item></li>
                                                            </Dropdown.Menu>
                                                        </Dropdown>
                                                    </div>
                                                    <div className="form-group">
                                                        <label>Destination account:</label>
                                                        <input type="text" className="form-control" defaultValue="0xdfdfgr45kjr55nke5jngkk4r5jnwlker5jngkkejn54e" />
                                                    </div>
                                                    <div className="btn-container">
                                                        <button type="button" className="btn btn-primary" onClick={handleAddWithdraw}>Sign Transaction</button>
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
