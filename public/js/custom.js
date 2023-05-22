jQuery.event.special.touchstart = {
  setup: function( _, ns, handle ){
    if ( ns.includes("noPreventDefault") ) {
      this.addEventListener("touchstart", handle, { passive: false });
    } else {
      this.addEventListener("touchstart", handle, { passive: true });
    }
  }
};
$(document).ready(function(){
    $("input").attr("autocomplete", "off");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    $('#password_show').hide();
    $("#password-addon").on('click', function () {
        if ($(this).siblings('input').length > 0) {
        	if($(this).siblings('input').attr('type') == "password"){
        		$(this).siblings('input').attr('type', 'input');
        		$('#password_hide').hide();
        		$('#password_show').show();
        	}else{
        		$(this).siblings('input').attr('type', 'password');
        		$('#password_hide').show();
        		$('#password_show').hide();
        	}
        }
    });

    $('#conf_password_show').hide();
    $("#conf-password-addon").on('click', function () {
        if ($(this).siblings('input').length > 0) {
          if($(this).siblings('input').attr('type') == "password"){
            $(this).siblings('input').attr('type', 'input');
            $('#conf_password_hide').hide();
            $('#conf_password_show').show();
          }else{
            $(this).siblings('input').attr('type', 'password');
            $('#conf_password_hide').show();
            $('#conf_password_show').hide();
          }
        }
    });
});
function pageReload(){
    setTimeout(function() {
        location.reload(true);        
    }, 3000);
}
function showToastMessage(toast_type = "success", message = "") {
    var toast_type = toast_type.toLowerCase();
    if(toast_type=="warning"){
        $.toast({
            heading: 'Warning',
            text: message,
            position: 'top-right',
            icon: 'warning',
            loaderBg: '#DA5F01',
            stack: false
        });
    }else if(toast_type=="info"){
        $.toast({
            heading: 'Info',
            text: message,
            position: 'top-right',
            icon: 'info',
            loaderBg: '#DA5F01',
            stack: false
        });
    }else if(toast_type=="error"){
        $.toast({
            heading: 'Error',
            text: message,
            position: 'top-right',
            icon: 'error',
            loaderBg: '#DA5F01',
            stack: false
        });
    }else{
        $.toast({
            heading: 'Success',
            text: message,
            position: 'top-right',
            icon: 'success',
            loaderBg: '#DA5F01',
            stack: false
        });
    }    
}