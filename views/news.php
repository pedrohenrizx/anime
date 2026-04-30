<div class="container mx-auto px-4 py-8 max-w-4xl">
    <article id="news-article" class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm overflow-hidden hidden">
        <div class="w-full h-64 md:h-96 relative">
            <img id="news-image" src="" alt="News Image" class="w-full h-full object-cover">
            <div id="news-category" class="absolute top-4 left-4 bg-brand-500 text-white text-xs font-bold px-4 py-1.5 rounded-full uppercase tracking-wide shadow-md">
            </div>
        </div>

        <div class="p-6 md:p-10">
            <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-4 gap-4">
                <span id="news-date"><i class="fa-regular fa-calendar"></i> </span>
                <span id="news-author"><i class="fa-regular fa-user"></i> Admin</span>
            </div>

            <h1 id="news-title" class="text-3xl md:text-5xl font-bold mb-6 text-gray-900 dark:text-white leading-tight"></h1>

            <!-- Social Share & Actions -->
            <div class="flex items-center justify-between py-4 border-y border-gray-200 dark:border-gray-700 mb-8">
                <div class="flex gap-2">
                    <button class="w-10 h-10 rounded-full bg-[#1DA1F2] text-white flex items-center justify-center hover:opacity-90 transition-opacity"><i class="fa-brands fa-twitter"></i></button>
                    <button class="w-10 h-10 rounded-full bg-[#4267B2] text-white flex items-center justify-center hover:opacity-90 transition-opacity"><i class="fa-brands fa-facebook-f"></i></button>
                    <button class="w-10 h-10 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:opacity-90 transition-opacity"><i class="fa-brands fa-whatsapp"></i></button>
                </div>
                <div>
                    <button id="btn-favorite" class="flex items-center gap-2 text-gray-600 dark:text-gray-300 hover:text-brand-500 transition-colors px-4 py-2 rounded-full border border-gray-200 dark:border-gray-700">
                        <i class="fa-regular fa-heart"></i> <span class="hidden sm:inline">Salvar</span>
                    </button>
                </div>
            </div>

            <div id="news-content" class="prose dark:prose-invert max-w-none text-gray-700 dark:text-gray-300 text-lg leading-relaxed mb-8">
                <!-- Content injected here -->
            </div>

            <div id="news-tags" class="flex flex-wrap gap-2 mb-8">
                <!-- Tags injected here -->
            </div>
        </div>
    </article>

    <div id="loading-indicator" class="text-center py-20 text-gray-500">
        <i class="fa-solid fa-spinner fa-spin text-4xl mb-4"></i>
        <p>Carregando notícia...</p>
    </div>

    <!-- Comments Section -->
    <section id="comments-section" class="mt-12 hidden">
        <h3 class="text-2xl font-bold mb-6 border-l-4 border-brand-500 pl-4">Comentários</h3>

        <div id="comment-form-container" class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-sm mb-8">
            <h4 class="font-bold mb-4">Deixe um comentário</h4>
            <div id="auth-prompt" class="text-sm bg-blue-50 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 p-4 rounded-lg mb-4 hidden">
                Você precisa estar <a href="/login" class="underline font-bold">logado</a> para comentar.
            </div>
            <form id="comment-form" class="hidden">
                <textarea id="comment-text" rows="4" class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg p-4 mb-4 focus:outline-none focus:ring-2 focus:ring-brand-500 dark:text-white resize-none" placeholder="O que você achou desta notícia?"></textarea>
                <div class="flex justify-end">
                    <button type="submit" class="bg-brand-500 hover:bg-red-600 text-white px-6 py-2 rounded-md font-medium transition-colors">Comentar</button>
                </div>
            </form>
        </div>

        <div id="comments-list" class="space-y-6">
            <!-- Comments loaded here -->
        </div>
    </section>
</div>

<script>
    const newsId = "<?= $params['id'] ?? '' ?>";
</script>