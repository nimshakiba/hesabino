document.addEventListener("DOMContentLoaded", function () {
    const imageInput = document.getElementById('image');
    const previewContainer = document.getElementById('preview-image');
    if (imageInput) {
        imageInput.addEventListener('change', function (e) {
            previewContainer.innerHTML = '';
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    previewContainer.innerHTML = '<img src="' + e.target.result + '" alt="پیش‌نمایش تصویر">';
                }
                reader.readAsDataURL(this.files[0]);
            }
        });
    }
});
