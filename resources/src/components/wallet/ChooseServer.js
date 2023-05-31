import React, {useEffect, useState} from 'react';
import serverList from '../../data/wallet/serverList.json';

const ChooseServer = ({setStep, setSubStep, valance}) => {

    const [selectedId, setSelectedId] = useState(0);
    const [limitValance, setLimitValance] = useState(10);
    console.log('valance ==> ', valance);

    const selectServer = (id) => {
        setSelectedId(id);
    }

    const gotoTopupPage = () => {
        if(valance > limitValance){
            // payment function here
            setSubStep('deposit-success');
            setStep(7);
            
        }else{
            setSubStep('topup');
            setStep(5);
        }
    }

    useEffect(() => {

    }, []);
    return (
        <div className="steps-content fullwidthcontainer fiatscreen step5">
            <div className="container">
                <div className="row">
                    <div className="col-sm-7">
                        <div className="borerbox">
                            <div className="p30">
                                <h3>Choose server configuration</h3>
                                
                                <div className="server_table table-responsive">
                                    <table className="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>VCPUS</th>
                                                <th>RAM</th>
                                                <th>SSD</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            { 
                                                serverList.map((server, i) => {
                                                    return (
                                                        <tr key={i} onClick={()=>selectServer(server.id)} className={selectedId==server.id?"selected":""}>
                                                            <td className="graytext"> { i+1 }</td>
                                                            <td>{server.name}</td>
                                                            <td><span><img src="/img/icon-vspus.svg" /> {server.vcpus}</span></td>
                                                            <td className="graytext"> {server.ram}</td>
                                                            <td><span><img src="/img/icon-storage.svg" /> {server.ssd}</span></td>
                                                        </tr>
                                                    );
                                                })
                                            }
                                        </tbody>
                                    </table>
                                </div>
                                <div className="blueboxtext"><p>Minimum required server configuration means fewer rewards, but also lower monthly payments. The maximized configuration will increase the charge, but you'll also get from validating the most. Recommended parameters option exists to balance things out.</p></div>
                            </div>
                        </div>
                    </div>
                    <div className="col-sm-5">
                        <div className="borerbox" style={{border:0, background:'transparent', paddingLeft:0}}>
                            <div className="items transferdetailsbox server-balance-block border-left">
                                <div className="title">My Balance <span>12 $USDT</span></div>
                                <h4>Payment details</h4>
                                <div className="row">
                                    <label className="col-sm-8">One-time onboarding fee</label>
                                    <p className="col-sm-4">20 $USDT</p>
                                </div>
                                <div className="totalrow">
                                    <div className="row">
                                        <label className="col-sm-8">Total</label>
                                        <p className="col-sm-4 mt-2">20 $USDT</p>
                                    </div>
                                </div>
                                {
                                    valance>limitValance?"":<div className="insufficientbalance">Your balance has insufficient funds</div>
                                }
                                
                                <div className="btn-container">
                                    <a onClick={()=>gotoTopupPage()} className={valance>limitValance?"btn btn-new btn-primary":"btn btn-gray"}>{valance>limitValance?"Complete Payment":"Top-up account"}</a>
                                </div>
                            </div>
                        </div>
                        <p className="whitetext">Feel free to contact our support for any possible questions:</p>
                        <div className="f-c-d-support">
                            <div className="email">
                                <a href="#">support@nodigy.com</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default ChooseServer;