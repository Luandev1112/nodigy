import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import { Button, Dropdown, Form, Modal } from 'react-bootstrap';

const NodeAbout = () => {

    useEffect(()=>{
    
    }, []);
    return (
        <div className="node-block node-community-block">
            <div className="title">
                <span>About NYM</span>
            </div>
            <div className="node-block-content">
                <div className="row">
                    <label className="col-sm-4">Website:</label>
                    <span className="col-sm-8 text-end color-success">
                        <a role='button'>https://nymtech.net/</a>
                    </span>
                </div>
                <div className="row">
                    <label className="col-sm-4">Twitter:</label>
                    <span className="col-sm-8 text-end color-success">
                        <a role='button'>https://twitter.com/nymproject</a>
                    </span>
                </div>
                <div className="row">
                    <label className="col-sm-5">Block explorer:</label>
                    <span className="col-sm-7 text-end color-success">
                        <a role='button'>https://explorer.nym...</a>
                    </span>
                </div>
                <div className="row">
                    <label className="col-sm-6">Blockchain:</label>
                    <span className="col-sm-6 text-end">NYX</span>
                </div>
                <div className="row">
                    <label className="col-sm-6">Gas fee token:</label>
                    <span className="col-sm-6 text-end">$NYM</span>
                </div>
                <div className="row">
                    <label className="col-sm-7">Supported wallets:</label>
                    <span className="col-sm-5 text-end">NYM wallet</span>
                </div>
            </div>
        </div>
    )
}
export default NodeAbout;