@extends('layouts.customhome')

@section('content')
<style type="text/css">
header .header-right .login a,
.home-page header .navbar-default .navbar-nav>li>a{
    color:#000 !important;
}
.home-page header .navbar-default .navbar-nav>li>a:hover, .home-page header .header-right .login a:hover{
    color:#524d4d !important;
}
</style>
<?php 

$array[] = array('title'=>'<p dir="ltr"><b>What is Nodigy?</b></p>','description'=>'

<p dir="ltr">Nodigy is a service of automated deployment, monitoring and round-the-clock support of nodes of various blockchains, protocols and other web 3 projects.</p>

<p dir="ltr">It is a secure non-custodial service for earning passive income with no access to your funds.</p>

<p dir="ltr">For you, we have the automated deployment of nodes of popular projects and build a handy wizard that will help you run your own nodes with no specific technical knowledge.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>What makes our service unique?</b></p>','description'=>'

<p dir="ltr">You can become a validator of any blockchain or project that needs nodes. It allows you to monitor the state of your node, receive notifications on any changes related to the status of your nodes and updates on projects of your interest. You can do this with no specific knowledge and hands-on experience in the blockchain industry or system administration. You can start with the minimum threshold.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>Who is our service for?</b></p>','description'=>'

<p dir="ltr">If you are:</p>

<p dir="ltr">&nbsp;&bull; Crypto enthusiast</p>

<p dir="ltr">&bull; Individual investor</p>

<p dir="ltr">&bull; Institutional investor</p>

<p dir="ltr">&bull; Web 3 project</p>

<p dir="ltr">And Strive to become a part of the blockchain ecosystem, a validator of a specific network, but do not have the ability or desire to install, administer and maintain servers</p>

<p dir="ltr">WELCOME!</p>

<p dir="ltr"><u>You can become a validator!</u></p>

<p dir="ltr">With Nodigy you can easily go all the way from depositing fiat on your bank debit or credit card to running your own node on the desired network with the coins staked in it.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>How do we contribute to the blockchain ecosystem? What are the benefits of working with us?</b></p>','description'=>'

<p dir="ltr">For web 3 projects:</p>

<p dir="ltr">&bull; We assist in deploying the node infrastructure and help network accessibility</p>

<p dir="ltr">&bull; We take care of the servers</p>

<p dir="ltr">&bull; Your project teams can focus on developing a quality product</p>

<p dir="ltr">&bull; We attract new users and investors in projects, contributing to greater decentralisation</p>

<p dir="ltr">To individual investors:</p>

<ul>
    <li dir="ltr">
    <p dir="ltr">Facilitate entry into the world of crypto</p>
    </li>
    <li dir="ltr">
    <p dir="ltr">Enable you to run your own nodes and participate in the work of blockchains, receiving income. You do not need to have DevOps skills</p>
    </li>
    <li dir="ltr">
    <p dir="ltr">Provide ready-made analytics related to projects. You do not need to search and analyse information about projects yourself</p>
    </li>
    <li dir="ltr">
    <p dir="ltr">You can participate in testnets and contribute to web3 projects on the early stage to earn rewards</p>
    </li>
</ul>

');

$array[] = array('title'=>'<p dir="ltr"><b>What makes us believe our service will be in demand?</b></p>','description'=>'

<p dir="ltr">The POS consensus is the most popular and widely used among existing blockchains. A limited number of individuals can afford becoming validators and set up their own nodes. They are high profile IT specialists such as developers and network administrators with access to servers. However, they might not have enough liquidity.</p>

<p dir="ltr">On the other hand, professional investors and people who have some liquidity are not equipped with technical knowledge and skills to run nodes on their own.</p>

<p dir="ltr">Most crypto enthusiasts and investors can&rsquo;t run nodes on their own as there is no simple, user-friendly platform with affordable services.</p>

<p dir="ltr">Almost all blockchains strive to become as decentralised as possible to ensure the security and uninterrupted operation of their network, attract more users, hence, liquidity. And we can help with this.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>Can I run a node in testnets? If so, how can I do that?</b></p>','description'=>'

<p dir="ltr">Sure, you can. As you may know, many developers are working on new blockchains and protocols, and many of them want to test their ideas before they go live on the mainnet. They run testnets that pay their validators and community dispatchers. People in the community are interested in joining the race and becoming validators. But because they are not developers, they can&#39;t run their own nodes.</p>

<p dir="ltr">You need to sign up for the project you&#39;re interested in. Then send Nodigy an application to run your node on this blockchain, and we will take care of the rest.</p>

<p dir="ltr">We will set up a server based on blockchains&#39; needs, run the node, monitor the node&#39;s status, and update it whenever needed. Some incentive testnets include social tasks, but it isn&rsquo;t part we can do for you. It&#39;s up to you if you want to participate in these activities and do that or not.</p>

<p dir="ltr">We will charge a small monthly fee based on the server requirements and how often the node needs to be updated. This depends on the project. You will get all the rewards the project pays you. We don&rsquo;t request you to share the rewards with us as part of the fee.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>What makes us different?</b></p>','description'=>'

<p dir="ltr">With Nodigy you receive:</p>

<p dir="ltr">&bull; Ready-made analytics on the projects that are carefully selected by our team.</p>

<p dir="ltr">&bull; Automated deployment of nodes, node monitoring and scaling</p>

<p dir="ltr">&bull; The possibility to set up your own nodes</p>

<p dir="ltr">&bull; The opportunity to participate in the blockchain ecosystem and receive income</p>

<p dir="ltr">&bull; A step-by-step path from fiat on your debit card to a working node equipped with the right tokens&nbsp;</p>

<p dir="ltr">&bull; An advanced monitoring system that ensures the smooth operation of the nodes</p>

<p dir="ltr">Currently we are working with several blockchain projects. In the long-term we are to offer hundreds of projects to install nodes and delegate your tokens to.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>How complex is your service for a newbie to start with?</b></p>','description'=>'

<p dir="ltr">Simple and accessible to everyone:</p>

<p dir="ltr">&bull; Use step-by-step instructions and materials written in a simple language, for example, create your own wallet according to the instructions</p>

<p dir="ltr">&bull; With our investment wizard you will easily go all the way from fiat on a bank debit or credit card to a working node of a project of your interest and the tokens.</p>

<p dir="ltr">To start with - click a button and you will get detailed instructions and &ldquo;How to&rdquo; guides and educational materials written in a simple and easy language.</p>

<p dir="ltr">The maximum you have to do is to create your wallet according to the instructions.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>My knowledge of crypto currencies and blockchain is limited. How fast can I start investing using your service?</b></p>','description'=>'

<p dir="ltr">Immediately</p>

<p dir="ltr">You will be provided with the step-by-step guide &quot;how to create a wallet&quot;, how to swap and transfer tokens, how to monitor changes and withdraw rewards - everything is simple and transparent.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>How can I start earning passive income with Nodigy?</b></p>','description'=>'

<p dir="ltr">You have 2 investment options:</p>

<ol>
    <li dir="ltr">
    <p dir="ltr">Delegate your tokens to our nodes and receive passive income from your share of the investment minus the validator&#39;s commission;</p>
    </li>
    <li dir="ltr">
    <p dir="ltr">Install your own node and receive passive income, periodically fixing profits from the remuneration from the node. You will be paid rewards by the project itself for securing the network. You will also take a commission from the ones who have delegated their tokens to your node</p>
    </li>
</ol>

<p dir="ltr">&nbsp;Read the recommendations and choose the strategy that suits you.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>The main issue associated with crypto is the issue of trust. How do we respond to this challenge?</b></p>','description'=>'

<p dir="ltr">The issue of trust is the cornerstone of investing. We work hard to make our services trustless (when no need to trust, everything is transparent and verifiable). We do not have access to funds of our clients. Our service is non-custodial which means that we do not have access to your finances (it is you who is solely responsible for the keys to handle transactions, not a third party).</p>

<p dir="ltr">At the same time we work hard to ensure that nodes run smoothly with high performance and activity rates. This maximises income for node owners and delegators. That&rsquo;s why we are constantly working to improve the security and monitoring system, as well as provide ongoing support 24/7/365</p>

<p dir="ltr">As soon as main functionalities are ready we are to conduct rounds of security audits by independent companies. Auditors are welcome to test and try our infrastructure security.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>I want to learn more about how to buy and invest in cryptocurrencies. How does Nodigy help me with this?</b></p>','description'=>'

<p dir="ltr">In addition to providing a fully automated service, we pay great attention to educating our community. We regularly publish educational materials about cryptocurrencies, blockchain projects, step-by-step instructions, guides on financial literacy for beginners and advanced users.&nbsp;</p>

<p dir="ltr">In future you will have access to analysis of the value of different stakes and cross-network analytics to track rewards flows.</p>

<p dir="ltr">Each of the nodes has averaged statistics for past periods. Based on this data, you can build your investment strategy.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>What is the minimum threshold required for delegation?</b></p>','description'=>'

<p dir="ltr">If you want to delegate your tokens to other validators, you can do so with any amount of tokens. Normally, you can start with any amount since no restrictions apply as to the minimum and maximum delegation threshold. It all depends on the strategy you choose.&nbsp;</p>

<p dir="ltr">However, some projects have restrictions on the minimum and maximum amounts of tokens in the node. Prior to making decisions to delegate, read our analytical materials and instructions to learn more about investing in projects of your interest.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>What costs do I incur when delegating my tokens?</b></p>','description'=>'

<p dir="ltr">If you delegate your tokens to the node of another validator, you do not incur any costs. You receive income from your share of investment in the node in the form of rewards. The validator takes a commission from the rewards you receive, usually from 1% to 10%.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>What commission Nodigy charges when I run my node? Are there fixed and monthly costs?</b></p>','description'=>'

<p dir="ltr">The commission from the node is 2% of the received rewards. In addition, you will pay server and administrative costs, the amount of which depends on the project.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>What is the difference between staking in my node and in someone else&#39;s node?</b></p>','description'=>'

<p dir="ltr">A short answer - in a percentage of rewards.</p>

<p dir="ltr">By delegating tokens to another node, you receive income from the share of your investment in that node. In this case, you pay a commission set by the validator out of the rewards.</p>

<p dir="ltr">By setting up your node, you get rewards from the project itself - blockchain or protocol - for securing their network. You also earn on the commission you set from the tokens other users have delegated to your node.</p>

<p dir="ltr">&nbsp;</p>');

$array[] = array('title'=>'<p dir="ltr"><b>I have tokens of the projects other than those listed on your website. How can I exchange them for tokens of the projects you support?</b></p>','description'=>'

<p dir="ltr">You do so at any DEX or CEX that have these tokens available to swap, or use our service. When your node is being set up, our automated system exchanges them using the services and protocols connected to it.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>How many nodes of one project can I set up?</b></p>','description'=>'

<p dir="ltr">Normally, one is enough. When a project sets a limit on the maximum stake, then you can deploy as many nodes as you wish.</p>

<p dir="ltr">It is important that you put your tokens in each of your nodes. Some projects set an upper limit on the volume of tokens in a node to make the network more decentralised. In this case, if you have much more tokens than the project requires, you can run as many nodes as you want.</p>

<p dir="ltr"><b>In cases when profitability of a node depends on the number of tokens in it - the more staked, the more income received - it makes sense to invest as many tokens as possible in one node.</b></p>

');

$array[] = array('title'=>'<p dir="ltr"><b>How long does it take to install and deploy one node?</b></p>','description'=>'

<p dir="ltr">Depends on the node and on the project. Each project has its own requirements and the speed of installation varies. The installation of some nodes requires the participation of a human being, and we are working on minimising this involvement. However, certain actions still have to be taken either by us or by you.</p>

<p dir="ltr">&nbsp;</p>

<p dir="ltr">On average, installation ranges from 5 minutes to 30 minutes, then it takes time for a node to mix. Thus, the entire process may take up to 2 or 3 days.</p>

');

$array[] = array('title'=>'<p dir="ltr"><b>What should I do if my node goes down?</b></p>','description'=>'

<p dir="ltr">Usually nothing. But you will be required to follow our instructions in case your nodes fell due to your fault. For example, you withdrew money from the stake, or the network required you to increase the minimum stake, but you did not.</p>

<p dir="ltr">In other cases, we will inform you about any malfunction. Our team takes full responsibility for all node recovery work. We make every effort to ensure the smooth operation of all nodes. Our monitoring system helps to prevent the occurrence of errors and take timely action to eliminate them.</p>

<p dir="ltr">You do not need to constantly monitor the status of your nodes. We follow project news and implement updates in a timely manner. We give you advance notice of changes that require your participation to prevent node shutdowns. This mainly deals with changes in the amount of staking in nodes, and issues related to KYC requirements.</p>

<p><br />
&nbsp;</p>');

?>
<div class="main-container innerpage">
    <div class="faq-section1">
        <div class="container">
            <div class="text1">Knowledge Base</div>
            <div class="title">Frequently Asked Questions</div>
            <div class="box">
                <div class="row">
                    <div class="col-sm-12">
                        {{-- <div class="title">Content for experienced users</div> --}}
                        <div class="panel-group" id="accordion2" role="tablist" aria-multiselectable="true">
                            @foreach($array as $k=>$list)
                              <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingOne{{$k}}">
                                  <h4 class="panel-title">
                                    <a role="button" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne{{$k}}" aria-expanded="true" aria-controls="collapseOne{{$k}}">{!! $list['title'] !!}</a>
                                  </h4>
                                </div>
                                <div id="collapseOne{{$k}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne{{$k}}">
                                  <div class="panel-body">
                                    {!! $list['description'] !!}
                                  </div>
                                </div>
                              </div>
                            @endforeach
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="faq-section2">
        <div class="container">
            <div class="box">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="img"><img src="{{asset('/')}}img/faq-img.png" /></div>
                    </div>
                    <div class="col-sm-7">
                        <h2>Get in touch with us below and let us help!</h2>
                        <div class="btn-container"><a href="#" class="btn btn-primary">Help Center</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
@endsection