jQuery(document).ready(function($) {

	$('.topbar_in li:last').addClass('last');
	$('.nav > li').mouseenter(function(){
		$(this).children('ul').stop(true,true).animate({height:'show'})
	})
	$('.nav > li').mouseleave(function(){
		$(this).children('ul').stop(true,true).animate({height:'hide'})
	})
	$('.menu-item').mouseenter(function(){
		$(this).children('ul').stop(true,true).animate({height:'show'})
	})
	$('.menu-item').mouseleave(function(){
		$(this).children('ul').stop(true,true).animate({height:'hide'})
	})
	$('.extend-offer').mouseenter(function(){
		$(this).animate({opacity:'0.7'})
	})
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
		next:    '#before-after-next'
	});


});