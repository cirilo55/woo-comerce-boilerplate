/**
 * Products Page JavaScript
 * Handles filters, sorting, and view options
 */

document.addEventListener('DOMContentLoaded', function() {
    
    // ═══════════════════════════════════════════════════════════
    // Price Range Filter
    // ═══════════════════════════════════════════════════════════
    const priceRange = document.getElementById('priceRange');
    const priceValue = document.querySelector('.price-value');
    
    if (priceRange && priceValue) {
        // Format currency
        function formatPrice(value) {
            return 'R$ ' + parseFloat(value).toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }
        
        // Update price display
        priceRange.addEventListener('input', function() {
            priceValue.textContent = formatPrice(this.value);
        });
        
        // Filter products by price
        priceRange.addEventListener('change', function() {
            filterProductsByPrice(parseFloat(this.value));
        });
    }
    
    function filterProductsByPrice(maxPrice) {
        const products = document.querySelectorAll('.product-item');
        let visibleCount = 0;
        
        products.forEach(product => {
            const priceElement = product.querySelector('.price-current');
            if (priceElement) {
                const priceText = priceElement.textContent.replace(/[^\d,]/g, '').replace(',', '.');
                const price = parseFloat(priceText);
                
                if (price <= maxPrice) {
                    product.style.display = '';
                    visibleCount++;
                } else {
                    product.style.display = 'none';
                }
            }
        });
        
        updateProductCount(visibleCount);
    }
    
    // ═══════════════════════════════════════════════════════════
    // Sort Products
    // ═══════════════════════════════════════════════════════════
    const sortSelect = document.querySelector('.sort-select');
    
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const sortType = this.value;
            sortProducts(sortType);
        });
    }
    
    function sortProducts(sortType) {
        const grid = document.querySelector('.products-grid');
        if (!grid) return;
        
        const products = Array.from(grid.querySelectorAll('.product-item'));
        
        products.sort((a, b) => {
            switch(sortType) {
                case 'price':
                    return getPrice(a) - getPrice(b);
                case 'price-desc':
                    return getPrice(b) - getPrice(a);
                case 'rating':
                    return getRating(b) - getRating(a);
                case 'date':
                    // Would need data attribute with post date
                    return 0;
                default:
                    return 0;
            }
        });
        
        products.forEach(product => grid.appendChild(product));
    }
    
    function getPrice(product) {
        const priceElement = product.querySelector('.price-current');
        if (!priceElement) return 0;
        const priceText = priceElement.textContent.replace(/[^\d,]/g, '').replace(',', '.');
        return parseFloat(priceText) || 0;
    }
    
    function getRating(product) {
        const stars = product.querySelectorAll('.product-rating .stars');
        return stars.length;
    }
    
    // ═══════════════════════════════════════════════════════════
    // View Toggle (Grid/List)
    // ═══════════════════════════════════════════════════════════
    const viewButtons = document.querySelectorAll('.view-btn');
    const productsGrid = document.querySelector('.products-grid');
    
    viewButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.dataset.view;
            
            // Update active state
            viewButtons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Apply view
            if (productsGrid) {
                if (view === 'list') {
                    productsGrid.style.gridTemplateColumns = '1fr';
                    productsGrid.querySelectorAll('.product-card-wrapper').forEach(card => {
                        card.style.flexDirection = 'row';
                        card.style.maxWidth = '100%';
                    });
                } else {
                    productsGrid.style.gridTemplateColumns = '';
                    productsGrid.querySelectorAll('.product-card-wrapper').forEach(card => {
                        card.style.flexDirection = 'column';
                        card.style.maxWidth = '';
                    });
                }
            }
        });
    });
    
    // ═══════════════════════════════════════════════════════════
    // Rating Filter
    // ═══════════════════════════════════════════════════════════
    const ratingCheckboxes = document.querySelectorAll('.rating-filter input[type="checkbox"]');
    
    ratingCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            filterByRating();
        });
    });
    
    function filterByRating() {
        const checkedRatings = Array.from(ratingCheckboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.parentElement.textContent.split('⭐').length - 1);
        
        const products = document.querySelectorAll('.product-item');
        let visibleCount = 0;
        
        if (checkedRatings.length === 0) {
            products.forEach(product => {
                product.style.display = '';
                visibleCount++;
            });
        } else {
            products.forEach(product => {
                const stars = product.querySelectorAll('.product-rating .stars');
                const rating = stars.length > 0 ? stars[0].textContent.split('⭐').length - 1 : 0;
                
                const shouldShow = checkedRatings.some(minRating => rating >= minRating);
                product.style.display = shouldShow ? '' : 'none';
                if (shouldShow) visibleCount++;
            });
        }
        
        updateProductCount(visibleCount);
    }
    
    // ═══════════════════════════════════════════════════════════
    // Wishlist
    // ═══════════════════════════════════════════════════════════
    const wishlistButtons = document.querySelectorAll('.wishlist-btn');
    
    wishlistButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            this.textContent = this.textContent === '♡' ? '♥' : '♡';
            
            // Add animation
            this.style.transform = 'scale(1.3)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
        });
    });
    
    // ═══════════════════════════════════════════════════════════
    // Quick View (Placeholder)
    // ═══════════════════════════════════════════════════════════
    const quickViewButtons = document.querySelectorAll('.quick-view-btn');
    
    quickViewButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const productId = this.dataset.productId;
            
            // Would open a modal with product details
            alert('Quick view para produto ID: ' + productId + '\n\n(Funcionalidade de modal pode ser implementada)');
        });
    });
    
    // ═══════════════════════════════════════════════════════════
    // Update Product Count
    // ═══════════════════════════════════════════════════════════
    function updateProductCount(count) {
        const countElement = document.querySelector('.products-count');
        if (countElement) {
            countElement.textContent = `Mostrando ${count} produtos`;
        }
    }
    
    // ═══════════════════════════════════════════════════════════
    // Add to Cart Animation
    // ═══════════════════════════════════════════════════════════
    const addToCartForms = document.querySelectorAll('.add-to-cart-form');
    
    addToCartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const btn = this.querySelector('.add-to-cart-btn');
            if (btn) {
                const originalText = btn.innerHTML;
                btn.innerHTML = '✓ Adicionado!';
                btn.style.background = '#10b981';
                
                setTimeout(() => {
                    btn.innerHTML = originalText;
                    btn.style.background = '';
                }, 2000);
            }
        });
    });
    
    // ═══════════════════════════════════════════════════════════
    // Smooth Scroll for Anchors
    // ═══════════════════════════════════════════════════════════
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            if (href !== '#') {
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            }
        });
    });
    
});
