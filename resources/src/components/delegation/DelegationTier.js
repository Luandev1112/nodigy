import React from 'react';
import Graphimage from "../../assets/img/stats.png";
import TierIcon1 from "../../assets/img/dashboard-tier1-icon1.png";

const DelegationTier = ({url, id, title}) => {
    return (
        <div className="dashboard-tier1 delegation-tier1">
            <div className="row">
                <div className="col-sm-5">
                    <div className="items item1">
                        <h5>Vestibulum sapien</h5>
                        <p>Etiam eget ante metus. Suspendisse aliquam risus id posuere cursus</p>
                        <div className="btn-container"><a href="#">Delegate Now <svg width="12" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.33337 4H10.6667" stroke="#5129F1" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/> <path d="M8 6.66667L10.6667 4" stroke="#5129F1" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/><path d="M8 1.33337L10.6667 4.00004" stroke="#5129F1" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round"/></svg></a></div>
                    </div>
                </div>
                <div className="col-sm-7">
                    <div className="row">
                        <div className="col-sm-4">
                            <div className="items item2">
                                <div className="text1">Total Staked</div>
                                <div className="text2">$35 752.45</div>
                                <div className="graphimg"><img src={Graphimage} /></div>
                                <div className="icons"><img src={TierIcon1} /></div>
                            </div>
                        </div>
                        <div className="col-sm-4">
                            <div className="items item2">
                                <div className="text1">Total rewards earned</div>
                                <div className="text2">$35 752.45</div>
                                <div className="graphimg"><img src={Graphimage} /></div>
                                <div className="icons"><img src={TierIcon1} /></div>
                            </div>
                        </div>
                        <div className="col-sm-4">
                            <div className="items item2">
                                <div className="text1">Total Unclaimed</div>
                                <div className="text2">$35 752.45</div>
                                <div className="graphimg"><img src={Graphimage} /></div>
                                <div className="icons"><img src={TierIcon1} /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}

export default DelegationTier
