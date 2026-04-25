document.addEventListener('alpine:init', () => {
    Alpine.data('cartDrawer', (initialData) => ({
        open: false,
        loading: false,
        items: initialData.items || [],
        total: parseFloat(initialData.total) || 0,

        init() {
            // Watch for Livewire updates to sync state
            this.$watch('$wire.items', (value) => {
                this.items = value || [];
                this.updateTotal();
            });

            this.$watch('$wire.total', (value) => {
                const parsed = parseFloat(value);
                this.total = isNaN(parsed) ? 0 : parsed;
            });
            
            // Final check on init
            if (isNaN(this.total)) this.total = 0;
        },

        toggle() {
            this.open = !this.open;
        },

        updateTotal() {
            if (!this.items || this.items.length === 0) {
                this.total = 0;
                return;
            }

            const calculated = this.items.reduce((acc, item) => {
                const price = parseFloat(item.price) || 0;
                const quantity = parseInt(item.quantity) || 0;
                return acc + (price * quantity);
            }, 0);

            this.total = isNaN(calculated) ? 0 : calculated;
        },

        async addItem(detail) {
            if (this.loading) return;
            this.loading = true;

            const qty = parseInt(detail.quantity) || 1;
            let existingItem = this.items.find(i => i.pizza_id === detail.pizzaId);
            
            // Optimistic update
            if (existingItem) {
                existingItem.quantity += qty;
            } else {
                this.items.push({
                    id: 'temp-' + Date.now(),
                    pizza_id: detail.pizzaId,
                    name: detail.name,
                    price: parseFloat(detail.price) || 0,
                    image: detail.image,
                    quantity: qty,
                    subtotal: (parseFloat(detail.price) || 0) * qty
                });
            }
            
            this.updateTotal();
            this.open = true;

            // Sync with backend
            try {
                await this.$wire.addItem(detail.pizzaId, qty);
                this.items = this.$wire.items || [];
                const backendTotal = parseFloat(this.$wire.total);
                this.total = isNaN(backendTotal) ? 0 : backendTotal;
            } catch (e) {
                console.error("Cart sync error:", e);
            } finally {
                this.loading = false;
            }
        },

        async increase(id) {
            if (this.loading) return;
            this.loading = true;

            let item = this.items.find(i => i.id === id);
            if (item) {
                item.quantity++;
                this.updateTotal();
                
                try {
                    if (typeof id === 'string' && id.startsWith('temp-')) {
                        await this.$wire.addItem(item.pizza_id, 1);
                    } else {
                        await this.$wire.increase(id);
                    }
                    this.items = this.$wire.items || [];
                    const backendTotal = parseFloat(this.$wire.total);
                    this.total = isNaN(backendTotal) ? 0 : backendTotal;
                } finally {
                    this.loading = false;
                }
            } else {
                this.loading = false;
            }
        },

        async decrease(id) {
            if (this.loading) return;
            this.loading = true;

            let item = this.items.find(i => i.id === id);
            if (item) {
                if (item.quantity > 1) {
                    item.quantity--;
                    this.updateTotal();
                    
                    try {
                        if (typeof id === 'string' && id.startsWith('temp-')) {
                            await this.$wire.addItem(item.pizza_id, -1);
                        } else {
                            await this.$wire.decrease(id);
                        }
                        this.items = this.$wire.items || [];
                        const backendTotal = parseFloat(this.$wire.total);
                        this.total = isNaN(backendTotal) ? 0 : backendTotal;
                    } finally {
                        this.loading = false;
                    }
                } else {
                    await this.remove(id);
                    this.loading = false;
                }
            } else {
                this.loading = false;
            }
        },

        async remove(id) {
            if (this.loading) return;
            this.loading = true;

            this.items = this.items.filter(i => i.id !== id);
            this.updateTotal();
            
            try {
                await this.$wire.removeItem(id);
                this.items = this.$wire.items || [];
                const backendTotal = parseFloat(this.$wire.total);
                this.total = isNaN(backendTotal) ? 0 : backendTotal;
            } finally {
                this.loading = false;
            }
        }
    }));
});
