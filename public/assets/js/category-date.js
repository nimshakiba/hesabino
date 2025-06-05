function enablePersianDatePickerForCurrentTab() {
    // ابتدا همه inputها را حذف و دوباره مقداردهی کن
    ['person', 'product', 'service'].forEach(function(type) {
        let selector = '#created_at_display_' + type;
        let hiddenSelector = '#created_at_' + type;
        if ($(selector).length) {
            // اگر قبلاً مقداردهی شده باشد destroy کن
            $(selector).MdPersianDateTimePicker('destroy');
            // مقداردهی مجدد
            $(selector).MdPersianDateTimePicker({
                targetTextSelector: selector,
                targetDateSelector: hiddenSelector,
                englishNumber: true,
                textFormat: 'yyyy/MM/dd',
                enableTimePicker: false,
            });
        }
    });
}

// بارگذاری اولیه فقط برای تب فعال
$(document).ready(function() {
    enablePersianDatePickerForCurrentTab();
});

// هربار که تب عوض شد، باید دوباره مقداردهی شود
window.addEventListener('tabChanged', function(e) {
    setTimeout(enablePersianDatePickerForCurrentTab, 10); // کمی تاخیر برای رندر Alpine
});
