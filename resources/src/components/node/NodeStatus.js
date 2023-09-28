import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import { Button, Dropdown, Form, Modal } from 'react-bootstrap';
import IconEmojiActive from '../../assets/img/icon-emoji-active.svg';
import IconEmojiWarning from '../../assets/img/icon-emoji-warning.svg';
import IconEmojiDanger from '../../assets/img/icon-emoji-danger.svg';
import TrackVisibility from "react-on-screen";
import Progress from '../../components/Progress';

const NodeStatus = () => {
    const [hourProgress, setHourProgress] = useState({ percantage: 100, progressColor: "#5129F1"});
    const [dayProgress, setDayProgress] = useState({ percantage: 80, progressColor: "#FACC15"});
    useEffect(()=>{
    
    }, []);
    return (
        <div className="items item2">
            <div className="text1">Uptime</div>
            <div className="text2 color-active">~21%</div>
            <div className="node-block-content">
                <div className="row progress-content">
                    <label className="col-sm-5">1 hour:</label>
                    <div className="col-sm-7 text-end">
                        <TrackVisibility
                            once
                            key={1}
                            className="single-progress"
                        >
                            <Progress progress={hourProgress} /> 
                        </TrackVisibility>
                    </div>
                </div>
                <div className="row progress-content">
                    <label className="col-sm-5">1 day:</label>
                    <div className="col-sm-7 text-end">
                        <TrackVisibility
                            once
                            key={1}
                            className="single-progress"
                        >
                            <Progress progress={dayProgress} /> 
                        </TrackVisibility>
                    </div>
                </div>
            </div>
            <div className="icons" role='button'><img src={IconEmojiActive} /></div>
        </div>
    )
}
export default NodeStatus;