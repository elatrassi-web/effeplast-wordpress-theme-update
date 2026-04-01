/**
 * Effe Plast - Custom Quote System (Local Storage based)
 */

const QuoteSystem = {
    cartKey: 'ep_quote_cart',

    // Get current cart from local storage
    getCart: function() {
        let cart = localStorage.getItem(this.cartKey);
        return cart ? JSON.parse(cart) : [];
    },

    // Save cart to local storage
    saveCart: function(cart) {
        localStorage.setItem(this.cartKey, JSON.stringify(cart));
        this.updateCartUI();
    },

    // Add item to cart
    addItem: function(id, name, image, quantity = 1) {
        let cart = this.getCart();
        let existingItemIndex = cart.findIndex(item => item.id === id);

        if (existingItemIndex > -1) {
            cart[existingItemIndex].quantity += parseInt(quantity, 10);
        } else {
            cart.push({
                id: id,
                name: name,
                image: image,
                quantity: parseInt(quantity, 10)
            });
        }

        this.saveCart(cart);
        return true;
    },

    // Remove item from cart
    removeItem: function(id) {
        let cart = this.getCart();
        cart = cart.filter(item => item.id !== id);
        this.saveCart(cart);
    },

    // Update quantity
    updateQuantity: function(id, quantity) {
        let cart = this.getCart();
        let existingItemIndex = cart.findIndex(item => item.id === id);

        if (existingItemIndex > -1) {
            if (quantity > 0) {
                cart[existingItemIndex].quantity = parseInt(quantity, 10);
            } else {
                this.removeItem(id);
                return;
            }
        }
        this.saveCart(cart);
    },

    // Clear cart
    clearCart: function() {
        localStorage.removeItem(this.cartKey);
        this.updateCartUI();
    },

    // Check if item is in cart
    isInCart: function(id) {
        let cart = this.getCart();
        return cart.some(item => item.id === id);
    },

    // Update UI elements (buttons, counters) based on cart state
    updateCartUI: function() {
        let cart = this.getCart();
        let totalItems = cart.length;

        // Update header badges if any
        let badges = document.querySelectorAll('.ep-quote-count');
        badges.forEach(badge => {
            badge.innerText = totalItems;
            if(totalItems > 0) {
                badge.classList.remove('hidden');
            } else {
                badge.classList.add('hidden');
            }
        });

        // Update add-to-quote buttons state
        let addButtons = document.querySelectorAll('.ep-add-to-quote-btn');
        addButtons.forEach(btn => {
            let productId = btn.getAttribute('data-product-id');

            // Check if it's a slider button (which has a slightly different layout, rounded pills)
            let isSliderBtn = btn.classList.contains('whitespace-nowrap');

            if (this.isInCart(productId)) {
                btn.classList.add('bg-gray-600', 'hover:bg-gray-500', 'cursor-not-allowed');
                btn.classList.remove('bg-[#1762A4]', 'hover:bg-ep-cyan', 'bg-ep-blue-night');

                if (isSliderBtn) {
                    btn.innerHTML = '<i class="fas fa-check"></i> <span class="btn-text">Déjà ajouté</span>';
                } else {
                    btn.innerHTML = 'Déjà ajouté';
                }

                btn.setAttribute('disabled', 'disabled');

                // Show "Voir la liste" link if it exists next to it (specifically for page-devis table)
                let viewLinkContainer = btn.parentElement.nextElementSibling;
                if(viewLinkContainer && viewLinkContainer.classList.contains('ep-view-list-container')) {
                    viewLinkContainer.innerHTML = '<a href="/panier-devis" class="text-sm text-gray-300 hover:text-white underline underline-offset-2">Voir la liste</a>';
                }
            } else {
                btn.classList.remove('bg-gray-600', 'hover:bg-gray-500', 'cursor-not-allowed');
                // Use default color based on btn type
                if (isSliderBtn) {
                    btn.classList.add('bg-ep-blue-night', 'hover:bg-ep-cyan');
                    btn.innerHTML = '<i class="fas fa-plus"></i> <span class="btn-text">Au devis</span>';
                } else {
                    btn.classList.add('bg-[#1762A4]', 'hover:bg-ep-cyan');
                    btn.innerHTML = 'Ajouter au devis';
                }

                btn.removeAttribute('disabled');

                let viewLinkContainer = btn.parentElement.nextElementSibling;
                if(viewLinkContainer && viewLinkContainer.classList.contains('ep-view-list-container')) {
                    viewLinkContainer.innerHTML = '';
                }
            }
        });
    },

    // Initialize event listeners
    init: function() {
        const self = this;

        // Initial UI update
        this.updateCartUI();

        // Single add button click
        document.addEventListener('click', function(e) {
            // Check if clicking on the add button or inside it
            let btn = e.target.closest('.ep-add-to-quote-btn');
            if (btn && !btn.hasAttribute('disabled')) {
                e.preventDefault();
                let productId = btn.getAttribute('data-product-id');
                let productName = btn.getAttribute('data-product-name');
                let productImage = btn.getAttribute('data-product-image');

                // Find quantity input if exists near the button
                let row = btn.closest('tr') || btn.closest('.product-card');
                let qtyInput = row ? row.querySelector('.ep-qty-input') : null;
                let quantity = qtyInput ? qtyInput.value : 1;

                self.addItem(productId, productName, productImage, quantity);

                // Show a small toast/notification
                self.showNotification('Produit ajouté au devis !');
            }
        });

        // Custom event for updating quantities
        document.addEventListener('change', function(e) {
            if(e.target.classList.contains('ep-qty-input') && e.target.closest('.ep-cart-row')) {
                let row = e.target.closest('.ep-cart-row');
                let productId = row.getAttribute('data-product-id');
                self.updateQuantity(productId, e.target.value);
            }
        });
    },

    showNotification: function(message) {
        let toast = document.createElement('div');
        toast.className = 'fixed bottom-4 right-4 bg-ep-cyan text-white px-6 py-3 rounded-xl shadow-lg transform transition-all duration-300 translate-y-0 opacity-100 z-50';
        toast.innerHTML = '<i class="fas fa-check-circle mr-2"></i> ' + message;
        document.body.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('translate-y-4', 'opacity-0');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
};

document.addEventListener('DOMContentLoaded', function() {
    QuoteSystem.init();
});
