@extends('layouts.app')

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
<div class="main-container innerpage">
        <div class="about-section1">
            <div class="container">
                <div class="text1">We focus on innovative projects</div>
                <div class="title">with the capacity to advance blockchain technology to the new heights</div>
                <div class="btn-container"><a href="#" class="btn btn-primary">GET STARTED</a></div>
                <div class="img-container"><img src="{{asset('/')}}img/about-section1-img.png" alt="" /></div>
                <div class="text2"><p>Company (what we do, our services) we focus on innovative projects which have the capacity to advance blockchain technology to the new height</p></div>
            </div>
        </div>
        <div class="about-section2">
            <div class="container">
                <div class="title">The advantage of staking your assets today</div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="items item1">
                            <div class="svg"><svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 0.5C8.3575 0.5 0.5 8.3575 0.5 18C0.5 27.6425 8.3575 35.5 18 35.5C27.6425 35.5 35.5 27.6425 35.5 18C35.5 8.3575 27.6425 0.5 18 0.5ZM26.365 13.975L16.4425 23.8975C16.1975 24.1425 15.865 24.2825 15.515 24.2825C15.165 24.2825 14.8325 24.1425 14.5875 23.8975L9.635 18.945C9.1275 18.4375 9.1275 17.5975 9.635 17.09C10.1425 16.5825 10.9825 16.5825 11.49 17.09L15.515 21.115L24.51 12.12C25.0175 11.6125 25.8575 11.6125 26.365 12.12C26.8725 12.6275 26.8725 13.45 26.365 13.975Z" fill="#0C0507"/></svg></div>
                            <div class="subhead">Earn interest</div>
                            <p>Fusce ut vehicula nisi, quis semper ante</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="items item2">
                            <div class="svg"><svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 0.5C8.3575 0.5 0.5 8.3575 0.5 18C0.5 27.6425 8.3575 35.5 18 35.5C27.6425 35.5 35.5 27.6425 35.5 18C35.5 8.3575 27.6425 0.5 18 0.5ZM26.365 13.975L16.4425 23.8975C16.1975 24.1425 15.865 24.2825 15.515 24.2825C15.165 24.2825 14.8325 24.1425 14.5875 23.8975L9.635 18.945C9.1275 18.4375 9.1275 17.5975 9.635 17.09C10.1425 16.5825 10.9825 16.5825 11.49 17.09L15.515 21.115L24.51 12.12C25.0175 11.6125 25.8575 11.6125 26.365 12.12C26.8725 12.6275 26.8725 13.45 26.365 13.975Z" fill="#0C0507"/></svg></div>
                            <div class="subhead">Expertise</div>
                            <p>Fusce ut vehicula nisi, quis semper ante</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="items item3">
                            <div class="svg"><svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 0.5C8.3575 0.5 0.5 8.3575 0.5 18C0.5 27.6425 8.3575 35.5 18 35.5C27.6425 35.5 35.5 27.6425 35.5 18C35.5 8.3575 27.6425 0.5 18 0.5ZM26.365 13.975L16.4425 23.8975C16.1975 24.1425 15.865 24.2825 15.515 24.2825C15.165 24.2825 14.8325 24.1425 14.5875 23.8975L9.635 18.945C9.1275 18.4375 9.1275 17.5975 9.635 17.09C10.1425 16.5825 10.9825 16.5825 11.49 17.09L15.515 21.115L24.51 12.12C25.0175 11.6125 25.8575 11.6125 26.365 12.12C26.8725 12.6275 26.8725 13.45 26.365 13.975Z" fill="#0C0507"/></svg></div>
                            <div class="subhead">Alignment</div>
                            <p>Fusce ut vehicula nisi, quis semper ante</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="items item4">
                            <div class="svg"><svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 0.5C8.3575 0.5 0.5 8.3575 0.5 18C0.5 27.6425 8.3575 35.5 18 35.5C27.6425 35.5 35.5 27.6425 35.5 18C35.5 8.3575 27.6425 0.5 18 0.5ZM26.365 13.975L16.4425 23.8975C16.1975 24.1425 15.865 24.2825 15.515 24.2825C15.165 24.2825 14.8325 24.1425 14.5875 23.8975L9.635 18.945C9.1275 18.4375 9.1275 17.5975 9.635 17.09C10.1425 16.5825 10.9825 16.5825 11.49 17.09L15.515 21.115L24.51 12.12C25.0175 11.6125 25.8575 11.6125 26.365 12.12C26.8725 12.6275 26.8725 13.45 26.365 13.975Z" fill="#0C0507"/></svg></div>
                            <div class="subhead">Solo on Web</div>
                            <p>Fusce ut vehicula nisi, quis semper ante</p>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="items item5">
                            <div class="svg"><svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18 0.5C8.3575 0.5 0.5 8.3575 0.5 18C0.5 27.6425 8.3575 35.5 18 35.5C27.6425 35.5 35.5 27.6425 35.5 18C35.5 8.3575 27.6425 0.5 18 0.5ZM26.365 13.975L16.4425 23.8975C16.1975 24.1425 15.865 24.2825 15.515 24.2825C15.165 24.2825 14.8325 24.1425 14.5875 23.8975L9.635 18.945C9.1275 18.4375 9.1275 17.5975 9.635 17.09C10.1425 16.5825 10.9825 16.5825 11.49 17.09L15.515 21.115L24.51 12.12C25.0175 11.6125 25.8575 11.6125 26.365 12.12C26.8725 12.6275 26.8725 13.45 26.365 13.975Z" fill="#0C0507"/></svg></div>
                            <div class="subhead">Reward</div>
                            <p>Fusce ut vehicula nisi, quis semper ante</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="about-section3">
            <div class="container">
                <div class="box">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="img"><svg width="52" height="52" viewBox="0 0 52 52" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M36.8242 0.166748H15.1759C5.77258 0.166748 0.166748 5.77258 0.166748 15.1759V36.7984C0.166748 46.2276 5.77258 51.8334 15.1759 51.8334H36.7984C46.2017 51.8334 51.8076 46.2276 51.8076 36.8242V15.1759C51.8334 5.77258 46.2276 0.166748 36.8242 0.166748ZM20.4459 37.4959C20.4459 40.4151 18.0692 42.7917 15.1501 42.7917C12.2309 42.7917 9.85425 40.4151 9.85425 37.4959C9.85425 35.2484 11.2492 33.3626 13.2126 32.5876V21.5051C11.0426 20.7042 9.46675 18.6376 9.46675 16.1834C9.46675 13.0576 12.0242 10.5001 15.1501 10.5001C18.2759 10.5001 20.8334 13.0576 20.8334 16.1834C20.8334 18.6376 19.2576 20.7042 17.0876 21.5051V32.5876C19.0509 33.3626 20.4459 35.2743 20.4459 37.4959ZM38.2709 42.7917C35.3517 42.7917 32.9751 40.4151 32.9751 37.4959C32.9751 35.2484 34.3701 33.3626 36.3334 32.5876V17.6042C36.3334 17.2426 36.0492 16.9584 35.6876 16.9584H32.7684L33.3109 17.3976C34.1376 18.0951 34.2409 19.3092 33.5692 20.1359C33.1817 20.6009 32.6134 20.8334 32.0709 20.8334C31.6317 20.8334 31.1926 20.6784 30.8309 20.3942L26.1809 16.5192C25.7417 16.1317 25.4834 15.5892 25.4834 15.0209C25.4834 14.4526 25.7417 13.9101 26.1809 13.5226L30.8309 9.64758C31.6576 8.97591 32.8717 9.07925 33.5692 9.90591C34.2667 10.7326 34.1376 11.9467 33.3109 12.6442L32.7684 13.0834H35.6876C38.1676 13.0834 40.2084 15.1242 40.2084 17.6042V32.5876C42.1717 33.3626 43.5667 35.2743 43.5667 37.4959C43.5667 40.4151 41.1901 42.7917 38.2709 42.7917Z" fill="#00FFF0"/></svg></div>
                            <div class="title">Validator Physically located in Romania</div>
                            <p>Duis pretium sodales velit eget mollis. Curabitur blandit justo eu mauris egestas ultricies. Vestibulum lobortis ut mauris at congue. Etiam</p>
                        </div>
                        <div class="col-sm-6">
                            <div class="img"><svg width="44" height="53" viewBox="0 0 44 53" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M38.8951 6.64334L24.6867 1.32167C23.2142 0.77917 20.8117 0.77917 19.3392 1.32167L5.1309 6.64334C2.39256 7.67667 0.170898 10.88 0.170898 13.7992V34.7242C0.170898 36.8167 1.54007 39.5808 3.21923 40.8208L17.4276 51.4383C19.9334 53.3242 24.0409 53.3242 26.5467 51.4383L40.7551 40.8208C42.4342 39.555 43.8034 36.8167 43.8034 34.7242V13.7992C43.8292 10.88 41.6076 7.67667 38.8951 6.64334ZM30.9901 21.11L19.8817 32.2183C19.4942 32.6058 19.0034 32.7867 18.5126 32.7867C18.0217 32.7867 17.5309 32.6058 17.1434 32.2183L13.0101 28.0333C12.2609 27.2842 12.2609 26.0442 13.0101 25.295C13.7592 24.5458 14.9992 24.5458 15.7484 25.295L18.5384 28.085L28.2776 18.3458C29.0267 17.5967 30.2667 17.5967 31.0159 18.3458C31.7651 19.095 31.7651 20.3608 30.9901 21.11Z" fill="#00FFF0"/></svg></div>
                            <div class="title">DDos <br />Protection</div>
                            <p>Duis pretium sodales velit eget mollis. Curabitur blandit justo eu mauris egestas ultricies. Vestibulum lobortis ut mauris at congue. Etiam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection