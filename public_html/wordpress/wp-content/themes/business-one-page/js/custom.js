jQuery(document).ready(function($) {
    
    /** Variables from Customizer for Slider settings */
    if( business_one_page_data.auto == '1' ){
        var slider_auto = true;
    }else{
        slider_auto = false;
    }
    
    if( business_one_page_data.loop == '1' ){
        var slider_loop = true;
    }else{
        var slider_loop = false;
    }
    
    if( business_one_page_data.pager == '1' ){
        var slider_control = true;
    }else{
        slider_control = false;
    }
    
    /** Home Page Slider */
    $('.banner .flexslider').flexslider({
        slideshow: slider_auto,
        animationLoop : slider_loop,
        directionNav: false,
        animation: business_one_page_data.animation,
        controlNav: slider_control,
        slideshowSpeed: business_one_page_data.speed,
        animationSpeed: business_one_page_data.a_speed
    });
    
    $("#lightSlider").lightSlider({
        slideMargin: 30,
        pager: false,      
        enableDrag:false,      
        responsive : [
        	{
                breakpoint:768,
                settings: {
                    item:1,
                    slideMove:1,
                    slideMargin:0,
                  }
            }
        ],
    });
    
    /* for flexslider */
	$('.testimonial-slider .flexslider').flexslider({
	    animation: "slide"
	});
    
    //scrollup javascript
    $('.scrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 800);
        return false;
    });
    
    // grab an element
	var myElement = document.querySelector("header");
	// construct an instance of Headroom, passing the element
	var headroom  = new Headroom(myElement);
	// initialise
	headroom.init();
    
	$('#site-navigation').onePageNav({
        currentClass: 'current-menu-item',
        changeHash: false,
        scrollSpeed: 1500,
        scrollThreshold: 0.5,
        filter: '',
        easing: 'swing',        
    });
    
     //responsive menu
     $("#nav-anchor").click(function(){
		$("#site-navigation").slideToggle("slow");
	});
    
    /** Masonry */
    $('.js-masonry').imagesLoaded(function(){ 
        $('.js-masonry').masonry({
            itemSelector: '.portfolio-col'
        }); 
    });
    
    //same height js
    // these are (ruh-roh) globals. You could wrap in an
        // immediately-Invoked Function Expression (IIFE) if you wanted to...
        var currentTallest = 0,
            currentRowStart = 0,
            rowDivs = new Array();

        function setConformingHeight(el, newHeight) {
            // set the height to something new, but remember the original height in case things change
            el.data("originalHeight", (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight")));
            el.height(newHeight);
        }

        function getOriginalHeight(el) {
            // if the height has changed, send the originalHeight
            return (el.data("originalHeight") == undefined) ? (el.height()) : (el.data("originalHeight"));
        }

        function columnConform() {

            // find the tallest DIV in the row, and set the heights of all of the DIVs to match it.
            $('.three-cols > .row > .col').each(function() {

                // "caching"
                var $el = $(this);

                var topPosition = $el.position().top;

                if (currentRowStart != topPosition) {

                    // we just came to a new row.  Set all the heights on the completed row
                    for(currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);

                    // set the variables for the new row
                    rowDivs.length = 0; // empty the array
                    currentRowStart = topPosition;
                    currentTallest = getOriginalHeight($el);
                    rowDivs.push($el);

                } else {

                    // another div on the current row.  Add it to the list and check if it's taller
                    rowDivs.push($el);
                    currentTallest = (currentTallest < getOriginalHeight($el)) ? (getOriginalHeight($el)) : (currentTallest);

                }
                // do the last row
                for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) setConformingHeight(rowDivs[currentDiv], currentTallest);

            });

        }
        
        columnConform();
        
        $(window).resize(function() {
            columnConform();
        });
        
});