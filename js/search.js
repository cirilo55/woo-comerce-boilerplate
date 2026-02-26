/**
 * Header Search - Live Search Functionality
 * Provides real-time search suggestions as user types
 */

document.addEventListener('DOMContentLoaded', function() {
    const searchField = document.querySelector('.header-search .search-field');
    const searchForm = document.querySelector('.header-search .search-form');
    const resultsDropdown = document.querySelector('.search-results-dropdown');
    const resultsContainer = document.querySelector('.search-results-container');
    
    if (!searchField || !resultsDropdown || !resultsContainer) return;
    
    let searchTimeout;
    let currentRequest = null;
    
    // ═══════════════════════════════════════════════════════════
    // Live Search on Input
    // ═══════════════════════════════════════════════════════════
    searchField.addEventListener('input', function() {
        const query = this.value.trim();
        
        // Clear previous timeout
        clearTimeout(searchTimeout);
        
        // Cancel previous request
        if (currentRequest) {
            currentRequest.abort();
        }
        
        // Hide dropdown if query is too short
        if (query.length < 2) {
            hideDropdown();
            return;
        }
        
        // Show loading state
        showLoading();
        
        // Debounce search
        searchTimeout = setTimeout(() => {
            performSearch(query);
        }, 300);
    });
    
    // ═══════════════════════════════════════════════════════════
    // Perform Search
    // ═══════════════════════════════════════════════════════════
    function performSearch(query) {
        // Create URL for WordPress search
        const searchUrl = new URL(window.location.origin);
        searchUrl.searchParams.set('s', query);
        searchUrl.searchParams.set('post_type', 'product');
        searchUrl.searchParams.set('posts_per_page', '5');
        
        // For AJAX requests, we'll fetch the page and parse it
        // In a production environment, you'd use WordPress REST API
        fetchSearchResults(query);
    }
    
    // ═══════════════════════════════════════════════════════════
    // Fetch Search Results (Simulated)
    // ═══════════════════════════════════════════════════════════
    function fetchSearchResults(query) {
        // This is a simplified version
        // In production, use WordPress REST API or custom AJAX endpoint
        
        // Simulate search results
        const products = getProductsFromPage();
        const filteredProducts = products.filter(product => {
            return product.title.toLowerCase().includes(query.toLowerCase());
        }).slice(0, 5);
        
        displayResults(filteredProducts, query);
    }
    
    // ═══════════════════════════════════════════════════════════
    // Get Products from Current Page
    // ═══════════════════════════════════════════════════════════
    function getProductsFromPage() {
        const products = [];
        const productCards = document.querySelectorAll('.product-card, .product-item');
        
        productCards.forEach(card => {
            const titleEl = card.querySelector('.product-title a, h2 a, h3 a');
            const priceEl = card.querySelector('.price-current, .product-price, .price');
            const imageEl = card.querySelector('img');
            const linkEl = card.querySelector('a');
            
            if (titleEl && linkEl) {
                products.push({
                    title: titleEl.textContent.trim(),
                    price: priceEl ? priceEl.textContent.trim() : '',
                    image: imageEl ? imageEl.src : '',
                    url: linkEl.href
                });
            }
        });
        
        return products;
    }
    
    // ═══════════════════════════════════════════════════════════
    // Display Results
    // ═══════════════════════════════════════════════════════════
    function displayResults(products, query) {
        resultsContainer.innerHTML = '';
        
        if (products.length === 0) {
            showNoResults(query);
            return;
        }
        
        products.forEach(product => {
            const resultItem = createResultItem(product, query);
            resultsContainer.appendChild(resultItem);
        });
        
        // Add "View All Results" link
        const viewAllLink = document.createElement('a');
        viewAllLink.href = `?s=${encodeURIComponent(query)}&post_type=product`;
        viewAllLink.className = 'search-view-all';
        viewAllLink.textContent = `Ver todos os resultados para "${query}"`;
        resultsContainer.appendChild(viewAllLink);
        
        showDropdown();
    }
    
    // ═══════════════════════════════════════════════════════════
    // Create Result Item
    // ═══════════════════════════════════════════════════════════
    function createResultItem(product, query) {
        const item = document.createElement('a');
        item.className = 'search-result-item';
        item.href = product.url;
        
        // Highlight matching text
        const highlightedTitle = highlightMatch(product.title, query);
        
        item.innerHTML = `
            ${product.image ? `<img src="${product.image}" alt="${product.title}" class="search-result-image">` : '<div class="search-result-image"></div>'}
            <div class="search-result-info">
                <div class="search-result-title">${highlightedTitle}</div>
                ${product.price ? `<div class="search-result-price">${product.price}</div>` : ''}
            </div>
        `;
        
        return item;
    }
    
    // ═══════════════════════════════════════════════════════════
    // Highlight Matching Text
    // ═══════════════════════════════════════════════════════════
    function highlightMatch(text, query) {
        const regex = new RegExp(`(${escapeRegex(query)})`, 'gi');
        return text.replace(regex, '<strong style="color: var(--color-primary);">$1</strong>');
    }
    
    function escapeRegex(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }
    
    // ═══════════════════════════════════════════════════════════
    // Show States
    // ═══════════════════════════════════════════════════════════
    function showLoading() {
        resultsContainer.innerHTML = `
            <div class="search-loading">
                <div style="font-size: 1.5rem; margin-bottom: 8px;">⏳</div>
                <div>Buscando produtos...</div>
            </div>
        `;
        showDropdown();
    }
    
    function showNoResults(query) {
        resultsContainer.innerHTML = `
            <div class="search-no-results">
                <div class="search-no-results-icon">🔍</div>
                <div>Nenhum produto encontrado para "<strong>${query}</strong>"</div>
            </div>
        `;
        showDropdown();
    }
    
    function showDropdown() {
        resultsDropdown.style.display = 'block';
    }
    
    function hideDropdown() {
        resultsDropdown.style.display = 'none';
    }
    
    // ═══════════════════════════════════════════════════════════
    // Close Dropdown on Outside Click
    // ═══════════════════════════════════════════════════════════
    document.addEventListener('click', function(e) {
        if (!searchForm.contains(e.target)) {
            hideDropdown();
        }
    });
    
    // ═══════════════════════════════════════════════════════════
    // Close Dropdown on Escape Key
    // ═══════════════════════════════════════════════════════════
    searchField.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideDropdown();
            this.blur();
        }
    });
    
    // ═══════════════════════════════════════════════════════════
    // Keyboard Navigation (Optional Enhancement)
    // ═══════════════════════════════════════════════════════════
    let selectedIndex = -1;
    
    searchField.addEventListener('keydown', function(e) {
        const items = resultsContainer.querySelectorAll('.search-result-item');
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            selectedIndex = Math.min(selectedIndex + 1, items.length - 1);
            highlightItem(items, selectedIndex);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            selectedIndex = Math.max(selectedIndex - 1, -1);
            highlightItem(items, selectedIndex);
        } else if (e.key === 'Enter' && selectedIndex >= 0) {
            e.preventDefault();
            items[selectedIndex].click();
        }
    });
    
    function highlightItem(items, index) {
        items.forEach((item, i) => {
            if (i === index) {
                item.style.background = 'var(--color-gray-lighter)';
                item.scrollIntoView({ block: 'nearest' });
            } else {
                item.style.background = '';
            }
        });
    }
    
    // ═══════════════════════════════════════════════════════════
    // Clear Results on Form Submit
    // ═══════════════════════════════════════════════════════════
    searchForm.addEventListener('submit', function() {
        hideDropdown();
    });
    
});
