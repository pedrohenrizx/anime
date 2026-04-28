document.addEventListener('DOMContentLoaded', () => {

    // Redirect if already logged in
    if (Parse.User.current()) {
        window.location.href = '/profile';
        return;
    }

    const loginForm = document.getElementById('login-form');

    const showError = (message) => {
        const errorEl = document.getElementById('error-message');
        if (errorEl) {
            errorEl.textContent = message;
            errorEl.classList.remove('hidden');
        } else {
            alert(message);
        }
    };

    if (loginForm) {
        loginForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;
            const btn = document.getElementById('submit-btn');

            try {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Entrando...';

                await Parse.User.logIn(username, password);
                window.location.href = '/';

            } catch (error) {
                console.error("Login error:", error);
                showError("Usuário ou senha incorretos.");
                btn.disabled = false;
                btn.textContent = 'Entrar';
            }
        });
    }
});