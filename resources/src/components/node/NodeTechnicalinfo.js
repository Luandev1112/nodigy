import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import { Button, Dropdown, Form, Modal } from 'react-bootstrap';
import IconCopyImage from "../../assets/img/icon-copy.png";

const NodeTechnicalinfo = () => {

    useEffect(()=>{
    
    }, []);
    return (
         <div className="node-block node-info-block">
            <div className="title">
                <span>Node technical info </span>
            </div>
            <div className="node-block-content">
                <div className="row">
                    <label className="col-sm-5">Mix ID:</label>
                    <span className="col-sm-7 text-end">444</span>
                </div>
                <div className="row">
                    <label className="col-sm-5">Host:</label>
                    <span className="col-sm-7 text-end color-success">5.161.46.210</span>
                </div>
                <div className="row">
                    <label className="col-sm-5">Layer:</label>
                    <span className="col-sm-7 text-end">1</span>
                </div>
                <div className="row">
                    <label className="col-sm-5">Version:</label>
                    <span className="col-sm-7 text-end">1.1.12</span>
                </div>
                <div className="row">
                    <label className="col-sm-4">Sphinx Key:</label>
                    <span className="col-sm-8 text-end color-success"><span className="copylinke">5uzgAJ5uCN...Z2hCff4h <a href="#"><img src={IconCopyImage} /></a></span></span>
                </div>
                <div className="row">
                    <label className="col-sm-5">Total Delegation:</label>
                    <span className="col-sm-7 text-end">895 449.24 NYM</span>
                </div>
                <div className="row">
                    <label className="col-sm-5">Operating Cost:</label>
                    <span className="col-sm-7 text-end">40 NYM</span>
                </div>
                <div className="row small-text">
                    <label className="col-sm-5">Delegators:</label>
                    <span className="col-sm-7 text-end">11</span>
                </div>
            </div>
        </div>
    )
}
export default NodeTechnicalinfo;