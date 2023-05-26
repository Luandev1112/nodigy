import React, {useEffect, useState} from 'react';
const NodeInstall = () => {
    useEffect(() => {
       console.log("useEffect");
    });
    return (
        <div className="steps-content nodeinstallation">
            <div className="container">
                <div className="row">
                    <div className="col-sm-12">
                        <div className="borerbox" style={{border:0, background:'transparent', paddingLeft:0}} >
                            <div className="items border-left border-down">
                                <div className="p30">
                                    <div className="title">Node Installation</div>
                                    <div className="step-loader">
                                        <div className="img"><img src="/img/node-installation-process-icon.png" /></div>
                                        <div className="text">Installation in progress</div>
                                    </div>
                                    <div className="item border-left">
                                        <div className="img"><img src="/img/nodes-logo-icon1.png" /></div>
                                        <div className="text">
                                            <div className="item-name"><a href="#">NYM node</a></div>
                                            <div className="item-text">
                                                <div className="whitetext">Wallet address: 0xdf...5yg8br</div>
                                                <div className="bluetext">NYM (NYX Mainnet)</div>	
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