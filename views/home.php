<div class="container mx-auto px-4 py-8">
    <!-- Featured News Carousel (Placeholder for simplicity, standard grid here) -->
    <section class="mb-12">
        <h2 class="text-3xl font-bold mb-6 border-l-4 border-brand-500 pl-4">Destaques</h2>
        <div id="featured-news" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Loaded via JS -->
            <div class="col-span-full text-center py-8 text-gray-500">
                <i class="fa-solid fa-spinner fa-spin text-2xl"></i> Carregando destaques...
            </div>
        </div>
    </section>

    <!-- Latest News -->
    <section>
        <div class="flex justify-between items-end mb-6">
            <h2 class="text-3xl font-bold border-l-4 border-brand-500 pl-4">Últimas Notícias</h2>

            <!-- Filters -->
            <div class="hidden md:flex gap-2">
                <button class="px-4 py-1 rounded-full bg-brand-500 text-white text-sm">Todos</button>
                <button class="px-4 py-1 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-sm transition-colors">Lançamentos</button>
                <button class="px-4 py-1 rounded-full bg-gray-200 dark:bg-gray-700 hover:bg-gray-300 dark:hover:bg-gray-600 text-sm transition-colors">Mangás</button>
            </div>
        </div>

        <div id="latest-news" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Loaded via JS -->
             <div class="col-span-full text-center py-8 text-gray-500">
                <i class="fa-solid fa-spinner fa-spin text-2xl"></i> Carregando notícias...
            </div>
        </div>

        <div class="mt-8 text-center">
            <button id="load-more" class="px-6 py-2 border border-brand-500 text-brand-500 hover:bg-brand-500 hover:text-white rounded-md transition-colors hidden">
                Carregar Mais
            </button>
        </div>
    </section>
</div>
