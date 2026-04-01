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
            // Check if it's in the devis table (allows removal)
            let isTableBtn = btn.closest('tr') && !isSliderBtn;

            if (this.isInCart(productId)) {
                btn.classList.add('bg-red-600', 'hover:bg-red-500'); // Changed from disabled gray to active red for removal
                btn.classList.remove('bg-[#1762A4]', 'hover:bg-ep-cyan', 'bg-ep-blue-night');

                if (isSliderBtn) {
                    btn.innerHTML = '<i class="fas fa-check"></i> <span class="btn-text">Déjà ajouté</span>';
                    btn.setAttribute('disabled', 'disabled'); // Slider buttons remain disabled
                    btn.classList.add('cursor-not-allowed', 'bg-gray-600', 'hover:bg-gray-500');
                    btn.classList.remove('bg-red-600', 'hover:bg-red-500');
                } else if (isTableBtn) {
                    btn.innerHTML = '<i class="fas fa-trash-alt mr-2"></i> Retirer';
                    btn.removeAttribute('disabled');
                    btn.setAttribute('data-action', 'remove');
                }

                // Show "Voir la liste" link if it exists next to it (specifically for page-devis table)
                let viewLinkContainer = btn.parentElement.nextElementSibling;
                if(viewLinkContainer && viewLinkContainer.classList.contains('ep-view-list-container')) {
                    viewLinkContainer.innerHTML = '<a href="/panier-devis" class="text-sm text-gray-300 hover:text-white underline underline-offset-2">Voir la liste</a>';
                }
            } else {
                btn.classList.remove('bg-red-600', 'hover:bg-red-500', 'cursor-not-allowed', 'bg-gray-600', 'hover:bg-gray-500');
                // Use default color based on btn type
                if (isSliderBtn) {
                    btn.classList.add('bg-ep-blue-night', 'hover:bg-ep-cyan');
                    btn.innerHTML = '<i class="fas fa-plus"></i> <span class="btn-text">Au devis</span>';
                } else {
                    btn.classList.add('bg-[#1762A4]', 'hover:bg-ep-cyan');
                    btn.innerHTML = 'Ajouter au devis';
                }

                btn.removeAttribute('disabled');
                btn.removeAttribute('data-action');

                let viewLinkContainer = btn.parentElement.nextElementSibling;
                if(viewLinkContainer && viewLinkContainer.classList.contains('ep-view-list-container')) {
                    viewLinkContainer.innerHTML = '';
                }
            }

            // Sync quantity input on Devis page if item is in cart
            if (isTableBtn && this.isInCart(productId)) {
                let row = btn.closest('tr');
                let qtyInput = row.querySelector('.ep-qty-input');
                if (qtyInput) {
                    let cartItem = this.getCart().find(item => item.id === productId);
                    if (cartItem && qtyInput.value !== cartItem.quantity.toString()) {
                        qtyInput.value = cartItem.quantity;
                    }
                }
            }
        });

        // Update total order button on Devis page
        let orderBtnContainer = document.getElementById('ep-passer-commande-container');
        if (orderBtnContainer) {
            let totalItems = this.getCart().length;
            if (totalItems > 0) {
                orderBtnContainer.innerHTML = `<a href="/panier-devis" class="fixed bottom-6 right-6 md:bottom-10 md:right-10 z-50 px-8 py-4 bg-gradient-to-r from-ep-blue-night to-ep-cyan text-white font-bold rounded-full shadow-lg shadow-cyan-500/40 hover:-translate-y-1 hover:scale-105 transition-all flex items-center gap-3 animate-pulse-slow">
                    <span class="w-6 h-6 bg-white text-ep-blue-night rounded-full flex items-center justify-center text-xs">${totalItems}</span>
                    Passer la commande
                </a>`;
            } else {
                orderBtnContainer.innerHTML = '';
            }
        }
    },

    // Initialize event listeners
    init: function() {
        const self = this;

        // Add styling for slow pulse
        if(!document.getElementById('ep-custom-styles')) {
            let style = document.createElement('style');
            style.id = 'ep-custom-styles';
            style.innerHTML = `@keyframes pulse-slow { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.02); } } .animate-pulse-slow { animation: pulse-slow 3s infinite; }`;
            document.head.appendChild(style);
        }

        // Initial UI update
        this.updateCartUI();

        // Add/Remove button click
        document.addEventListener('click', function(e) {
            let btn = e.target.closest('.ep-add-to-quote-btn');
            if (btn && !btn.hasAttribute('disabled')) {
                e.preventDefault();
                let productId = btn.getAttribute('data-product-id');

                // If it's a remove action (from table)
                if (btn.getAttribute('data-action') === 'remove') {
                    self.removeItem(productId);
                    self.showNotification('Produit retiré du devis.', 'bg-red-500');
                    return;
                }

                // Add action
                let productName = btn.getAttribute('data-product-name');
                let productImage = btn.getAttribute('data-product-image');

                // Find quantity input
                let row = btn.closest('tr') || btn.closest('.product-card');
                let qtyInput = row ? row.querySelector('.ep-qty-input') : null;
                let quantity = qtyInput ? qtyInput.value : 1;

                self.addItem(productId, productName, productImage, quantity);
                self.showNotification('Produit ajouté au devis !', 'bg-ep-cyan');
            }
        });

        // Quantity change listeners (both for cart page and devis table)
        document.addEventListener('change', function(e) {
            if(e.target.classList.contains('ep-qty-input')) {
                let row = e.target.closest('.ep-cart-row') || e.target.closest('tr');
                if(row) {
                    let productId = row.getAttribute('data-product-id') || row.querySelector('.ep-add-to-quote-btn')?.getAttribute('data-product-id');
                    if (productId && self.isInCart(productId)) {
                        self.updateQuantity(productId, e.target.value);
                        // show subtle notification
                        self.showNotification('Quantité mise à jour', 'bg-gray-800');
                    }
                }
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
