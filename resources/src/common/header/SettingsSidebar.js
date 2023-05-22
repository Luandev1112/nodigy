import {useState, useRef} from "react";
import {Link} from "react-router-dom";
import IconEmailImage from '../../assets/img/icon-email.png';
import IconNotificationImage from '../../assets/img/icon-notification.png';
import IconLikeShapesImage from "../../assets/img/icon-like-shapes.png";
const SettingsSidebar = ({type}) => {
    return (
        <div className="networkpanel">
            <div className="head">Main Settings</div>
            <div className="n_p_scroll">
                <div className={type==='email'?"items active":"items"} >
                    <Link to="/admin/emails-setting">
                        <div className="img"><img src={IconEmailImage} /></div>
                        <div className="text">
                            <p><strong>Email</strong> Proin non urna egestas, gravida odio nec</p>
                        </div>
                    </Link>
                </div>
                <div className={type==='notification'?"items active":"items"}>
                    <Link to="/admin/notifications-setting">
                        <div className="img"><img src={IconNotificationImage} /></div>
                        <div className="text">
                            <p><strong>Notifications</strong> Suspendisse feugiat dignissim</p>
                        </div>
                    </Link>
                </div>
                <div className={type==='social'?"items active":"items"}> 
                    <Link to="/admin/social-accounts">
                        <div className="img"><img src={IconLikeShapesImage} /></div>
                        <div className="text">
                            <p><strong>Social Accounts</strong> Suspendisse feugiat dignissim</p>
                        </div>
                    </Link>
                </div>
            </div>
        </div>
    )
}
export default SettingsSidebar;