import React, {useEffect, useState} from 'react';
const WalletList = ({setWalletName, setStep}) => {
	const gotoWalletInstallation = (walletName) => {
		setWalletName(walletName);
		setStep(5);
	}

    useEffect(() => {
    
    });
    return (
        <div className="steps-content step3 connectwallet">
		<div className="container">
			<div className="title">Connect wallet to my node</div>
			<p className="subtext">Your node will need a Web 3 wallet as a source of tokens to stake and as an address to receive rewards. Choose one of the listed options, connect the wallet, and sign a message to prove your ownership. If the connection fails, enter your wallet address in the field below. Make sure to enter it correctly!</p>
			<div className="borerbox">
				<div className="row">
					<div className="col-sm-6">
						<div className="items item1 border-right">
							<div className="innerbox transparentbg">
								<div className="box-img"><img src="/img/step3-img1.png" /></div>
								<div className="box-content">
									<div className="box-title">MetaMask</div>
								</div>
							</div>
						</div>
					</div>
					<div className="col-sm-6">
						<div className="items item2 border-down border-left">
							<div className="innerbox transparentbg">
								<div className="box-img"><img src="/img/step3-img2.png" /></div>
								<div className="box-content">
									<div className="box-title">KEPLR</div>
								</div>
								<a onClick={()=>gotoWalletInstallation('keplr')} className="instwlletbtn">Install wallet</a>
							</div>
						</div>
					</div>
				</div>
				<div className="row">
					<div className="col-sm-6">
						<div className="items item3 border-down border-left">
							<div className="innerbox transparentbg">
								<div className="btn-close"><a href="#"><img src="/img/icon-line-close-black.png" /></a></div>
								<div className="box-img"><img src="/img/step3-img4.png" /></div>
								<div className="box-content">
									<div className="box-title">MyEtherWallet</div>
								</div>
								<div className="hovercontent">
									<p><span>Network:</span><span><a href="#">Change to  polygon <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M5.13312 3.99328L3.81979 2.67995L1.67979 0.539951C1.22646 0.0932846 0.453125 0.413285 0.453125 1.05328V5.20662V8.94662C0.453125 9.58662 1.22646 9.90662 1.67979 9.45328L5.13312 5.99995C5.68646 5.45328 5.68646 4.54662 5.13312 3.99328Z" fill="#5129F1"/></svg></a></span></p>
									<p><span>9c2E80xd4C90xd4C9S9c2E8</span><span><a href="#"><img src="/img/icon-copy.svg" /></a></span></p>
								</div>
							</div>
						</div>
					</div>
					<div className="col-sm-6">
						<div className="items item4 border-right">
							<div className="innerbox transparentbg">
								<div className="btn-close"><a href="#"><img src="/img/icon-line-close-black.png" /></a></div>
								<div className="box-img"><img src="/img/nodes-logo-icon1.png" /></div>
								<div className="box-content">
									<div className="box-title">NYM Wallet</div>
								</div>
								<div className="form-group">
									<label>Node’s owner wallet address:</label>
									<input type="text" className="form-control" placeholder="placeholder" />
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    )
}
export default WalletList;