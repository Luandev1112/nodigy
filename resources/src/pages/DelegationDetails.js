import React, {useState, useEffect} from 'react'
import Sidebar from '../common/header/Sidebar';
import HeaderTopBar from '../common/header/HeaderTopBar';
import DelegationTier from '../components/delegation/DelegationTier';
import DelegationTable from '../components/delegation/DelegationTable';
import { Accordion, Card, Button, Dropdown } from 'react-bootstrap';
import IconNodeArrowChartImage from '../assets/img/icon-node-arrow-chart.png';
import IconPlusWhiteImage from '../assets/img/icon-plus-white.svg';
import IconFilterWhiteImage from '../assets/img/icon-filter-white.svg';
import DelegationDetailsImage from '../assets/img/delegation-details-listicon.png'; 
import IconCopyGreyImage from '../assets/img/icon-copy-grey.png'; 
import IconCopyImage from '../assets/img/icon-copy.png';
import TierIcon1Image from '../assets/img/dashboard-tier1-icon1.png';
import TierIcon2Image from '../assets/img/dashboard-tier1-icon2.png';
import TierIcon3Image from '../assets/img/dashboard-tier1-icon3.png';
import NodeStatsImage from '../assets/img/node-stats-img.png'; 
import IconEditGrayImage from '../assets/img/icon-edit-gray.png';
import IconDeleteGrayImage from '../assets/img/icon-delete-gray.png';
import WalletNodeImage from '../assets/img/wallet-node-img1.png';

import nodeList from '../data/delegation/nodeList.json';
const DelegationDetails = () => {
    const [selectedId, setSelectedId] = useState(0);

    const selectNode = (nodeId) => {
        setSelectedId(nodeId);
    }
    return (
        <div className="wrapper delegation">
            <Sidebar  menu="delegation" />
            <div className="wrapper-content">
                <HeaderTopBar menu="delegation" />
                <div className="node-wrapper">
                    <div className="left">
                        <div className="node-left-tier1">
                            <div className="bluebox">
                                <p><span>Total balance</span> <span><img src={IconNodeArrowChartImage} />2.05%</span> <span>This Month</span> </p>
                                <div className="text">10 00 000</div>
                            </div>
                        </div>
                        <div className="node-left-tier2">
                            <a href="#" className="btnaddnew"><img src={IconPlusWhiteImage} /> Add New</a>
                            <Dropdown className="">
                              <Dropdown.Toggle variant="default" className="btnfilter">
                                <img src={IconFilterWhiteImage} /> Filter
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
                                            <div className="text2"><p><span>{node.name}</span> <span className="key">{node.address}</span></p></div>
                                            <div className="text3"><a href="#"><img src={IconCopyGreyImage} /></a></div>
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
                                <p><span>05 Sep 2022</span><span>kv.d***s@gmail.com</span><span>Germany</span></p>
                            </h1> 
                            <div className="rightdiv">
                                <a href="#"><img src={IconEditGrayImage} /></a>
                                <a href="#"><img src={IconDeleteGrayImage} /></a>
                            </div>
                        </div>
                        <div className="dashboard-tier1 node-content-tier1">
                            <div className="row">
                                <div className="col-sm-12">
                                    <div className="row">
                                        <div className="col-sm-4">
                                            <div className="items item2">
                                                <div className="text1">Unclaimed rewards</div>
                                                <div className="text2">12.54 $ARB</div>
                                                <div className="graphimg">
                                                    <a href="#" className="btn btn-primary">Claim now</a>
                                                </div>
                                                <div className="icons"><img src={TierIcon2Image} /></div>
                                            </div>
                                        </div>
                                        <div className="col-sm-4">
                                            <div className="items item2">
                                                <div className="text1">Total rewards earned</div>
                                                <div className="text2">698.44 $ARB</div>
                                                <div className="graphimg"><img src={NodeStatsImage} /></div>
                                                <div className="icons"><img src={TierIcon1Image} /></div>
                                            </div>
                                        </div>
                                        <div className="col-sm-4">
                                            <div className="items item2">
                                                <div className="text1">Estimated APY</div>
                                                <div className="text2">~21%</div>
                                                <div className="graphimg"><img src={NodeStatsImage} /></div>
                                                <div className="icons"><img src={TierIcon3Image} /></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="node-content-tier2">
                            <div className="row">
                                <div className="col-sm-6">
                                    <div className="node-block node-info-block">
                                        <div className="title"><span>Staking</span></div>
                                        <div className="node-block-content">
                                            <div className="fixheightdiv">
                                                <div className="row">
                                                    <label className="col-sm-6">Total staked</label>
                                                    <span className="col-sm-6 text-end">~23.45 $ARB</span>
                                                </div>
                                                <div className="row">
                                                    <label className="col-sm-6">My staking</label>
                                                    <span className="col-sm-6 text-end">~23.45 $ARB</span>
                                                </div>
                                                <div className="row">
                                                    <label className="col-sm-6">Self%:</label>
                                                    <span className="col-sm-6 text-end">97%</span>
                                                </div>
                                            </div>
                                            <div className="row">
                                                <div className="col-sm-6"><a href="#" className="btn btn-default">Unstake</a></div>
                                                <div className="col-sm-6"><a href="#" className="btn btn-primary">Stake More</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="node-block node-info-block">
                                        <div className="title">
                                            <span>Delegation</span>
                                            <div className="dropdown node-blockdropdown">
                                                <button className="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">This Month <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 1.13806L5 5.13806L9 1.13806" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></button>
                                                <ul className="dropdown-menu" aria-labelledby="">
                                                    <li><a href="#">This Month</a></li>
                                                    <li><a href="#">Last Month</a></li>
                                                    <li><a href="#">Next Month</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div className="node-block-content">
                                            <div className="fixheightdiv">
                                                <div className="row">
                                                    <label className="col-sm-7">Total Delegated:</label>
                                                    <span className="col-sm-5 text-end">~23.45 $ARB</span>
                                                </div>
                                                <div className="row">
                                                    <label className="col-sm-7">Delegators:</label>
                                                    <span className="col-sm-5 text-end">~23.45 $ARB</span>
                                                </div>
                                                <div className="row">
                                                    <label className="col-sm-7">Comission:</label>
                                                    <span className="col-sm-5 text-end">97%</span>
                                                </div>
                                                <div className="row">
                                                    <label className="col-sm-7">Total rewards earned from delegators:</label>
                                                    <span className="col-sm-5 text-end">97%</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="node-content-tier3">
                            <div className="row">
                                <div className="col-sm-12">
                                    <div className="node-block node-info-block">
                                        <div className="title">
                                            <span>Wallet</span>
                                            <a href="#" className="btn-viewall">View All <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 9L5 5L1 1" stroke="#718096" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
                                        </div>
                                        <div className="node-block-content">
                                            <div className="items">
                                                <div className="img"><img src={WalletNodeImage} /></div>
                                                <div className="name">NEAR</div>
                                                <div className="key">0x075a12vb3yh4o5k6qa78902BE53</div>
                                            </div>
                                            <div className="items">
                                                <div className="img"><img src={WalletNodeImage} /></div>
                                                <div className="name">ETH</div>
                                                <div className="key">0x075a12vb3yh4o5k6qa78902BE53</div>
                                            </div>
                                            <div className="items">
                                                <div className="img"><img src={WalletNodeImage} /></div>
                                                <div className="name">NYX Mainnet</div>
                                                <div className="key">0x075a12vb3yh4o5k6qa78902BE53</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="node-content-tier4">
                            <div className="row">
                                <div className="col-sm-6">
                                    <div className="node-block node-info-block">
                                        <div className="title">
                                            <span>Info</span>
                                        </div>
                                        <div className="node-block-content">
                                            <div className="row">
                                                <label className="col-sm-3">Contract:</label>
                                                <span className="col-sm-9 text-end"><span className="copylinke">5uzgAJ5uCN...Z2hCff4h <a href="#"><img src={IconCopyImage} /></a></span></span>
                                            </div>
                                            <div className="row">
                                                <label className="col-sm-3">Website:</label>
                                                <span className="col-sm-9 text-end"><span className="spanbg">medium.com</span> <span className="spanbg">paxos.com</span></span>
                                            </div>
                                            <div className="row">
                                                <label className="col-sm-3">Explorers:</label>
                                                <span className="col-sm-9 text-end"><span className="spanbg">Etherscan</span></span>
                                            </div>
                                            <div className="row">
                                                <label className="col-sm-3">Wallets:</label>
                                                <span className="col-sm-9 text-end"><span className="spanbg">Ledger</span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div className="col-sm-6">
                                    <div className="node-block node-community-block">
                                        <div className="title">
                                            <span>Community</span>
                                        </div>
                                        <div className="node-block-content">
                                            <div className="row">
                                                <label className="col-sm-3">Community:</label>
                                                <span className="col-sm-9 text-end"><span className="spanbg">Twitter</span><span className="spanbg">Facebook</span></span>
                                            </div>
                                            <div className="row">
                                                <label className="col-sm-3">API Id:</label>
                                                <span className="col-sm-9 text-end"><span className="copylinke">binance-usd <a href="#"><img src={IconCopyImage} /></a></span></span>
                                            </div>
                                            <div className="row">
                                                <label className="col-sm-3">Tags:</label>
                                                <span className="col-sm-9 text-end"><span className="copylinke">binance-usd <a href="#"><img src={IconCopyImage} /></a></span></span>
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
export default DelegationDetails

