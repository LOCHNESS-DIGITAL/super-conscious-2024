export function HoverSlider( Splide, Components, options ) {
    /**
     * Optional. Called when the component is mounted.
     */
    function mount() {
        
        $(Splide.root).attr('data-slide-count', Splide.length);
        
        Splide.Components.Slides.forEach(function(slides){
            var currentSlideNumber = slides.slideIndex + 1;
            $(slides.slide).attr('data-slide-num', currentSlideNumber);
        })

        if(window.innerWidth >= 980) {
            Splide.root.addEventListener("mouseenter", function(){
                Components.AutoScroll.play();
            });

            Splide.root.addEventListener("mouseleave", function(){
                Components.AutoScroll.pause();
            });
        }
        
    }

    return {
        mount
    };
}