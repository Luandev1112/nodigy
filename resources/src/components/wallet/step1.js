import React from 'react';
import IconGhostImage from "../../assets/img/icon-ghost.svg";
import IconDislikeImage from "../../assets/img/icon-dislike.svg";

const Step1 = () => {
    return (
        <div className="steps-content step1">
            <div className="container">
                <div className="title">Any crypto/blockchain experience?</div>
                <div className="desc"><p>We'll offer options based on your experience in blockchain interactions. Unsure which option to choose? You can go by the experienced user option and address our detailed instructions and help desk if needed.</p></div>
                <div className="borerbox">
                    <div className="row">
                        <div className="col-sm-6">
                            <div className="border-up">
                            <div className="innerbox bluebg">
                                <div className="box-img"><img src={IconGhostImage} /></div>
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
                        </div>
                        <div className="col-sm-6">
                            <div className="innerbox transparentbg">
                                <div className="box-img"><img src={IconDislikeImage} /></div>
                                <div className="box-title">Have no idea what is it</div>
                                <div className="box-content">
                                    <ul>
                                        <li>Have no idea what is it</li>
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