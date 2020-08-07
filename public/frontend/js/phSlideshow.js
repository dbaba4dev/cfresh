/* 
	Copyright 2017 Scott Lucht <phphq.Net>
	Simple jQuery Slideshow Function
*/

var phSlideShow=function(){

	var slideTimer;
	var slideImages;
	var slideSpeed;
	var slideCaptions;
	var slideControls;

	this.slideshowInit=function(el, speed, controls, captions) {

		slideImages=$(el);
		slideImages.find('img:gt(0)').hide();

		slideSpeed = speed || 5000;   
		slideCaptions = captions || false;
		slideControls = controls || false;

		phSlideShow.slideshowSetCaption($(el).find('img:first').attr('title'));

		phSlideShow.slideshowStart();

		$('.slideshow-prev').click(function() {
			 phSlideShow.slideshowPrevious();
		});

		$('.slideshow-next').click(function() {
			 phSlideShow.slideshowNext();
		});

		$('.slideshow-pause, .slideshow-next, .slideshow-prev').click(function() {
			$('.slideshow-pause').hide();
			$('.slideshow-resume').show();
			phSlideShow.slideshowPause();
		});

		$('.slideshow-resume').click(function() {
			$('.slideshow-resume').hide();
			$('.slideshow-pause').show();
			phSlideShow.slideshowResume();
		});

		$('.slideshow').hover(
			function() {

				if(slideCaptions) {
					$('.slideshow-caption').show();
				}

				if(slideControls) {
					$('.slideshow-prev, .slideshow-next, .slideshow-controls').show();
				}

			}, function() {

				$('.slideshow-prev, .slideshow-next, .slideshow-controls, .slideshow-caption').hide();

			}

		);

	}

	this.slideshowStart=function() {

		clearInterval(slideTimer);

		slideTimer=setInterval(function(){

			phSlideShow.slideshowAdvance(1);

		}, slideSpeed);

	}

	this.slideshowAdvance=function(count) {
		var currentImg=slideImages.find('img:visible');
		var imageList=slideImages.find('img');
		var nextImg=imageList.eq((imageList.index(currentImg)+count) % imageList.length);

		if(nextImg.length==0) {
			nextImg=slideImages.find('img:eq(0)');
		}

		currentImg.fadeOut(200, function(){
			phSlideShow.slideshowSetCaption($(nextImg).attr('title'));
			nextImg.fadeIn(800);

		});

	}

	this.slideshowSetCaption=function(caption) {
		caption = caption || '';
		caption=caption.replace(/\[url=([^\s\]]+)\s*\](.*(?=\[\/url\]))\[\/url\]/g, '<a href="$1">$2</a>');

		$('.slideshow-caption').html('<div style="padding:5px;">'+caption+'</div>');

		if(caption) {

			$('.slideshow-caption').css({minHeight:'50px'});

		} else {

			$('.slideshow-caption').css({minHeight:'0px'});
			$('.slideshow-caption').css({height:'0px'});

		}

	}

	this.slideshowPause=function(){
		clearInterval(slideTimer);
	}

	this.slideshowResume=function(){
		phSlideShow.slideshowStart();
	}

	this.slideshowNext=function(){
		phSlideShow.slideshowAdvance(1);
		phSlideShow.slideshowPause();
	}

	this.slideshowPrevious=function(){
		phSlideShow.slideshowAdvance(-1);
		phSlideShow.slideshowPause();
	}

	return this;
}();