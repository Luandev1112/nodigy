import React, {useState, useEffect} from 'react'
import Sidebar from '../common/header/Sidebar';
import HeaderTopBar from '../common/header/HeaderTopBar';
import { Accordion, Card, Button, Dropdown } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import IconFilterWhiteImage from '../assets/img/icon-filter-white.svg';
import TierIcon1Image from '../assets/img/dashboard-tier1-icon1.png';
import TierIcon2Image from '../assets/img/dashboard-tier1-icon2.png';
import IconEmojiActive from '../assets/img/icon-emoji-active.svg';
import IconEmojiWarning from '../assets/img/icon-emoji-warning.svg';
import IconEmojiDanger from '../assets/img/icon-emoji-danger.svg';
import TierIcon3Image from '../assets/img/dashboard-tier1-icon3.png';
import NodeStatsImage from '../assets/img/node-stats-img.png'; 
import IconExportImage from '../assets/img/icon-export.svg';
import WalletNodeImage from '../assets/img/wallet-node-img1.png';
import IconCopyImage from "../assets/img/icon-copy.png";
import CheckCircleImage from "../assets/img/icon-check-bullet.svg";
import IconEditWhiteImage from '../assets/img/icon-edit-white.svg';
import IconDeleteWhiteImage from '../assets/img/icon-delete-white.svg';
import nodeList from '../data/delegation/nodeList.json';
import {shortenAddressString, shortenAddress} from '../utils/script';

import NodeStaked from '../components/node/NodeStaked';
import NodeReward from '../components/node/NodeReward';
import NodeStatus from '../components/node/NodeStatus';
import NodeFinance from '../components/node/NodeFinance';
import NodeInfo from '../components/node/NodeInfo';
import NodeTechnicalinfo from '../components/node/NodeTechnicalinfo';
import NodeAbout from '../components/node/NodeAbout';


const Node = () => {
    const [selectedId, setSelectedId] = useState(0);
    const [walletAddress, setWalletAddress] = useState('HbYdET93DG8yj4Ux3Rp3CP2aCKKFwbhdAuNxoy1T8T7K');
    const [copyContent, setCopyContent] = useState('');
    const [hourProgress, setHourProgress] = useState({ percantage: 100, progressColor: "#5129F1"});
    const [dayProgress, setDayProgress] = useState({ percantage: 80, progressColor: "#FACC15"});

    const conpyLink = async(address, type) => {
        if(address != "") {
            setCopyContent(type);
            await navigator.clipboard.writeText(address);
        }
    }

    const selectNode = (nodeId) => {
        setSelectedId(nodeId);
    }
    return (
        <div className="wrapper dashboard">
            <Sidebar  menu="node" />

            <div className="wrapper-content">
                <HeaderTopBar menu="node" />
                <div className="node-wrapper">
                    <div className="left">
                        <div className="node-left-tier1">
                            <div className="bluebox">
                                <h5>Your wizard in validation world</h5>
                                <div className="btn-container"><Link to="/admin/add-new-node">Add New Node <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.33337 4H10.6667" stroke="#5129F1" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/> <path d="M8 6.66667L10.6667 4" stroke="#5129F1" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/><path d="M8 1.33337L10.6667 4.00004" stroke="#5129F1" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/></svg></Link></div>
                            </div>
                        </div>
                        <div className='node-check-block'>
                            <div className="form-check">
                                <input className="form-check-input" type="checkbox" name="step2" id="bond-step-2" />
                                <label className="form-check-label" htmlFor="bond-step-2">
                                    Hide deleted nodes
                                </label>
                            </div>
                        </div>
                        <div className="node-left-tier2">
                            <Dropdown className="">
                              <Dropdown.Toggle variant="default" className="btnfilter">
                                <img src={IconFilterWhiteImage} /> Filters
                              </Dropdown.Toggle>

                              <Dropdown.Menu>
                                 <div className="form-group">
                                    <select className="form-control">
                                        <option>Project</option>
                                        <option>Project 1</option>
                                        <option>Project 2</option>
                                    </select>
                                </div>
                                <div className="form-group">
                                    <select className="form-control">
                                        <option>Status</option>
                                        <option>Status 1</option>
                                        <option>Status 2</option>
                                    </select>
                                </div>
                                <div className="form-group">
                                    <select className="form-control">
                                        <option>All Currencies</option>
                                        <option>Currencies 1</option>
                                        <option>Currencies 2</option>
                                    </select>
                                </div>
                                <div className="btn-container">
                                    <input type="button" className="btn btn-primary" value="Apply" />
                                </div>
                              </Dropdown.Menu>
                            </Dropdown>
                        </div>
                        <div className="node-left-tier3">
                            <div className="scrollingdiv">
                                {nodeList.map((node, i) => {
                                    return (
                                        <div className={selectedId==node.id?"items active":"items"} onClick={()=>selectNode(node.id)} key={i}>
                                            <div className="img"><img src={node.image} /></div>
                                            <div className="text2"><p><span>{node.name}</span> {node.url}</p></div>
                                            <div className="text3"><span className={node.statusClass}>{node.status}</span></div>
                                        </div>   
                                    )
                                })}
                            </div>
                        </div>
                    </div>
                    <div className="right">
                        <div className="title">
                            <h1>
                                <span>Name or label node1</span>
                                <p>
                                    <span>05 Sep 2022</span>
                                    <span className="copy-link">
                                        <span>{shortenAddress(walletAddress)}</span>
                                        <a role="button" onClick={()=>conpyLink(walletAddress, 'wallet')}>
                                            <img src={copyContent=='wallet'?CheckCircleImage:IconCopyImage} />
                                        </a>
                                    </span>
                                </p>
                            </h1> 
                            <div className="rightdiv">
                                <a role='button' className='btn-edit'><img src={IconEditWhiteImage} /> Edit</a>
                                <a role='button' className='btn-delete'><img src={IconDeleteWhiteImage} /> Delete </a>
                            </div>
                        </div>
                        <div className="node-content-tier1">
                            <div className="row">
                                <div className="col-sm-12">
                                    <div className="row">
                                        <div className="col-sm-4">
                                            <NodeStaked />
                                        </div>
                                        <div className="col-sm-4">
                                            <NodeReward />
                                        </div>
                                        <div className="col-sm-4">
                                            <NodeStatus />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="node-content-tier2">
                            <div className="row">
                                <div className="col-sm-6">
                                    <NodeFinance />
                                </div>
                                <div className="col-sm-6">
                                    <NodeInfo />
                                </div>
                            </div>
                        </div>
                        <div className="node-content-tier4">
                            <div className="row">
                                <div className="col-sm-6">
                                    <NodeTechnicalinfo />
                                </div>
                                <div className="col-sm-6">
                                    <NodeAbout />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default Node
