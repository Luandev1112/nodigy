@extends('layouts.home')

@section('content')
<div class="main-container">
    <div class="home-section4">
        <div class="container">
            <div class="searchbar row">
                <div class="search col-sm-7">
                    <div class="form-group">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.72633 0.51628C6.41702 0.652618 5.11292 1.17541 3.98839 2.01481C3.57169 2.32588 2.80614 3.09339 2.49523 3.51186C1.5296 4.81151 1.01336 6.28543 0.957845 7.90147C0.92479 8.86436 1.041 9.69349 1.33505 10.5922C1.70195 11.7137 2.33227 12.7469 3.16682 13.5947C4.39029 14.8377 5.93644 15.6012 7.66366 15.8153C8.12863 15.873 9.31715 15.8417 9.7602 15.7602C10.7905 15.5706 11.7072 15.215 12.5364 14.6833L12.8572 14.4775L15.1054 16.85C16.3419 18.1548 17.405 19.2663 17.4677 19.32C17.8613 19.6564 18.5459 19.5637 18.8463 19.1334C18.9972 18.9172 19.0439 18.7756 19.0473 18.5248C19.0526 18.1205 19.0267 18.0887 16.651 15.5838C15.4626 14.3306 14.4525 13.2598 14.4064 13.2041L14.3226 13.1029L14.5188 12.8477C15.8489 11.1181 16.3643 8.84288 15.9303 6.61701C15.7134 5.50482 15.1457 4.28209 14.4217 3.36793C12.8001 1.32054 10.286 0.249745 7.72633 0.51628ZM9.22964 2.53802C11.6067 2.85958 13.4894 4.62744 13.9938 7.01169C14.094 7.48545 14.1315 8.43301 14.0678 8.88488C13.8852 10.1802 13.3484 11.2866 12.4691 12.18C11.6213 13.0413 10.5696 13.5876 9.37673 13.7863C8.97652 13.853 8.09745 13.8533 7.66828 13.7869C6.12187 13.5477 4.72117 12.6358 3.86061 11.3081C3.55307 10.8336 3.38768 10.49 3.21757 9.97227C3.03251 9.40909 2.95889 8.98726 2.93528 8.35449C2.81684 5.18173 5.33603 2.51564 8.47758 2.48898C8.67913 2.48727 9.01756 2.50931 9.22964 2.53802Z" fill="white"/></svg>
                        <input type="text" class="form-control" placeholder="Search nэtwork" />
                    </div>
                </div>
                <div class="links col-sm-5">
                    <a href="javascript:void(0)" data-rel="all" class="fil-cat active filter">All Projects</a>
                    <a href="javascript:void(0)" data-rel="testnet" class="fil-cat filter">Testnet</a>
                    <a href="javascript:void(0)" data-rel="mainnet" class="fil-cat filter">Mainnet</a>
                    <a href="javascript:void(0)" data-rel="a-z" class="fil-cat" id="sortAZ">A-Z</a>                    
                </div>
            </div>
            <div class="web3itemscontent" id="portfolio" style="opacity:1;">
                <div class="box tile scale-anm all mainnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon1.png" /></div>
                                <div class="row1">
                                    <div class="name">NYM</div>
                                    <div class="per"><span>MAINNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price">$12.7B</div>
                                    <div class="value">Market Cap</div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <a href="javascript:void(0)">Live</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Nym is a protocol aiming to provide privacy for internet traffic. The decentralized NYM mix-net uses blockchain technology and economic incentives to provide powerful network-level privacy. The work of mixing your traffic is done by nodes, which are run by node runners incentivized via NYM tokens.</p>
                            <p class="greytext">Detailed information and step-by-step guide how to delegate your $NYM tokens into our node is in this article.</p>
                            <p class="greytext">Analytical research of $NYM token economics is in this article.</p>
                        </div>
                    </div>
                </div>
                <div class="box tile scale-anm all a-z testnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/sui-logo.png" /></div>
                                <div class="row1">
                                    <div class="name">SUI</div>
                                    <div class="per"><span>TESTNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price">$12.7B</div>
                                    <div class="value">Market Cap</div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <a href="javascript:void(0)">Coming soon</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Sui is a decentralized permissionless layer-1 blockchain, based on PoS consensus and designed from the ground up to enable creators and developers to build experiences that cater to the next billion users in web3. Sui is horizontally scalable to support a wide range of application development with unrivaled speed at low cost.</p>
                            <p class="greytext">Detailed information about SUI you can read in this article.</p>
                            <p class="greytext">You can apply to run your node and participate in SUI testnet (not incentivized).</p>
                        </div>
                    </div>
                </div>
                <div class="box tile scale-anm all mainnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon2.png" /></div>
                                <div class="row1">
                                    <div class="name">ARBITRUM</div>
                                    <div class="per"><span>MAINNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price">$119,640</div>
                                    <div class="value">Market Cap</div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <a href="javascript:void(0)">Coming soon</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Arbitrum is a Layer-2 blockchain that aims to provide scalable, private, and secure smart contract execution. The native token of the Arbitrum network will be $ARB. $ARB is used to pay transaction fees on the network, as well as to incentivize validators to run nodes and provide computational resources to the network.</p>
                            <p class="greytext">Detailed information about Arbitrum you can read in this article.</p>
                            <p class="greytext">As of now Arbitrum’s nodes work without tokens until listing of $ARB and running PoS consensus.</p>
                        </div>
                    </div>
                </div>
                <div class="box tile scale-anm all mainnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon3.png" /></div>
                                <div class="row1">
                                    <div class="name">StarkNet</div>
                                    <div class="per"><span>MAINNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price">$12.7B</div>
                                    <div class="value">Market Cap</div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <a href="javascript:void(0)">Live</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>StarkNet is a permissionless decentralized Validity-Rollup (also known as a “ZK-Rollup”). It operates as an L2 network over Ethereum, enabling any dApp to achieve unlimited scale for its computation – without compromising Ethereum’s composability and security.<br>
                            StarkNet Sequencer Node is the main node of the StarkNet network. It implements the core functionality of sequencing transactions submitted to it, executes the StarkNet OS Cairo program, proves the result  and updates the network state on the StarkNet Core Contract.</p>
                            <p class="greytext">Detailed information about StarkNet you can read in this article.</p>
                            <p class="greytext">As of now StarkNet’s nodes work without tokens.</p>
                        </div>
                    </div>
                </div>                
                <div class="box tile scale-anm all mainnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/s-nym-logo.png" /></div>
                                <div class="row1">
                                    <div class="name">Forta</div>
                                    <div class="per"><span>MAINNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price">$12.7B</div>
                                    <div class="value">Market Cap</div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <a href="javascript:void(0)">Live</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Forta is a decentralized monitoring network dedicated to detecting threats and anomalies on Web 3.0 systems like DeFi. The network detects abnormalities in real-time with the help of independent node operators that scan all transactions and block-by-block state changes for outliers and threats.</p>
                            <p class="greytext">Detailed information about Forta you can read in this article.</p>
                            <p class="greytext">Forta’s nodes work on PoS consensus and requre min 2500 $FORT tokens and max 3000 $FORT per one node.</p>
                        </div>
                    </div>
                </div>
                <div class="box tile scale-anm all mainnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/ironfish-logo.png" /></div>
                                <div class="row1">
                                    <div class="name">IRONFISH</div>
                                    <div class="per"><span>MAINNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price">$12.7B</div>
                                    <div class="value">Market Cap</div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <a href="javascript:void(0)">Coming soon</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Iron Fish is a decentralized blockchain, based on proof-of-work (PoW) and designed in a way that every transaction will remain private and anonymous. Iron Fish is on their last phase of incentivized testnet. The mainnet will go live in the first or second quarter of 2023.</p>
                            <p class="greytext">Detailed information about IronFish you can read in this article.</p>
                            <p class="greytext">You can apply to run your node and participate in incetnivized testnet of IronFish now.</p>
                        </div>
                    </div>
                </div>
                <div class="box tile scale-anm all mainnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/evmos-logo.png" /></div>
                                <div class="row1">
                                    <div class="name">EVMOS</div>
                                    <div class="per"><span>MAINNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price">$12.7B</div>
                                    <div class="value">Market Cap</div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <a href="javascript:void(0)">Live</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Evmos is a community driven decentralized PoS blockchain that behaves as a hub between Ethereum and Cosmos ecosystems using Inter Blockchain Communication Protocol (IBC). Evmos simplifies interactions between smart-contracts and allows builders to create EVM-compatible applications on Cosmos SDK.<br>
                            PoS mechanism requires validators to stake tokens $EVMOS into their nodes and get rewards.</p>
                            <p class="greytext">Detailed information about Evmos you can read in this article.</p>
                            <p class="greytext">You can apply to run your node for Evmos blockchain.</p>
                        </div>
                    </div>
                </div>
                <div class="box tile scale-anm all mainnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/kyve-logo.png" /></div>
                                <div class="row1">
                                    <div class="name">KYVE</div>
                                    <div class="per"><span>MAINNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price">$12.7B</div>
                                    <div class="value">Market Cap</div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <a href="javascript:void(0)">Live</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>KYVE is a decentralized archive network that proposes to increase the scalability of various data streams through standardization and decentralized storage. Their native token $KYVE will be used to incentivise validators. Validators first should participate in testnet to be chosen for mainnet with high uptime and no slashing dirung at least one month on testnet.</p>
                            <p class="greytext">Detailed information about KYVE you can read in this article.</p>
                            <p class="greytext">You can run your node for KYVE’s testnet now.</p>
                        </div>
                    </div>
                </div>
                <div class="box tile scale-anm all testnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/scroll-logo.png" /></div>
                                <div class="row1">
                                    <div class="name">SCROLL</div>
                                    <div class="per"><span>TESTNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price">$12.7B</div>
                                    <div class="value">Market Cap</div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <a href="javascript:void(0)">Coming soon</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Scroll is a Layer-2 blockchain, zkEVM-based zkRollup on Ethereum that enables native compatibility for existing Ethereum applications and tools.</p>
                            <p class="greytext">More info will be available soon. Stay tuned!</p>
                            <p class="greytext"></p>
                        </div>
                    </div>
                </div>
                <div class="box tile scale-anm all a-z testnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon5.png" /></div>
                                <div class="row1">
                                    <div class="name">ALTLAYER</div>
                                    <div class="per"><span>TESTNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price"></div>
                                    <div class="value"></div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <span>Coming soon</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Scroll is a Layer-2 blockchain, designed to scale Ethereum Network. Its main difference from other layer 2 solutions is that they build a system of highly scalable execution layers designed for applications, a modular, pluggable framework for optimizing and distributing loads in the blockchain.</p>
                            <p class="greytext">More info will be available soon. Stay tuned!</p>
                            <p class="greytext"></p>
                        </div>
                    </div>
                </div>
                <div class="box tile scale-anm all a-z testnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/taiko-logo.png" /></div>
                                <div class="row1">
                                    <div class="name">TAIKO</div>
                                    <div class="per"><span>TESTNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price"></div>
                                    <div class="value"></div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <span>Coming soon</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Taiko is a decentralized layer-1 blockchain, equivalent of Ethereum (ZK-EVM) built on ZK Rollup. It will have layer 1 and layer 2, and will allow applications, that are written for the Ethereum network, migrate to Taiko without any changes.</p>
                            <p class="greytext">More info will be available soon. Stay tuned!</p>
                            <p class="greytext"></p>
                        </div>
                    </div>
                </div>
                <div class="box tile scale-anm all a-z testnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/namada-logo.png" /></div>
                                <div class="row1">
                                    <div class="name">NAMADA</div>
                                    <div class="per"><span>TESTNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price"></div>
                                    <div class="value"></div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <span>Coming soon</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Namada is Anoma's first fractal, a blockchain built on the Anoma protocol - a layer-1 PoS blockchain for cross-chain privacy, independent of assets.</p>
                            <p class="greytext">More info will be available soon. Stay tuned!</p>
                            <p class="greytext"></p>
                        </div>
                    </div>
                </div>
                <div class="box tile scale-anm all a-z testnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/celestia-logo.png" /></div>
                                <div class="row1">
                                    <div class="name">CELESTIA</div>
                                    <div class="per"><span>TESTNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price"></div>
                                    <div class="value"></div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <span>Coming soon</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Celestia is a layer-1 blockchain with a modular architecture that makes building blockchains as easy as smart contracts. They promise support for all types of rollups, but are currently developing for the EVM and Cosmos SDK.</p>
                            <p class="greytext">More info will be available soon. Stay tuned!</p>
                            <p class="greytext"></p>
                        </div>
                    </div>
                </div>                
                <div class="box tile scale-anm all a-z testnet">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="items">
                                <div class="img"><img src="{{asset('/')}}img/shardeum-logo.png" /></div>
                                <div class="row1">
                                    <div class="name">SHARDEUM</div>
                                    <div class="per"><span>TESTNET</span></div>
                                </div>
                                <div class="row2">
                                    <div class="price"></div>
                                    <div class="value"></div>
                                </div>
                                <div class="row3">
                                    <div class="buttons">
                                        <span>Live</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-9">
                            <p>Shardeum is a linearly scalable EVM-based smart contract platform that always provides low gas cost while maintaining decentralization and strong security through dynamic state sharding like Near, Elrond and Harmony. This is a layer-1 blockchain that increases the number of transactions per second by increasing the number of nodes</p>
                            <p class="greytext">More info will be available soon. Stay tuned!</p>
                            <p class="greytext"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script type="text/javascript" id="rendered-js">

$('body').addClass('web3projects');

$(document).ready(function() {
    var selectedClass = "";
    $(".filter").click(function(){
        $(this).addClass("active").siblings().removeClass("active");
        
        selectedClass = $(this).attr("data-rel");        
        $("#portfolio").fadeTo(500, 1);
        $("#portfolio .tile").not("." + selectedClass).fadeOut().removeClass("scale-anm");
        setTimeout(function(){
            $("." + selectedClass).fadeIn().addClass("scale-anm");
            $("#portfolio").fadeTo(500, 1);
        },300);
        setTimeout(function(){
            $("#loading-animation").hide();
            $(".web3itemscontent").css("visibility","visible");
        },800);
    });
});
$(document).ready(function() {
    // Sort by project name A-Z
    $("#sortAZ").click(function() {
        $(this).addClass("active").siblings().removeClass("active");
        var type = $(this).attr('data-rel');
        
        var portfolio = $("#portfolio .box");
        if(type=="a-z"){
            $(this).html('Z-A');
            $(this).attr('data-rel','z-a');
            portfolio.sort(function(a, b) {
                var aName = $(a).find(".items .name").text().toUpperCase();
                var bName = $(b).find(".items .name").text().toUpperCase();
                if (aName < bName) {
                    return -1;
                }
                if (aName > bName) {
                    return 1;
                }
                return 0;
            });                        
        }else{
            $(this).html('A-Z');
            $(this).attr('data-rel','a-z');            
            portfolio.sort(function(a, b) {
                var aName = $(a).find(".items .name").text().toUpperCase();
                var bName = $(b).find(".items .name").text().toUpperCase();
                if (aName < bName) {
                    return 1;
                }
                if (aName > bName) {
                    return -1;
                }
                return 0;
            });
        }
        $("#portfolio").fadeTo(500, 0, function() {
            $(this).empty().append(portfolio).fadeTo(500, 1);
        });        
    });
});

</script>
@endsection