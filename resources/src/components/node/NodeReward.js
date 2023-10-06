import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import { Button, Dropdown, Form, Modal } from 'react-bootstrap';
import TierIcon1Image from '../../assets/img/dashboard-tier1-icon1.png';

const NodeReward = ({projectType}) => {

    useEffect(()=>{
    
    }, []);
    return (
        <React.Fragment>
            {projectType=='nym'&&
            <div className="items item2">
                <div className="text1">Epoch Estimated Rewards</div>
                <div className="text2">Total 20.5 NYM</div>
                <div className="node-block-content">
                    <div className="row">
                        <label className="col-sm-6">Operator:</label>
                        <span className="col-sm-6 text-end"> 3.54 NYM</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-7">Delegators:</label>
                        <span className="col-sm-5 text-end">16.9 NYM</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-6">Profit margin:</label>
                        <span className="col-sm-6 text-end">10%</span>
                    </div>
                </div>
                <div className="icons" role='button'><img src={TierIcon1Image} /></div>
            </div>
            }
            {projectType == "goerli" && 
            <div className="items item2">
                <div className="text1">Rewards</div>
                <div className="text2">Total 20.5 NYM</div>
                <div className="node-block-content">
                    <div className="row">
                        <label className="col-sm-6">Income today:</label>
                        <span className="col-sm-6 text-end"> 3.54 NYM</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-7">Income 1d | 7d | 31d:</label>
                        <span className="col-sm-5 text-end">21 | 222 | 98</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-6">APR 7d | 31d | 365d </label>
                        <span className="col-sm-6 text-end">0.00% | 0.00% | 0.66%</span>
                    </div>
                </div>
                <div className="icons" role='button'><img src={TierIcon1Image} /></div>
            </div>
            }
        </React.Fragment>
    )
}
export default NodeReward;