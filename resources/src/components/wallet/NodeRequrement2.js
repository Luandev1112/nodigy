import React, {useEffect, useState} from 'react';
const NodeRequirement2 = () => {
    useEffect(() => {
       console.log("useEffect");
    });
    return (
        <div className="steps-content nodeinstallation">
            <div className="container">
                <div className="row">
                    <div className="col-sm-12">
                        <div className="borerbox border-0 bg-transparent ps-0">
                            <div className="items border-left border-down">
                                <div className="p30">
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
                                    <div className="nod-red-text">
                                        <h4>Node requirements:</h4>
                                        <p>Min tokens amount: 500 $NYM</p>
                                        <p>Recommended tokens amount: 70 000 $NYM</p>
                                        <p>Gas fee paid in: $ETH</p>
                                        <p>You can buy NYM tokens on MEXC, OKX, Binance and Huobi</p>
                                        <p>Follow our <a href="">video</a> or <a href="">text guide</a></p>
                                    </div>
                                    <div className="nodeyourballance item border-left">
                                        <div className="icon"><img src="/img/icon-empty-wallet.svg" /></div>
                                        <div className="text">
                                            <p><span>Your balance is 12.43 $NYM</span> Too low to stake</p>
                                        </div>
                                        <div className="action"><a href="#"><img src="/img/icon-refresh-circle-white.svg" /></a></div>
                                    </div>
                                    <div className="n_r_form_field">
                                        <p>85 485.56 $NYM <span>MAX</span></p>
                                        <div className="form-group">
                                            <span>$NYM</span>
                                            <input type="text" className="form-control" value="10" />
                                        </div>
                                    </div>
                                    <div className="btn-container">
                                        <a href="#" className="btn btn-primary btn-buytoken">Buy tokens with fiat</a>
                                        <a href="#" className="btn btn-primary btn-buytoken">Buy tokens with crypto</a>
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
export default NodeRequirement2;