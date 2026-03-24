/**
 * Auto-update cart via AJAX when quantity changes (no page reload)
 */
(function() {
    console.log('Cart auto-update script loaded');
    
    const cartForm = document.querySelector('.woocommerce-cart-form');
    console.log('Cart form found:', !!cartForm);
    
    if (!cartForm) return;

    document.addEventListener('change', function(e) {
        if (!e.target.matches('input[name*="[qty]"]')) return;
        
        console.log('Quantity changed:', e.target.value);
        
        const qty = e.target;
        const row = qty.closest('tr');
        if (!row) return;

        // Get cart item key from input name
        const match = qty.name.match(/cart\[(.+?)\]/);
        if (!match) return;

        const cartItemKey = match[1];
        const newQty = parseFloat(qty.value) || 0;

        console.log('Updating item:', cartItemKey, 'qty:', newQty);
        updateItemQuantity(cartItemKey, newQty, row);
    });

    function updateItemQuantity(cartItemKey, qty, row) {
        console.log('Send AJAX - key:', cartItemKey, 'qty:', qty);
        console.log('AJAX URL:', meutema_ajax?.ajax_url);
        
        const data = new FormData();
        data.append('action', 'meutema_update_cart_item');
        data.append('cart_item_key', cartItemKey);
        data.append('quantity', qty);

        cartForm.classList.add('updating');
        row.classList.add('updating');

        fetch(meutema_ajax.ajax_url, {
            method: 'POST',
            body: data
        })
        .then(response => {
            console.log('Response status:', response.status);
            return response.json();
        })
        .then(result => {
            console.log('AJAX Result:', result);
            
            if (result.success && result.data) {
                // Atualizar tabela
                if (result.data.cart_table) {
                    const newTable = document.createElement('div');
                    newTable.innerHTML = result.data.cart_table;
                    const newTableElement = newTable.querySelector('.shop_table');
                    const oldTable = cartForm.querySelector('.shop_table');
                    if (oldTable && newTableElement) {
                        console.log('Updating cart table');
                        oldTable.replaceWith(newTableElement);
                        reattachListeners();
                    }
                }

                // Atualizar totais
                if (result.data.cart_totals) {
                    const newTotals = document.createElement('div');
                    newTotals.innerHTML = result.data.cart_totals;
                    const newTotalsElement = newTotals.querySelector('.cart_totals');
                    const oldTotals = document.querySelector('.cart_totals');
                    if (oldTotals && newTotalsElement) {
                        console.log('Updating cart totals');
                        oldTotals.replaceWith(newTotalsElement);
                    }
                }

                // Disparar evento customizado para WooCommerce
                document.dispatchEvent(new CustomEvent('wc_fragment_refresh'));
            } else {
                console.error('AJAX error:', result.message || 'Unknown error');
            }
            
            cartForm.classList.remove('updating');
            row.classList.remove('updating');
        })
        .catch(error => {
            console.error('Fetch error:', error);
            cartForm.classList.remove('updating');
            row.classList.remove('updating');
        });
    }

    function reattachListeners() {
        console.log('Reattaching quantity listeners');
        // Listeners are already attached via event delegation
    }
})();
