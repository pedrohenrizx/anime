<!DOCTYPE html>
<html lang="pt-BR" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AnimeNews Hub</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            500: '#ef4444', // Red-500 for a vibrant anime feel
                        }
                    }
                }
            }
        }
    </script>
    <script src="https://npmcdn.com/parse/dist/parse.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="/assets/css/style.css" rel="stylesheet">
    <script src="/assets/js/theme.js"></script> <!-- Load theme script early to prevent FOUC -->
</head>
<body class="bg-gray-50 text-gray-900 dark:bg-gray-900 dark:text-gray-100 transition-colors duration-200 min-h-screen flex flex-col">
    <header class="bg-white dark:bg-gray-800 shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4 flex justify-between items-center">
            <a href="/" class="text-2xl font-bold text-brand-500 flex items-center gap-2">
                <i class="fa-solid fa-bolt"></i> AnimeNews
            </a>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden text-gray-600 dark:text-gray-300 focus:outline-none">
                <i class="fa-solid fa-bars text-xl"></i>
            </button>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-6" id="desktop-nav">
                <a href="/" class="hover:text-brand-500 transition-colors">Início</a>
                <a href="/category/lancamentos" class="hover:text-brand-500 transition-colors">Lançamentos</a>

                <div class="relative group">
                    <button class="hover:text-brand-500 transition-colors flex items-center gap-1">
                        Categorias <i class="fa-solid fa-chevron-down text-sm"></i>
                    </button>
                    <div class="absolute top-full right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-2 hidden group-hover:block border border-gray-200 dark:border-gray-700">
                        <a href="/category/temporadas" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Temporadas</a>
                        <a href="/category/estudios" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Estúdios</a>
                        <a href="/category/mangas" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Mangás</a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <button id="theme-toggle" class="text-gray-600 dark:text-gray-300 hover:text-brand-500 focus:outline-none p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                        <i id="theme-icon" class="fa-solid fa-moon"></i>
                    </button>

                    <div id="auth-buttons" class="hidden flex gap-2">
                        <a href="/login" class="text-gray-700 dark:text-gray-200 hover:text-brand-500 font-medium px-4 py-2">Entrar</a>
                        <a href="/register" class="bg-brand-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-medium transition-colors">Cadastrar</a>
                    </div>

                    <div id="user-menu" class="hidden relative">
                        <button id="user-menu-btn" class="flex items-center gap-2 focus:outline-none">
                            <img id="user-avatar" src="https://ui-avatars.com/api/?name=User&background=random" class="w-8 h-8 rounded-full border-2 border-brand-500" alt="Avatar">
                        </button>
                        <div id="user-dropdown" class="absolute top-full right-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-md shadow-lg py-2 hidden border border-gray-200 dark:border-gray-700">
                            <a href="/profile" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"><i class="fa-solid fa-user w-5"></i> Perfil</a>
                            <a id="admin-link" href="/admin" class="hidden px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700"><i class="fa-solid fa-cog w-5"></i> Admin</a>
                            <button id="logout-btn" class="w-full text-left block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500"><i class="fa-solid fa-sign-out-alt w-5"></i> Sair</button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

        <!-- Mobile Nav Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white dark:bg-gray-800 border-t dark:border-gray-700 px-4 pt-2 pb-4 space-y-1 shadow-inner">
            <a href="/" class="block px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Início</a>
            <a href="/category/lancamentos" class="block px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Lançamentos</a>
            <a href="/category/temporadas" class="block px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Temporadas</a>
            <a href="/category/mangas" class="block px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Mangás</a>

            <div class="border-t border-gray-200 dark:border-gray-700 mt-2 pt-2">
                <div id="mobile-auth-buttons" class="hidden flex-col gap-2">
                    <a href="/login" class="block px-3 py-2 text-center rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Entrar</a>
                    <a href="/register" class="block px-3 py-2 text-center bg-brand-500 text-white rounded-md hover:bg-red-600">Cadastrar</a>
                </div>
                <div id="mobile-user-menu" class="hidden flex-col">
                    <a href="/profile" class="block px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Perfil</a>
                    <a id="mobile-admin-link" href="/admin" class="hidden block px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700">Admin</a>
                    <button id="mobile-logout-btn" class="w-full text-left block px-3 py-2 rounded-md hover:bg-gray-100 dark:hover:bg-gray-700 text-red-500">Sair</button>
                </div>
            </div>

             <div class="mt-2 flex items-center justify-between px-3 py-2">
                 <span>Tema</span>
                 <button id="theme-toggle-mobile" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i id="theme-icon-mobile" class="fa-solid fa-moon"></i>
                 </button>
             </div>
        </div>
    </header>

    <main class="flex-grow">
        <?php if (isset($content) && file_exists($content)) require_once $content; ?>
    </main>

    <footer class="bg-gray-900 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4 text-brand-500"><i class="fa-solid fa-bolt"></i> AnimeNews Hub</h3>
                    <p class="text-gray-400">Sua fonte diária das melhores notícias, lançamentos e curiosidades sobre o universo dos animes e mangás.</p>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Links Rápidos</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="/" class="hover:text-white transition-colors">Início</a></li>
                        <li><a href="/category/lancamentos" class="hover:text-white transition-colors">Lançamentos</a></li>
                        <li><a href="/category/temporadas" class="hover:text-white transition-colors">Temporadas</a></li>
                        <li><a href="/category/mangas" class="hover:text-white transition-colors">Mangás</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-4">Siga-nos</h3>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-brand-500 transition-colors"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-brand-500 transition-colors"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="w-10 h-10 rounded-full bg-gray-800 flex items-center justify-center hover:bg-brand-500 transition-colors"><i class="fa-brands fa-discord"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-500 text-sm">
                &copy; <?= date('Y') ?> AnimeNews Hub. Todos os direitos reservados.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="/assets/js/app.js"></script>
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', () => {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // User Dropdown Toggle
        const userMenuBtn = document.getElementById('user-menu-btn');
        if (userMenuBtn) {
            userMenuBtn.addEventListener('click', () => {
                document.getElementById('user-dropdown').classList.toggle('hidden');
            });
        }
    </script>
    <?php if (isset($view) && file_exists("assets/js/{$view}.js")): ?>
        <script src="/assets/js/<?= $view ?>.js"></script>
    <?php endif; ?>
</body>
</html>
