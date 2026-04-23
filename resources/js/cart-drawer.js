document.addEventListener('alpine:init', () => {
    Alpine.data('cartDrawer', (initialData) => ({
        open: false,
        items: initialData.items || [],
        total: initialData.total || 0,

        init() {
            // Listen for global add-to-cart events
            window.addEventListener('add-to-cart', (event) => {
                this.addItem(event.detail);
            });

            // Listen for global toggle-cart events
            window.addEventListener('toggle-cart', () => {
                this.toggle();
            });
        },

        toggle() {
            this.open = !this.open;
        },

        updateTotal() {
            this.total = this.items.reduce((acc, item) => acc + (item.price * item.quantity), 0);
        },

        addItem(detail) {
            let existingItem = this.items.find(i => i.pizza_id === detail.pizzaId);
            
            if (existingItem) {
                existingItem.quantity += detail.quantity;
            } else {
                this.items.push({
                    id: 'temp-' + Date.now(),
                    pizza_id: detail.pizzaId,
                    name: detail.name,
                    price: detail.price,
                    image: detail.image,
                    quantity: detail.quantity,
                    subtotal: detail.price * detail.quantity
                });
            }
            
            this.updateTotal();
            this.open = true;

            // Sync with backend
            this.$wire.addItem(detail.pizzaId, detail.quantity);
        },

        increase(id) {
            let item = this.items.find(i => i.id === id);
            if (item) {
                item.quantity++;
                this.updateTotal();
                
                if (typeof id === 'string' && id.startsWith('temp-')) {
                    this.$wire.addItem(item.pizza_id, 1);
                } else {
                    this.$wire.increase(id);
                }
            }
        },

        decrease(id) {
            let item = this.items.find(i => i.id === id);
            if (item) {
                if (item.quantity > 1) {
                    item.quantity--;
                    this.updateTotal();
                    
                    if (typeof id === 'string' && id.startsWith('temp-')) {
                        // For temp items, we just add -1
                        this.$wire.addItem(item.pizza_id, -1);
                    } else {
                        this.$wire.decrease(id);
                    }
                } else {
                    this.remove(id);
                }
            }
        },

        remove(id) {
            this.items = this.items.filter(i => i.id !== id);
            this.updateTotal();
            
            if (typeof id === 'string' && id.startsWith('temp-')) {
                // Sync with backend using the pizza_id if needed
                this.$wire.removeItem(id);
            } else {
                this.$wire.removeItem(id);
            }
        }
    }));
});
