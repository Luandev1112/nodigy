import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import { Button, Dropdown, Form, Modal } from 'react-bootstrap';

const NodeFinance = () => {

    useEffect(()=>{
    
    }, []);
    return (
        <div className="node-block node-info-block">
            <div className="title"><span>Node finance</span></div>
            <div className="node-block-content">
                <div className="fixheightdiv">
                    <div className="row">
                        <label className="col-sm-7">Node age:</label>
                        <span className="col-sm-5 text-end">148 days</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-8">Server monthly payment:</label>
                        <span className="col-sm-4 text-end">5.43 $USDT</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-7">Next payment:</label>
                        <span className="col-sm-5 text-end">1 Oct. 2023</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-7">Total expanses paid:</label>
                        <span className="col-sm-5 text-end">32.15 $USDT</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-7">Total rewards earned:</label>
                        <span className="col-sm-5 text-end">5 478.56 $NYM</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-7">from bonding:</label>
                        <span className="col-sm-5 text-end">1 054.11 $NYM</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-7">from delegations:</label>
                        <span className="col-sm-5 text-end">4 424.45 $NYM</span>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default NodeFinance;