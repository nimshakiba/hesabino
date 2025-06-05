function initPersianDatePickers() {
    // اشخاص
    if (document.getElementById('created_at_display_person') && !document.getElementById('created_at_display_person').dataset.pickerInit) {
        new mds.MdsPersianDateTimePicker(document.getElementById('created_at_display_person'), {
            targetTextSelector: '#created_at_display_person',
            targetDateSelector: '#created_at_person',
            enableTimePicker: false,
            englishNumber: true,
            textFormat: 'yyyy/MM/dd',
            dateFormat: 'yyyy-MM-dd',
        });
        document.getElementById('created_at_display_person').dataset.pickerInit = "1";
    }
    // کالا
    if (document.getElementById('created_at_display_product') && !document.getElementById('created_at_display_product').dataset.pickerInit) {
        new mds.MdsPersianDateTimePicker(document.getElementById('created_at_display_product'), {
            targetTextSelector: '#created_at_display_product',
            targetDateSelector: '#created_at_product',
            enableTimePicker: false,
            englishNumber: true,
            textFormat: 'yyyy/MM/dd',
            dateFormat: 'yyyy-MM-dd',
        });
        document.getElementById('created_at_display_product').dataset.pickerInit = "1";
    }
    // خدمات
    if (document.getElementById('created_at_display_service') && !document.getElementById('created_at_display_service').dataset.pickerInit) {
        new mds.MdsPersianDateTimePicker(document.getElementById('created_at_display_service'), {
            targetTextSelector: '#created_at_display_service',
            targetDateSelector: '#created_at_service',
            enableTimePicker: false,
            englishNumber: true,
            textFormat: 'yyyy/MM/dd',
            dateFormat: 'yyyy-MM-dd',
        });
        document.getElementById('created_at_display_service').dataset.pickerInit = "1";
    }
}

// اجرا در ابتدا
document.addEventListener('DOMContentLoaded', initPersianDatePickers);

// اجرا بعد از هر تغییر تب (در handleTab)
document.addEventListener('alpine:init', () => {
    Alpine.data('categoryTabs', () => ({
        tab: 'person',
        // ... سایر پراپرتی‌ها
        handleTab(newTab) {
            this.tab = newTab;
            setTimeout(initPersianDatePickers, 100); // کمی تاخیر برای اینکه input تو DOM اضافه شود
        }
        // ... بقیه کد
    }));
});
