document.addEventListener("alpine:init", () => {
    Alpine.data('categoryForm', () => ({
        tab: window.initialTab || 'person',
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
        imgDefault: (
            window.initialTab === 'person'
                ? '/assets/img/default-person.png'
                : (window.initialTab === 'product'
                    ? '/assets/img/default-product.png'
                    : '/assets/img/default-service.png')
        ),
        imgPreview: '',
        tabLabel: window.initialTab === 'person' ? 'اشخاص' : (window.initialTab === 'product' ? 'کالا' : 'خدمات'),
        changeTab(type) {
            this.tab = type;
            this.imgDefault = type === 'person'
                ? '/assets/img/default-person.png'
                : (type === 'product'
                    ? '/assets/img/default-product.png'
                    : '/assets/img/default-service.png');
            this.tabLabel = type === 'person'
                ? 'اشخاص'
                : type === 'product'
                    ? 'کالا'
                    : 'خدمات';
        },
        handleImage(e) {
            const file = e.target.files[0];
            if(file) {
                const reader = new FileReader();
                reader.onload = evt => { this.imgPreview = evt.target.result; };
                reader.readAsDataURL(file);
            } else {
                this.imgPreview = '';
            }
        },
        showJalaliDatepicker() {
            $('#created_at_display').MdPersianDateTimePicker({
                targetTextSelector: '#created_at_display',
                targetDateSelector: '#created_at',
                englishNumber: true,
                textFormat: 'yyyy-MM-dd',
                enableTimePicker: false,
                selectedDate: $('#created_at').val() || undefined,
                disableBeforeToday: false,
                groupId: 'jalali-datepicker',
                modalMode: true,
            });
            $('#created_at_display').trigger('click');
        }
    }));
});

// مقدار اولیه فیلد نمایش تاریخ را میلادی به شمسی کند
document.addEventListener('DOMContentLoaded', function() {
    let val = document.getElementById('created_at')?.value;
    if(window.moment && val) {
        let jdate = window.moment(val, 'YYYY-MM-DD').locale('fa').format('jYYYY/jMM/jDD');
        document.getElementById('created_at_display').value = jdate;
    }
    // هنگام تغییر مقدار مخفی، مقدار نمایش را هم آپدیت کند
    $('#created_at').on('change', function() {
        let val = $(this).val();
        if(window.moment && val) {
            let jdate = window.moment(val, 'YYYY-MM-DD').locale('fa').format('jYYYY/jMM/jDD');
            $('#created_at_display').val(jdate);
        }
    });
});
