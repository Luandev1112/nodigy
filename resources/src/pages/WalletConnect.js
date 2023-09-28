import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import NodeHeader from '../common/NodeHeader';
import NodeFooter from '../common/NodeFooter';
import Step1 from "../components/wallet/step1.js";
import Step2 from "../components/wallet/step2.js";
import Http from "../utils/Http";

const WalletConnect = () => {
    const [step, setStep] = useState(1);
    const [disableBtn, setDisableBtn] = useState('prev');
    const [btnStatus, setBtnStatus] = useState(true);
    const [subStep, setSubStep] = useState('');
    const [myBalance, setMyBalance] = useState(0);
    const [darkMode, setDarkMode] = useState(true);
    const [loggedUser, setLoggedUser] = useState(null);
    const [project, setProject] = useState(null);
    const [server, setServer] = useState(null);
    const [stepType, setStepType] = useState(''); // stepType = "experience", "no-experience"

    const nymUrl = "https://nym.nodigy.com";
    // const nymUrl = "http://localhost:3000";

    const changeMode = () => {
        darkMode ? setDarkMode(false) : setDarkMode(true);
    }

    const changeStepType = (type) => {
        setStepType(type);
    }

    const chooseProject = (project) => {
        setProject(project)
    }

    const nextStep = () => {
        if(step < 8){
            
            if(step == 7){
                setDisableBtn('next');
            }else{
                setDisableBtn('none')
            }
            
            switch(step){
                case 1:
                    setStep(step + 1);    
                break;
                case 2:
                    if(project) {
                        console.log("Project: ", project);
                        switch(project.project_name) {
                            case 'NYM':
                                window.location.href = nymUrl + "?token=" + loggedUser.access_token;
                            break;
                        }
                        return;
                        setStep(step + 1);
                        setSubStep('');
                    }
                break;                  
            }
        }
    }

    const prevStep = () => {
        if(step > 1) {
            if(step == 2){
                setDisableBtn('prev');
            }else{
                setDisableBtn('none')
            }
            setStep(step - 1);
            setSubStep('');
        }
    }

    const getUser = async () => {
        const user = await Http("/admin/getuser");
        if(user.data) {
            setLoggedUser(user.data);
            setMyBalance(user.data.balance);
        }
    }

    const getUnpublishedNode = async() => {
        const nodeRes = await Http("/admin/api/getInitialNode");
        setProject(nodeRes.data.project);
        setServer(nodeRes.data.server);
    }

    useEffect(() => {
        getUser();
        getUnpublishedNode();
    }, []);

    return (
        <div className="steps">
            <NodeHeader step={step} />
            { step == 1 && <Step1 stepType={stepType} changeStepType={changeStepType} /> }
            { step == 2 && <Step2 chooseProject={chooseProject} project={project} /> }
            <NodeFooter step={step} prevStep={prevStep} nextStep={nextStep} disableBtn={disableBtn} />
        </div>
    )
}
export default WalletConnect

