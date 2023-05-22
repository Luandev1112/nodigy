@extends('layouts.home')

@section('content')
<div class="main-container">
        <div class="contact-tier1">
            <div class="contactimg"><img src="{{asset('/')}}img/contact-img.png" /></div>
            <div class="container">
                <form method="POST" action="{{ route('contact.store') }}" id="form_contact">
                @csrf
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-6">
                            <div class="title">Contact Us</div>
                            <div class="subtext">Questions, bug reports, feedback.</div>
                            <div class="form-group">
                                <label>Your email</label>
                                <input type="text" class="form-control email" name="email" id="email" placeholder="Enter your email" />
                                <span class="form-error error-email" role="alert"><strong></strong></span>
                            </div>
                            <div class="form-group">
                                <label>Tell us what you need help with:</label>
                                <textarea class="form-control message" name="message" id="message" placeholder="Enter a topic, like “channel problem...”"></textarea>
                                <span class="form-error error-message" role="alert"><strong></strong></span>
                            </div>
                            <div class="form-group recaptcha-div">                                
                                <div class="g-recaptcha" id="g-recaptcha-contact"></div>
                                <span class="form-error error-g-recaptcha-response" role="alert"><strong></strong></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-primary" value="Send now" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
<!--GOOGLE-JS-->
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"></script>
<script type="text/javascript">
    var recaptcha_key = "<?=(env('GOOGLE_RECAPTCHA_KEY')) ? env('GOOGLE_RECAPTCHA_KEY') : ''?>";

    $('body').addClass('blog-page');
    $('body').addClass('contactpage');
    
    $(document).ready(function() {
        let FromIDNews = "#form_contact";
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
                    $($this).find('input[type="submit"]').val('Sending...');
                },
                success: function(result) {
                    $($this).find('input[type="submit"]').prop('disabled', false);
                    $($this).find('input[type="submit"]').val('Send now');
                    setRecaptcha();
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
    
    function onloadCallback() {
        if ($('#g-recaptcha-contact').length ) {
            recaptcha_contact = grecaptcha.render('g-recaptcha-contact', {
              'sitekey' : recaptcha_key
            });            
        }
    }
    function setRecaptcha(){
        if ($('#g-recaptcha-contact').length ) {
            grecaptcha.reset();
        }
    }
</script>
</script>
@endsection