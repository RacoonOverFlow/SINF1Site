document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.search-category').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const category = this.getAttribute('data-category');
            const dropdown = document.getElementById('category-select');
            if (dropdown && category) {
                dropdown.value = category;
                // Trigger change event to apply filter logic
                dropdown.dispatchEvent(new Event('change'));
            }
        });
    });

    document.querySelectorAll('.photos-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const imgUrl = this.getAttribute('data-img');
            if (imgUrl) {
                window.open(imgUrl, '_blank');
            }
        });
    });

    document.querySelectorAll('.more-link').forEach(function(link) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            // Remove any other open dropdowns
            document.querySelectorAll('.more-dropdown').forEach(function(dd) {
                dd.parentNode.removeChild(dd);
            });

            // Create dropdown
            const dropdown = document.createElement('div');
            dropdown.className = 'more-dropdown';
            dropdown.style.position = 'absolute';
            dropdown.style.background = '#fff';
            dropdown.style.border = '1px solid #ccc';
            dropdown.style.zIndex = 1000;
            dropdown.innerHTML = '<button class="delete-btn" style="color:red;width:100%;">Delete</button>';

            // Position dropdown below the icon
            const rect = this.getBoundingClientRect();
            dropdown.style.left = rect.left + window.scrollX + 'px';
            dropdown.style.top = rect.bottom + window.scrollY + 'px';

            document.body.appendChild(dropdown);

            // Remove dropdown if clicking elsewhere
            function removeDropdown(e) {
                if (!dropdown.contains(e.target) && e.target !== link) {
                    dropdown.remove();
                    document.removeEventListener('mousedown', removeDropdown);
                }
            }
            document.addEventListener('mousedown', removeDropdown);

            // Delete logic
            dropdown.querySelector('.delete-btn').addEventListener('click', () => {
                if (confirm('Are you sure you want to delete this item?')) {

                }
            });
        });
    });

    // Toggle favorite status
    document.querySelectorAll('.favorite-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const itemId = this.getAttribute('data-id');
            // Toggle favorite in localStorage (or send AJAX to server for logged-in users)
            let favs = JSON.parse(localStorage.getItem('favorites') || '[]');
            if (favs.includes(itemId)) {
                favs = favs.filter(id => id !== itemId);
            } else {
                favs.push(itemId);
            }
            localStorage.setItem('favorites', JSON.stringify(favs));
            this.querySelector('img').src = favs.includes(itemId)
                ? '../Images/icons/favorite2.png'
                : '../Images/icons/favorite.png';
            updateCardsVisibility();
        });
    });

    // Filter by favorites
    document.getElementById('favorite-filter').addEventListener('change', updateCardsVisibility);

    function updateCardsVisibility() {
        const showFavorites = document.getElementById('favorite-filter').checked;
        let favs = JSON.parse(localStorage.getItem('favorites') || '[]');
        document.querySelectorAll('.collection_box_primary').forEach(function(card) {
            const itemId = card.querySelector('.favorite-btn').getAttribute('data-id');
            if (showFavorites && !favs.includes(itemId)) {
                card.style.display = 'none';
            } else {
                card.style.display = '';
            }
        });
    }


    updateCardsVisibility();
});
