$(document).ready(function(){       
	var scroll_start = 0;
	var startchange = $('#startchange');
	var offset = startchange.offset();
	  $(document).scroll(function() { 
	   scroll_start = $(this).scrollTop();
	   if(scroll_start > offset.top) {
		 $(".navbar").addClass("navbar-default");
		 $(".navbar").removeClass("pt-5");
	   } else {
		 $('.navbar').removeClass("navbar-default");
	   }
	 });
   });


// Open Weather ============================================


var timer = 4000;

var i = 0;
var max = $('#c > li').length;

 
	$("#c > li").eq(i).addClass('active').css('left','0');
	$("#c > li").eq(i + 1).addClass('active').css('left','25%');
	$("#c > li").eq(i + 2).addClass('active').css('left','50%');
	$("#c > li").eq(i + 3).addClass('active').css('left','75%');
 

	setInterval(function(){ 

		$("#c > li").removeClass('active');

		$("#c > li").eq(i).css('transition-delay','0.25s');
		$("#c > li").eq(i + 1).css('transition-delay','0.5s');
		$("#c > li").eq(i + 2).css('transition-delay','0.75s');
		$("#c > li").eq(i + 3).css('transition-delay','1s');

		if (i < max-4) {

			i = i+4; 
			if (i>4) {
			i = 0; 
			}
		}

		else { 
			i = 0; 
		}  

		$("#c > li").eq(i).css('left','0').addClass('active').css('transition-delay','1.25s');
		$("#c > li").eq(i + 1).css('left','25%').addClass('active').css('transition-delay','1.5s');
		$("#c > li").eq(i + 2).css('left','50%').addClass('active').css('transition-delay','1.75s');
		$("#c > li").eq(i + 3).css('left','75%').addClass('active').css('transition-delay','2s');
	
	}, timer);
 

// =========================== TIMELINE ========================================




	(function() {
			 
		'use strict';

		// define variables
		var timelines= document.querySelectorAll('.timeline2');
		 
		  function debounce(func, wait, immediate) {
			  var timeout;
			  return function() {
				  var context = this, args = arguments;
				  var later = function() {
					  timeout = null;
					  if (!immediate) func.apply(context, args);
				  };
				  var callNow = immediate && !timeout;
				  clearTimeout(timeout);
				  timeout = setTimeout(later, wait);
				  if (callNow) func.apply(context, args);
			  };
		  }
		  function callbackFunc() {
				var h,timeline, li,rect,parent_rect,i,items;
			  for(h=0;h<timelines.length;h++){
					timeline=timelines[h];
					  parent_rect=timeline.getBoundingClientRect();
					 items = timeline.querySelectorAll(".timeline2 li");
				  for (  i = 0; i < items.length; i++) {
					  /*
					if (isElementInViewport(items[i])) {
					  items[i].classList.add("in-view");				   
					}
					*/
					  li=items[i];
					  rect = li.getBoundingClientRect();  
					   
					  if( (rect.bottom<=(parent_rect.top+(rect.height/2) ) ) || (rect.top >=(parent_rect.bottom-(rect.height/2)) ) ){
						  //debugger;
						  //li.style['background']='red';
						  li.classList.remove("in-view");
						  
					  }else{
						  //li.style['background']='white';
						  li.classList.add("in-view");
					  }
					   
				  }
			  }
		  }
		  var updateLayout =debounce(function(e) {

			  // Does all the layout updating here
			  callbackFunc();
			  
		  }, 500); // Maximum run of once per 500 milliseconds

		  // listen for events
		  window.addEventListener("load", callbackFunc);
		  window.addEventListener("resize", updateLayout);
		  window.addEventListener("scroll", callbackFunc);
		  for(var h=0;h<timelines.length;h++){
				  var  timeline=timelines[h];
			  timeline.addEventListener("scroll",callbackFunc );
		  }
		  
	   })();

// ===============================================================================================
//  bouton footer remonter en haut

jQuery(function(){
	$(function () {
		$(window).scroll(function () {
			if ($(this).scrollTop() > 200 ) { 
				$('#scrollUp').css('right','10px');
			} else { 
				$('#scrollUp').removeAttr( 'style' );
			}

		});
	});
});

		  