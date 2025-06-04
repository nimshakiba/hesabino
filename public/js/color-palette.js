function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('color-theme', theme);

    document.querySelectorAll('.theme-switcher-btn').forEach(btn => {
        btn.classList.toggle('selected', btn.dataset.theme === theme);
    });
}
document.addEventListener('DOMContentLoaded', function () {
    const savedTheme = localStorage.getItem('color-theme') || 'light';
    setTheme(savedTheme);

    document.querySelectorAll('.theme-switcher-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            setTheme(this.dataset.theme);
        });
    });
});
