import React, {useEffect, useState} from 'react';
const NodePreparation = ({setStep, setSubStep}) => {
    useEffect(() => {
       console.log("useEffect");
    });
    return (
        <div className="steps-content nodeinstallation">
            <div className="container">
                <div className="row">
                    <div className="col-sm-12">
                        <div className="borerbox" style={{border:0, background:'transparent', paddingLeft:0}}>
                            <div className="items border-left border-down">
                                <div className="p30">
                                    <div className="title">Node Installation Preparing</div>
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
                                    
                                    <div className="node-prep-steps">
                                        <ul>
                                            <li>
                                                <div className="img"><img src="/img/node-prep-icon1.svg" /></div>
                                                <div className="text">
                                                    <p className="title">1. Hardware: CPU Intel 4 core; RAM 10 Gb; SSD 1Tb </p>
                                                </div>
                                            </li>
                                            <li>
                                                <div className="img"><img src="/img/node-prep-icon2.svg" /></div>
                                                <div className="text">
                                                    <p className="title">2. Add scanner pool</p>
                                                    <p>Go to https://app.forta.network/ and follow our video guide</p>
                                                    <div className="image"><img src="/img/add-scanner-pool.png" /></div>
                                                </div>
                                            </li>
                                            <li>
                                                <div className="img"><img src="/img/node-prep-icon3.svg" /></div>
                                                <div className="text">
                                                    <p className="title">3. Enter pool details for my node</p>
                                                    <p>Go to https://app.forta.network/ and follow our video guide</p>
                                                </div>
                                            </li>
                                        </ul>
                                        <div className="row">
                                            <div className="col-sm-6">
                                                <div className="form-group">
                                                    <label>Pool ID</label>
                                                    <input type="text" className="form-control" value="12345" />
                                                </div>
                                            </div>
                                            <div className="col-sm-6">
                                                <div className="form-group">
                                                    <label>Pool chain</label>
                                                    <div className="dropdown dropdown-currency dropdown-poolchain">
                                                        <button className="btn btn-default dropdown-toggle" type="button" id="dropdown-currency" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="/img/country-img.png" /> Pool chain <span className="caret"></span></button>
                                                        <ul className="dropdown-menu" aria-labelledby="dropdown-currency">
                                                            <li><a href="#"><img src="/img/country-img.png" /> Pool chain</a></li>
                                                        </ul>
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
            </div>
        </div>
    )
}
export default NodePreparation;