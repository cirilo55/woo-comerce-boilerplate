// Atualiza badge do carrinho dinamicamente via AJAX
(function(){
    'use strict';

    function selectBadge() {
        return document.querySelector('.cart-link .badge');
    }

    function setBadge(count) {
        var badge = selectBadge();
        if (!badge) return;
        badge.textContent = String(count);
        badge.setAttribute('data-count', String(count));
        if (Number(count) <= 0) {
            badge.classList.add('badge-empty');
        } else {
            badge.classList.remove('badge-empty');
            // animação de pop
            badge.classList.add('badge-pop');
            window.setTimeout(function(){ badge.classList.remove('badge-pop'); }, 350);
        }
    }

    function fetchCount() {
        if (!window.meutema_ajax || !meutema_ajax.ajax_url) return;
        var url = meutema_ajax.ajax_url + '?action=meutema_get_cart_count&_=' + Date.now();
        fetch(url, { credentials: 'same-origin' })
            .then(function(res){ return res.json(); })
            .then(function(data){
                if (data && data.success && data.data && typeof data.data.count !== 'undefined') {
                    setBadge(Number(data.data.count));
                }
            }).catch(function(){ /* fail silently */ });
    }

    document.addEventListener('DOMContentLoaded', function(){
        // Inicializa
        fetchCount();

        // Quando um formulário de add-to-cart for submetido, atualizar contagem após pequeno delay
        document.addEventListener('submit', function(e){
            var form = e.target;
            if (form && form.classList && form.classList.contains('add-to-cart-form')) {
                // atualizar depois de 800ms — tempo para o WC processar o POST
                window.setTimeout(fetchCount, 800);
            }
        }, true);

        // Ouvir eventos globais do WooCommerce (se existirem)
        document.body.addEventListener('added_to_cart', function(){ fetchCount(); });
        document.body.addEventListener('wc_fragment_refresh', function(){ fetchCount(); });
    });

})();
