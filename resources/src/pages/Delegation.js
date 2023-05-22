import React from 'react'
import Sidebar from '../common/header/Sidebar';
import HeaderTopBar from '../common/header/HeaderTopBar';
import DelegationTier from '../components/delegation/DelegationTier';
import DelegationTable from '../components/delegation/DelegationTable';
import { Accordion, Card, Button, Dropdown } from 'react-bootstrap';
import tableData from '../data/delegation/DelegationTable.json';
const Delegation = () => {
    
    return (
        <div className="wrapper delegation">
            <Sidebar  menu="delegation" />

            <div className="wrapper-content">
                <HeaderTopBar menu="delegation" />
                <DelegationTier />
                <DelegationTable data={tableData} />
            </div>
        </div>
    )
}
export default Delegation

