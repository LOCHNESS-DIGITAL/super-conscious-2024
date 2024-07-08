
import { HoverSlider } from './splide-extension-hover-slider.js';
const { AutoScroll } = window.splide.Extensions;
$(window).on('load', function(){

    $('body').removeClass('loading');

    var elms = document.getElementsByClassName( 'splide' );

    for ( var i = 0; i < elms.length; i++ ) {
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
            lazyLoad: true,
            autoScroll: {
                speed: .5,
                pauseOnHover: false,
                autoStart: false,
            },
            // mediaQuery: 'min',
            breakpoints: {
                980: {
                    height: '253px',
                    perPage: 4,
                },
            }
        });

        splide_init(splide);

        splide.on( 'drag', function () {
            $('.work__item__images').addClass('dragging');
            $('.work__item__image').removeClass('hover');
        } );

        splide.on( 'dragged', function () {
            $('.work__item__images').removeClass('dragging');
        } );

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

    // Work Flyout
    document.querySelectorAll('.work__item__link--more-info a').forEach(function(item, idx) {
        item.addEventListener('click', function(e) {
            const flyoutID = this.hash;
            e.preventDefault();
            closeWorkFlyout()
            document.body.classList.add('flyout-active');
            document.querySelector(flyoutID).classList.add('work__flyout--active');
        })
    });

    document.querySelectorAll('.work__flyout__close').forEach(function(closeButton, idx){
        closeButton.addEventListener('click', closeWorkFlyout);
    })    
    
});


function closeWorkFlyout() {
    document.body.classList.remove('flyout-active');
    document.querySelectorAll('.work__flyout').forEach(function(workFlyout, idx) {
        workFlyout.classList.remove('work__flyout--active');
    })
}