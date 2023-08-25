import React, {useEffect, useState} from 'react';
import Http from "../../utils/Http";
import { Form, Dropdown } from 'react-bootstrap';
import flagList from "../../data/wallet/flagList.json"

const ChooseServer = ({setStep, setSubStep, balance, setMyBalance, chooseServer, project, server}) => {

    const [selectedId, setSelectedId] = useState(0);
    const [limitBalance, setLimitBalance] = useState(0);
    const [selectedServer, setSelectedServer] = useState(null);
    const [servers, setServers] = useState([]);
    const [onbordingFee, setOnbordingFee] = useState(project.setup_fee);
    const [monthlyPrice, setMonthlyPrice] = useState(0);
    const [dataCenters, setDataCenter] = useState(['Hartzner']);
    const [selectedDataCenter, setSelectedDataCenter] = useState(0);
    const [selectedFlagIndex, setSelectedFlagIndex] = useState(-1);

    const selectServer = (idx) => {
        const _selectedServer = servers[idx];
        setSelectedServer(_selectedServer);
        setSelectedId(_selectedServer.id);
        setMonthlyPrice(_selectedServer.monthly_price);
        const _limitBalance = onbordingFee*1 + _selectedServer.monthly_price*1;
        setLimitBalance(_limitBalance);
        chooseServer(_selectedServer);
    }

    const gotoTopupPage = async() => {
        if(balance > limitBalance){
            // payment function here
            if(selectedServer) {
                const formData = new FormData();
                formData.append('server_id', selectedServer.id);
                formData.append('project_id', project.id);
                const result = await Http.post('/admin/api/purchaseServer', formData);
                const userBalance = result.data.user_balance;
                setMyBalance(userBalance);
            }
            setSubStep('');
            setStep(4);
            
        }else{
            setSubStep('topup');
            setStep(5);
        }
    }

    const getAllServers = async() => {
        const _servers = await Http.get('admin/api/getAllServers');
        setServers(_servers.data);
    }

    const selectDatacenter = (idx) => {
        setSelectedDataCenter(idx);
    }

    const selectFlag = (idx) => {
        setSelectedFlagIndex(idx);
    }

    useEffect(() => {
        getAllServers();
        if(server) {
            setSelectedId(server.id); 
            setMonthlyPrice(server.monthly_price);
            const _limitBalance = onbordingFee*1 + server.monthly_price*1;
            setLimitBalance(_limitBalance);
            setSelectedServer(server);
        }
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
                                            { servers.length > 0 &&
                                                servers.map((server, i) => {
                                                    return (
                                                        <tr key={i} onClick={()=>selectServer(i)} className={selectedId==server.id?"selected":""}>
                                                            <td className="graytext"> { i+1 }</td>
                                                            <td>{server.server_name}</td>
                                                            <td><span className="vcpus"><img src="/img/icon-vspus.svg" /> {server.vcpus}</span></td>
                                                            <td className="graytext"> {server.ram}</td>
                                                            <td><span><img src="/img/icon-storage.svg" /> {server.ssd}</span></td>
                                                        </tr>
                                                    );
                                                })
                                            }
                                        </tbody>
                                    </table>
                                </div>

                                <div className="form-group mt-4">
                                    <label>Choose Server Configuration</label>
                                    <Dropdown className="dropdown-currency">
                                        <Dropdown.Toggle variant="default" id="">
                                            {
                                                selectedDataCenter >= 0 ?
                                                <React.Fragment>
                                                   {dataCenters[selectedDataCenter]}
                                                   <span className="caret"></span>
                                                </React.Fragment> :
                                                <React.Fragment>
                                                    <a>Please select datacenter</a>
                                                    <span className="caret"></span>
                                                </React.Fragment>
                                            }
                                        </Dropdown.Toggle>

                                        <Dropdown.Menu>
                                        {
                                            dataCenters.length > 0 && dataCenters.map((dataCenter, i) => {
                                                return(
                                                    <li key={i}>
                                                        <Dropdown.Item onClick={()=>selectDatacenter(i)}> { dataCenter }</Dropdown.Item>
                                                    </li>
                                                )
                                            })
                                        }
                                        </Dropdown.Menu>
                                    </Dropdown>
                                </div>
                                
                                <div className="form-group mt-4">
                                    <label>Choose a country</label>
                                    <Dropdown className="dropdown-currency">
                                        <Dropdown.Toggle variant="default" id="">
                                            {
                                                selectedFlagIndex >= 0 ?
                                                <React.Fragment>
                                                    <img src={"/images/flags/" + flagList[selectedFlagIndex].slug + ".svg"} className="rounded-circle" /> {flagList[selectedFlagIndex].name}
                                                    <span className="caret"></span>
                                                </React.Fragment> :
                                                <React.Fragment>
                                                    <a>Please select country</a>
                                                    <span className="caret"></span>
                                                </React.Fragment>
                                            }
                                        </Dropdown.Toggle>

                                        <Dropdown.Menu>
                                        {
                                            flagList.length > 0 && flagList.map((flag, i) => {
                                                return(
                                                    <li key={i}>
                                                        <Dropdown.Item onClick={()=>selectFlag(i)}><img src={"/images/flags/" + flag.slug + ".svg"} className="rounded-circle" /> { flag.name }</Dropdown.Item>
                                                    </li>
                                                )
                                            })
                                        }
                                        </Dropdown.Menu>
                                    </Dropdown>
                                </div>

                                <div className="blueboxtext"><p>Minimum required server configuration means fewer rewards, but also lower monthly payments. The maximized configuration will increase the charge, but you'll also get from validating the most. Recommended parameters option exists to balance things out.</p></div>
                            </div>
                        </div>
                    </div>
                    <div className="col-sm-5">
                        <div className="borerbox" style={{border:0, background:'transparent', paddingLeft:0}}>
                            <div className="items transferdetailsbox server-balance-block border-left">
                                <div className="title">My Balance <span>{balance} $USDT</span></div>
                                <h4>Payment details</h4>
                                <div className="row">
                                    <label className="col-sm-8">Server Monthly Payment</label>
                                    <p className="col-sm-4">{monthlyPrice} $USDT</p>
                                </div>
                                <div className="row">
                                    <label className="col-sm-8">One-time onboarding fee</label>
                                    <p className="col-sm-4">{onbordingFee} $USDT</p>
                                </div>
                                <div className="totalrow">
                                    <div className="row">
                                        <label className="col-sm-8">Total</label>
                                        <p className="col-sm-4 mt-2">{limitBalance} $USDT</p>
                                    </div>
                                </div>
                                {
                                    balance>limitBalance?"":<div className="insufficientbalance">Your balance has insufficient funds</div>
                                }
                                
                                <div className="btn-container">
                                    <a onClick={()=>gotoTopupPage()} className={balance>limitBalance?"btn btn-new btn-primary":"btn btn-gray"}>{balance>limitBalance?"Complete Payment":"Top-up account"}</a>
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