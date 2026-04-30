// Setup theme on load
function initTheme() {
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
}

// Initialize immediately
initTheme();

// Handle toggle click after DOM is loaded
document.addEventListener('DOMContentLoaded', () => {
    const themeToggleBtn = document.getElementById('theme-toggle');
    const themeIcon = document.getElementById('theme-icon');

    const themeToggleBtnMobile = document.getElementById('theme-toggle-mobile');
    const themeIconMobile = document.getElementById('theme-icon-mobile');

    function updateIcons() {
        const isDark = document.documentElement.classList.contains('dark');
        if (themeIcon) {
            themeIcon.className = isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
        }
        if (themeIconMobile) {
            themeIconMobile.className = isDark ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
        }
    }

    updateIcons();

    function toggleTheme() {
        if (localStorage.getItem('color-theme')) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            }
        } else {
            if (document.documentElement.classList.contains('dark')) {
                document.documentElement.classList.remove('dark');
                localStorage.setItem('color-theme', 'light');
            } else {
                document.documentElement.classList.add('dark');
                localStorage.setItem('color-theme', 'dark');
            }
        }
        updateIcons();
    }

    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', toggleTheme);
    }

    if (themeToggleBtnMobile) {
        themeToggleBtnMobile.addEventListener('click', toggleTheme);
    }
});