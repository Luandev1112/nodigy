import React, {useState, useEffect} from 'react';
import {BrowserRouter as Router, Routes, Route} from 'react-router-dom';
import Http from "./utils/Http";
// Pages import Here 
import Dashobard from "./pages/Dashboard";
import Wallets from "./pages/Wallets";
import MyBalance from "./pages/MyBalance";
import Delegation from "./pages/Delegation";
import Node from "./pages/Node";
import WalletDetail from "./pages/WalletDetail";
import DelegationDetails from "./pages/DelegationDetails";
import EmailSetting from "./pages/EmailSetting";
import NotificationsSetting from "./pages/NotificationsSetting";
import SocialsSetting from "./pages/SocialsSetting";
import WalletConnect from "./pages/WalletConnect";
import Error from "./pages/Error";
const App = () => {
    const [isLogin, setIsLogin] = useState(false);
    const [url, setUrl] = useState('');
    const checkUser = async() => {
        try{
            const res = await Http.get('/admin/getuser');
            setIsLogin(true);
        }catch(err){
            const statusCode = err.response.status;
            if(statusCode == 401 || statusCode == 405)
            {
                window.location.href = "/logout";
            }
        }
    }

    const setPath = (path) => {
        setUrl(path);
    }

    checkUser();
    useEffect(()=>{
        checkUser();
    }, [url]);
    return (
        <Router>
        {
            isLogin && (
                <Routes>
                    <Route exact path="/" element={<Dashobard setPath={setPath} />} />
                    <Route path="/admin" element={<Dashobard setPath={setPath} />} />
                    <Route path="/admin/dashboard" element={<Dashobard setPath={setPath} />} />
                    <Route path="/admin/wallets" element={<Wallets setPath={setPath} />} />
                    <Route path="/admin/mybalance" element={<MyBalance />} />
                    <Route path="/admin/delegation" element={<Delegation />} />
                    <Route path="/admin/node" element={<Node />}/>
                    <Route path="/admin/wallet-details" element={<WalletDetail />}/>
                    <Route path="/admin/delegatin-details" element={<DelegationDetails />}/>
                    <Route path="/admin/emails-setting" element={<EmailSetting />}/>
                    <Route path="/admin/notifications-setting" element={<NotificationsSetting />}/>
                    <Route path="/admin/social-accounts" element={<SocialsSetting />}/>
                    <Route path="/admin/add-new-node" element={<WalletConnect />}/>
                    <Route path="/error" element={Error}/>
                </Routes>
            )
        }
        </Router>
    )
}
export default App
