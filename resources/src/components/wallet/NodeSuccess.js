import React, {useEffect, useState} from 'react';
const NodeSuccess = () => {
    useEffect(() => {
       console.log("useEffect");
    });
    return (
        <div className="steps-content nodeinstallation installation">
            <div className="container">
                <div className="row">
                    <div className="col-sm-12">
                        <div className="borerbox border-0 bg-transparent ps-0">
                            <div className="items border-left border-down">
                                <div className="p30">
                                    <div className="title">Installation</div>
                                    <div className="step-loader">
                                        <div className="img"><img src="/img/icon-installation.png" /></div>
                                        <div className="text">Installation completed</div>
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
                                    <div className="table-responsive">
                                        <table className="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td>Node address:</td>
                                                    <td><span>0x425BEde68e1bF2bD9f76432E5eA9e22BE71257a9</span><a href="#"><img src="/img/icon-copy.svg" /></a></td>
                                                </tr>
                                                <tr>
                                                    <td>Node IP: </td>
                                                    <td><span>5.161.53.14:</span><a href="#"><img src="/img/icon-copy.svg" /></a></td>
                                                </tr>
                                                <tr>
                                                    <td>Owner wallet:</td>
                                                    <td><span>0x12ff65BC4c9818B0721fc23a79B1cDcE891cEa83</span><a href="#"><img src="/img/icon-copy.svg" /></a></td>
                                                </tr>
                                                <tr>
                                                    <td>API_URL: </td>
                                                    <td><span>https://eth-mainnet.alchemyapi.io/v2/</span><a href="#"><img src="/img/icon-copy.svg" /></a></td>
                                                </tr>
                                                <tr>
                                                    <td>API_KEY:</td>
                                                    <td><span>ZOL6KhkBnH6xPwaWoX7jethGnlCjgkIz</span><a href="#"><img src="/img/icon-copy.svg" /></a></td>
                                                </tr>
                                                <tr>
                                                    <td colSpan="2" className="text-center"><a href="#" className="fullurl">https://explorer.forta.network/scan-node/0x425BEde68e1bF2bD9f76432E5eA9...</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div className="btn-container"><a href="node-requirement1.html" className="btn btn-primary width100">Stake tokens to my node</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    )
}
export default NodeSuccess;