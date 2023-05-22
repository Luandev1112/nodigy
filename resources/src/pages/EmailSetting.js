import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import Sidebar from '../common/header/Sidebar';
import SettingsSidebar from '../common/header/SettingsSidebar';
import HeaderTopBar from '../common/header/HeaderTopBar';
import DelegationTier from '../components/delegation/DelegationTier';
import DelegationTable from '../components/delegation/DelegationTable';
import { Accordion, Card, Button, Dropdown, Modal } from 'react-bootstrap';
import IconCloseModalImage from '../assets/img/icon-close-modal.png';
import DropdownImage from '../assets/img/dropdown-img1.png';
import DotsVerticalImage from '../assets/img/dots-vertical.png';
import IconShieldTickImage from "../assets/img/icon-shield-tick.svg";
import IconCloseGrayImage from "../assets/img/icon-close-gray.svg";

import emailsData from '../data/settings/emailsData.json';

const EmailSetting = () => {
    const [show, setShow] = useState(false);
    const handleClose = () => {
        setShow(!show);
    }
    return (
        <div className="wrapper wallets notification-page">
            <Sidebar menu="settings" />
            <div className="wrapper-content">
                <HeaderTopBar menu="settings" />
                <div className="wallets-details">
                    <div className="box">
                        <div className="wrapp">
                            <SettingsSidebar type="email" />
                            <div className="connectedwallets notification email">
                                <div className="head">
                                    <span>Email</span>
                                    <div className="text">Get alerts about lists you've joined and updates from AAAValidator</div>
                                    
                                    <a className="btn-add-new-wallet" onClick={handleClose}>Add New</a>
                                    {/*Add New Wallet Modal*/}
                                    <Modal show={show} onHide={handleClose} id="add-new-wallet-modal ">
                                        <Modal.Header>
                                            <h4 className="modal-title w-100 text-center" id="myModalLabel">Add Email Address</h4>
                                            <button type="button" class="close" onClick={handleClose}>
                                                <img src={IconCloseModalImage} />
                                            </button>
                                        </Modal.Header>
                                        <Modal.Body>
                                            <p className="text">Vestibulum auctor facilisis urna, a vulputate ipsum tempus in mattis nibh, sed convallis mauris</p>
                                            <div className="form-group">
                                                <label>Select Social Account</label>
                                                <Dropdown className="">
                                                    <Dropdown.Toggle variant="default" id="connectedwalletsaction1">
                                                        <span className="img"><img src={DropdownImage} /></span> Facebook
                                                    </Dropdown.Toggle>

                                                    <Dropdown.Menu>
                                                       <li><Dropdown.Item to="#"><span className="img"><img src={DropdownImage} /></span> Google</Dropdown.Item></li>
                                                       <li><Dropdown.Item to="#"><span className="img"><img src={DropdownImage} /></span> Facebook</Dropdown.Item></li>
                                                    </Dropdown.Menu>
                                                </Dropdown>
                                            </div>
                                            <div className="form-group">
                                                <label>Name</label>
                                                <input type="text" className="form-control" />
                                            </div>
                                            <div className="form-group">
                                                <label>URL</label>
                                                <input type="text" className="form-control" />
                                            </div>
                                            <div className="btn-container">
                                                <a className="btn btn-primary w-100" onClick={handleClose}>Confirm</a>
                                            </div>
                                        </Modal.Body>
                                    </Modal>
                                </div> 
                                <div className="email-list tab-content">
                                    {emailsData.map((data, i) => (
                                        <div className="items" key={i}>
                                            <div className="img"><img src={data.image} /></div>
                                            <div className="emailid" data-id={data.id}><Link to="#">{data.email}</Link></div>
                                            <div className="name">{data.name}</div>
                                            <div className="status"><span className={data.statusClass}>{data.status}</span></div>
                                            <div className="action">
                                                <Dropdown className="">
                                                    <Dropdown.Toggle variant="" id="connectedwalletsaction1">
                                                        <img src={DotsVerticalImage} />
                                                    </Dropdown.Toggle>

                                                    <Dropdown.Menu>
                                                       <li className="edit"><Dropdown.Item to="#">Edit</Dropdown.Item></li>
                                                       <li className="delete"><Dropdown.Item to="#">Disconnect</Dropdown.Item></li>
                                                    </Dropdown.Menu>
                                                </Dropdown>
                                            </div>
                                        </div>
                                    ))}
                                </div>
                                <div className="email-safety">
                                    <div className="title">Safety</div>
                                    <div className="text">Anti-phishing code</div>
                                    <div className="form">
                                        <div className="field">
                                            <div className="icon"><img src={IconShieldTickImage} /></div>
                                            <input type="text" className="form-control" defaultValue="1234567890" />
                                            <a href="#" className="btnclose"><img src={IconCloseGrayImage} /></a>
                                        </div>
                                        <button className="btn btn-primary">Save</button>
                                    </div>
                                    <p className="subtext">What is this? This is a word/string that only you know, and we will include prominently in every PREMINT email we send you. That way, you'll know it's officially from AAAValidator.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default EmailSetting

