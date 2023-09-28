import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import { Button, Dropdown, Form, Modal } from 'react-bootstrap';
import TierIcon1Image from '../../assets/img/dashboard-tier1-icon1.png';
const NodeStaked = () => {

    useEffect(()=>{
    
    }, []);
    return (
        <div className="items item2">
            <div className="text1">Staked</div>
            <div className="text2 color-yellow">32 $gETH</div>
            <div className="node-block-content">
                <div className="row">
                    <label className="col-sm-6">Claimed:</label>
                    <span className="col-sm-6 text-end">971969.97 NYM</span>
                </div>
                <div className="row">
                    <label className="col-sm-6">Withdrawable:</label>
                    <span className="col-sm-6 text-end">76 470.77 NYM</span>
                </div>
                <div className="row">
                    <label className="col-sm-6">Delegated:</label>
                    <span className="col-sm-6 text-end">895499.20 NYM</span>
                </div>
            </div>
            <div className="icons" role='button'><img src={TierIcon1Image} /></div>
        </div>
    )
}
export default NodeStaked;