function ngLouisville() {
    var handleScroll = function() {
        var scrollTop = $(window).scrollTop();
        var mainOffset = $('#main').offset().top;
        if(scrollTop > mainOffset+280) {
        	$('#maincaptionfixed:hidden').css({'top':'-100px'}).show().animate({'top':'0'}, 250);
        } else {
            if(scrollTop <= mainOffset) {
            	$('#maincaptionfixed').hide();
            }
        }
        
        var navigationOffset=$('#navigationcontainer').offset().top;

        if(scrollTop > navigationOffset-40) {
        	$('#navigation').css({
        		'position' : 'fixed',
        		'top' : '40px'
        	});
        } else {
        	$('#navigation').css({
        		'position' : 'relative',
        		'top' : ''
        	});
        }
    };
    
    if (navigator.userAgent.match(/iPad/i) == null) {
    	$(window).scroll(handleScroll);
    	handleScroll();
    }
}



$(document).ready(ngLouisville);