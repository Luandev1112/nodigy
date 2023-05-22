@extends('layouts.home')

@section('content')
<div class="main-container">
    <div class="home-section1">
        <div class="container">
            <div class="text">
                <div class="title">WEB3 Nodes Wizard</div>
                <div class="subtitle span loader"><span>E</span><span>a</span><span>r</span><span>n</span> <span>f</span><span>r</span><span>o</span><span>m</span> <span>p</span><span>e</span><span>r</span><span>s</span><span>o</span><span>n</span><span>a</span><span>l</span> <span>b</span><span>l</span><span>o</span><span>c</span><span>k</span><span>c</span><span>h</span><span>a</span><span>i</span><span>n</span> <span>n</span><span>o</span><span>d</span><span>e</span><span>s</span></div>
                <p>Nodigy – Your Trusted Partner in the Decentralized World</p>
                <form method="POST" action="{{ route('email-subscription') }}" id="form_subscription">
                @csrf
                <div class="sub-form">
                    <div class="form-group">
                        <input type="text" class="form-control email" name="email" id="email" placeholder="Your Email" />
                        <span class="form-error error-email" role="alert"><strong></strong></span>
                    </div>
                    <input type="submit" class="btn btn-primary button" value="Subscribe" />
                </div>
                </form>
            </div>
        </div>
        <canvas class="background" width="1349" height="207" style="width: 100%; height: 100%;"></canvas>
    </div>
    <div class="home-section4">
        <div class="container">
            <div class="title">We run nodes in</div>
            <div class="searchbar row">
                <div class="search col-sm-7">
                    <div class="form-group">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M7.72633 0.51628C6.41702 0.652618 5.11292 1.17541 3.98839 2.01481C3.57169 2.32588 2.80614 3.09339 2.49523 3.51186C1.5296 4.81151 1.01336 6.28543 0.957845 7.90147C0.92479 8.86436 1.041 9.69349 1.33505 10.5922C1.70195 11.7137 2.33227 12.7469 3.16682 13.5947C4.39029 14.8377 5.93644 15.6012 7.66366 15.8153C8.12863 15.873 9.31715 15.8417 9.7602 15.7602C10.7905 15.5706 11.7072 15.215 12.5364 14.6833L12.8572 14.4775L15.1054 16.85C16.3419 18.1548 17.405 19.2663 17.4677 19.32C17.8613 19.6564 18.5459 19.5637 18.8463 19.1334C18.9972 18.9172 19.0439 18.7756 19.0473 18.5248C19.0526 18.1205 19.0267 18.0887 16.651 15.5838C15.4626 14.3306 14.4525 13.2598 14.4064 13.2041L14.3226 13.1029L14.5188 12.8477C15.8489 11.1181 16.3643 8.84288 15.9303 6.61701C15.7134 5.50482 15.1457 4.28209 14.4217 3.36793C12.8001 1.32054 10.286 0.249745 7.72633 0.51628ZM9.22964 2.53802C11.6067 2.85958 13.4894 4.62744 13.9938 7.01169C14.094 7.48545 14.1315 8.43301 14.0678 8.88488C13.8852 10.1802 13.3484 11.2866 12.4691 12.18C11.6213 13.0413 10.5696 13.5876 9.37673 13.7863C8.97652 13.853 8.09745 13.8533 7.66828 13.7869C6.12187 13.5477 4.72117 12.6358 3.86061 11.3081C3.55307 10.8336 3.38768 10.49 3.21757 9.97227C3.03251 9.40909 2.95889 8.98726 2.93528 8.35449C2.81684 5.18173 5.33603 2.51564 8.47758 2.48898C8.67913 2.48727 9.01756 2.50931 9.22964 2.53802Z" fill="white"/></svg>
                        <input type="text" class="form-control" placeholder="Search nэtwork" />
                    </div>
                </div>
                <div class="links col-sm-5">
                    {{-- <a href="#" class="active">All Projects</a>
                    <a href="#">Testnet</a>
                    <a href="#">Mainnet</a>
                    <a href="#">A-Z</a> --}}
                </div>
            </div>
            <div class="box">
                <div class="row owl-carousel owl-theme">
                    <div class="col-sm-3">
                        <div class="items">
                            <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon1.png" /></div>
                            <div class="row1">
                                <div class="name">NYM</div>
                                <div class="per"><span>7% APR</span></div>
                            </div>
                            <div class="row2">
                                <div class="price">$12.7B</div>
                                <div class="value">Market Cap</div>
                            </div>
                            <div class="row3">
                                <div class="buttons">
                                    <a href="javascript:void(0)">Mainnet</a>
                                    <!--
									<span>Testnet</span>
									-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="items">
                            <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon2.png" /></div>
                            <div class="row1">
                                <div class="name">ARBITRUM</div>
                                <div class="per"><span>?% APR</span></div>
                            </div>
                            <!--
							<div class="row2">
                                <div class="price">$119,640</div>
                                <div class="value">Market Cap</div>
                            </div>
							-->
                            <div class="row3">
                                <div class="buttons">
                                    <a href="javascript:void(0)">Mainnet</a>
                                    <!--
									<span>Testnet</span>
									-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="items">
                            <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon3.png" /></div>
                            <div class="row1">
                                <div class="name">StarkNet</div>
                                <div class="per"><span>?% APR</span></div>
                            </div>
                            <!--
							<div class="row2">
                                <div class="price">$12.7B</div>
                                <div class="value">Market Cap</div>
                            </div>
							-->
                            <div class="row3">
                                <div class="buttons">
                                    <a href="javascript:void(0)">Mainnet</a>
                                    <!--
									<span>Testnet</span>
									-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="items">
                            <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon4.png" /></div>
                            <div class="row1">
                                <div class="name">SUI</div>
                                <div class="per"><span>?% APR</span></div>
                            </div>
                            <!--
							<div class="row2">
                                <div class="price">$0.297</div>
                                <div class="value">Market Cap</div>
                            </div>
							-->
                            <div class="row3">
                                <div class="buttons">
                                    <!-- <a href="javascript:void(0)">Mainnet</a> -->
                                    <span>Testnet</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="items">
                            <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon5.png" /></div>
                            <div class="row1">
                                <div class="name">ALTLAYER</div>
                                <div class="per"><span>?% APR</span></div>
                            </div>
                            <div class="row3">
                                <div class="buttons">
                                    <span class="comingsoontag">Coming Soon</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="items">
                            <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon6.png" /></div>
                            <div class="row1">
                                <div class="name">KYVE</div>
                                <div class="per"><span>?% APR</span></div>
                            </div>
                            <div class="row3">
                                <div class="buttons">
                                    <span class="comingsoontag">Coming Soon</span>
                                </div>
								<!--
								<div class="text-center">
                                    <a href="#" class="btn btn-primary btnstakenow">Stake Now</a>
                                </div>
								-->
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="items">
                            <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon7.png" /></div>
                            <div class="row1">
                                <div class="name">Forta</div>
                                <div class="per"><span>7% APR</span></div>
                            </div>
                            <div class="row2">
                                <div class="price">$119,640</div>
                                <div class="value">Market Cap</div>
                            </div>
                            <div class="row3">
                                <div class="buttons">
                                    <a href="javascript:void(0)">Mainnet</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="items">
                            <div class="img"><img src="{{asset('/')}}img/nodes-logo-icon8.png" /></div>
                            <div class="row1">
                                <div class="name">ironfish</div>
                                <div class="per"><span>?% APR</span></div>
                            </div>
                            <!--
							<div class="row2">
                                <div class="price">$119,640</div>
                                <div class="value">Market Cap</div>
                            </div>
							-->
                            <div class="row3">
                                <div class="buttons">
                                    <a href="javascript:void(0)">Testnet</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-container"><a href="{{route('web3projects')}}" class="btn btn-default">Show all networks</a></div>
        </div>
    </div>
    <div class="home-section5-2023">
        <div class="container">
            <img src="{{asset('/')}}img/painful-node-owenership.png" />
        </div>
    </div>
    <div class="home-section6-2023" id="solution-we-offer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 hide-desktop">
                    <div class="img"><img src="{{asset('/')}}img/home-section6-2023-bg.png" /></div>
                </div>
                <div class="col-sm-6 col-sm-offset-6">
                    <div class="title">Solution we offer</div>
                    <div class="items item1">
                        <div class="img"><img src="{{asset('/')}}img/home-section6-2023-icon1.svg" /></div>
                        <p>Automated wizard to run personal nodes and delegation for passive income</p>
                    </div>
                    <div class="items item2">
                        <div class="img"><img src="{{asset('/')}}img/home-section6-2023-icon2.svg" /></div>
                        <p>No developer skills required</p>
                    </div>
                    <div class="items item3">
                        <div class="img"><img src="{{asset('/')}}img/home-section6-2023-icon3.svg" /></div>
                        <p>Analytical research and projects news  all in one place</p>
                    </div>
                    <div class="items item4">
                        <div class="img"><img src="{{asset('/')}}img/home-section6-2023-icon4.svg" /></div>
                        <p>Scale decentralization of blockchain</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="home-section7-2023">
        <div class="container">
            <div class="box">
                <div class="title">How it works?</div>
                <div class="img"><img src="{{asset('/')}}img/how-it-works-diagram.png" /></div>
            </div>
        </div>
    </div>
    <div class="home-section8-2023">
        <div class="container">
            <div class="box">
                <div class="title">Competitors</div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th class="selected">
                                    <div class="img"><img src="{{asset('/')}}img/competitors-logo-1.png" /></div>
                                    <span>Nodigy</span>
                                </th>
                                <th>
                                    <div class="img"><img src="{{asset('/')}}img/competitors-logo-2.svg" /></div>
                                    <span>Allnodes</span>
                                </th>
                                <th>
                                    <div class="img"><img src="{{asset('/')}}img/competitors-logo-3.svg" /></div>
                                    <span>Everstake</span>
                                </th>
                                <th>
                                    <div class="img"><img src="{{asset('/')}}img/competitors-logo-4.png" /></div>
                                    <span>P2P Validator</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="darkbg">
                                <td>Nodes installation wizard</td>
                                <td class="selected"><img src="{{asset('/')}}img/icon-tick-circle-white.svg" alt="" /></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Manual Nodes installation</td>
                                <td class="selected"><img src="{{asset('/')}}img/icon-tick-circle-white.svg" alt="" /></td>
                                <td><img src="{{asset('/')}}img/icon-tick-circle-white.svg" alt="" /></td>
                                <td></td>
                                <td><img src="{{asset('/')}}img/icon-tick-circle-white.svg" alt="" /></td>
                            </tr>
                            <tr class="darkbg">
                                <td>Staking, Delegation</td>
                                <td class="selected"><img src="{{asset('/')}}img/icon-tick-circle-white.svg" alt="" /></td>
                                <td><img src="{{asset('/')}}img/icon-tick-circle-white.svg" alt="" /></td>
                                <td><img src="{{asset('/')}}img/icon-tick-circle-white.svg" alt="" /></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Fiat 2Crypto2 Fiat conversion</td>
                                <td class="selected"><img src="{{asset('/')}}img/icon-tick-circle-white.svg" alt="" /></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr class="darkbg">
                                <td>Nodes for testnets</td>
                                <td class="selected"><img src="{{asset('/')}}img/icon-tick-circle-white.svg" alt="" /></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="home-section9-2023" id="roadmap">
        <div class="container">
            <div class="title">Roadmap</div>
        </div>
        <div class="items item1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="img"><img src="{{asset('/')}}img/roadmap-diagram1.png" /></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="subtitle">Phase 01</div>
                        <ul>
                            <li>Manual nodes running</li>
                            <li>Website development</li>
                            <li>Monitoring system development</li>
                            <li>Wizard’s concept creation</li>
                            <li>Wizard’s UI/UX for Web and Mobile</li>
                            <li>Personal area UI/UX for Web and mobile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="items item2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="img"><img src="{{asset('/')}}img/roadmap-diagram2.png" /></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="sbtitle1">We are here</div>
                        <div class="subtitle">Phase 02</div>
                        <ul>
                            <li>Service for testnets participants</li>
                            <li>Wizard MVP development</li>
                            <li>Personal area MVP development</li>
                            <li>Fiat-Crypto Fiat deposit and withdraw</li>
                            <li class="icon2">White paper</li>
                            <li class="icon2">WEB3 projects partnerships</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="items item3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="img"><img src="{{asset('/')}}img/roadmap-diagram3.png" /></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="subtitle">Phase 03</div>
                        <ul>
                            <li>More partnerships</li>
                            <li>Security audit</li>
                            <li>Community incentivized program</li>
                            <li>Continuous services improvement</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="items item4">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="subtitle">Phase 04</div>
                        <ul>
                            <li>DAO for validators’ pools</li>
                            <li>More TBA</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="home-section10-2023 subscribe-block">
            <div class="row">
                <div class="col-sm-4">
                    <img src="{{asset('/')}}img/subscribe-img.png" alt="" />
                </div>
                <div class="col-sm-7">
                    <div class="title">Subscribe for our news</div>
                    <p>Enter and verify your email address to receive our latest news and updates. Let`s keep in touch!</p>
                    <form method="POST" action="{{ route('subscribe.news') }}" id="form_subscribe_news">
                        @csrf
                        <div class="sub-form">
                            <div class="form-group">
                                <input type="text" class="form-control email" name="email" id="email" placeholder="Your Email" />
                                <span class="form-error error-email" role="alert"><strong></strong></span>
                            </div>
                            <input type="submit" class="btn btn-primary button" value="Subscribe" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="home-section6">
        <div class="container">
            <div class="text2">Disclaimer</div>
            <p>Information on this site is provided for educational purposes only. You must be aware that cryptocurrency is a highly volatile asset which might significantly rise and drop in value at any time. Educational content on this site should not be considered as investment advice.</p>
        </div>
        <div class="img"><img src="{{asset('/')}}img/home-section6-img-v1.png" /></div>
    </div>
</div>
@endsection

@section('pagejs')

<link href="{{asset('/')}}css/normalize.min.css?{{time()}}" rel="stylesheet">
<script src="{{asset('/')}}js/particles.min.js?{{time()}}"></script>

<script id="rendered-js">
window.onload = function () {
  Particles.init({
    selector: ".background" });

};
const particles = Particles.init({
  selector: ".background",
  color: ["#03dac6", "#ff0266", "#000000"],
  connectParticles: true,
  responsive: [
  {
    breakpoint: 768,
    options: {
      color: ["#faebd7", "#03dac6", "#ff0266"],
      maxParticles: 43,
      connectParticles: false } }] });

class NavigationPage {
  constructor() {
    this.currentId = null;
    this.currentTab = null;
    this.tabContainerHeight = 70;
    this.lastScroll = 0;
    let self = this;
    $(".nav-tab").click(function () {
      self.onTabClick(event, $(this));
    });
    $(window).scroll(() => {
      this.onScroll();
    });
    $(window).resize(() => {
      this.onResize();
    });
  }

  onTabClick(event, element) {
    event.preventDefault();
    let scrollTop =
    $(element.attr("href")).offset().top - this.tabContainerHeight + 1;
    $("html, body").animate({ scrollTop: scrollTop }, 600);
  }

  onScroll() {
    this.checkHeaderPosition();
    this.findCurrentTabSelector();
    this.lastScroll = $(window).scrollTop();
  }

  onResize() {
    if (this.currentId) {
      this.setSliderCss();
    }
  }

  checkHeaderPosition() {
    const headerHeight = 75;
    if ($(window).scrollTop() > headerHeight) {
      $(".nav-container").addClass("nav-container--scrolled");
    } else {
      $(".nav-container").removeClass("nav-container--scrolled");
    }
    let offset =
    $(".nav").offset().top +
    $(".nav").height() -
    this.tabContainerHeight -
    headerHeight;
    if (
    $(window).scrollTop() > this.lastScroll &&
    $(window).scrollTop() > offset)
    {
      $(".nav-container").addClass("nav-container--move-up");
      $(".nav-container").removeClass("nav-container--top-first");
      $(".nav-container").addClass("nav-container--top-second");
    } else if (
    $(window).scrollTop() < this.lastScroll &&
    $(window).scrollTop() > offset)
    {
      $(".nav-container").removeClass("nav-container--move-up");
      $(".nav-container").removeClass("nav-container--top-second");
      $(".nav-container-container").addClass("nav-container--top-first");
    } else {
      $(".nav-container").removeClass("nav-container--move-up");
      $(".nav-container").removeClass("nav-container--top-first");
      $(".nav-container").removeClass("nav-container--top-second");
    }
  }

  findCurrentTabSelector(element) {
    let newCurrentId;
    let newCurrentTab;
    let self = this;
    $(".nav-tab").each(function () {
      let id = $(this).attr("href");
      let offsetTop = $(id).offset().top - self.tabContainerHeight;
      let offsetBottom =
      $(id).offset().top + $(id).height() - self.tabContainerHeight;
      if (
      $(window).scrollTop() > offsetTop &&
      $(window).scrollTop() < offsetBottom)
      {
        newCurrentId = id;
        newCurrentTab = $(this);
      }
    });
    if (this.currentId != newCurrentId || this.currentId === null) {
      this.currentId = newCurrentId;
      this.currentTab = newCurrentTab;
      this.setSliderCss();
    }
  }

  setSliderCss() {
    let width = 0;
    let left = 0;
    if (this.currentTab) {
      width = this.currentTab.css("width");
      left = this.currentTab.offset().left;
    }
    $(".nav-tab-slider").css("width", width);
    $(".nav-tab-slider").css("left", left);
  }}


new NavigationPage();

$(document).ready(function() {    
    let FromID = "#form_subscription";
    $(FromID).submit(function(event) {
        event.preventDefault();
        
        var $this = $(this);
        var formData = $(FromID).serializeArray();
        
        $(FromID).find('.form-error strong').html("");
        $(FromID).find(".is-invalid").removeClass('is-invalid');

        $.ajax({
            url: $(FromID).attr('action'),
            type: 'POST',
            data: formData,            
            dataType: 'json',
            beforeSend: function() {
                $($this).find('input[type="submit"]').prop('disabled', true);
                $($this).find('input[type="submit"]').val('Subscribe...');
            },
            success: function(result) {
                $($this).find('input[type="submit"]').prop('disabled', false);
                $($this).find('input[type="submit"]').val('Subscribe');

                if(result.status) 
                {
                    $this[0].reset();
                    showToastMessage("success", result.message);                    
                }
                else if(!result.status && result.message)
                {
                    showToastMessage("error", result.message);
                    pageReload();
                } else {
                    if(result.errors){                        
                        $.each(result.errors, function(key) {
                            var errorMsg = result.errors[key][0];
                            if(errorMsg != NaN && errorMsg != undefined && errorMsg != null){                                
                                $(FromID).find("#"+key).addClass('is-invalid');
                                $(FromID).find('.error-'+key+' strong').html(errorMsg);
                            }
                        });
                        $(FromID).find(".is-invalid").first().focus();
                    }
                }
            },
            error: function(error) {
                showToastMessage("error",'Something went wrong!');
                pageReload();
            }
        });
    });

    let FromIDNews = "#form_subscribe_news";
    $(FromIDNews).submit(function(event) {
        event.preventDefault();
        
        var $this = $(this);
        var formData = $(FromIDNews).serializeArray();
        
        $(FromIDNews).find('.form-error strong').html("");
        $(FromIDNews).find(".is-invalid").removeClass('is-invalid');

        $.ajax({
            url: $(FromIDNews).attr('action'),
            type: 'POST',
            data: formData,            
            dataType: 'json',
            beforeSend: function() {
                $($this).find('input[type="submit"]').prop('disabled', true);
                $($this).find('input[type="submit"]').val('Subscribe...');
            },
            success: function(result) {
                $($this).find('input[type="submit"]').prop('disabled', false);
                $($this).find('input[type="submit"]').val('Subscribe');

                if(result.status) 
                {
                    $this[0].reset();
                    showToastMessage("success", result.message);                    
                }
                else if(!result.status && result.message)
                {
                    showToastMessage("error", result.message);
                    pageReload();
                } else {
                    if(result.errors){                        
                        $.each(result.errors, function(key) {
                            var errorMsg = result.errors[key][0];
                            if(errorMsg != NaN && errorMsg != undefined && errorMsg != null){                                
                                $(FromIDNews).find("#"+key).addClass('is-invalid');
                                $(FromIDNews).find('.error-'+key+' strong').html(errorMsg);
                            }
                        });
                        $(FromIDNews).find(".is-invalid").first().focus();
                    }
                }
            },
            error: function(error) {
                showToastMessage("error",'Something went wrong!');
                pageReload();
            }
        });
    });
});
</script>
@endsection