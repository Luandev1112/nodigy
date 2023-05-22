@extends('layouts.home')

@section('content')
<div class="main-container">
    <div class="presskit-tier1">
        <div class="container">
            <div class="subtext">SMARTTHINGS BRAND ASSETS</div>
            <div class="title">Marketing Resources and Identity Guidelines</div>
            <div class="img"><img src="{{asset('/')}}img/presskit-tier1-img.png" /></div>
        </div>
    </div>
    <div class="presskit-tier2">
        <div class="items item1">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="img"><img src="{{asset('/')}}img/presskit-tier2-img1.png" /></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="content">
                            <div class="icon"><img src="{{asset('/')}}img/presskit-tier2-icon.png" /></div>
                            <div class="title">Official logo with name</div>
                            <p>Options of our main logo in different colors</p>
                            <div class="btn-container">
                                <a href="#">Download file</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="items item2">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="img"><img src="{{asset('/')}}img/presskit-tier2-img2.png" /></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="content">
                            <div class="icon"><img src="{{asset('/')}}img/presskit-tier2-icon.png" /></div>
                            <div class="title">Official Name only</div>
                            <p>Options of our name in different colors</p>
                            <div class="btn-container">
                                <a href="#">Download file</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="items item3">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="img"><img src="{{asset('/')}}img/presskit-tier2-img3.png" /></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="content">
                            <div class="icon"><img src="{{asset('/')}}img/presskit-tier2-icon.png" /></div>
                            <div class="title">Official Logo variations</div>
                            <p>Other versions of our logo in different colors</p>
                            <div class="btn-container">
                                <a href="#">Download file</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="presskit-tier3">
        <div class="container">
            <div class="title">Official icons</div>
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-1.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-2.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-3.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-4.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-5.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-6.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-7.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-8.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-9.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-10.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-11.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="items">
                        <a href="#">
                            <div class="img"><img src="{{asset('/')}}img/official-icon-12.png" /></div>
                            <p>Download</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
<script type="text/javascript">

$('body').addClass('blog-page');
$('body').addClass('presskitpage');

</script>
@endsection