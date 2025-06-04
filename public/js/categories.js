// Highlight active sidebar link
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.sidebar-link').forEach(link => {
        if (link.classList.contains('active')) {
            link.scrollIntoView({ block: 'center' });
        }
    });
    // Optional: Focus on name input when editing
    let nameInput = document.getElementById('name');
    if (nameInput) nameInput.focus();
});
