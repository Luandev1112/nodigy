import React, { useState, useEffect } from 'react';
import { Link } from 'react-router-dom';
import { Card, Button, Dropdown } from 'react-bootstrap';
import NavIcon from "../../assets/img/nav-icon.png";
import LogoImage from "../../assets/img/logo.png";
import IconEmptyWallet from "../../assets/img/icon-empty-wallet.png";
import IconNotifications from "../../assets/img/icon-notifications.png";
import ProfileImage from "../../assets/img/profile-img.png";
import IconSettingsImage from "../../assets/img/icon-setings.png";
import IconLogoutImage from "../../assets/img/icon-setings.png";
import ArrowUpImage from "../../assets/img/arrow-narrow-up.png";
import FortaDropdownImage from '../../assets/img/forte-dropdown-img.png';
import NYMNodeImage from '../../assets/img/nym.png';
import Http from "../../utils/Http";

const HeaderTopBar = ({menu, myBalance}) => {
    const [darkMode, setDarkMode] = useState(true);
    const changeMode = () => {
        darkMode ? setDarkMode(false) : setDarkMode(true);
    }
    const [user, setUser] = useState(null);
    const [userBalance, setUserBalance] = useState(0);

    console.log("My balance : ", myBalance);

    const getUser = async() => {
      try{
          const res = await Http.get('/admin/getuser');
          if(res.data) {
            setUser(res.data);
            setUserBalance(res.data.balance);
          }
      }catch(err){
         console.log("error:::", err);
      }
    }

    useEffect(()=>{
      getUser();
    }, []);

    useEffect(()=>{
      if(myBalance >= 0){
        setUserBalance(myBalance);
      }
    }, [myBalance]);

    return (
        <div className="pagetitle">
            <div className="mobilenavicon hide-desktop"><img src={NavIcon} /></div>
            <div className="logo hide-desktop"><img src={LogoImage} /></div>
            {menu=='dashboard' &&
              <h1>Dashboard</h1>
            }
            {menu=='wallets' &&
              <h1><Link to="#" className="btn-back"><img src={ArrowUpImage} /></Link> <span>Wallets</span></h1>
            }
            {menu=='mybalance' &&
              <h1><Link to="#" className="btn-back"><img src={ArrowUpImage} /></Link> <span>My Balance</span></h1>
            }
            {menu=='delegation' &&
              <h1><Link to="#" className="btn-back"><img src={ArrowUpImage} /></Link> <span>Delegation</span></h1>
            }
            {menu=='node' &&
              <div className="node-header-dropdown">
                <Dropdown className="">
                  <Dropdown.Toggle variant="default">
                    <img src={NYMNodeImage} /> <span>NYM Node<span>12 Node</span></span>
                  </Dropdown.Toggle>

                  <Dropdown.Menu>
                     <li><Dropdown.Item to="#"><img src={FortaDropdownImage} /> Forta</Dropdown.Item></li>
                     <li><Dropdown.Item to="#"><img src={FortaDropdownImage} /> Forta</Dropdown.Item></li>
                  </Dropdown.Menu>
                </Dropdown>
              </div>
            }
            {menu=='settings' &&
              <h1><Link to="#" className="btn-back"><img src={ArrowUpImage} /></Link> <span></span></h1>
            }

            <div className="actionright">
              <div className="walletdropdown">
                <button aria-haspopup="true" aria-expanded="false" id="" type="button" className="dropdown-toggle btn btn-default">
                  <img src={IconEmptyWallet} /> <span>{userBalance} USDT</span>
                </button>
              </div>

                <Dropdown className="notifications">
                  <Dropdown.Toggle variant="default" id="">
                    <img src={IconNotifications} />
                  </Dropdown.Toggle>

                  <Dropdown.Menu>
                    <li><Dropdown.Item href="#">Option 1</Dropdown.Item></li>
                    <li><Dropdown.Item href="#">Option 2</Dropdown.Item></li>
                  </Dropdown.Menu>
                </Dropdown>

                <Dropdown className="profiledropdown">
                  <Dropdown.Toggle variant="default" id="">
                    <div className="img"><img src={ProfileImage} /></div>
                    <span>{user?.email}</span>
                  </Dropdown.Toggle>

                  <Dropdown.Menu>
                    <li className="title"><Dropdown.Item>{user?.name}</Dropdown.Item></li>
                    <li><Dropdown.Item href="#"><img src={IconSettingsImage} /> Account settings</Dropdown.Item></li>
                    <li><Dropdown.Item href="#"><img src={IconLogoutImage} /> Logout</Dropdown.Item></li>
                    <li className="last">
                        <span className="text">Dark mode</span>
                        <div className="cus_switch themechange">
                            <input type="checkbox" checked={darkMode} onChange={changeMode} />
                            <span></span>
                        </div>
                    </li>
                  </Dropdown.Menu>
                </Dropdown>
            </div>
        </div>
    )
}

export default HeaderTopBar;
