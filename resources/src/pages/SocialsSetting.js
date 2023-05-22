import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import Sidebar from '../common/header/Sidebar';
import SettingsSidebar from '../common/header/SettingsSidebar';
import HeaderTopBar from '../common/header/HeaderTopBar';
import DelegationTier from '../components/delegation/DelegationTier';
import DelegationTable from '../components/delegation/DelegationTable';
import { Accordion, Card, Button, Dropdown, Modal } from 'react-bootstrap';
import IconEmailImage from '../assets/img/icon-email.png';
import IconNotificationImage from '../assets/img/icon-notification.png';
import IconLikeShapesImage from "../assets/img/icon-like-shapes.png";
import IconCloseModalImage from '../assets/img/icon-close-modal.png';
import DropdownImage from '../assets/img/dropdown-img1.png';
import DotsVerticalImage from '../assets/img/dots-vertical.png';

import socialsData from '../data/settings/socialsData.json';

const SocialsSetting = () => {
    const [show, setShow] = useState(false);

    const handleClose = () => {
        setShow(!show);
    }
    const changeEvent = () => {
        console.log("Testing");
    }
    return (
        <div className="wrapper wallets notification-page">
            <Sidebar menu="settings" />
            <div className="wrapper-content">
                <HeaderTopBar menu="settings" />
                <div className="wallets-details">
                    <div className="box">
                        <div className="wrapp">
                            <SettingsSidebar type="social" />
                            <div className="connectedwallets social-accounts">
                                <div className="head">
                                    <span>Social Accounts</span>
                                    <div className="text">Get alerts about lists you've joined and updates from AAAValidator</div>
                                    <a className="btn-add-new-wallet" onClick={handleClose}>Add New</a>
                                    {/*Add New Wallet Modal*/}
                                    <Modal show={show} onHide={handleClose} id="add-new-wallet-modal ">
                                        <Modal.Header>
                                            <h4 className="modal-title w-100 text-center" id="myModalLabel">Add New Social Accounts</h4>
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
                                <div className="social-list">
                                    {socialsData.map((data, i) => (
                                        <div className="items" key={i}>
                                            <div className="left">
                                                <div className="img"><img src={data.image} /></div>
                                                <div className="text2">{data.name}</div>
                                            </div>
                                            <div className="center">
                                                <p className="name">{data.socialId}</p>
                                            </div>
                                            <div className="right">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default SocialsSetting

