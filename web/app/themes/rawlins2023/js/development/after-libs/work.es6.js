
import { HoverSlider } from './splide-extension-hover-slider.js';
const { AutoScroll } = window.splide.Extensions;

var elms = document.getElementsByClassName( 'splide' );

for ( var i = 0; i < elms.length; i++ ) {
    const currentItem = elms[i];
    const splide = new Splide( elms[ i ], {
        type   : 'loop',
        drag   : 'free',
        snap: true,
        perPage: 6,
        autoWidth: true,
        height: '387px',
        waitForTransition: true,
        pagination: false,
        cloneStatus: false,
        slideFocus: false,
        pauseOnHover: false,
        omitEnd: true,
        live: false,
        updateOnMove: false,
        focus: false,
        pauseOnFocus: false,
        lazyLoad: false,
        autoScroll: {
            speed: .5,
            pauseOnHover: false,
            autoStart: false,
        },
        // mediaQuery: 'min',
        breakpoints: {
            980: {
                height: '243px',
                perPage: 4,
            },

            768: {
                perPage: 1
            }
        }
    });

    splide.on( 'drag', function () {
        $('.work__item__images').addClass('dragging');
        $('.work__item__image').removeClass('hover');
    } );

    splide.on( 'dragged', function () {
        $('.work__item__images').removeClass('dragging');
    } );
    

    if(isInViewport(currentItem)){
        splide_init(splide);
    }

    $(window).on('scroll', function(){
        if ( splide.state.is( Splide.STATES.IDLE ) ) {
            return;
        }
        if(isInViewport(currentItem)){
            splide_init(splide);
        }
    })

    $(window).on('resize', function(){
        splide.destroy();
        splide_init(splide);
    })


    function splide_init(splide) {
        if (window.innerWidth >= 980) {
            splide.mount({
                AutoScroll,
                HoverSlider
            });
        } else {
            splide.mount({
                HoverSlider
            });
        }
    }

    document.querySelectorAll('.work__item__image').forEach(function(item, idx) {
        item.addEventListener('mouseenter', function() {
            this.classList.add('hover');
        });
        item.addEventListener('mouseleave', function() {
            this.classList.remove('hover');
        });
    });
}

$(window).on('load', function(){

    // Check if the user has visited the site before
    if (getCookie('firstVisit') !== 'true' && !$('.coming-soon').length) {
        // Set a cookie to indicate that the user has visited the site
        setCookie('firstVisit', 'true', 2); // Cookie expires in 1 year
        
        if($('.icon-loading').length) {
            $('.icon-loading img').fadeOut(300);
            $('body').removeClass('loading');
        }
    }
    
    
    aspectRatios();

    $(document).on('click', '.work__item__video__volume-up',function(){
        const video = $(this).prev('video');
        $(this).removeClass('active');
        video[0].muted = !video[0].muted;
        $(this).next().addClass('active');
    })

    $(document).on('click', '.work__item__video__volume-down',function(){
        const video = $(this).prev().prev('video');
        console.log(video);
        $(this).removeClass('active');
        video[0].muted = !video[0].muted;
        $(this).prev().addClass('active');
    })

    // Work Flyout
    document.querySelectorAll('.work__item__link--more-info a').forEach(function(item, idx) {
        item.addEventListener('click', function(e) {
            const flyoutID = this.hash;
            if(flyoutID) {
                e.preventDefault();
                closeWorkFlyout()
                document.body.classList.add('flyout-active');
                document.querySelector(flyoutID).classList.add('work__flyout--active');
            }
        })
    });

    document.querySelectorAll('.work__flyout__close').forEach(function(closeButton, idx){
        closeButton.addEventListener('click', closeWorkFlyout);
    })

});


function isInViewport(element) {
    var elementTop = $(element).offset().top;
    var elementBottom = elementTop + $(element).outerHeight();
    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();
  
    return elementBottom > viewportTop && elementTop < viewportBottom;
  }


function closeWorkFlyout() {
    document.body.classList.remove('flyout-active');
    document.querySelectorAll('.work__flyout').forEach(function(workFlyout, idx) {
        workFlyout.classList.remove('work__flyout--active');
    })
}

function aspectRatios() {
    const videos = document.querySelectorAll('.work__item__video video');

    videos.forEach(function(e){
        let videoWidth = e.videoWidth;
        let videoHeight = e.videoHeight;

        e.parentElement.style.aspectRatio = videoWidth +'/'+ videoHeight;
    })
}

function setCookie(name, value, days) {
    const expires = new Date();
    expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
    document.cookie = `${name}=${value};expires=${expires.toUTCString()};path=/`;
  }
  
  function getCookie(name) {
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
      const cookie = cookies[i].trim();
      if (cookie.startsWith(name + '=')) {
        return decodeURIComponent(cookie.substring(name.length + 1));
      }
    }
    return null;
  }