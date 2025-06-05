document.addEventListener('DOMContentLoaded', function () {
    // تب اشخاص
    if (document.getElementById('created_at_display_person')) {
        new mds.MdsPersianDateTimePicker(document.getElementById('created_at_display_person'), {
            targetTextSelector: '#created_at_display_person',
            targetDateSelector: '#created_at_person',
            enableTimePicker: false,
            englishNumber: true,
            textFormat: 'yyyy/MM/dd',
            dateFormat: 'yyyy-MM-dd',
        });
    }
    // تب کالا
    if (document.getElementById('created_at_display_product')) {
        new mds.MdsPersianDateTimePicker(document.getElementById('created_at_display_product'), {
            targetTextSelector: '#created_at_display_product',
            targetDateSelector: '#created_at_product',
            enableTimePicker: false,
            englishNumber: true,
            textFormat: 'yyyy/MM/dd',
            dateFormat: 'yyyy-MM-dd',
        });
    }
    // تب خدمات
    if (document.getElementById('created_at_display_service')) {
        new mds.MdsPersianDateTimePicker(document.getElementById('created_at_display_service'), {
            targetTextSelector: '#created_at_display_service',
            targetDateSelector: '#created_at_service',
            enableTimePicker: false,
            englishNumber: true,
            textFormat: 'yyyy/MM/dd',
            dateFormat: 'yyyy-MM-dd',
        });
    }
});
