import React from 'react';
import IconGhostImage from "../../assets/img/icon-ghost.svg";
import IconDislikeImage from "../../assets/img/icon-dislike.svg";

const Step1 = () => {
    return (
        <div className="steps-content step-new step1">
            <div className="container">
                <div className="title">Any crypto/blockchain experience?</div>
                <div className="desc"><p>We'll offer options based on your experience in blockchain interactions. Unsure which option to choose? You can go by the experienced user option and address our detailed instructions and help desk if needed.</p></div>
                <div className="borerbox">
                    <div className="row">
                        <div className="col-sm-6">
                            <div className="border-up innerbox selected">
                                <div className="box-img"><svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 0.5C8.375 0.5 0.5 8.515 0.5 18.315V32.1225C0.5 34.3275 1.8125 34.9225 3.4225 33.4525L5.1725 31.86C5.82 31.265 6.87 31.265 7.5175 31.86L11.0175 35.0625C11.665 35.6575 12.715 35.6575 13.3625 35.0625L16.8625 31.86C17.51 31.265 18.56 31.265 19.2075 31.86L22.7075 35.0625C23.355 35.6575 24.405 35.6575 25.0525 35.0625L28.5525 31.86C29.2 31.265 30.25 31.265 30.8975 31.86L32.6475 33.4525C34.2575 34.9225 35.57 34.3275 35.57 32.1225V18.315C35.5 8.515 27.625 0.5 18 0.5ZM18 8.585C20.2925 8.585 22.165 10.4575 22.165 12.75C22.165 15.0425 20.2925 16.915 18 16.915C15.7075 16.915 13.835 15.0425 13.835 12.75C13.835 10.4575 15.7075 8.585 18 8.585ZM25.7875 22.55C23.495 24.265 20.7475 25.1225 18 25.1225C15.2525 25.1225 12.505 24.265 10.2125 22.55C9.635 22.1125 9.5125 21.29 9.95 20.7125C10.3875 20.135 11.21 20.0125 11.7875 20.45C15.445 23.1975 20.555 23.1975 24.2125 20.45C24.79 20.0125 25.6125 20.135 26.05 20.7125C26.4875 21.29 26.365 22.1125 25.7875 22.55Z" fill="#5129F1"/></svg></div>
                                <div className="box-title">Yes, baby!</div>
                                <div className="box-content">
                                    <ul>
                                        <li>I can swap different tokens</li>
                                        <li>I can bridge tokens from one blockchain to another</li>
                                        <li>I frequently use my accounts on CEXes</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div className="col-sm-6">
                            <div className="innerbox transparentbg">
                                <div className="box-img"><svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M27.3175 9.62516V27.4052C27.3175 28.1052 27.1075 28.7877 26.7225 29.3652L21.945 36.4702C21.1925 37.6077 19.32 38.4127 17.7275 37.8177C16.0125 37.2402 14.875 35.3152 15.2425 33.6002L16.1525 27.8777C16.2225 27.3527 16.0825 26.8802 15.785 26.5127C15.4875 26.1802 15.05 25.9702 14.5775 25.9702H7.385C6.0025 25.9702 4.8125 25.4102 4.1125 24.4302C3.4475 23.4852 3.325 22.2602 3.7625 21.0177L8.0675 7.91016C8.61 5.74016 10.9725 3.97266 13.3175 3.97266H20.1425C21.315 3.97266 22.96 4.37516 23.7125 5.12766L25.9525 6.86016C26.81 7.52516 27.3175 8.54016 27.3175 9.62516Z" fill="#BAC3CA"/><path d="M32.8825 30.8177H34.685C37.3975 30.8177 38.5 29.7677 38.5 27.1777V9.5902C38.5 7.0002 37.3975 5.9502 34.685 5.9502H32.8825C30.17 5.9502 29.0675 7.0002 29.0675 9.5902V27.1952C29.0675 29.7677 30.17 30.8177 32.8825 30.8177Z" fill="#BAC3CA"/></svg></div>
                                <div className="box-title">Have no idea what is it</div>
                                <div className="box-content">
                                    <ul>
                                        <li>I don't know how to buy tokens</li>
                                        <li>There is more than one blockchain? Really?</li>
                                        <li>I have my bank account! Isn't it enough?</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    )
}
export default Step1;