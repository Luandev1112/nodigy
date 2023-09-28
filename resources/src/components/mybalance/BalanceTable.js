import React, {useState, useEffect} from 'react';
import Graphimage from "../../assets/img/stats.png";
import LogoIcon1 from "../../assets/img/logo-icon 1.png";
import IconSorting from "../../assets/img/icon-sorting-table.svg";
import IconArrowImage from "../../assets/img/icon-arrow-right.png";
import { Accordion, Card, Button, Dropdown } from 'react-bootstrap';
import { shortenAddress } from "../../utils/script";
const BalanceTable = ({data}) => {
    const [tableData, setTableData] = useState([]);
    const transactionUrl = "https://nile.tronscan.io/#/transaction/";

    useEffect(()=>{
       setTableData(data);
    }, [data]);
    return (
        <React.Fragment>
            <div className="nearestpayment">
                <p><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.9105 10.72H14.8205V3.51999C14.8205 1.83999 13.9105 1.49999 12.8005 2.75999L12.0005 3.66999L5.2305 11.37C4.3005 12.42 4.6905 13.28 6.0905 13.28H9.1805V20.48C9.1805 22.16 10.0905 22.5 11.2005 21.24L12.0005 20.33L18.7705 12.63C19.7005 11.58 19.3105 10.72 17.9105 10.72Z" fill="#EAB308"/></svg>
                <span>Nearest Paymenet: 346.85 $USDT at <strong>23.01.2023</strong></span></p>
            </div>
            <div className="dashboard-tier2 mybalance-tier2">
                <div className="title">
                    <h3>Transactions</h3>
                    <span>Total Paid: 1,546.567 $USDT</span>
                </div>
                <div className="table-responsive">
                    <table className="table custable">
                        <thead>
                            <tr>
                                <th><span>Date</span> <a href="#" className="btn-sortdata"><img src={IconSorting} /></a></th>
                                <th><span>Amount,$USDT</span> <a href="#" className="btn-sortdata"><img src={IconSorting} /></a></th>
                                <th><span>Purpose of payment</span> <a href="#" className="btn-sortdata"><img src={IconSorting} /></a></th>
                                <th><span>Project</span> <a href="#" className="btn-sortdata"><img src={IconSorting} /></a></th>
                                <th><span>Status</span> <a href="#" className="btn-sortdata"><img src={IconSorting} /></a></th>
                                <th><span>TXH</span> <a href="#" className="btn-sortdata"><img src={IconSorting} /></a></th>
                                <th><span></span></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <Dropdown className="more">
                                    <Dropdown.Toggle variant="default" id="">Select</Dropdown.Toggle>
                                    <Dropdown.Menu>
                                        <li><Dropdown.Item href="#">Select 1</Dropdown.Item></li>
                                        <li><Dropdown.Item href="#">Select 2</Dropdown.Item></li>
                                    </Dropdown.Menu>
                                    </Dropdown>
                                </td>
                                <td>
                                    <Dropdown className="more">
                                    <Dropdown.Toggle variant="default" id="">Select</Dropdown.Toggle>
                                    <Dropdown.Menu>
                                        <li><Dropdown.Item href="#">Select 1</Dropdown.Item></li>
                                        <li><Dropdown.Item href="#">Select 2</Dropdown.Item></li>
                                    </Dropdown.Menu>
                                    </Dropdown>
                                </td>
                                <td><input type="text" className="form-control" /></td>
                                <td>
                                    <Dropdown className="more">
                                    <Dropdown.Toggle variant="default" id="">Select</Dropdown.Toggle>
                                    <Dropdown.Menu>
                                        <li><Dropdown.Item href="#">Select 1</Dropdown.Item></li>
                                        <li><Dropdown.Item href="#">Select 2</Dropdown.Item></li>
                                    </Dropdown.Menu>
                                    </Dropdown>
                                </td>
                                <td>
                                    <div className="dropdown">
                                        <button className="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">All </button>
                                        <ul className="dropdown-menu" aria-labelledby="dropdown-currency">
                                            <li><a href="#">1</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td>
                                    <div className="dropdown">
                                        <button className="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">All </button>
                                        <ul className="dropdown-menu" aria-labelledby="dropdown-currency">
                                            <li><a href="#">1</a></li>
                                        </ul>
                                    </div>
                                </td>
                                <td></td>
                            </tr>
                            {
                                tableData.map((row, i)=>{
                                    return (
                                    <tr key={i}>
                                        <td><strong>{row.date}</strong></td>
                                        <td><strong>{row.amount}</strong></td>
                                        <td><strong>{row.purpose}</strong></td>
                                        <td className="projectnameimg">
                                            <div className="img">
                                                {row.project_name != '-' ?
                                                    <img src={LogoIcon1} height="32" /> :
                                                    ''
                                                }
                                            </div> <span>{row.project_name}</span></td>
                                        <td><strong className={row.statusClass}>{row.status}</strong></td>
                                        <td><strong>{shortenAddress(row.txnHash)}</strong></td>
                                        <td><a href={transactionUrl+row.txnHash} className="btn-arrow-right" target="_blank"><img src={IconArrowImage} /></a></td>
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
                        <div className="dropdown showfilterdropdown">
                            <button className="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">10</button>
                            <ul className="dropdown-menu" aria-labelledby="">
                                <li><a>10</a></li>
                                <li><a>20</a></li>
                            </ul>
                        </div>
                    </div>
                    <div className="paginations">
                        <nav aria-label="Page navigation example">
                            <ul className="pagination">
                                <li className="page-item"><a className="page-link" href="#">Prev</a></li>
                                <li className="page-item"><a className="page-link" href="#">1</a></li>
                                <li className="page-item"><a className="page-link" href="#">2</a></li>
                                <li className="page-item"><a className="page-link" href="#">3</a></li>
                                <li className="page-item"><a className="page-link" href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </React.Fragment>
    )
}
export default BalanceTable
