/**
 * Testimonial Carousel
 * 
 * Initialize Swiper carousel for testimonials
 */

(function($) {
    'use strict';
    
    /**
     * Initialize testimonial carousel
     */
    function initTestimonialCarousel() {
        // Check if carousel exists on page
        if (!$('.testimonial-swiper').length) {
            console.log('No testimonial carousel found on page');
            return;
        }
        
        // Wait for Swiper to be available
        if (typeof Swiper === 'undefined') {
            console.log('Waiting for Swiper to load...');
            setTimeout(initTestimonialCarousel, 100);
            return;
        }
        
        console.log('Initializing testimonial carousel...');
        
        // Initialize Swiper
        const testimonialSwiper = new Swiper('.testimonial-swiper', {
            // Show only 1 slide at a time
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            
            // Autoplay
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            
            // Pagination
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
                dynamicBullets: true,
            },
            
            // Navigation arrows
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
            
            // Keyboard control
            keyboard: {
                enabled: true,
                onlyInViewport: true,
            },
            
            // Smooth transitions
            speed: 600,
            effect: 'slide',
            
            // Accessibility
            a11y: {
                enabled: true,
                prevSlideMessage: 'Previous testimonial',
                nextSlideMessage: 'Next testimonial',
            }
        });
        
        console.log('Testimonial carousel initialized successfully!');
    }
    
    /**
     * Initialize on DOM ready
     */
    $(document).ready(function() {
        initTestimonialCarousel();
    });
    
    /**
     * Also try on window load (backup)
     */
    $(window).on('load', function() {
        if (!$('.testimonial-swiper').hasClass('swiper-initialized')) {
            initTestimonialCarousel();
        }
    });
    
})(jQuery);