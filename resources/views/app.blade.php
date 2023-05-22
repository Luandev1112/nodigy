<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta
      name="description"
      content="Nodigy Admin"
    />
     <link href="{{ mix('/assets/css/style.css') }}" rel="stylesheet">
     <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body class="darkmode">
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>
    <script src="{{ asset('/assets/js/manifest.js') }}"></script>
    <script src="{{ asset('/assets/js/vendor.js') }}"></script>
    <script src="{{ asset('/assets/js/index.js') }}"></script>
  </body>
</html>
