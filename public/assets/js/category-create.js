document.addEventListener('alpine:init', () => {
    Alpine.data('categoryForm', () => ({
        tab: '{{ old("type", "person") }}',
        tabColors: {
            person: '#6366f1',
            product: '#06b6d4',
            service: '#10b981'
        },
        tabBGs: {
            person: '#f6f6f8',
            product: '#f0fcfd',
            service: '#f3fcf7'
        },
        imgDefault: '{{ old("type", "person") }}' === 'person'
            ? '/assets/img/default-person.png'
            : ('{{ old("type", "person") }}' === 'product'
                ? '/assets/img/default-product.png'
                : '/assets/img/default-service.png'),
        imgPreview: '',
        tabLabel: '{{ old("type", "person") }}' === 'person'
            ? 'اشخاص'
            : ('{{ old("type") }}' === 'product' ? 'کالا' : 'خدمات'),

        init() {
            this.initJalaliDate();
        },

        changeTab(newTab) {
            this.tab = newTab;
            this.imgDefault = `/assets/img/default-${newTab}.png`;
            this.tabLabel = this.getTabLabel(newTab);
        },

        getTabLabel(tab) {
            const labels = {
                person: 'اشخاص',
                product: 'کالا',
                service: 'خدمات'
            };
            return labels[tab];
        },

        handleImage(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = evt => {
                    this.imgPreview = evt.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                this.imgPreview = '';
            }
        },

        initJalaliDate() {
            const dateInput = document.getElementById('created_at');
            const displayInput = document.getElementById('created_at_display');

            // تنظیم تاریخ اولیه
            const initialDate = moment(dateInput.value);
            displayInput.value = initialDate.locale('fa').format('jYYYY/jMM/jDD');

            // نمایش تاریخ جاری به صورت شمسی
            const today = moment();
            dateInput.value = today.format('YYYY-MM-DD');
            displayInput.value = today.locale('fa').format('jYYYY/jMM/jDD');
        }
    }));
});
