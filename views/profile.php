<div class="container mx-auto px-4 py-8">
    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden mb-8">
        <div class="h-32 bg-brand-500"></div>
        <div class="px-8 pb-8 relative">
            <img id="profile-avatar" src="https://ui-avatars.com/api/?name=User&background=random&size=128" alt="Avatar" class="w-32 h-32 rounded-full border-4 border-white dark:border-gray-800 absolute -top-16 bg-white">

            <div class="pt-20">
                <h1 id="profile-name" class="text-3xl font-bold text-gray-900 dark:text-white mb-2">Carregando...</h1>
                <p id="profile-email" class="text-gray-500 dark:text-gray-400 mb-6"></p>

                <div class="flex gap-4">
                    <button class="bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-gray-800 dark:text-white px-4 py-2 rounded-md font-medium transition-colors">
                        Editar Perfil
                    </button>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-2xl font-bold mb-6 border-l-4 border-brand-500 pl-4">Notícias Salvas</h2>
    <div id="favorites-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="col-span-full text-center py-8 text-gray-500">
            <i class="fa-solid fa-spinner fa-spin text-2xl mb-2"></i><br>Carregando favoritos...
        </div>
    </div>
</div>