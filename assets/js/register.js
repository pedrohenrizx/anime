document.addEventListener('DOMContentLoaded', () => {

    // Redirect if already logged in
    if (Parse.User.current()) {
        window.location.href = '/profile';
        return;
    }

    const registerForm = document.getElementById('register-form');

    const showError = (message) => {
        const errorEl = document.getElementById('error-message');
        if (errorEl) {
            errorEl.textContent = message;
            errorEl.classList.remove('hidden');
        } else {
            alert(message);
        }
    };

    if (registerForm) {
        registerForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const btn = document.getElementById('submit-btn');

            try {
                btn.disabled = true;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Cadastrando...';

                const user = new Parse.User();
                user.set("username", username);
                user.set("password", password);
                user.set("email", email);

                await user.signUp();
                window.location.href = '/';

            } catch (error) {
                console.error("Register error:", error);
                showError(error.message || "Erro ao criar conta.");
                btn.disabled = false;
                btn.textContent = 'Cadastrar';
            }
        });
    }
});