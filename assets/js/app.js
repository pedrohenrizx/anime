// Initialize Parse (Back4App)
Parse.initialize(
  "TSUoZRjndrZmU9CvNozMoLqsHlIzjg5qg4UT5bET", // App ID
  "CP4HSq3cyY0PNfwukFUbI0XV1lH6CT1OpfHSuXyE"  // Javascript Key
);
Parse.serverURL = 'https://parseapi.back4app.com/';

// Core Functions
const App = {
    // Check if user is logged in and update UI
    checkAuth: () => {
        const currentUser = Parse.User.current();
        const authButtons = document.getElementById('auth-buttons');
        const userMenu = document.getElementById('user-menu');
        const mobileAuthButtons = document.getElementById('mobile-auth-buttons');
        const mobileUserMenu = document.getElementById('mobile-user-menu');

        if (currentUser) {
            if (authButtons) authButtons.classList.add('hidden');
            if (mobileAuthButtons) mobileAuthButtons.classList.add('hidden');
            if (userMenu) userMenu.classList.remove('hidden');
            if (mobileUserMenu) mobileUserMenu.classList.remove('hidden');

            // Make Admin link visible for password prompt flow
            const adminLink = document.getElementById('admin-link');
            const mobileAdminLink = document.getElementById('mobile-admin-link');
            if (adminLink) adminLink.classList.remove('hidden');
            if (mobileAdminLink) mobileAdminLink.classList.remove('hidden');

        } else {
            if (authButtons) authButtons.classList.remove('hidden');
            if (mobileAuthButtons) mobileAuthButtons.classList.remove('hidden');
            if (userMenu) userMenu.classList.add('hidden');
            if (mobileUserMenu) mobileUserMenu.classList.add('hidden');
        }
    },

    // Format date
    formatDate: (dateObj) => {
        if (!dateObj) return '';
        const options = { year: 'numeric', month: 'short', day: 'numeric' };
        return dateObj.toLocaleDateString('pt-BR', options);
    },

    // Generate Friendly URL slug
    generateSlug: (text) => {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }
};

// Global Event Listeners
document.addEventListener('DOMContentLoaded', () => {
    App.checkAuth();

    // Logout handlers
    const logoutBtn = document.getElementById('logout-btn');
    const mobileLogoutBtn = document.getElementById('mobile-logout-btn');

    const handleLogout = async () => {
        try {
            await Parse.User.logOut();
            window.location.href = '/';
        } catch (error) {
            console.error("Error logging out:", error);
            alert("Erro ao sair.");
        }
    };

    if (logoutBtn) logoutBtn.addEventListener('click', handleLogout);
    if (mobileLogoutBtn) mobileLogoutBtn.addEventListener('click', handleLogout);
});