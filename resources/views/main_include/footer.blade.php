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