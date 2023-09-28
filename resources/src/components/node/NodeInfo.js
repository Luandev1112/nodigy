import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import { Button, Dropdown, Form, Modal } from 'react-bootstrap';
import IconCopyImage from "../../assets/img/icon-copy.png";
import IconExportImage from '../../assets/img/icon-export.svg';

const NodeInfo = () => {

    useEffect(()=>{
    
    }, []);
    return (
        <div className="node-block node-info-block">
            <div className="title">
                <span>Node info</span>
            </div>
            <div className="node-block-content">
                <div className="fixheightdiv">
                    <div className="row">
                        <label className="col-sm-5">Wallet address:</label>
                        <span className="col-sm-7 text-end"><span className="copylinke">5uzgAJ5uCNZ2hCf... <a href="#" role='button'><img src={IconCopyImage} /></a></span></span>
                    </div>
                    <div className="row">
                        <label className="col-sm-5">Location:</label>
                        <span className="col-sm-7 text-end">Washington, USA</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-5">Identity Key:</label>
                        <span className="col-sm-7 text-end"><span className="copylinke">5uzgAJ5uCNZ2hCf... <a href="#" role='button'><img src={IconCopyImage} /></a></span></span>
                    </div>
                    <div className="row">
                        <label className="col-sm-5">Node explorer:</label>
                        <span className="col-sm-7 text-end"><span className="copylinke color-success">5uzgAJ5uCNZ2hCf... <a href="#" role='button'><img src={IconExportImage} /></a></span></span>
                    </div>
                    <div className="row">
                        <label className="col-sm-5">Node explorer:</label>
                        <span className="col-sm-7 text-end"><span className="copylinke color-success">5uzgAJ5uCNZ2hCf... <a href="#" role='button'><img src={IconExportImage} /></a></span></span>
                    </div>
                    <div className="row">
                        <label className="col-sm-7">Probability in Active:</label>
                        <span className="col-sm-5 text-end color-active">High</span>
                    </div>
                    <div className="row">
                        <label className="col-sm-7">Probabilhr in Reserve:</label>
                        <span className="col-sm-5 text-end color-yellow">Low</span>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default NodeInfo;