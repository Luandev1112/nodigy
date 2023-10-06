import React, {useState, useRef, useEffect} from "react";
import {Link} from "react-router-dom";
import LogoImage from "../../assets/img/logo.svg";
import IconDashboardImage from "../../assets/img/icon-dashboard.svg";
import IconWalletsImage from "../../assets/img/icon-wallets.svg";
import IconBalanceImage from "../../assets/img/icon-my-balance.svg";
import IconNodeImage from "../../assets/img/icon-node.svg";
import IconHelpImage from "../../assets/img/icon-get-help.svg";
import IconSettingsImage from "../../assets/img/icon-settings.svg";
import Disclamer from "../../components/Disclamer";


const Sidebar = ({menu}) => {
    
    useEffect(()=>{

    }, []);
    return (
        <>
            <div className="sidebar">
                <a className="logo hide-mobile"><img src={LogoImage} /></a>
                <ul>
                    <li>
                        <Link to="/admin/dashboard" className={menu=='dashboard' ? "active" : ""} >
                            <div className="img"><img src={IconDashboardImage} /></div> 
                            <span>Dashboard</span>
                        </Link>
                    </li>
                    <li>
                        <Link to="/admin/wallets" className={menu=='wallets' ? "active" : ""} >
                            <div className="img"><img src={IconWalletsImage} /></div> 
                            <span>Wallets</span>
                        </Link>
                    </li>
                    <li>
                        <Link to="/admin/mybalance" className={menu=='mybalance' ? "active" : ""} >
                            <div className="img"><img src={IconBalanceImage} /></div> 
                            <span>My Balance</span>
                        </Link>
                    </li>
                    <li>
                        <Link to="/admin/delegation" className={menu=='delegation' ? "active" : ""} >
                            <div className="img"><img src={IconBalanceImage} /></div> 
                            <span>Delegation</span>
                        </Link>
                    </li>
                    <li>
                        <Link to="/admin/node" className={menu=='node' ? "active" : ""} >
                            <div className="img"><img src={IconNodeImage} /></div> 
                            <span>Node</span>
                        </Link>
                    </li>
                </ul>
                <div className="bottomlinks">
                    <ul>
                        <li>
                            <Link to="#" className="">
                                <div className="img"><img src={IconHelpImage} /></div> 
                                <span>Get Help</span>
                            </Link>
                        </li>
                        <li>
                            <Link to="/admin/emails-setting" className={menu=='settings' ? "active" : ""}>
                                <div className="img"><img src={IconSettingsImage} /></div> 
                                <span>Settings</span>
                            </Link>
                        </li>
                    </ul>
                </div>
            </div>
            <Disclamer />
        </>
    )
}
export default Sidebar;