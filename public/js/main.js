
$(document).ready(function(){
	$(".navbar-toggle").click(function(){
	  $("header").toggleClass("openmenu");
	});
	 $(".scrolllink").on('click', function(event) {
	 	var hash = this.hash;
		// Make sure this.hash has a value before overriding default behavior
		if ($(hash).length > 0) {
		  // Prevent default anchor click behavior
		  event.preventDefault();

		  // Store hash
		  var hash = this.hash;

		  // Using jQuery's animate() method to add smooth page scroll
		  // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
		  $('html, body').animate({
			scrollTop: $(hash).offset().top
		  }, 800, function(){
	   
			// Add hash (#) to URL when done scrolling (default click behavior)
			window.location.hash = hash;
		  });
		} // End if
	  });
});

$(window).scroll(function(){
	if ($(window).scrollTop() >= 300) {
		$('header').addClass('fixed-header');
	}
	else {
		$('header').removeClass('fixed-header');
	}
});

$(document).ready(function() {
	$(".signin .bluebox .owl-carousel").owlCarousel({
		loop:true,
		margin:0,
		nav:false,
		pagination:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
	
	$(".home-section5 .owl-carousel").owlCarousel({
		loop:true,
		margin:20,
		nav:false,
		pagination:true,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
	
	$(".recommended-items").owlCarousel({
		loop:true,
		margin:20,
		nav:false,
		pagination:false,
		responsive:{
			0:{
				items:1
			},
			600:{
				items:3
			},
			1000:{
				items:4
			}
		}
	});
	
	if($(window).width() < 767) {
		$(".home-section3 .owl-carousel").owlCarousel({
			loop:true,
			margin:20,
			nav:false,
			pagination:false,
			responsive:{
				0:{
					items:1.3
				},
				600:{
					items:1.3
				},
				1000:{
					items:1.3
				}
			}
		});
		$(".home-section4 .owl-carousel").owlCarousel({
			loop:true,
			margin:20,
			nav:false,
			pagination:false,
			responsive:{
				0:{
					items:1.3
				},
				600:{
					items:1.3
				},
				1000:{
					items:1.3
				}
			}
		});
		$(".about-section2 .owl-carousel").owlCarousel({
			loop:true,
			margin:20,
			nav:false,
			pagination:false,
			responsive:{
				0:{
					items:1.3
				},
				600:{
					items:1.3
				},
				1000:{
					items:1.3
				}
			}
		});
		$(".recommended-items").owlCarousel({
			loop:true,
			margin:20,
			nav:false,
			pagination:false,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:3
				},
				1000:{
					items:4
				}
			}
		});
	}
	
	$(window).resize(function(){
		  if($(window).width() < 767) {
			$(".home-section3 .owl-carousel").owlCarousel({
				loop:true,
				margin:20,
				nav:false,
				pagination:false,
				responsive:{
					0:{
						items:1.3
					},
					600:{
						items:1.3
					},
					1000:{
						items:1.3
					}
				}
			});
			$(".home-section4 .owl-carousel").owlCarousel({
				loop:true,
				margin:20,
				nav:false,
				pagination:false,
				responsive:{
					0:{
						items:1.3
					},
					600:{
						items:1.3
					},
					1000:{
						items:1.3
					}
				}
			});
			$(".about-section2 .owl-carousel").owlCarousel({
				loop:true,
				margin:20,
				nav:false,
				pagination:false,
				responsive:{
					0:{
						items:1.3
					},
					600:{
						items:1.3
					},
					1000:{
						items:1.3
					}
				}
			});
		}
	});

	//  Find the initial scroll top when the page is loaded.
		var initScrollTop = $(window).scrollTop();
  
	//  Set the image's vertical background position based on the scroll top when the page is loaded.
	    $("parallax1").css({'background-position-y' : (initScrollTop/75)+'%'});
  
	//  When the user scrolls...
	$(window).scroll(function() {
		// Find the new scroll top.
		var scrollTop = $(window).scrollTop();
    
		// Set the new background position.
		$("parallax1").css({'background-position-y' : (scrollTop/75)+'%'});
	});
});



function reveal() {
  var reveals = document.querySelectorAll(".reveal");

  for (var i = 0; i < reveals.length; i++) {
    var windowHeight = window.innerHeight;
    var elementTop = reveals[i].getBoundingClientRect().top;
    var elementVisible = 150;

    if (elementTop < windowHeight - elementVisible) {
      reveals[i].classList.add("active");
    } else {
      reveals[i].classList.remove("active");
    }
  }
}

window.addEventListener("scroll", reveal);