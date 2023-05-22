@php
   $loginUser = Auth::user();
   $fixAssetUrl = asset('/frontend')."/";
@endphp
<div class="pagetitle">
   <div class="mobilenavicon hide-desktop"><img src="{{$fixAssetUrl}}img/nav-icon.png" /></div>
   <div class="logo hide-desktop"><img src="{{$fixAssetUrl}}img/logo.png" /></div>
   <h1>Dashboard</h1>
   <div class="actionright">
      <div class="dropdown walletdropdown">
         <button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="{{$fixAssetUrl}}img/icon-empty-wallet.png" /> <span>$10,350752.45</span></button>
         <ul class="dropdown-menu" aria-labelledby="">
            <li><a href="#">$10,350752.45</a></li>
            <li><a href="#">$10,350752.45</a></li>
         </ul>
      </div>
      <div class="dropdown notifications">
         <button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><img src="{{$fixAssetUrl}}img/icon-notifications.png" /></button>
         <ul class="dropdown-menu" aria-labelledby="">
            <li><a href="#">Option 1</a></li>
            <li><a href="#">Option 2</a></li>
         </ul>
      </div>
      <div class="dropdown profiledropdown">
         <button class="btn btn-default dropdown-toggle" type="button" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
            <div class="img"><img src="{{$fixAssetUrl}}img/profile-img.png" /></div>
            <span>{{getEmailToName($loginUser->email)}}</span>
         </button>
         <ul class="dropdown-menu" aria-labelledby="">
            <li class="title"><a href="javascript:void(0)">{{getEmailToName($loginUser->email)}}</a></li>
            <li><a href="#"><img src="{{$fixAssetUrl}}img/icon-setings.png" /> Account settings</a></li>
            <li><a href="{{route('logout')}}"><img src="{{$fixAssetUrl}}img/icon-logout.png" /> Logout</a></li>
            <li class="last">
               <span class="text">Dark mode</span>
               <div class="cus_switch themechange">
                  <input type="checkbox" checked />
                  <span></span>
               </div>
            </li>
         </ul>
      </div>
   </div>
</div>