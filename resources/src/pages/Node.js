import React, {useState, useEffect, useLayoutEffect} from 'react'
import { useParams, useNavigate } from 'react-router-dom';
import Sidebar from '../common/header/Sidebar';
import HeaderTopBar from '../common/header/HeaderTopBar';
import { Accordion, Card, Button, Dropdown, Modal, Form } from 'react-bootstrap';
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
import ProgressCheckImage from "../assets/img/progress-check.svg";
import ProgressNullImage from "../assets/img/progress-null.svg";
import IconCopyImage from "../assets/img/icon-copy.png";
import CheckCircleImage from "../assets/img/icon-check-bullet.svg";
import IconEditWhiteImage from '../assets/img/icon-edit-white.svg';
import IconDeleteWhiteImage from '../assets/img/icon-delete-white.svg';
import {shortenAddressString, shortenAddress} from '../utils/script';
import Http from "../utils/Http";
import IconCloseModalImage from '../assets/img/icon-close-modal.png';

import NodeStaked from '../components/node/NodeStaked';
import NodeReward from '../components/node/NodeReward';
import NodeStatus from '../components/node/NodeStatus';
import NodeFinance from '../components/node/NodeFinance';
import NodeInfo from '../components/node/NodeInfo';
import NodeTechnicalinfo from '../components/node/NodeTechnicalinfo';
import NodeAbout from '../components/node/NodeAbout';
import { startCase } from 'lodash';
import { HttpProvider } from 'web3';
import { getNodeText } from '@testing-library/react';


const Node = ({match}) => {
    const [selectedId, setSelectedId] = useState(0);
    const [selectedNode, setSelectedNode] = useState(null);
    const [walletAddress, setWalletAddress] = useState('HbYdET93DG8yj4Ux3Rp3CP2aCKKFwbhdAuNxoy1T8T7K');
    const [copyContent, setCopyContent] = useState('');
    const [editStatus, setEditStatus] = useState(false);
    const [deleteStatus, setDeleteStatus] = useState(false);
    const [deleteStep, setDeleteStep] = useState('');
    const [nodeList, setNodeList] = useState([]);
    const [error, setError] = useState(false);
    const [errorContent, setErrorContent] = useState('');

    const [nodeName, setNodeName] = useState('');
    const [nodeUrl, setNodeUrl] = useState('');
    const [nodeDescription, setNodeDescription] = useState('');
    const [nodeImage, setNodeImage] = useState(null);
    const [logoFile, setLogoFile] = useState(null);
    const navigate = useNavigate();
    const params = useParams();
    const [projectName, setProjectName] = useState(params.project);

    const openEditForm = () => {
        if(selectedNode) {
            setNodeName(selectedNode.node_name);
            setNodeUrl(selectedNode.node_url);
            setNodeDescription(selectedNode.description);
            setNodeImage(selectedNode.logo_url);
        }
        setEditStatus(true);
    }

    const handleEditStatus = () => {
        setEditStatus(!editStatus);
    }

    const setEditDetails = (node) => {
        if(node) {
            setNodeName(node.node_name);
            setNodeUrl(node.node_url);
            setNodeDescription(node.description);
            setNodeImage(node.logo_url);
        }
    }

    const handleDeleteStatus = () => {
        setDeleteStatus(!deleteStatus);
    }

    const formatDate = (strDate) => {
        let formatDate = null;
        if(strDate && strDate.length > 0) {
            const date = new Date(strDate);
            const options = {day: 'numeric', month: 'short', year: 'numeric'};
            formatDate = date.toLocaleDateString('en-US', options);
        }
        console.log("formated date: ", formatDate);
        return formatDate;
    }

    const conpyLink = async(address, type) => {
        if(address != "") {
            setCopyContent(type);
            await navigator.clipboard.writeText(address);
        }
    }

    const handleDeleteStep = (step) => {
       setDeleteStep('confirmed'); 
    }

    const getDeleteStep = () => {

    }

    const handleInputChange = (e) => {
        e.preventDefault();
        const _name = e.target.name;
        const _value = e.target.value;
        switch(_name) {
            case 'name':
                setNodeName(_value);
            break;
            case 'url':
                setNodeUrl(_value);
            break;
            case 'description':
                setNodeDescription(_value);
            break;
        }
    }

    const handleFileChange = (e) => {
        if (e.target.files && e.target.files[0]) {
            setNodeImage(URL.createObjectURL(e.target.files[0]));
            setLogoFile(e.target.files[0]);
        } 
    }

    const selectNode = (nodeId, idx) => {
        setSelectedId(nodeId);
        setSelectedNode(nodeList[idx]);
        setEditDetails(nodeList[idx]);
    }

    const getNodeList = async(_projectName) => {
        const _projectDetailResult = await Http.get('/admin/api/project-detail/'+_projectName);
        if(_projectDetailResult.data.status == 1) {
            const project = _projectDetailResult.data.project;
            const formData = new FormData();
            formData.append('project_id', project.id);
            const _nodeListResult = await Http.post('/admin/api/get-project-nodes', formData);
            console.log("Nodes Result: ", _nodeListResult);
            if(_nodeListResult.data.status == 1) {
                const _nodes = _nodeListResult.data.nodes;
                setNodeList(_nodes);
                setSelectedNode(_nodes[0]);
                setSelectedId(_nodes[0].id);
                setEditDetails(_nodes[0]);
            } else if(_nodeListResult.data.status == 0) {
                setError(true);
                setErrorContent("There is not any node");
            }
            
        } else if(_projectDetailResult.data.status == 0) {
            setError(true);
            setErrorContent("There is not project");
        }
    }

    const getProjectList = async() => {
        if(projectName) {
            await getNodeList(projectName);
        } else {
            const res = await Http.get('/admin/api/get-node-projects');
            const _projectList = res.data.data.project_list;
            if(_projectList.length > 0) {
                setProjectName(_projectList[0].project_name);
                await getNodeList(_projectList[0].project_name);
            }else {
                setError(true);
                setErrorContent("There is not project");
            }
        }
    }

    const submitEditNode = async() => {
        const formData = new FormData();
        formData.append('node_id', selectedNode.id);
        formData.append('node_name', nodeName);
        formData.append('node_url', nodeUrl);
        formData.append('description', nodeDescription);
        if(logoFile) {
            formData.append('file', logoFile);
        }
        const result = await Http.post('/admin/api/update-node', formData);
        if(result.data.status == 1) {
            let _nodeList = nodeList;
            const _node = result.data.node;
            const idx = nodeList.findIndex(node => node.id = _node.id);
            _nodeList[idx].node_name = _node.node_name;
            _nodeList[idx].node_url = _node.node_url;
            _nodeList[idx].description = _node.description;
            _nodeList[idx].node_logo = _node.node_logo;
            _nodeList[idx].logo_url = _node.logo_url;
            setNodeList(_nodeList);
        }
        setEditStatus(false);
    }

    useEffect(()=>{
        getProjectList();
    }, []);

    return (
        <div className="wrapper dashboard">
            <Sidebar  menu="node" />
            {error ? 
            <div className='no-content'>
                <h3>{errorContent}</h3>
            </div> : 
            selectedNode &&
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
                                        <div className={selectedId==node.id?"items active":"items"} onClick={()=>selectNode(node.id, i)} key={i}>
                                            <div className="img"><img src={node.logo_url} /></div>
                                            <div className="text2"><p><span>{node.node_name}</span> {node.node_url}</p></div>
                                            <div className="text3"><span className={node.status.toLowerCase()}>{node.status}</span></div>
                                        </div>   
                                    )
                                })}
                            </div>
                        </div>
                    </div>
                    <div className="right">
                        <div className="title">
                            <h1>
                                <span>{selectedNode.node_name}</span>
                                <p>
                                    <span>{formatDate(selectedNode.created_at)}</span>
                                    <span className="copy-link">
                                        <span>{shortenAddress(selectedNode.node_wallet)}</span>
                                        <a role="button" onClick={()=>conpyLink(selectedNode.node_wallet, 'wallet')}>
                                            <img src={copyContent=='wallet'?CheckCircleImage:IconCopyImage} />
                                        </a>
                                    </span>
                                </p>
                            </h1> 
                            <div className="rightdiv">
                                <a role='button' className='btn-edit' onClick={()=>openEditForm()}><img src={IconEditWhiteImage} /> Edit</a>
                                <a role='button' className='btn-delete' onClick={handleDeleteStatus}><img src={IconDeleteWhiteImage} /> Delete </a>
                            </div>
                        </div>
                        <div className="node-content-tier1">
                            <div className="row">
                                <div className="col-sm-12">
                                    <div className="row">
                                        <div className="col-sm-4">
                                            <NodeStaked projectType={projectName.toLocaleLowerCase()} node={selectNode} />
                                        </div>
                                        <div className="col-sm-4">
                                            <NodeReward projectType={projectName.toLocaleLowerCase()} node={selectNode} />
                                        </div>
                                        <div className="col-sm-4">
                                            <NodeStatus projectType={projectName.toLocaleLowerCase()} node={selectNode} />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div className="node-content-tier2">
                            <div className="row">
                                <div className="col-sm-6">
                                    <NodeFinance projectType={projectName.toLocaleLowerCase()} node={selectNode} />
                                </div>
                                <div className="col-sm-6">
                                    <NodeInfo projectType={projectName.toLocaleLowerCase()} node={selectNode} />
                                </div>
                            </div>
                        </div>
                        <div className="node-content-tier4">
                            <div className="row">
                                <div className="col-sm-6">
                                    <NodeTechnicalinfo projectType={projectName.toLocaleLowerCase()} node={selectNode} />
                                </div>
                                <div className="col-sm-6">
                                    <NodeAbout projectType={projectName.toLocaleLowerCase()} node={selectNode} />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            }

            <Modal show={editStatus} onHide={handleEditStatus} id="edit-node-modal" className='modal-center'>
                <Modal.Header>
                    <h4 className="modal-title w-100" id="edit-node-modal">Edit Node</h4>
                    <button type="button" className="close" onClick={handleEditStatus}>
                        <img src={IconCloseModalImage} />
                    </button>
                </Modal.Header>
                <Modal.Body>
                    <div className="addfundsfirst">
                        <div className="node-logo">
                            <div className='logo-group'>
                                <div className="logo-avatar">
                                { nodeImage == ''? 
                                    <div className='no-image'></div>:
                                    <img src={nodeImage} />
                                }
                                    
                                </div>
                                <div className="avatarupload dragfile-bluebg">
                                    <input type="file" onChange={handleFileChange} />
                                    <div className="text">
                                        <span>Upload new logo</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div className="form-group">
                            <label>Name</label>
                            <div className="fields">
                                <input type="text" className={"form-control"} name="name" value={nodeName} onChange={handleInputChange} />
                            </div>
                        </div>
                        <div className="form-group">
                            <label>Url</label>
                            <div className="fields">
                                <input type="text" className={"form-control"} name="url" value={nodeUrl} onChange={handleInputChange} />
                            </div>
                        </div>
                        <div className="form-group">
                            <label>Description</label>
                            <textarea className='form-control' name='description' onChange={handleInputChange}>{nodeDescription}</textarea>
                        </div>
                        <div className="btn-container">
                            <button type="button" className="btn btn-primary" onClick={submitEditNode} >Confirm</button>
                        </div>
                    </div>
                </Modal.Body>
            </Modal>

            <Modal show={deleteStatus} onHide={handleDeleteStatus} id="delete-node-modal" className='modal-center'>
                <Modal.Header>
                    <h4 className="modal-title w-100" id="delete-funds-modal">Delete Node. Are you sure?</h4>
                    <button type="button" className="close" onClick={handleDeleteStatus}>
                        <img src={IconCloseModalImage} />
                    </button>
                </Modal.Header>
                <Modal.Body>
                    {deleteStep == '' ?
                    <div className="">
                        <div className='node-radio-block'>
                            <div className="form-check">
                                <input className="form-check-input" type="radio" name="delete" id="node-claimed" />
                                <label className="form-check-label" htmlFor="node-claimed">
                                All rewards are claimed
                                </label>
                            </div>
                        </div>

                        <div className='node-radio-block'>
                            <div className="form-check">
                                <input className="form-check-input" type="radio" name="delete" id="node-unstaked" />
                                <label className="form-check-label" htmlFor="node-unstaked">
                                All tokens are unstaked
                                </label>
                            </div>
                        </div>
                        <div className='node-radio-block'>
                            <div className="form-check">
                                <input className="form-check-input" type="radio" name="delete" id="node-delete" />
                                <label className="form-check-label" htmlFor="node-delete">
                                I am sure I want to delete this node!
                                </label>
                            </div>
                        </div>

                        <p>Backup of your node, node key and node IP will be available in your personal area</p>

                        <div className="btn-container row">
                            <div className='col-sm-6'>
                                <a role='button' className='btn btn-edit' onClick={handleEditStatus}>Cancel</a>
                            </div>
                            <div className='col-sm-6'>
                                <a role='button' className='btn btn-delete' onClick={()=>handleDeleteStep('confirmed')}>Delete </a>
                            </div>
                        </div>
                    </div> :
                    <div className="delete-progress">
                        <div className='delete-step'>
                            <span className="delete-check">
                                <img src={ProgressCheckImage} />
                            </span>
                            <label>Node key backup</label>
                        </div>

                        <div className='delete-step'>
                            <span className="delete-check">
                                <img src={ProgressNullImage} />
                            </span>
                            <label>OS image and IP saving</label>
                        </div>

                        <div className='delete-step'>
                            <span className="delete-check">
                                <img src={ProgressNullImage} />
                            </span>
                            <label>Downloading node info</label>
                        </div>

                        <div className='delete-step'>
                            <span className="delete-check">
                                <img src={ProgressNullImage} />
                            </span>
                            <label>Server deleting</label>
                        </div>

                        <div className="btn-container row">
                            <div className='col-sm-12'>
                                <a role='button' className='btn btn-gray btn-dashboard' onClick={handleDeleteStatus}>Go to dashboard</a>
                            </div>
                        </div>
                    </div>
                    }
                </Modal.Body>
            </Modal>
        </div>
    )
}
export default Node
