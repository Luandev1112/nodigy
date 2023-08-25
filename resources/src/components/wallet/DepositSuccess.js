import React, {useState, useEffect} from 'react';
const DepositSuccess = ({setStep, setSubStep, balanceType}) => {
    const gotoNextStep = () => {
        switch(balanceType) {
            case 'server':
                setSubStep('');
                setStep(3);
            break;
            case 'node-install':
                setSubStep('');
                setStep(6);
            break;
        }
    }
    return (
        <div className="steps-content nodeinstallation">
            <div className="container">
                <div className="row">
                    <div className="col-sm-12">
                        <div className="borerbox border-0 bg-transparent ps-0">
                            <div className="items border-left border-down">
                                <div className="p30">
                                    <div className="nod-center-text">
                                        <div className="icon"><img src="/img/node-trans-congrats.png" /></div>
                                        <h3>Congratulations!</h3>
                                        <p>This invoice will be available in transaction history <br /> in your personal area</p>
                                    </div>
                                    <div className="table-responsive">
                                        <table className="table table-striped" style={{maxWidth: '560px', margin: '0 auto 40px'}}>
                                            <tbody>
                                                <tr>
                                                    <td>Payment ID:</td>
                                                    <td className="text-right"><span className="whitetext">213213213</span><a href="#"><img src="/img/icon-copy.svg" /></a></td>
                                                </tr>
                                                <tr>
                                                    <td>Amount</td>
                                                    <td className="text-right"><span className="whitetext">301 000, 01464 USDT</span><a href="#"><img src="/img/icon-copy.svg" /></a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div className="btn-container">
                                        <a href="#" className="btn btn-gray">Download PDF</a>
                                        <a onClick={()=>gotoNextStep()} className="btn btn-primary">Next</a>
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
export default DepositSuccess;