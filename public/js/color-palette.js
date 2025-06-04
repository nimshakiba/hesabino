function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('color-theme', theme);

    document.querySelectorAll('.theme-switcher').forEach(btn => {
        btn.classList.toggle('selected', btn.dataset.theme === theme);
    });
    document.querySelectorAll('.theme-btn').forEach(btn => {
        btn.classList.toggle('selected', btn.dataset.theme === theme);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    const savedTheme = localStorage.getItem('color-theme') || 'light';
    setTheme(savedTheme);

    document.querySelectorAll('.theme-switcher').forEach(btn => {
        btn.addEventListener('click', function () {
            setTheme(this.dataset.theme);
        });
    });

    document.querySelectorAll('.theme-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            setTheme(this.dataset.theme);
        });
    });

    // اسکرول اتومات سایدبار
    let sidebar = document.querySelector('.sidebar-menu');
    if(sidebar) {
        sidebar.scrollTop = 0;
    }
});
