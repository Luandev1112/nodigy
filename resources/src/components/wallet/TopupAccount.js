import React, {useEffect, useState} from 'react';

const TopupAccount = ({setStep, setSubStep, setMyValance, valanceType}) => {
    const [cardNumber, setCardNumber] = useState('1234 5678 89012 3456');
    const [cardHolder, setCardHolder] = useState('JOHN DOE');
    const [expirationDate, setExpirationDate] = useState('02 / 2024');
    const [cvv, setCVV] = useState('111');
    const [amountFrom, setAmountFrom] = useState('301 000 000');
    const [amountTo, setAmountTo] = useState(301.001);
    const [tabType, setTabType] = useState('card');
    const handleChange = (e) => {
        e.preventDefault();
        const name = e.target.name;
        const value = e.target.value;
        switch(name){
            case 'card_number':
                setCardNumber(value);
            break;
            case 'card_holder':
                setCardHolder(value);
            break;
            case 'expiration_date':
                setExpirationDate(value);
            break;
            case 'cvv':
                setCVV(value);
            break;
            case 'amount_from':
                setAmountFrom(value);
            break;
            case 'amount_to':
                setAmountTo(value);
            break;
        }
    }

    const changeTabType = (type) => {
        console.log(type)
        setTabType(type);
    }

    const handleDeposit = () => {
        setMyValance(amountTo);
        console.log(valanceType);
        switch(valanceType) {
            case 'server':
                setSubStep('deposit-success');
                setStep(5);    
            break;
            case 'deposit':
                setSubStep('deposit-success');
                setStep(7);
            break;
        }
    }

    const handleDepositFail = () => {
        switch(valanceType) {
            case 'server':
                setSubStep('deposit-fail');
                setStep(5);    
            break;
            case 'deposit':
                setSubStep('deposit-fail');
                setStep(7);
            break;
        }
    }

    return (
        <div className="steps-content fullwidthcontainer fiatscreen step5">
            <div className="container">
                <div className="row">
                    <div className="col-sm-7">
                        <div className="borerbox">
                            <div className="p30">
                                <h3>Top-up account</h3>
                                <div className="topuptabs">
                                <ul className="nav nav-tabs" role="tablist">
                                    <li role="presentation" className={tabType=='card'?'active': ''}><a onClick={()=>changeTabType('card')} aria-controls="card" role="tab" data-toggle="tab"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M29.3334 10.0665C29.3334 10.9465 28.6134 11.6665 27.7334 11.6665H4.26675C3.38675 11.6665 2.66675 10.9465 2.66675 10.0665V10.0532C2.66675 6.99987 5.13341 4.5332 8.18675 4.5332H23.8001C26.8534 4.5332 29.3334 7.0132 29.3334 10.0665Z" fill="#ffffff"/><path d="M2.66675 15.2665V21.9465C2.66675 24.9998 5.13341 27.4665 8.18675 27.4665H23.8001C26.8534 27.4665 29.3334 24.9865 29.3334 21.9332V15.2665C29.3334 14.3865 28.6134 13.6665 27.7334 13.6665H4.26675C3.38675 13.6665 2.66675 14.3865 2.66675 15.2665ZM10.6667 22.9998H8.00008C7.45341 22.9998 7.00008 22.5465 7.00008 21.9998C7.00008 21.4532 7.45341 20.9998 8.00008 20.9998H10.6667C11.2134 20.9998 11.6667 21.4532 11.6667 21.9998C11.6667 22.5465 11.2134 22.9998 10.6667 22.9998ZM19.3334 22.9998H14.0001C13.4534 22.9998 13.0001 22.5465 13.0001 21.9998C13.0001 21.4532 13.4534 20.9998 14.0001 20.9998H19.3334C19.8801 20.9998 20.3334 21.4532 20.3334 21.9998C20.3334 22.5465 19.8801 22.9998 19.3334 22.9998Z" fill="#ffffff"/></svg> <span>Сard</span></a></li>
                                    <li role="presentation" className={tabType=='crypto'?'active': ''}><a  onClick={()=>changeTabType('crypto')} aria-controls="crypto" role="tab" data-toggle="tab"><svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M29.3334 11.3332C29.3334 15.6798 26.1334 19.2665 21.9734 19.8932V19.8132C21.56 14.6398 17.36 10.4398 12.1467 10.0265H12.1067C12.7334 5.8665 16.32 2.6665 20.6667 2.6665C25.4534 2.6665 29.3334 6.5465 29.3334 11.3332Z" fill="#ffffff"/><path d="M19.9734 19.9733C19.6401 15.7467 16.2534 12.36 12.0267 12.0267C11.8001 12.0133 11.5601 12 11.3334 12C6.54675 12 2.66675 15.88 2.66675 20.6667C2.66675 25.4533 6.54675 29.3333 11.3334 29.3333C16.1201 29.3333 20.0001 25.4533 20.0001 20.6667C20.0001 20.44 19.9867 20.2 19.9734 19.9733ZM12.5067 21.84L11.3334 24L10.1601 21.84L8.00008 20.6667L10.1601 19.4933L11.3334 17.3333L12.5067 19.4933L14.6667 20.6667L12.5067 21.84Z" fill="#ffffff"/></svg> <span>Сrypto</span></a></li>
                                </ul>
                                <div className="tab-content">
                                    {   tabType == 'card' &&
                                        <div role="tabpanel" className="" id="card">
                                            <div className="form-group">
                                                <label>Card Number</label>
                                                <div className="card-number">
                                                    <img className="cardicon" src="/img/icon-visa.png" />
                                                    <input type="text" className="form-control" name="card_number" value={cardNumber} onChange={handleChange} />
                                                </div>
                                            </div>
                                            <div className="form-group">
                                                <label>Card Holder</label>
                                                <input type="text" className="form-control" name="card_holder" value={cardHolder} onChange={handleChange} />
                                            </div>
                                            <div className="row">
                                                <div className="col-sm-6">
                                                    <div className="form-group">
                                                        <label>Expiration</label>
                                                        <input type="text" name="expiration_date" className="form-control" value={expirationDate} onChange={handleChange} />
                                                    </div>
                                                </div>
                                                <div className="col-sm-6">
                                                    <div className="form-group">
                                                        <label>CVV</label>
                                                        <input type="text" name="cvv" className="form-control" value={cvv} onChange={handleChange} />
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="yourcardinfodiv">Your card/wallet data will be used for charge JUST ONCE (now). In the future, monthly payments will be charged only from your account balance, and you'll receive a reminder to replenish it.</div>
                                            <div className="form-group amountdiv">
                                                <label>Amount</label>
                                                <div className="row">
                                                    <div className="col-sm-6">
                                                        <div className="amount_cus_dropdown">USD</div>
                                                        <input type="text" name="amount_from" className="form-control" value={amountFrom} onChange={handleChange} />
                                                    </div>
                                                    <div className="col-sm-6">
                                                        <div className="amount_cus_dropdown">USDT</div>
                                                        <input type="text" name="amount_to" className="form-control" value={amountTo} onChange={handleChange} />
                                                    </div>
                                                </div>
                                            </div>
                                            <div className="btn-container">
                                                {/* <!--input type="button" className="btn btn-primary btn-new width100" value="Deposit" /--> */}
                                                <a onClick={()=>handleDeposit()} className="btn btn-primary btn-new width100">Deposit</a>
                                            </div>
                                        </div>
                                    }
                                    {
                                        tabType == 'crypto' &&
                                        <div role="tabpanel" className="" id="crypto">
                                            <div className="form-group">
                                                <div className="dropdown dropdown-currency">
                                                    <button className="btn btn-default dropdown-toggle" type="button" id="dropdown-currency" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="/img/country-img.png" /> BNB Chain <span className="caret"></span></button>
                                                    <ul className="dropdown-menu" aria-labelledby="dropdown-currency">
                                                        <li><a href="#"><img src="/img/country-img.png" /> BNB Chain</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div className="form-group">
                                                <label>Source wallet</label>
                                                <div className="dropdown dropdown-currency">
                                                    <button className="btn btn-default dropdown-toggle" type="button" id="dropdown-currency" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="/img/country-img.png" /> MetaMask <a className="anchortext" href="#">Install wallet</a> <span className="caret"></span></button>
                                                    <ul className="dropdown-menu" aria-labelledby="dropdown-currency">
                                                        <li><a href="#"><img src="/img/country-img.png" /> BNB Chain</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div className="btn-container">
                                                <button type="button" className="btn btn-primary btn-new btn-gray width100">Connect</button>
                                            </div>
                                            <div className="disconnectaccount item border-left">
                                                <div className="icon"><img src="/img/step3-img1.png" /></div>
                                                <div className="text">
                                                    <p>0x35s1dg...fsdf1dfg5224 <a href="#"><img src="/img/icon-copy.svg" /></a></p>
                                                    <div className="link-disconnect"><a href="#"><img src="/img/icon-close-circle.svg" />Disconnect</a></div>
                                                </div>
                                            </div>
                                            <div className="n_r_form_field">
                                                <p>85 485.56 $NYM <span>MAX</span></p>
                                                <div className="form-group">
                                                    <span>$NYM</span>
                                                    <input type="text" className="form-control" defaultValue="10" />
                                                </div>
                                            </div>
                                            <div className="btn-container">
                                                <input onClick={()=>handleDeposit()} type="button" className="btn btn-primary btn-new width100" defaultValue="Deposit" />
                                            </div>
                                        </div>
                                    }
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="col-sm-5">
                        <div className="borerbox" style={{border:0, background:'transparent', paddingLeft:0}}>
                            <div className="items transferdetailsbox server-balance-block border-left">
                                <div className="dipositedundsinfo">
                                    <div className="img"><img src="/img/img-dipositedundsinfo.png" /></div>
                                    <p>Funds will be deposited to your account balance and used to pay a one-time onboarding fee and server payment for the first month.</p>
                                </div>
                            </div>
                        </div>
                        <p className="whitetext">Feel free to contact our support for any possible questions:</p>
                        <div className="f-c-d-support">
                            <div className="email">
                                <a href="#">support@nodigy.com</a>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    )
}
export default TopupAccount;