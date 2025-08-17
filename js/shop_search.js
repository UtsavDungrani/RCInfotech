document.getElementById('searchInput').addEventListener('input', function () {
      const searchTerm = this.value.toLowerCase();
      const cards = document.querySelectorAll('.col-md-4');
      const rowContainer = document.querySelector('.row');

      // First, hide all product cards
      cards.forEach(card => {
        if (card.querySelector('.shop_list')) {
          card.style.display = 'none';
        }
      });

      // Then show matching cards and maintain rows
      let visibleCount = 0;
      cards.forEach(card => {
        if (card.querySelector('.shop_list')) {
          const shopName = card.querySelector('.sname').textContent.toLowerCase();
          const address = card.querySelector('.address').textContent.toLowerCase();
          const contact = card.querySelector('.mno').textContent.toLowerCase();

          if (shopName.includes(searchTerm) || address.includes(searchTerm) || contact.includes(searchTerm)) {
            card.style.display = 'block';
            visibleCount++;
          }
        }
      });

      // Add clearfix divs to maintain layout
      const existingClearfixes = rowContainer.querySelectorAll('.clearfix');
      existingClearfixes.forEach(clearfix => clearfix.remove());

      for (let i = 3; i < visibleCount; i += 3) {
        const clearfix = document.createElement('div');
        clearfix.className = 'clearfix';
        cards[i - 1].after(clearfix);
      }
    });