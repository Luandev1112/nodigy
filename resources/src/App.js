import React, {useState, useEffect} from 'react';
import {BrowserRouter as Router, Switch, Route} from 'react-router-dom';
import PageScrollTop from './components/pageToTop/PageScrollTop'
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
            <PageScrollTop>
                <Switch>
                    <Route exact path="/" render={ () => <Dashobard setPath={setPath} />} ></Route>
                    <Route path="/admin" exact render={ () => <Dashobard setPath={setPath} />} />
                    <Route path="/admin/dashboard" exact render={ () => <Dashobard setPath={setPath} />} />
                    <Route path="/admin/wallets" exact render={ () => <Wallets setPath={setPath} />} />
                    <Route path="/admin/mybalance" exact component={MyBalance}/>
                    <Route path="/admin/delegation" exact component={Delegation}/>
                    <Route path="/admin/node" exact component={Node}/>
                    <Route path="/admin/wallet-details"exact component={WalletDetail}/>
                    <Route path="/admin/delegatin-details" exact component={DelegationDetails}/>
                    <Route path="/admin/emails-setting" exact component={EmailSetting}/>
                    <Route path="/admin/notifications-setting" exact component={NotificationsSetting}/>
                    <Route path="/admin/social-accounts" exact component={SocialsSetting}/>
                    <Route path="/admin/wallet-connect" exact component={WalletConnect}/>
                    <Route path="/error" exact component={Error}/>
                </Switch>
            </PageScrollTop>)
        }
        </Router>
    )
}
export default App
