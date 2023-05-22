import React, {useState, useEffect} from 'react';
import Graphimage from "../../assets/img/stats.png";
import LogoIcon1 from "../../assets/img/logo-icon 1.png";
import IconSortingImage from "../../assets/img/icon-sorting-table.svg";
import IconArrowImage from "../../assets/img/icon-arrow-right.png";
import IconCopyImage from "../../assets/img/icon-copy.png";
import { Accordion, Card, Button, Dropdown } from 'react-bootstrap';
import {Link} from "react-router-dom";
const DelegationTable = ({data}) => {
    const [tableData, setTableData] = useState([]);

    useEffect(()=>{
       setTableData(data);
    }, [data]);
    return (
        <div className="dashboard-tier2 delegation-tier2">
            <div className="table-responsive">
                <table className="table custable">
                    <thead>
                        <tr>
                            <th><span>Project</span> <a href="#" className="btn-sortdata"><img src={IconSortingImage} /></a></th>
                            <th><span>Validator</span> <a href="#" className="btn-sortdata"><img src={IconSortingImage} /></a></th>
                            <th><span>My Delegation</span> <a href="#" className="btn-sortdata"><img src={IconSortingImage} /></a></th>
                            <th><span>Rewards</span> <a href="#" className="btn-sortdata"><img src={IconSortingImage} /></a></th>
                            <th><span>Ulclaimed</span> <a href="#" className="btn-sortdata"><img src={IconSortingImage} /></a></th>
                            <th><span>Wallet</span> <a href="#" className="btn-sortdata"><img src={IconSortingImage} /></a></th>
                            <th><span></span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <Dropdown className="nodename">
                                  <Dropdown.Toggle variant="default" id="">
                                    All ID
                                  </Dropdown.Toggle>
                                  <Dropdown.Menu>
                                    <li><Dropdown.Item href="#">1</Dropdown.Item></li>
                                    <li><Dropdown.Item href="#">2</Dropdown.Item></li>
                                  </Dropdown.Menu>
                                </Dropdown>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <Dropdown className="nodename">
                                  <Dropdown.Toggle variant="default" id="">
                                    All
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
                                        <td className="projectnameimg"><div className="img"><img src={LogoIcon1} height="32" /></div> <span>{row.projectName}</span></td>
                                        <td><div className="coprlink">{row.validator} <a href="#"><img src={IconCopyImage} /></a></div></td>
                                        <td><strong>{row.delegation}</strong></td>
                                        <td><strong>{row.rewards}</strong></td>
                                        <td><strong>{row.claim}</strong></td>
                                        <td>
                                             <div className="table-box-content">
                                                <div className="img"><img src={LogoIcon1} /></div>
                                                <div className="t-b-c-innert">
                                                    <strong>{row.nodeName}</strong>
                                                    <div className="coprlink">{row.walletName} <a href="#"><img src={IconCopyImage} /></a></div>
                                                </div>
                                             </div>
                                        </td>
                                        <td><Link to="/admin/delegatin-details" className="btn-arrow-right"><img src={IconArrowImage} /></Link></td>
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
export default DelegationTable
