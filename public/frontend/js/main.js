var themeStyle = localStorage.getItem('is_visited_theme');
$(document).ready(function(){
	$(".mobilenavicon").click(function(){
	  $("body").toggleClass("opensidebar");
	});
	
	initSettings();

	$('.themechange input:checkbox').change(function(){		
		updateThemeSetting();
	});
});
function updateThemeSetting() {
    //My custom code
    if ($(".themechange input:checkbox").prop("checked") == true) {
        $("body").addClass("darkmode");
		$("body").removeClass("lightmode");
        localStorage.setItem("is_visited_theme", "dark-mode-switch");
    } else {
        $("body").removeClass("darkmode");
		$("body").addClass("lightmode");
        localStorage.setItem("is_visited_theme", "light-mode-switch");
    }
}
function initSettings() {
    //My custom code    
    if (themeStyle != null) {
        if (themeStyle == 'dark-mode-switch') {
            $(".themechange input:checkbox").prop('checked', true);
            $("body").addClass("darkmode");
			$("body").removeClass("lightmode");
            localStorage.setItem("is_visited_theme", "dark-mode-switch");            
        } else {
            $(".themechange input:checkbox").prop('checked', false);
            $("body").removeClass("darkmode");
			$("body").addClass("lightmode");
            localStorage.setItem("is_visited_theme", "light-mode-switch");            
        }
    } else {
        $(".themechange input:checkbox").prop('checked', true);
        $("body").addClass("darkmode");
		$("body").removeClass("lightmode");
        localStorage.setItem("is_visited_theme", "dark-mode-switch");        
    }
}