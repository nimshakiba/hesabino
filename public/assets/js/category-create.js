document.addEventListener('alpine:init', () => {
    Alpine.data('categoryForm', () => ({
        tab: 'person',
        imgPreview: { person: null, product: null, service: null },
        imgDefault: '/assets/images/default-category.png', // مطمئن شو این فایل وجود دارد
        tabColors: {person: '#6366f1', product: '#f59e42', service: '#22c55e'},
        handleTab(newTab) { this.tab = newTab },
        handleImage(e, which) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (ev) => this.imgPreview[which] = ev.target.result;
                reader.readAsDataURL(file);
            } else {
                this.imgPreview[which] = null;
            }
        }
    }));
});
