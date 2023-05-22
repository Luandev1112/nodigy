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

const NotificationsSetting = () => {
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
                            <SettingsSidebar type="notification" />
                            <div className="connectedwallets notification">
                                <div className="head">
                                    <span>Notifications</span>
                                    <div className="text">Get alerts via email if you've entered your email address above.</div>
                                </div> 
                                <div className="notification-list">
                                    <div className="items">
                                        <div className="left">
                                            <p className="text1">News related to projects you follow</p>
                                            <p className="text2">Vestibulum tempor aliquet massa, vitae consequat sapien tempor vitae massa, vitae consequat sapien tempor vitae</p>
                                        </div>
                                        <div className="right">
                                            <div className="cus-checkbox">
                                                <input type="checkbox" onChange={changeEvent} checked/>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="items">
                                        <div className="left">
                                            <p className="text1">News from AAAValidator</p>
                                            <p className="text2">Curabitur at scelerisque massa. Sed quis suscipit felis</p>
                                        </div>
                                        <div className="right">
                                            <div className="cus-checkbox">
                                                <input type="checkbox" onChange={changeEvent} checked/>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="items">
                                        <div className="left">
                                            <p className="text1">Claimable rewards available</p>
                                            <p className="text2">Curabitur at scelerisque massa. Sed quis suscipit felis Curabitur at scelerisque massa. Sed quis suscipit felis</p>
                                        </div>
                                        <div className="right">
                                            <div className="cus-checkbox">
                                                <input type="checkbox" onChange={changeEvent} checked/>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="items">
                                        <div className="left">
                                            <p className="text1">Node status changed</p>
                                            <p className="text2">Suspendisse in vestibulum turpis, consequat malesuada velit</p>
                                        </div>
                                        <div className="right">
                                            <div className="cus-checkbox">
                                                <input type="checkbox" onChange={changeEvent} checked/>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div className="items last">
                                        <div className="left">
                                            <p className="text1">Unstake cooldown period finished</p>
                                            <p className="text2">Vestibulum tempor aliquet massa, vitae consequat sapien tempor vitae massa, vitae consequat sapien tempor vitae</p>
                                        </div>
                                        <div className="right">
                                            <div className="cus-checkbox">
                                                <input type="checkbox" onChange={changeEvent} checked/>
                                                <span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default NotificationsSetting

