/**
 * Effe Plast - Interactive Product Swiper (Coverflow)
 */

document.addEventListener('DOMContentLoaded', function() {

    // Initialize Swiper with Coverflow effect
    let productSwiper = new Swiper('.ep-product-swiper', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 'auto',
        loop: false, // Don't loop initially until we have dynamic data loaded properly
        speed: 800,
        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 2.5,
            slideShadows: false,
        },
        keyboard: {
            enabled: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            320: {
                coverflowEffect: { modifier: 1.5, depth: 50 }
            },
            768: {
                coverflowEffect: { modifier: 2, depth: 100 }
            },
            1024: {
                coverflowEffect: { modifier: 2.5, depth: 150 }
            }
        }
    });

    // Elements
    const wrapper = document.getElementById('ep-slider-wrapper');
    const catButtons = document.querySelectorAll('.ep-cat-btn');
    const searchInput = document.getElementById('ep-slider-search');
    const loader = document.getElementById('ep-slider-loader');

    let currentCategory = 'all';
    let currentSearch = '';
    let searchTimeout = null;

    // Function to fetch products via AJAX
    function fetchProducts() {
        // Show loader
        loader.classList.remove('hidden');
        wrapper.style.opacity = '0.5';

        const data = new FormData();
        data.append('action', 'ep_fetch_slider_products');
        data.append('category', currentCategory);
        data.append('search', currentSearch);

        fetch(ep_ajax_obj.ajaxurl, {
            method: 'POST',
            body: data
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Update slides HTML
                wrapper.innerHTML = data.data.html;

                // Re-initialize or update swiper
                productSwiper.update();
                productSwiper.slideTo(0, 0); // go to first slide instantly

                // Re-sync with quote system to update button states ("Déjà ajouté")
                if(typeof QuoteSystem !== 'undefined') {
                    QuoteSystem.updateCartUI();
                }
            }
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            wrapper.innerHTML = '<div class="text-white text-center w-full py-20">Une erreur est survenue. Veuillez réessayer.</div>';
        })
        .finally(() => {
            // Hide loader
            loader.classList.add('hidden');
            wrapper.style.opacity = '1';
        });
    }

    // Category click listeners
    catButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            // Reset active states
            catButtons.forEach(b => {
                b.classList.remove('bg-ep-cyan', 'text-white', 'shadow-[0_0_15px_rgba(0,180,216,0.5)]', 'border-ep-cyan', 'scale-105');
                b.classList.add('bg-transparent', 'text-gray-300', 'border-white/20');
            });

            // Set active state on clicked
            this.classList.remove('bg-transparent', 'text-gray-300', 'border-white/20');
            this.classList.add('bg-ep-cyan', 'text-white', 'shadow-[0_0_15px_rgba(0,180,216,0.5)]', 'border-ep-cyan', 'scale-105');

            currentCategory = this.getAttribute('data-cat');
            fetchProducts();
        });
    });

    // Search listener with debounce
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            currentSearch = this.value.trim();

            // Debounce for 500ms
            searchTimeout = setTimeout(() => {
                fetchProducts();
            }, 500);
        });
    }

    // Initial fetch on load
    fetchProducts();
});
