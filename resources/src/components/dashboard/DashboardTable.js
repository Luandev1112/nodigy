import React, {useState, useEffect} from 'react';
import Graphimage from "../../assets/img/stats.png";
import LogoIcon1 from "../../assets/img/logo-icon 1.png";
import { Accordion, Card, Button, Dropdown } from 'react-bootstrap';
const DashboardTable = ({data}) => {
    const [tableData, setTableData] = useState([]);

    useEffect(()=>{
       setTableData(data);
    }, [data]);
    return (
        <div className="dashboard-tier2">
            <div className="table-responsive">
                <table className="table custable">
                    <thead>
                        <tr>
                            <th><span>Node ID</span></th>
                            <th><span>Project</span></th>
                            <th><span>Node name</span>
                                <Dropdown className="nodename">
                                  <Dropdown.Toggle variant="default" id="">
                                    <svg width="10" height="6" viewBox="0 0 10 6" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M8.94662 0.453369H4.79329H1.05329C0.413288 0.453369 0.0932878 1.2267 0.546621 1.68004L3.99995 5.13337C4.55329 5.6867 5.45329 5.6867 6.00662 5.13337L7.31995 3.82004L9.45995 1.68004C9.90662 1.2267 9.58662 0.453369 8.94662 0.453369Z" fill="#E8EDFF"/></svg>
                                  </Dropdown.Toggle>

                                  <Dropdown.Menu>
                                    <li><Dropdown.Item href="#"><svg width="3" height="14" viewBox="0 0 3 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1.66663 13V1" stroke="#718096" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg> Sort Ascending</Dropdown.Item></li>
                                    <li><Dropdown.Item href="#"><svg width="7" height="4" viewBox="0 0 7 4" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.33325 3L3.33325 1L1.33325 3" stroke="#718096" strokeWidth="1.5" strokeLinecap="round" strokeLinejoin="round"/></svg> Sort Descending</Dropdown.Item></li>
                                    <li><hr /></li>
                                    <li><Dropdown.Item href="#">Hide Column</Dropdown.Item></li>
                                  </Dropdown.Menu>
                                </Dropdown>
                            </th>
                            <th><span>Own stake</span></th>
                            <th><span>Clients stake</span></th>
                            <th><span>APY %</span></th>
                            <th><span>Earned</span></th>
                            <th>
                                <Dropdown className="more">
                                  <Dropdown.Toggle variant="default" id="">
                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.19 3.05176e-05H5.81C2.17 3.05176e-05 0 2.17003 0 5.81003V14.18C0 17.83 2.17 20 5.81 20H14.18C17.82 20 19.99 17.83 19.99 14.19V5.81003C20 2.17003 17.83 3.05176e-05 14.19 3.05176e-05ZM14 10.75H10.75V14C10.75 14.41 10.41 14.75 10 14.75C9.59 14.75 9.25 14.41 9.25 14V10.75H6C5.59 10.75 5.25 10.41 5.25 10C5.25 9.59003 5.59 9.25003 6 9.25003H9.25V6.00003C9.25 5.59003 9.59 5.25003 10 5.25003C10.41 5.25003 10.75 5.59003 10.75 6.00003V9.25003H14C14.41 9.25003 14.75 9.59003 14.75 10C14.75 10.41 14.41 10.75 14 10.75Z" fill="#A0AEC0"/></svg>
                                  </Dropdown.Toggle>

                                  <Dropdown.Menu>
                                    <li><Dropdown.Item href="#">Option 1</Dropdown.Item></li>
                                    <li><Dropdown.Item href="#">Option 2</Dropdown.Item></li>
                                  </Dropdown.Menu>
                                </Dropdown>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <Dropdown className="">
                                  <Dropdown.Toggle variant="default" id="">
                                    All ID
                                  </Dropdown.Toggle>
                                  <Dropdown.Menu>
                                    <li><Dropdown.Item href="#">1</Dropdown.Item></li>
                                    <li><Dropdown.Item href="#">2</Dropdown.Item></li>
                                  </Dropdown.Menu>
                                </Dropdown>
                            </td>
                            <td>
                                <Dropdown className="">
                                  <Dropdown.Toggle variant="default" id="">
                                    Name
                                  </Dropdown.Toggle>
                                  <Dropdown.Menu>
                                    <li><Dropdown.Item href="#">1</Dropdown.Item></li>
                                    <li><Dropdown.Item href="#">2</Dropdown.Item></li>
                                  </Dropdown.Menu>
                                </Dropdown>
                            </td>
                            <td>
                                <Dropdown className="">
                                  <Dropdown.Toggle variant="default" id="">
                                    Node name or wallet
                                  </Dropdown.Toggle>
                                  <Dropdown.Menu>
                                    <li><Dropdown.Item href="#">1</Dropdown.Item></li>
                                    <li><Dropdown.Item href="#">2</Dropdown.Item></li>
                                  </Dropdown.Menu>
                                </Dropdown>
                            </td>
                            <td>
                                <Dropdown className="">
                                  <Dropdown.Toggle variant="default" id="">
                                    100
                                  </Dropdown.Toggle>
                                  <Dropdown.Menu>
                                    <li><Dropdown.Item href="#">1</Dropdown.Item></li>
                                    <li><Dropdown.Item href="#">2</Dropdown.Item></li>
                                  </Dropdown.Menu>
                                </Dropdown>
                            </td>
                            <td>
                                <Dropdown className="">
                                  <Dropdown.Toggle variant="default" id="">
                                    30 Days
                                  </Dropdown.Toggle>
                                  <Dropdown.Menu>
                                    <li><Dropdown.Item href="#">1</Dropdown.Item></li>
                                    <li><Dropdown.Item href="#">2</Dropdown.Item></li>
                                  </Dropdown.Menu>
                                </Dropdown>
                            </td>
                            <td>
                                <Dropdown className="">
                                  <Dropdown.Toggle variant="default" id="">
                                    30 Days
                                  </Dropdown.Toggle>
                                  <Dropdown.Menu>
                                    <li><Dropdown.Item href="#">1</Dropdown.Item></li>
                                    <li><Dropdown.Item href="#">2</Dropdown.Item></li>
                                  </Dropdown.Menu>
                                </Dropdown>
                            </td>
                            <td>
                                <Dropdown className="">
                                  <Dropdown.Toggle variant="default" id="">
                                    30 Days
                                  </Dropdown.Toggle>
                                  <Dropdown.Menu>
                                    <li><Dropdown.Item href="#">1</Dropdown.Item></li>
                                    <li><Dropdown.Item href="#">2</Dropdown.Item></li>
                                  </Dropdown.Menu>
                                </Dropdown>
                            </td>
                            <td></td>
                        </tr>
                        {
                            tableData.map((row, i)=>{
                                return (
                                  <tr key={i}>
                                    <td>{row.nodeId}</td>
                                    <td>{row.token}</td>
                                    <td>
                                         <div className="table-box-content">
                                            <div className="img"><img src={LogoIcon1} /></div>
                                            <p className="t-b-c-innert">
                                                <strong>{row.nodeName}</strong>
                                                <span>Forta Forta Forta</span>
                                            </p>
                                         </div>
                                    </td>
                                    <td><strong>{row.ownStake}</strong></td>
                                    <td><strong>{row.clientsStake}</strong></td>
                                    <td><strong>{row.APY}</strong></td>
                                    <td><strong>{row.Earned}</strong></td>
                                    <td></td>
                                  </tr>
                                );
                            })
                        }
                    </tbody>
                </table>
            </div>
            <div className="tablefooter">
                <div className="showfilter">
                    <span>Show</span>
                    <Dropdown className="showfilterdropdown">
                        <Dropdown.Toggle variant="default" id="">10</Dropdown.Toggle>
                        <Dropdown.Menu>
                            <li><Dropdown.Item href="javascript:void(0)">10</Dropdown.Item></li>
                            <li><Dropdown.Item href="javascript:void(0)">20</Dropdown.Item></li>
                        </Dropdown.Menu>
                    </Dropdown>
                </div>
                <div className="paginations">
                    <nav aria-label="Page navigation example">
                        <ul className="pagination">
                            <li className="page-item"><a className="page-link" href="#">Previous</a></li>
                            <li className="page-item"><a className="page-link" href="#">1</a></li>
                            <li className="page-item"><a className="page-link" href="#">2</a></li>
                            <li className="page-item"><a className="page-link" href="#">3</a></li>
                            <li className="page-item"><a className="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    )
}
export default DashboardTable
