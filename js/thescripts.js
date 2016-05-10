jQuery(document).ready(function($) {

	$('.topbar_in li:last').addClass('last');
    if ( isMobile() == true ) {
		$('.nav .menu-item,.nav > li').mouseenter(function(){
            $(this).children('ul').stop(true,true).animate({height:'show'});
        });
		$('.nav .menu-item').mouseleave(function () {
			if($(this).children('ul').is(':visible')){
				$(this).children('ul').stop(true, true).animate({height: 'hide'});
			}else{				
				$(this).children('ul').stop(true, true).animate({height: 'show'});
			}
        });
    }
    else {
        $('.menu-item,.nav > li').mouseenter(function () {
            $(this).children('ul').stop(true, true).animate({height: 'show'});
        });
        $('.menu-item,.nav > li').mouseleave(function () {
            $(this).children('ul').stop(true, true).animate({height: 'hide'});
        });       
    }
	$('.extend-offer').mouseenter(function(){
		$(this).animate({opacity:'0.7'});
	});
	$('.extend-offer').mouseleave(function(){
		$(this).animate({opacity:'1'})
	});


	$(".various").fancybox({
		maxWidth	: 800,
		maxHeight	: 600,
		fitToView	: false,
		width		: '70%',
		height		: '70%',
		autoSize	: true,
		closeClick	: false,
		openEffect	: 'elastic',
		closeEffect	: 'elastic',
	});

	$("#cycle").cycle({
		timeout: 0,
		fx:      'scrollHorz',
		prev:    '#prev',
        next:    '#next'
	});

	$( "#cycle" ).click(function() {
	   $(this).cycle("pause");
	});
	
	$( "#testimonial-nav span" ).click(function() {
	   $("#cycle").cycle("resume");
	});
    $("#before-after-cycle").cycle({
        fx:      'scrollHorz',
        slideExpr: 'img',
        fit:           1,
        prev:    '#before-after-prev',
        next:    '#before-after-next',
        after: function (){
            $(this).parent().css("height", $(this).height());
        }
    });

 	$("#office-images-cycle").cycle({
		fx:      'scrollHorz',
		slideExpr: 'img',
		fit:           1,
		prev:    '#office-images-prev',
		next:    '#office-images-next',
		after: function (){
            $(this).parent().css("height", $(this).height());
        }
	});
	
});

window.addEventListener("touchstart", function(ev){
	if(jQuery('.nav').is(":visible")  && ev.target.nodeName !="H3" && ev.target.innerText != "MENU" ){
		setTimeout(function(){ console.log('show'); jQuery('.nav').show(); }, 900);
	}
});

function isMobile() {
	if (navigator.userAgent.match(/Android/i) ||
        navigator.userAgent.match(/webOS/i) ||
        navigator.userAgent.match(/iPhone/i) ||
        navigator.userAgent.match(/iPad/i) ||
        navigator.userAgent.match(/iPod/i) ||
        navigator.userAgent.match(/BlackBerry/) ||
        navigator.userAgent.match(/Windows Phone/i) ||
        navigator.userAgent.match(/ZuneWP7/i)
		){
			return true;
	} else { 
	 return false;
	}
}
