import React, {useState, useEffect} from 'react';
import Sidebar from '../common/header/Sidebar';
import HeaderTopBar from '../common/header/HeaderTopBar';
import BalanceTier from '../components/mybalance/BalanceTier';
import BalanceTable from '../components/mybalance/BalanceTable';
import { Accordion, Card, Button, Dropdown } from 'react-bootstrap';
import tableData from '../data/mybalance/BalanceTable.json';
import Http from "../utils/Http";

const MyBalance = () => {
    const [transactionData, setTransactionData] = useState([]);
    const [myBalance, setMyBalance] = useState(0);

    const changeBalance = (balance) => {
        setMyBalance(balance);
    }

    const getTransactionData = async() => {
        const res = await Http.get("/admin/api/getUserTransaction");
        setTransactionData(res.data.transaction_array);
        console.log("transaction data => ", res.data);
    }

    useEffect(()=> {
        getTransactionData();
    }, [myBalance]);
    return (
        <div className="wrapper mybalance">
            <Sidebar  menu="mybalance" />

            <div className="wrapper-content">
                <HeaderTopBar menu="mybalance" myBalance={myBalance} />
                <BalanceTier changeBalance={changeBalance} />
                <BalanceTable data={transactionData} />
            </div>
        </div>
    )
}

export default MyBalance
