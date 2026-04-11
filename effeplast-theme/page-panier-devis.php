<?php
/**
 * Template Name: Page Validation Devis
 *
 * The template for displaying the actual Quote Cart / Checkout where users validate their products and submit the form.
 *
 * @package EffePlast
 */

get_header();
?>

<div class="bg-ep-gray-light min-h-screen pb-24">
    <!-- Page Header -->
    <div class="bg-ep-blue-night pt-24 pb-20 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-10">
            <div class="absolute top-1/2 left-1/4 w-96 h-96 bg-ep-cyan rounded-full mix-blend-overlay filter blur-[100px] animate-pulse"></div>
        </div>

        <div class="container mx-auto px-4 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 tracking-tight">VOTRE DEMANDE DE DEVIS</h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto font-light">
                Vérifiez votre sélection de produits et remplissez vos coordonnées pour recevoir notre meilleure offre.
            </p>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="container mx-auto px-[0.1rem] sm:px-4 lg:px-8 -mt-6 md:-mt-10 relative z-30">

        <?php
        // Check if we are displaying a receipt after successful submission
        $is_receipt = isset($_GET['quote_success']) && $_GET['quote_success'] == '1' && isset($_GET['token']);

        if ( $is_receipt ) {
            $token = sanitize_text_field($_GET['token']);
            // Find the quote by token
            $quote_query = new WP_Query(array(
                'post_type' => 'ep_commande_devis',
                'meta_key' => '_ep_devis_token',
                'meta_value' => $token,
                'posts_per_page' => 1
            ));

            if ( $quote_query->have_posts() ) {
                $quote_query->the_post();
                $post_id = get_the_ID();
                $company = get_post_meta($post_id, '_ep_devis_company', true);
                $name = get_post_meta($post_id, '_ep_devis_name', true);
                $email = get_post_meta($post_id, '_ep_devis_email', true);
                $phone = get_post_meta($post_id, '_ep_devis_phone', true);
                $message = get_post_meta($post_id, '_ep_devis_message', true);
                $items = json_decode(get_post_meta($post_id, '_ep_devis_items', true), true);
                ?>
                <!-- Client Receipt View -->
                <div class="max-w-4xl mx-auto">
                    <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 overflow-hidden mb-8" id="ep-receipt-document">
                        <!-- Receipt Header -->
                        <div class="bg-ep-blue-night p-8 text-white flex justify-between items-center border-b-[6px] border-ep-cyan">
                            <div>
                                <h2 class="text-3xl font-black mb-1">REÇU DE DEMANDE</h2>
                                <p class="text-blue-200 text-sm">Réf: #EP-<?php echo $post_id; ?> | Date: <?php echo get_the_date('d/m/Y'); ?></p>
                            </div>
                            <div class="text-right">
                                <h3 class="font-bold text-xl">Effe Plast</h3>
                                <p class="text-xs text-blue-200">Av. Bahnini - Res .Taissir -A2-4-6<br>USINE : Lot. N 7 -Q.I . BirRami KENITRA<br>05 37 36 08 20</p>
                            </div>
                        </div>

                        <div class="p-8 md:p-12">
                            <!-- Client Info -->
                            <div class="mb-10 p-6 bg-gray-50 rounded-xl border border-gray-100">
                                <h3 class="text-xs font-bold text-ep-cyan uppercase tracking-wider mb-4 border-b border-gray-200 pb-2">Informations du demandeur</h3>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div><span class="text-gray-500 text-sm block">Société:</span> <strong class="text-ep-blue-night"><?php echo esc_html($company); ?></strong></div>
                                    <div><span class="text-gray-500 text-sm block">Contact:</span> <strong class="text-ep-blue-night"><?php echo esc_html($name); ?></strong></div>
                                    <div><span class="text-gray-500 text-sm block">Email:</span> <strong class="text-ep-blue-night"><?php echo esc_html($email); ?></strong></div>
                                    <div><span class="text-gray-500 text-sm block">Téléphone:</span> <strong class="text-ep-blue-night"><?php echo esc_html($phone); ?></strong></div>
                                </div>
                            </div>

                            <!-- Items Table -->
                            <h3 class="text-xs font-bold text-ep-cyan uppercase tracking-wider mb-4 border-b border-gray-200 pb-2">Produits demandés</h3>
                            <div class="overflow-x-auto mb-8">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-gray-100 text-gray-600 text-xs font-bold uppercase tracking-wider">
                                            <th class="py-3 px-4 rounded-l-lg">Référence</th>
                                            <th class="py-3 px-4">Produit</th>
                                            <th class="py-3 px-4 text-center rounded-r-lg">Quantité</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        <?php if(is_array($items)) { foreach($items as $item): ?>
                                        <tr class="hover:bg-gray-50">
                                            <td class="py-4 px-4 text-sm font-medium text-gray-500">EP-<?php echo esc_html($item['id']); ?></td>
                                            <td class="py-4 px-4 font-bold text-ep-blue-night"><?php echo esc_html($item['name']); ?></td>
                                            <td class="py-4 px-4 text-center font-bold text-ep-cyan"><?php echo esc_html($item['quantity']); ?></td>
                                        </tr>
                                        <?php endforeach; } ?>
                                    </tbody>
                                </table>
                            </div>

                            <?php if(!empty($message)): ?>
                            <div class="mb-6">
                                <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Notes additionnelles</h3>
                                <p class="text-sm text-gray-600 bg-gray-50 p-4 rounded-lg italic border border-gray-100">"<?php echo nl2br(esc_html($message)); ?>"</p>
                            </div>
                            <?php endif; ?>

                            <div class="text-center mt-12 pt-8 border-t border-dashed border-gray-200">
                                <p class="text-gray-500 text-sm font-medium">Merci pour votre confiance. Notre équipe commerciale vous contactera prochainement avec une offre détaillée.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-center gap-4 ep-hide-print">
                        <button id="ep-download-pdf" class="px-8 py-3.5 bg-ep-blue-night hover:bg-ep-primary text-white font-bold rounded-xl shadow-lg transition-colors flex items-center justify-center gap-3">
                            <i class="fas fa-file-pdf"></i> Télécharger en PDF
                        </button>
                        <a href="<?php echo esc_url(home_url('/devis')); ?>" class="px-8 py-3.5 bg-white border-2 border-ep-cyan text-ep-cyan hover:bg-ep-cyan hover:text-white font-bold rounded-xl shadow-sm transition-colors flex items-center justify-center gap-3">
                            <i class="fas fa-arrow-left"></i> Retour au catalogue
                        </a>
                    </div>
                </div>

                <!-- Load html2pdf for client-side PDF generation -->
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const downloadBtn = document.getElementById('ep-download-pdf');
                    if (downloadBtn) {
                        downloadBtn.addEventListener('click', function() {
                            const element = document.getElementById('ep-receipt-document');
                            const opt = {
                                margin:       0,
                                filename:     'Devis_EffePlast_EP-<?php echo $post_id; ?>.pdf',
                                image:        { type: 'jpeg', quality: 0.98 },
                                html2canvas:  { scale: 2, useCORS: true },
                                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
                            };

                            // Visual feedback
                            const originalText = this.innerHTML;
                            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Génération...';
                            this.classList.add('opacity-75', 'cursor-not-allowed');

                            html2pdf().set(opt).from(element).save().then(() => {
                                this.innerHTML = originalText;
                                this.classList.remove('opacity-75', 'cursor-not-allowed');
                            });
                        });
                    }
                });
                </script>

                <?php
                wp_reset_postdata();
            } else {
                echo '<div class="text-center py-20"><h2 class="text-2xl font-bold text-red-500">Erreur</h2><p>Ce reçu est introuvable ou a expiré.</p></div>';
            }
        } else {
            // SHOW THE NORMAL CART CHECKOUT
        ?>
        <div class="grid lg:grid-cols-12 gap-8">

            <!-- Liste des produits du devis (Cart Items) -->
            <div class="lg:col-span-7 xl:col-span-8">
                <div class="bg-white rounded-3xl shadow-modern border border-gray-100 p-4 sm:p-6 md:p-10 mb-8" id="ep-quote-cart-container">

                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3 mb-6 sm:mb-8 pb-4 border-b border-gray-100">
                        <h2 class="text-xl sm:text-2xl font-black text-ep-blue-night flex items-center gap-3">
                            <i class="fas fa-boxes text-ep-cyan"></i> Produits sélectionnés
                        </h2>
                        <span class="text-xs sm:text-sm font-bold bg-ep-cyan/10 text-ep-cyan py-1 px-3 rounded-full flex-shrink-0 whitespace-nowrap"><span class="ep-quote-count">0</span> produit(s)</span>
                    </div>

                    <!-- Empty state -->
                    <div id="ep-empty-cart-msg" class="text-center py-12 hidden">
                        <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                            <i class="fas fa-box-open text-4xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-ep-blue-night mb-2">Votre liste de devis est vide</h3>
                        <p class="text-gray-500 mb-8">Vous n'avez pas encore sélectionné de produits pour votre demande de devis.</p>
                        <a href="/devis" class="px-8 py-3 bg-ep-cyan hover:bg-ep-primary text-white font-bold rounded-xl shadow-md transition-colors inline-block">
                            Parcourir notre catalogue
                        </a>
                    </div>

                    <!-- Products List Table -->
                    <div class="overflow-x-auto pb-4" id="ep-cart-table-wrapper">
                        <table class="w-full text-left border-collapse min-w-[500px] sm:min-w-[600px]">
                            <thead>
                                <tr class="bg-gray-50 text-gray-500 text-xs font-bold uppercase tracking-wider border-b border-gray-100">
                                    <th class="py-4 px-[0.1rem] sm:px-4 w-20">Produit</th>
                                    <th class="py-4 px-[0.1rem] sm:px-4">Détails</th>
                                    <th class="py-4 px-[0.1rem] sm:px-4 text-center w-32">Quantité estimée</th>
                                    <th class="py-4 px-[0.1rem] sm:px-4 text-right w-12"></th>
                                </tr>
                            </thead>
                            <tbody id="ep-cart-items-tbody" class="divide-y divide-gray-100">
                                <!-- JS WILL INJECT ROWS HERE -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Formulaire de soumission -->
            <div class="lg:col-span-5 xl:col-span-4">
                <div class="bg-gradient-to-br from-[#1C2638] to-[#0B1C38] rounded-[2rem] shadow-xl p-4 sm:p-8 sticky top-28">
                    <h2 class="text-xl font-bold text-white mb-2">Finaliser la demande</h2>
                    <p class="text-gray-400 text-sm mb-8 font-light">Remplissez ce formulaire pour nous envoyer votre sélection.</p>

                    <form id="ep-submit-quote-form" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST" class="space-y-5">
                        <input type="hidden" name="action" value="ep_submit_quote">
                        <input type="hidden" name="quote_data" id="quote_data_input" value="">
                        <?php wp_nonce_field( 'ep_submit_quote_nonce', 'ep_quote_nonce' ); ?>

                        <div class="space-y-1.5">
                            <label for="company" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Société / Entreprise *</label>
                            <input type="text" id="company" name="company" required class="w-full px-4 py-3 bg-white/5 border border-white/10 text-white rounded-xl focus:outline-none focus:border-ep-cyan transition-colors placeholder-gray-500">
                        </div>

                        <div class="space-y-1.5">
                            <label for="contact_name" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Nom du contact *</label>
                            <input type="text" id="contact_name" name="contact_name" required class="w-full px-4 py-3 bg-white/5 border border-white/10 text-white rounded-xl focus:outline-none focus:border-ep-cyan transition-colors placeholder-gray-500">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="space-y-1.5">
                                <label for="email" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Email *</label>
                                <input type="email" id="email" name="email" required class="w-full px-4 py-3 bg-white/5 border border-white/10 text-white rounded-xl focus:outline-none focus:border-ep-cyan transition-colors placeholder-gray-500">
                            </div>
                            <div class="space-y-1.5">
                                <label for="phone" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Téléphone *</label>
                                <input type="text" id="phone" name="phone" required class="w-full px-4 py-3 bg-white/5 border border-white/10 text-white rounded-xl focus:outline-none focus:border-ep-cyan transition-colors placeholder-gray-500">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label for="message" class="text-xs font-bold text-gray-300 uppercase tracking-wider">Notes additionnelles</label>
                            <textarea id="message" name="message" rows="3" placeholder="Exigences spécifiques, couleurs, matériaux..." class="w-full px-4 py-3 bg-white/5 border border-white/10 text-white rounded-xl focus:outline-none focus:border-ep-cyan transition-colors placeholder-gray-500 resize-none"></textarea>
                        </div>

                        <button type="submit" id="ep-submit-btn" class="w-full py-4 mt-4 bg-ep-cyan hover:bg-ep-primary text-white font-bold rounded-xl transition-colors shadow-lg shadow-cyan-500/30 flex items-center justify-center gap-2">
                            <span>Envoyer ma demande</span>
                            <i class="fas fa-paper-plane text-sm"></i>
                        </button>

                        <p class="text-xs text-center text-gray-500 mt-4">Nous vous répondrons dans les plus brefs délais (généralement sous 24h).</p>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {

    function renderCartPage() {
        const cart = QuoteSystem.getCart();
        const tbody = document.getElementById('ep-cart-items-tbody');
        const emptyMsg = document.getElementById('ep-empty-cart-msg');
        const tableWrapper = document.getElementById('ep-cart-table-wrapper');
        const submitBtn = document.getElementById('ep-submit-btn');
        const dataInput = document.getElementById('quote_data_input');

        // Populate hidden input with cart data for PHP submission
        dataInput.value = JSON.stringify(cart);

        if (cart.length === 0) {
            emptyMsg.classList.remove('hidden');
            tableWrapper.classList.add('hidden');
            submitBtn.setAttribute('disabled', 'disabled');
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
            return;
        }

        emptyMsg.classList.add('hidden');
        tableWrapper.classList.remove('hidden');
        submitBtn.removeAttribute('disabled');
        submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');

        tbody.innerHTML = '';

        cart.forEach(item => {
            let tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50 transition-colors ep-cart-row';
            tr.setAttribute('data-product-id', item.id);
            tr.setAttribute('data-unique-id', item.uniqueId || item.id);

            // Fallback image
            let imgHtml = item.image ? `<img src="${item.image}" alt="${item.name}" class="w-12 h-12 object-contain mix-blend-multiply">` : `<i class="fas fa-box text-2xl text-gray-300"></i>`;

            // Color badge
            let colorHtml = item.color ? `<span class="mt-1 text-[10px] sm:text-xs text-gray-600 bg-gray-50 border border-gray-200 px-2 py-0.5 rounded inline-flex items-center gap-1 font-bold ml-1"><i class="fas fa-circle text-[8px] opacity-50"></i> ${item.color}</span>` : '';

            tr.innerHTML = `
                <td class="py-4 px-[0.1rem] sm:px-4">
                    <div class="w-12 h-12 sm:w-16 sm:h-16 bg-gray-50 rounded-lg border border-gray-100 flex items-center justify-center p-1 sm:p-2">
                        ${imgHtml}
                    </div>
                </td>
                <td class="py-4 px-[0.1rem] sm:px-4">
                    <h4 class="font-bold text-ep-blue-night text-[15px] sm:text-lg leading-tight mb-1 break-words">${item.name}</h4>
                    <span class="text-[10px] sm:text-xs text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full inline-block whitespace-nowrap">Ref: EP-${item.id}</span>
                    ${colorHtml}
                </td>
                <td class="py-4 px-[0.1rem] sm:px-4 text-center">
                    <div class="flex items-center justify-center border border-gray-200 rounded-lg overflow-hidden bg-white w-24 sm:w-28 mx-auto">
                        <button type="button" class="ep-qty-minus w-6 sm:w-8 h-8 sm:h-10 flex items-center justify-center text-gray-500 hover:text-ep-cyan focus:outline-none"><i class="fas fa-minus text-[10px] sm:text-xs"></i></button>
                        <input type="number" min="50" value="${item.quantity}" class="ep-qty-input w-10 sm:w-12 h-8 sm:h-10 text-center text-gray-800 font-bold border-x border-gray-100 focus:outline-none appearance-none m-0 p-0 text-xs sm:text-sm">
                        <button type="button" class="ep-qty-plus w-6 sm:w-8 h-8 sm:h-10 flex items-center justify-center text-gray-500 hover:text-ep-cyan focus:outline-none"><i class="fas fa-plus text-[10px] sm:text-xs"></i></button>
                    </div>
                </td>
                <td class="py-4 px-[0.1rem] sm:px-4 text-right">
                    <button type="button" class="ep-remove-item w-8 h-8 rounded-full bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition-colors flex items-center justify-center ml-auto" title="Supprimer">
                        <i class="fas fa-trash-alt text-xs"></i>
                    </button>
                </td>
            `;
            tbody.appendChild(tr);
        });

        bindCartEvents();
    }

    function bindCartEvents() {
        document.querySelectorAll('.ep-qty-minus').forEach(btn => {
            btn.addEventListener('click', function() {
                let input = this.nextElementSibling;
                if(input.value > 50) {
                    input.value = parseInt(input.value) - 1;
                    // Trigger change event to update local storage via quote-system.js listener
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                    document.getElementById('quote_data_input').value = JSON.stringify(QuoteSystem.getCart());
                }
            });
        });

        document.querySelectorAll('.ep-qty-plus').forEach(btn => {
            btn.addEventListener('click', function() {
                let input = this.previousElementSibling;
                input.value = parseInt(input.value) + 1;
                input.dispatchEvent(new Event('change', { bubbles: true }));
                document.getElementById('quote_data_input').value = JSON.stringify(QuoteSystem.getCart());
            });
        });

        document.querySelectorAll('.ep-remove-item').forEach(btn => {
            btn.addEventListener('click', function() {
                let row = this.closest('tr');
                let id = row.getAttribute('data-product-id');
                QuoteSystem.removeItem(id);
                renderCartPage(); // Re-render the whole table
            });
        });

        // Ensure input manual changes also update hidden input
        document.querySelectorAll('.ep-qty-input').forEach(input => {
            input.addEventListener('change', function() {
                setTimeout(() => {
                    document.getElementById('quote_data_input').value = JSON.stringify(QuoteSystem.getCart());
                }, 100);
            });
        });
    }

    // Initial render
    renderCartPage();

    // Before submit logic to clear cart if successful (handled server-side via redirect, but good to prep)
    const form = document.getElementById('ep-submit-quote-form');
    if(form) {
        form.addEventListener('submit', function() {
            // we let it submit normally. Cart clearing will be handled by the success page or a flag.
        });
    }
});
</script>

        <?php
        } // End of else block (normal cart view)
        ?>
    </div>
</div>

<style>
/* CSS to override standard inputs */
input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type=number] {
    -moz-appearance: textfield;
}

/* Print specific styles */
@media print {
    .ep-hide-print { display: none !important; }
    body { background: white !important; }
    .bg-ep-blue-night { background-color: #1762A4 !important; color: white !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
    .text-white { color: white !important; }
    header, footer { display: none !important; }
}
</style>

<?php get_footer(); ?>