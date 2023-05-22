@php
  $fixAssetUrl = asset('/frontend')."/";
@endphp
<div class="sidebar">
  <div class="logo hide-mobile"><img src="{{$fixAssetUrl}}/img/logo.png" /></div>
  <ul>
      <li>
          <a href="javascript:void(0);" class="active">
              <div class="img"><img src="{{$fixAssetUrl}}img/icon-dashboard.svg" /></div>
              <span>Dashboard</span>
          </a>
      </li>
      <li>
          <a href="javascript:void(0);">
              <div class="img"><img src="{{$fixAssetUrl}}img/icon-wallets.svg" /></div>
              <span>Wallets</span>
          </a>
      </li>
      <li>
          <a href="javascript:void(0);">
              <div class="img"><img src="{{$fixAssetUrl}}img/icon-my-balance.svg" /></div> 
              <span>My Balance</span>
          </a>
      </li>
      <li>
          <a href="javascript:void(0);">
              <div class="img"><img src="{{$fixAssetUrl}}img/icon-node.svg" /></div> 
              <span>Node</span>
          </a>
      </li>
      <li>
          <a href="javascript:void(0);">
              <div class="img"><img src="{{$fixAssetUrl}}img/icon-analytics.svg" /></div> 
              <span>Analytics</span>
          </a>
      </li>
  </ul>
  <div class="bottomlinks">
      <ul>
          <li>
              <a href="javascript:void(0);">
                  <div class="img"><img src="{{$fixAssetUrl}}img/icon-get-help.svg" /></div> 
                  <span>Get Help</span>
              </a>
          </li>
          <li>
              <a href="javascript:void(0);"><div class="img"><img src="{{$fixAssetUrl}}img/icon-settings.svg" /></div> 
                  <span>Settings</span>
              </a>
          </li>
      </ul>
  </div>
</div>