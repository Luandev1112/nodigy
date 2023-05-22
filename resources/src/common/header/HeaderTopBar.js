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

const HeaderTopBar = ({menu}) => {
    const [darkMode, setDarkMode] = useState(true);
    const changeMode = () => {
        darkMode ? setDarkMode(false) : setDarkMode(true);
    }
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
                    <img src={FortaDropdownImage} /> <span>Forta<span>12 Node</span></span>
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
                <Dropdown className="walletdropdown">
                  <Dropdown.Toggle variant="default" id="">
                    <img src={IconEmptyWallet} /> <span>$10,350752.45</span>
                  </Dropdown.Toggle>

                  <Dropdown.Menu>
                    <li><Dropdown.Item href="#">$10,350752.45</Dropdown.Item></li>
                    <li><Dropdown.Item href="#">$10,350752.45</Dropdown.Item></li>
                  </Dropdown.Menu>
                </Dropdown>

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
                    <span>Кузнецова Мария</span>
                  </Dropdown.Toggle>

                  <Dropdown.Menu>
                    <li className="title"><Dropdown.Item href="#">Кузнецова Мария</Dropdown.Item></li>
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
