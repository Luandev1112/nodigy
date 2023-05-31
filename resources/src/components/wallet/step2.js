import React, {useState, useEffect} from 'react';
import nodeList from "../../data/wallet/nodeList.json";
const Step2 = () => {
    const [nodes, setNodes] = useState(nodeList);
    const [networkType, setNetworkType] = useState('all');
    const filterByNet = (netType) => {
        setNetworkType(netType);
        let filterdNodes = [];
        if(netType == 'all'){
            filterdNodes = nodeList;
        }else{
            filterdNodes = nodeList.filter(node => node.type == netType);
        }
        setNodes(filterdNodes);
    };
    useEffect(()=>{
        // filterByNet('all');
    });
    return (
        <div className="steps-content step-new step2 step2new">
            <div className="container">
                <div className="title">Choose a web3 project to validate</div>
                <div className="desc">
                    <p>Attention! It's crucial to DYOR things before you start!  Do Your Own Research — analytical materials, articles, project docs, and social media will help. Dive into the project's story and perspectives before making any investment decision. I'm just a deployment wizard who's not competent enough to do it for you.</p>
                    <p>You might see some projects double each other at this stage. Pay attention to their status — it could be mainnet or testnet, and they'll have different conditions for validators.</p>
                </div>
                <div className="step2_filter">
                    <a onClick={()=>filterByNet('all')} className={networkType=='all'?"active":""}>All Projects</a>
                    <a onClick={()=>filterByNet('test')} className={networkType=='test'?"active":""}>Testnet</a>
                    <a onClick={()=>filterByNet('main')} className={networkType=='main'?"active":""}>Mainnet</a>
                </div>
                <div className="borerbox">
                    <div className="row">
                        {nodes.map((node, i) => {
                            return(
                                <div className="col-sm-6" key={i}>
                                    <div className="items item1 border-up">
                                        <div className="innerbox transparentbg">
                                            <div className="box-head">
                                                <div className="img"><img src={node.image} /></div>
                                                <div className="name">{node.name}</div>
                                                {node.type == 'main' && <div className="tag"><span className="mainnet">Mainnet</span></div>}
                                                {node.type == 'test' && <div className="tag"><span className="testnet">Testnet</span></div>}
                                            </div>
                                            <div className="box-content">
                                                <p>{node.description}<a href="#">Learn more...</a></p>
                                                <div className="minstake">
                                                    <table>
                                                        <tbody>
                                                            <tr>
                                                                <td>Min stake:</td>
                                                                <td className="text-right">{node.min_stake}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colSpan="2" className="text-right">~ {node.min_price}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colSpan="2" className="text-right"><span className="setupfee">Setup fee  ~ {node.setup_fee}</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            )
                        })}
                    </div>
                </div>
            </div>
        </div>
    )
}
export default Step2;