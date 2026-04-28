<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold border-l-4 border-brand-500 pl-4">Painel de Administração</h1>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 max-w-4xl mx-auto">
        <h2 class="text-xl font-bold mb-6 border-b border-gray-200 dark:border-gray-700 pb-2">Nova Notícia</h2>

        <div id="admin-message" class="hidden p-4 rounded-md mb-6 font-medium"></div>

        <form id="news-form" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="md:col-span-2">
                    <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Título da Notícia</label>
                    <input type="text" id="title" required class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:text-white">
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Categoria</label>
                    <select id="category" required class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:text-white">
                        <option value="Lançamentos">Lançamentos</option>
                        <option value="Temporadas">Temporadas</option>
                        <option value="Estúdios">Estúdios</option>
                        <option value="Mangás">Mangás</option>
                        <option value="Eventos">Eventos</option>
                    </select>
                </div>

                <div>
                    <label for="imageUrl" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">URL da Imagem</label>
                    <input type="url" id="imageUrl" required placeholder="https://..." class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:text-white">
                </div>
            </div>

            <div>
                <label for="summary" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Resumo (opcional)</label>
                <textarea id="summary" rows="2" class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:text-white"></textarea>
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Conteúdo Completo</label>
                <textarea id="content" rows="10" required class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:text-white"></textarea>
            </div>

            <div>
                <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tags (separadas por vírgula)</label>
                <input type="text" id="tags" placeholder="anime, shounen, novidade" class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:text-white">
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" id="submit-btn" class="bg-brand-500 hover:bg-red-600 text-white font-bold py-2 px-8 rounded-lg transition-colors">
                    Publicar Notícia
                </button>
            </div>
        </form>
    </div>
</div>