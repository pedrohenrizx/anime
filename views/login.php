<div class="container mx-auto px-4 py-16 flex justify-center items-center min-h-[60vh]">
    <div class="bg-white dark:bg-gray-800 p-8 rounded-2xl shadow-lg w-full max-w-md">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Bem-vindo de volta</h1>
            <p class="text-gray-500 dark:text-gray-400">Faça login para acessar sua conta</p>
        </div>

        <div id="error-message" class="hidden bg-red-50 text-red-500 p-3 rounded-md mb-4 text-sm text-center"></div>

        <form id="login-form" class="space-y-4">
            <div>
                <label for="username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Usuário</label>
                <input type="text" id="username" required class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:text-white">
            </div>

            <div>
                <div class="flex justify-between items-center mb-1">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Senha</label>
                    <a href="#" class="text-xs text-brand-500 hover:underline">Esqueceu a senha?</a>
                </div>
                <input type="password" id="password" required class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:text-white">
            </div>

            <button type="submit" id="submit-btn" class="w-full bg-brand-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg transition-colors mt-6">
                Entrar
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-gray-500 dark:text-gray-400">
            Ainda não tem uma conta? <a href="/register" class="text-brand-500 font-bold hover:underline">Cadastre-se</a>
        </div>
    </div>
</div>