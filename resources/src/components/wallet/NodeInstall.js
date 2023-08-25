import React, {useEffect, useState} from 'react';
import Http from "../../utils/Http";
const NodeInstall = ({setStep, setSubStep, server, project, wallet, chain}) => {
    console.log("final project>>>>>", project);
    const [node, selectedNode] = useState(null);
    const installnode = async() => {
        const formData = new FormData();
        formData.append('project_id', project.id);
        formData.append('server_id', server.id);
        formData.append('user_wallet_id', wallet.user_wallet_id);
        formData.append('node_name', wallet.network_name + " Node");
        formData.append('node_logo', project.image);
        formData.append('node_type', project.network_type);
        // formData.append('min_stake', project.min_stake);
        // formData.append('min_price', project.min_price);
        const res = await Http.post('/admin/api/createNode', formData);
        console.log(res);
        if(res.data.result == 1) {
            setTimeout(() => {
                setStep(7);
                setSubStep('node-install-success');
            }, 1000);
        }
    }

    const shortenAddress = (address) => {
        let newString = address.substr(0 , 5) + "..." + address.substr(-5, 5);
        return newString;
    }
    useEffect(() => {
        installnode();
    }, []);
    return (
        <div className="steps-content nodeinstallation">
            <div className="container">
                <div className="row">
                    <div className="col-sm-12">
                        <div className="borerbox border-0 bg-transparent ps-0">
                            <div className="items border-left border-down">
                                <div className="p30">
                                    <div className="title">Node Installation</div>
                                    <div className="step-loader">
                                        <div className="img"><img src="/img/node-installation-process-icon.png" /></div>
                                        <div className="text">Installation in progress</div>
                                    </div>
                                    <div className="item border-left">
                                        <div className="img"><img src={'/assets/images/'+project.image} /></div>
                                        <div className="text">
                                            <div className="item-name"><a href="#">{wallet.network_name} node</a></div>
                                            <div className="item-text">
                                                <div className="whitetext">Wallet address: {shortenAddress(wallet.wallet_address)}</div>
                                                <div className="bluetext">{chain.chain_name}</div>	
                                            </div>
                                        </div>
                                        <div className="action">
                                            <a href="#"><img src="/img/icon-edit-2.svg" /></a>
                                        </div>
                                    </div>
                                    <p className="graytext">The installation process may take from 2 hours to 3 days. You can close this window. We will notify you when the installation is finished and send you a link to complete the last steps. You can track progress also in your <a href="">personal area.</a></p>
                                    <div className="img"><img src="/img/node-installation-process.png" /></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    )
}
export default NodeInstall;