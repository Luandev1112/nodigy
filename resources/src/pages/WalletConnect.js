import React, {useState, useEffect} from 'react';
import {Link} from "react-router-dom";
import { Button, Dropdown, Modal } from 'react-bootstrap';
import LogoImage from "../assets/img/logo.svg";

import Step1 from "../components/wallet/step1.js";
import Step2 from "../components/wallet/step2.js";
import Step3 from "../components/wallet/step3.js";
import Step4 from "../components/wallet/step4.js";
import Fiat1 from "../components/wallet/fiat1.js";
import ChooseServer from "../components/wallet/ChooseServer.js";
import TopupAccount from "../components/wallet/TopupAccount.js";
import DepositSuccess from "../components/wallet/DepositSuccess.js";
import WalletInstall from '../components/wallet/WalletInstall';
import NodeInstall from '../components/wallet/NodeInstall';
import NodePreparation from '../components/wallet/NodePreparation';

const WalletConnect = () => {
    const [step, setStep] = useState(1);
    const [widthArr, setWidthArr] = useState([0, 21, 39, 45, 51, 57, 63, 69, 100]);
    const [disableBtn, setDisableBtn] = useState('prev');
    const [btnStatus, setBtnStatus] = useState(true);
    const [leftOffset, setLeftOffset] = useState(0);
    const [subStep, setSubStep] = useState('');
    const [myValance, setMyValance] = useState(5);

    const nextStep = () => {
        if(step < 8){
            
            if(step == 7){
                setDisableBtn('next');
            }else{
                setDisableBtn('none')
            }
            setStep(step + 1);
            setSubStep('');
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

    useEffect(() => {
        const offsets = document.querySelectorAll('.step-bar a.active');
        const leftoffset = offsets[offsets.length - 1].offsetLeft;
        setLeftOffset(leftoffset);
        console.log(leftoffset);
    }, [step]);

    return (
        <div className="steps">
            <div className="step-header">
                <div className="container">
                    <div className="logo"><img src={LogoImage} /></div>
                    <div className="btn-header actionright">
                        <div className="dropdown walletdropdown">
                            <a className="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false"><img src="/img/icon-empty-wallet.png" /> <span>$10,350752.45</span></a>
                            <ul className="dropdown-menu">
                                <li><a className="dropdown-item" href="#">$10,350752.45</a></li>
                                <li><a className="dropdown-item" href="#">$10,350752.45</a></li>
                            </ul>
                        </div>
                        <div className="dropdown notifications">
                            <a className="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false"><img src="/img/icon-notifications.svg" /></a>
                            <ul className="dropdown-menu">
                                <li><a className="dropdown-item" href="#">Option 1</a></li>
                                <li><a className="dropdown-item" href="#">Option 2</a></li>
                            </ul>
                        </div>
                        
                        <div className="dropdown profiledropdown">
                            <a className="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div className="img"><img src="/img/profile-img-new.png" /></div>
                            </a>
                            <ul className="dropdown-menu">
                                <li className="title"><a>Кузнецова Мария</a></li>
                                <li><a href="#"><img src="/img/icon-setings.png" /> Account settings</a></li>
                                <li><a href="#"><img src="/img/icon-logout.png" /> Account settings</a></li>
                                <li className="last">
                                    <span className="text">Dark mode</span>
                                    <div className="cus_switch themechange">
                                        <input type="checkbox" checked />
                                        <span></span>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div className="step-bar">
                <div className="line"><span style={{width: leftOffset+"px"}}></span></div>
                <a href="#" className={step>=1?"checked active":""} />
                <a href="#" className={step>=2?"checked active":""} />
                <a href="#" className={step>=3?"checked active":""} />
                <a href="#" className={step>=4?"checked active":""} />
                <a href="#" className={step>=5?"checked active":""} />
                <a href="#" className={step>=6?"checked active":""} />
                <a href="#" className={step>=7?"checked active":""} />
                <a href="#" className={step>=8?"checked active":""} />
            </div>
            { step == 1 && <Step1 /> }
            { step == 2 && <Step2 /> }
            {/* { step == 3 && <Step3 /> } */}
            { step == 3 && subStep == '' && <ChooseServer setStep={setStep} setSubStep={setSubStep} valance={myValance} /> }
            { step == 3 && subStep == 'topup' && <TopupAccount setStep={setStep} setSubStep={setSubStep} setMyValance={setMyValance} valanceType="server" />}
            { step == 4 && <Step4 /> }
            { step == 5 && subStep=='' && <Fiat1 /> }
            { step == 5 && subStep == 'topup' && <TopupAccount setStep={setStep} setSubStep={setSubStep} setMyValance={setMyValance} valanceType="server" />}
            { step == 5 && subStep == 'deposit-success' && <DepositSuccess setStep={setStep} setSubStep={setSubStep} valanceType="server" /> }
            { step == 7 && subStep == 'deposit-success' && <DepositSuccess setStep={setStep} setSubStep={setSubStep} valanceType="node-install" /> }
            { step == 6 && subStep == '' && <NodePreparation setStep={setStep} setSubStep={setSubStep} /> }
            { step == 6 && subStep == 'wallet-install' && <WalletInstall setStep={setStep} setSubStep={setSubStep} /> }
            { step == 7 && subStep == '' && <NodeInstall setStep={setStep} setSubStep={setSubStep} /> }
            <div className="step-footer">
            
                <div className="container">
                    <div className="row">
                        <div className="col-sm-3">
                            <div className="s-f-links">
                                <a href="#">Terms of service</a>
                                <a href="#">Privacy Policy</a>
                                <a href="#">Press Kit</a>
                            </div>
                        </div>
                        <div className="col-sm-6">
                            <div className="btn-container">
                            {
                                btnStatus &&  <a onClick={prevStep} className={disableBtn=='prev'?"btn btn-primary":"btn btn-primary active"}>Previous</a>
                            }
                                <span>Step {step} of 8</span>
                            {
                                btnStatus &&  <a onClick={nextStep} className={disableBtn=='next'?"btn btn-primary":"btn btn-primary active"}>Next</a>
                            }
                            </div>
                        </div>
                        <div className="col-sm-3">
                            <ul>
                                <li className="active"><a href="#"><svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fillRule="evenodd" clipRule="evenodd" d="M16.1187 1.94694C15.2268 0.949039 14.041 0.399902 12.7794 0.399902C11.5178 0.399902 10.459 0.949039 9.56667 1.94694L8.99997 2.85211L8.43333 1.94694C7.5413 0.949039 6.48219 0.399902 5.22076 0.399902C3.95938 0.399902 2.7731 0.949039 1.88115 1.94694C0.0396161 4.00723 0.0396161 7.35941 1.88115 9.41889L8.47989 15.7608C8.58778 15.882 8.72209 15.9561 8.86242 15.9847C8.90948 15.9951 8.95681 15.9999 9.00423 15.9999C9.1909 15.9999 9.37789 15.9203 9.52005 15.7608L16.1188 9.41889C17.9604 7.35941 17.9604 4.00723 16.1187 1.94694Z" fill="#BAC3CA"/></svg></a></li>
                                <li><a href="#"><svg width="10" height="18" viewBox="0 0 10 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path fillRule="evenodd" clipRule="evenodd" d="M9.62343 0.0037452L7.22488 0C4.5302 0 2.78878 1.73871 2.78878 4.42982V6.47227H0.377148C0.168754 6.47227 0 6.63668 0 6.83949V9.79876C0 10.0016 0.168947 10.1658 0.377148 10.1658H2.78878V17.633C2.78878 17.8358 2.95753 18 3.16593 18H6.31242C6.52081 18 6.68956 17.8356 6.68956 17.633V10.1658H9.50932C9.71772 10.1658 9.88647 10.0016 9.88647 9.79876L9.88763 6.83949C9.88763 6.74211 9.84779 6.64886 9.77717 6.57994C9.70656 6.51103 9.61034 6.47227 9.51029 6.47227H6.68956V4.74086C6.68956 3.90868 6.89334 3.48622 8.00727 3.48622L9.62304 3.48566C9.83125 3.48566 10 3.32124 10 3.11863V0.370775C10 0.168347 9.83144 0.00411972 9.62343 0.0037452Z" fill="#BAC3CA"/></svg></a></li>
                                <li><a href="#"><svg width="18" height="16" viewBox="0 0 18 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path fillRule="evenodd" clipRule="evenodd" d="M17.979 2.36296C17.9532 2.33225 17.9106 2.32183 17.8743 2.33858C17.3361 2.57957 16.77 2.75282 16.1869 2.85518C16.8059 2.3851 17.2672 1.73415 17.5037 0.98773C17.5151 0.952 17.5033 0.912921 17.4744 0.889659C17.4453 0.866397 17.4049 0.86342 17.373 0.882587C16.6758 1.29999 15.9206 1.59421 15.1276 1.75741C14.4248 1.02123 13.4435 0.600098 12.4278 0.600098C10.3623 0.600098 8.68211 2.29615 8.68211 4.38096C8.68211 4.63311 8.70626 4.88285 8.75419 5.12533C5.89336 4.94705 3.21836 3.56066 1.3995 1.30874C1.38088 1.28567 1.35268 1.27282 1.32318 1.2758C1.29387 1.27804 1.26769 1.29478 1.25294 1.32028C0.921099 1.89493 0.745777 2.5524 0.745777 3.22122C0.745777 4.3804 1.2675 5.4642 2.15591 6.17936C1.69853 6.12391 1.25183 5.97857 0.849016 5.75283C0.821916 5.73739 0.788179 5.73758 0.761078 5.75339C0.733978 5.76902 0.716833 5.79806 0.716095 5.82969L0.715727 5.87808C0.715727 7.54287 1.8025 9.00463 3.3487 9.48996C2.94145 9.55621 2.51891 9.55174 2.10356 9.47172C2.07295 9.46595 2.04088 9.47656 2.01986 9.50038C1.99903 9.5242 1.99202 9.55751 2.00161 9.58766C2.46526 11.0485 3.75354 12.0729 5.25309 12.2006C4.00224 13.1257 2.5237 13.613 0.961473 13.613C0.673694 13.613 0.383886 13.5957 0.0999786 13.5621C0.0594204 13.5574 0.0192308 13.5818 0.00521981 13.621C-0.00879122 13.6607 0.00614159 13.705 0.0411692 13.7275C1.73171 14.8219 3.68643 15.4001 5.69425 15.4001C12.2619 15.4001 16.1865 10.0149 16.1865 4.80878C16.1865 4.66382 16.1837 4.51959 16.178 4.37574C16.8865 3.85264 17.4947 3.21229 17.9851 2.47108C18.007 2.43796 18.0046 2.39385 17.979 2.36296Z" fill="#BAC3CA"/></svg></a></li>
                                <li><a href="#"><svg width="14" height="18" viewBox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg"><path fillRule="evenodd" clipRule="evenodd" d="M2 0H12C13.1046 0 14 0.89543 14 2V18L7.09495 13L0 18V2C0 0.89543 0.89543 0 2 0Z" fill="#BAC3CA"/></svg></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default WalletConnect

