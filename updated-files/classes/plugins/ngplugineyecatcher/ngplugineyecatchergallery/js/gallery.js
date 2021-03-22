$(document).ready(function() {
	var eyecatcher = $('#eyecatcher>div')
	var stagecontainer = $('#eyecatcher ul');
	var items = $('#eyecatcher li');
	var effect = $('#eyecatcher>div').attr('data-changeeffect');
	var delay = parseInt(eyecatcher.attr('data-autochangedelay'));
	var width = parseInt(eyecatcher.css('width').replace('px',''));
	var bullets = $('#eyecatcherbullets>div');
	var next = $('#eyecatchernext');
	var prev = $('#eyecatcherprev');
	var offset = 0;
	var current = 0;
	var timer = null;

	if (effect=='Slide') {
		items.each(function(i) {
			$(this).css('left',i*width+'px');
		});
	} else {
		items.css({'z-index':0,'display':'none'}).eq(0).css({'display':'block','z-index':1} );
	}

	function setOffset()
	{
		if (offset!=current) {
			if (effect=='Slide') {
				stagecontainer.css('left',-offset*width+'px');
			} else {
				items.css({'z-index':0,'display':'none'});
				items.eq(current).css({'display':'block'});
				items.eq(offset).css({'z-index':1}).fadeIn(500);
			}
			current=offset;
		}
		next.css('display', offset<items.length-1?'block':'none');
		prev.css('display', offset>0?'block':'none');
		bullets.removeClass('selected').eq(offset).addClass('selected');
	}
	
	function gotoNext()
	{
		offset++;
		if (offset>items.length-1) offset=items.length-1;
		setOffset();		
	}
	
	function gotoNextOverlap()
	{
		offset++;
		if (offset>items.length-1) offset=0;
		setOffset();		
	}

	
	function gotoPrev() 
	{
		offset--;
		if (offset<0) offset=0;
		setOffset();		
	}
	
	function start() {
		if (delay>0 && timer===null) {
			timer=window.setInterval(gotoNextOverlap, delay*1000);
		}
	}
	
	function stop() {
		if (delay>0 && timer!==null) {
			window.clearInterval(timer);
			timer=null;
		}
	}

	setOffset();

	$(window).load(function() {
		next.on('click',gotoNext);
		prev.on('click',gotoPrev);

		bullets.on('click',function() {
			offset = bullets.index(this);
			setOffset();
		});
		
		if (delay>0) {
			eyecatcher.hover(stop,start);
			start();
		}
	});
});