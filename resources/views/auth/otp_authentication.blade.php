@extends('layouts.login')

@section('content')
<div class="signinheader">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <div class="logo"><a href="{{ route('home') }}"><img src="{{asset('/')}}img/logo.svg" /></a></div>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{ route('register') }}" class="btn btn-primary">Back</a>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <form method="POST" action="{{ route('verify-otp-authentication') }}" id="form_otpAuthentication">
        @csrf
        <div class="otp-graybox verifypwdform">
            <h3>Verify your email</h3>
            <p class="subtext">We have sent code to your email <span>{{stringToSecret($user->email)}}</span></p>
            <div class="form-group">
                <input type="text" class="form-control verification_code" placeholder="" maxlength="1"/>
                <input type="text" class="form-control verification_code" placeholder="" maxlength="1"/>
                <input type="text" class="form-control verification_code" placeholder="" maxlength="1"/>
                <input type="text" class="form-control verification_code" placeholder="" maxlength="1"/>
                <input type="text" class="form-control verification_code" placeholder="" maxlength="1"/>
                <input type="hidden" name="otp_code" class="otp_code" class="otp_code" value="" />                
            </div>
            <div class="btn-container">
                <input type="submit" class="btn btn-primary" value="Verify account" />
            </div>
            <div class="donthaveacount"><a href="javascript:void(0)" id="timer">00:00</a></div>
        </div>
    </form>
</div>
@endsection

@section('pagejs')
<script>
let loginSuccessUrl = "{{ route('dashboard') }}";
let resendOtpAuthenticationUrl = "{{ route('resend-otp-authentication') }}";
let timerOn = true;
let timerLimit = 119;
$(document).ready(function() {
    function timer(remaining) {
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;

        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        if($('#timer').length){
            document.getElementById('timer').innerHTML = m + ':' + s;
        }
        remaining -= 1;

        if(remaining >= 0 && timerOn) {
            setTimeout(function() {
                timer(remaining);
            }, 1000);
            return;
        }
        // Do timeout stuff here
        $('.donthaveacount').html('<a href="javascript:void(0)" id="resend_code">Resend code</a>');
    }
    timer(timerLimit);

    $('body').on("click", "#resend_code", function(event){
        event.preventDefault();
        var $this = $(this);
        if ($($this).hasClass('disabled')) {
            return false;
        }
        $(".verification_code:first").focus();
        $(".verification_code").val('');
        $(".otp_code").val('');
        $.ajax({
            url: resendOtpAuthenticationUrl,
            method: "get",
            dataType: 'json',
            beforeSend: function() {
                $($this).addClass('disabled');
            },
            success: function(result) {
                $($this).removeClass('disabled');            
                if (result.status == true) {
                    $('.donthaveacount').html('<a href="javascript:void(0)" id="timer">00:00</a>');
                    timerOn=true;
                    timer(timerLimit);
                    showToastMessage("success", result.message);
                }else{
                    showToastMessage("error", result.message);
                    pageReload();
                }
            },
            error: function(error) {
                showToastMessage("error",'Something went wrong!');
                pageReload();
            }
        });        
    });

    let FromID = "#form_otpAuthentication";
    $(FromID).submit(function(event) {
        event.preventDefault();
        
        var $this = $(this);
        var formData = $(FromID).serializeArray();
        var otp_code = $('.otp_code').val();
        if(otp_code && jQuery.trim(otp_code) && otp_code.length >= 5){
            $.ajax({
            url: $(FromID).attr('action'),
            type: 'POST',
            data: formData,            
            dataType: 'json',
            beforeSend: function() {
                $($this).find('button[type="submit"]').prop('disabled', true);                
            },
            success: function(result) {
                $($this).find('button[type="submit"]').prop('disabled', false);

                if(result.status) 
                {                    
                    if(loginSuccessUrl){
                        window.location.href = loginSuccessUrl;
                    }else{
                        showToastMessage("success", result.message);
                        pageReload();
                    }
                } else {
                    $(".verification_code:first").focus();
                    $(".verification_code").val('');
                    $('.otp_code').val('');
                    timerOn=false;
                    $('.donthaveacount').html('<a href="javascript:void(0)" id="resend_code">Resend code</a>');
                    showToastMessage("error", result.message);                    
                }
            },
            error: function(error) {
                showToastMessage("error",'Something went wrong!', 'error');
                pageReload();
            }
        });
        }
        $('.verification_code').each(function(){
            if($(this).val()==""){
                $(this).focus();
                return false;
            }
        });
        return false;
    });

    //Code Verification
    var numberRegex = /^[+-]?\d+(\.\d+)?([eE][+-]?\d+)?$/;
    
    $(".verification_code:first").focus();
    let otp_fields = $(".verification_code"),
    otp_value_field = $(".otp_code");
    
    otp_fields.on("input", function (e) {
        $(this).val(
            $(this)
            .val()
            .replace(/[^0-9]/g, "")
            );
        let opt_value = "";
        otp_fields.each(function () {
            let field_value = $(this).val();
            if (field_value != "") opt_value += field_value;
        });
        otp_value_field.val(opt_value);
    })
    .on("keyup", function (e) {
        let key = e.keyCode || e.charCode;
        if (key == 8 || key == 46 || key == 37 || key == 40) {    
            $(this).prev().focus();
        } else if (key == 38 || key == 39 || $(this).val() != "") {    
            $(this).next().focus();
        }
    })
    .on("paste", function (e) {
        let paste_data = e.originalEvent.clipboardData.getData("text");
        let paste_data_splitted = paste_data.split("");
        $.each(paste_data_splitted, function (index, value) {
            if(numberRegex.test(value)) {
                otp_fields.eq(index).val(value);
            }
        });
        $(".verification_code:last").focus();
    });    
});
</script>
@endsection
