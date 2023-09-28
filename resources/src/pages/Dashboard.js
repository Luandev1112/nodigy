import React, {useState, useEffect} from 'react';
import Sidebar from '../common/header/Sidebar';
import HeaderTopBar from '../common/header/HeaderTopBar';
import DashboardTier from '../components/dashboard/DashboardTier';
import DashboardTable from '../components/dashboard/DashboardTable';
import { Accordion, Card, Button, Dropdown } from 'react-bootstrap';
import tableData from '../data/dashboard/DashboardTable.json';
const Dashboard = ({setPath}) => {
    useEffect(()=>{
        setPath('dashboard');
    }, []);
    return (
        <div className="wrapper dashboard">
            <Sidebar menu="dashboard" />
            <div className="wrapper-content">
                <HeaderTopBar menu="dashboard" />
                <DashboardTier />
                <DashboardTable data={tableData} />
            </div>
        </div>
    )
}
export default Dashboard

