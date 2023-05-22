import React, {useState, useEffect} from 'react';
import Graphimage from "../../assets/img/stats.png";
import LogoIcon1 from "../../assets/img/logo-icon 1.png";
import IconSorting from "../../assets/img/icon-sorting-table.svg";
import IconArrowImage from "../../assets/img/icon-arrow-right.png";
import { Accordion, Card, Button, Dropdown } from 'react-bootstrap';
const BalanceTable = ({data}) => {
    const [tableData, setTableData] = useState([]);

    useEffect(()=>{
       setTableData(data);
    }, [data]);
    return (
        <div className="dashboard-tier2 mybalance-tier2">
            <div className="title">
                <h3>Transactions</h3>
                <span>Total Paid: 1,546.567 $USDC</span>
            </div>
            <div className="table-responsive">
                <table className="table custable">
                    <thead>
                        <tr>
                            <th><span>Date</span> <a href="#" className="btn-sortdata"><img src={IconSorting} /></a></th>
                            <th><span>Amount,$USDC</span> <a href="#" className="btn-sortdata"><img src={IconSorting} /></a></th>
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
                                    <td><strong>{row.paymentType}</strong></td>
                                    <td className="projectnameimg"><div className="img"><img src={LogoIcon1} height="32" /></div> <span>Name Project & Logo</span></td>
                                    <td><strong className={row.statusCalss}>{row.status}</strong></td>
                                    <td><strong>{row.walletAddress}</strong></td>
                                    <td><a href="#" className="btn-arrow-right"><img src={IconArrowImage} /></a></td>
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
                            <li><a href="javascript:void(0)">10</a></li>
                            <li><a href="javascript:void(0)">20</a></li>
                        </ul>
                    </div>
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
export default BalanceTable
