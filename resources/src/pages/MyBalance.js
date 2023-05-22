import React, {useState, useEffect} from 'react';
import Sidebar from '../common/header/Sidebar';
import HeaderTopBar from '../common/header/HeaderTopBar';
import BalanceTier from '../components/mybalance/BalanceTier';
import BalanceTable from '../components/mybalance/BalanceTable';
import { Accordion, Card, Button, Dropdown } from 'react-bootstrap';
import tableData from '../data/mybalance/BalanceTable.json';

const MyBalance = () => {
    return (
        <div className="wrapper mybalance">
            <Sidebar  menu="mybalance" />

            <div className="wrapper-content">
                <HeaderTopBar menu="mybalance" />
                <BalanceTier />
                <div className="nearestpayment">
                    <p><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.9105 10.72H14.8205V3.51999C14.8205 1.83999 13.9105 1.49999 12.8005 2.75999L12.0005 3.66999L5.2305 11.37C4.3005 12.42 4.6905 13.28 6.0905 13.28H9.1805V20.48C9.1805 22.16 10.0905 22.5 11.2005 21.24L12.0005 20.33L18.7705 12.63C19.7005 11.58 19.3105 10.72 17.9105 10.72Z" fill="#EAB308"/></svg> <span>Nearest Paymenet: 346.85 $USDC at <strong>23.01.2023</strong></span></p>
                </div>
                <BalanceTable data={tableData} />

            </div>
        </div>
    )
}

export default MyBalance
