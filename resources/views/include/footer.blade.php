@php
$prefixUrl1="";
if(!request()->is('/')){
	$prefixUrl1 = asset('/');
}
@endphp
<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-3">	
				<div class="footer-logo"><img src="{{asset('/')}}img/footer-logo.png" /></div>
			</div>	
			<div class="col-md-9">
				<div class="row">
					<div class="col-sm-3 col-xs-6">
						<div class="items">
							<p>About us</p>
							<ul>
								<li><a href="{{ $prefixUrl1 }}#solution-we-offer" class="scrolllink">Our Mission</a></li>
								<li><a href="{{route('presskit')}}">Press Kit</a></li>
								<li><a role="link" aria-disabled="true">Privacy Policy</a></li>
								<li><a role="link" aria-disabled="true">Terms of Service</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-xs-6">
						<div class="items">
							<p>Support</p>
							<ul>
								<li><a href="{{route('faq')}}">F.A.Q.</a></li>
								<li><a role="link" aria-disabled="true">Help centre</a></li>
								<li><a role="link" aria-disabled="true">Blog</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-xs-6">
						<div class="items">
							<p>Services</p>
							<ul>
								<li><a href="{{route('web3projects')}}" role="link" aria-disabled="true">Projects</a></li>
								<li><a role="link" aria-disabled="true">Run node</a></li>
								<li>
									@if(Auth::user())
						              <a href="#">Delegate</a>
						            @else
						              <a href="{{route('login')}}">Delegate</a>
						            @endif									
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3 col-xs-6">
						<div class="items">
							<p>Follow us</p>
							<ul class="hero-userful-links">
								<!-- <li><a href="#" target="_blank"><img src="{{asset('/')}}img/icon-discord.svg" /> Discord</a></li> -->
								<li><a href="https://medium.com/@nodigy" target="_blank"><img src="{{asset('/')}}img/icon-medium.svg" /> Medium</a></li>
								<li><a href="https://twitter.com/NodigyProject" target="_blank"><img src="{{asset('/')}}img/icon-twitter.svg" /> Twitter</a></li>
								<li><a href="https://t.me/nodigy_news" target="_blank"><img src="{{asset('/')}}img/icon-telegram.svg" /> Telegram</a></li>
								<!-- <li><a href="https://www.facebook.com/profile.php?id=100087976975660" target="_blank"><img src="{{asset('/')}}img/icon-facebook.png" height="22" /> Facebook</a></li> -->
							</ul>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<div class="subfooter">
			<div class="container">
				<p>© {{date('Y')}} Nodigy. All rights reserved</p>
			</div>
		</div>
	</div>
</footer>

@if(Session::has('status'))
    <script type="text/javascript">
        showToastMessage("success","{{ Session::get('status') }}");
    </script>    
    @php Session::forget('status') @endphp
@endif
@if(Session::has('success'))
    <script type="text/javascript">
        showToastMessage("success","{{ Session::get('success') }}");
    </script>
    @php Session::forget('success') @endphp
@endif
@if(Session::has('error'))
    <script type="text/javascript">
        showToastMessage("error","{{ Session::get('error') }}");
    </script>
    @php Session::forget('error') @endphp
@endif
@if(Session::has('warning'))
    <script type="text/javascript">
        showToastMessage("warning","{{ Session::get('warning') }}");
    </script>
    @php Session::forget('warning') @endphp
@endif

@yield('js')
@yield('pagejs')

</body>
</html>