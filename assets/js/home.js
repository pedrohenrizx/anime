document.addEventListener('DOMContentLoaded', () => {

    // Function to render a news card
    const createNewsCard = (newsItem, isFeatured = false) => {
        const title = newsItem.get('title') || 'Sem título';
        const summary = newsItem.get('summary') || '';
        const imageUrl = newsItem.get('imageUrl') || 'https://via.placeholder.com/600x400?text=Sem+Imagem';
        const category = newsItem.get('category') || 'Geral';
        const date = App.formatDate(newsItem.get('createdAt'));
        // Using objectId for simplicity in URLs right now, though slug is better
        const url = `/news/${newsItem.id}`;

        const cardClass = isFeatured ? 'md:col-span-2 lg:col-span-2 row-span-2' : '';
        const imgHeight = isFeatured ? 'h-64 md:h-full' : 'h-48';
        const titleClass = isFeatured ? 'text-2xl md:text-4xl' : 'text-xl';

        return `
            <a href="${url}" class="group block bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 ${cardClass} flex flex-col relative">
                <div class="relative overflow-hidden ${imgHeight}">
                    <img src="${imageUrl}" alt="${title}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <div class="absolute top-4 left-4 bg-brand-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide shadow-md">
                        ${category}
                    </div>
                </div>
                <div class="p-5 flex-grow flex flex-col justify-between">
                    <div>
                        <div class="flex items-center text-xs text-gray-500 dark:text-gray-400 mb-2 gap-2">
                            <span><i class="fa-regular fa-calendar"></i> ${date}</span>
                        </div>
                        <h3 class="font-bold ${titleClass} mb-2 text-gray-900 dark:text-white group-hover:text-brand-500 transition-colors line-clamp-2">${title}</h3>
                        ${!isFeatured ? `<p class="text-gray-600 dark:text-gray-300 text-sm line-clamp-3 mb-4">${summary}</p>` : ''}
                    </div>
                </div>
                ${isFeatured ? `
                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex flex-col justify-end p-6">
                    <div class="bg-brand-500 text-white text-xs font-bold px-3 py-1 rounded-full uppercase tracking-wide w-max mb-3">
                        ${category}
                    </div>
                    <h3 class="font-bold text-white ${titleClass} mb-2 leading-tight">${title}</h3>
                    <div class="flex items-center text-sm text-gray-300 gap-2">
                        <span><i class="fa-regular fa-calendar"></i> ${date}</span>
                    </div>
                </div>
                ` : ''}
            </a>
        `;
    };

    const fetchNews = async () => {
        const News = Parse.Object.extend("News");
        const query = new Parse.Query(News);
        query.descending("createdAt");
        query.limit(10);

        try {
            const results = await query.find();

            const featuredContainer = document.getElementById('featured-news');
            const latestContainer = document.getElementById('latest-news');

            featuredContainer.innerHTML = '';
            latestContainer.innerHTML = '';

            if (results.length === 0) {
                latestContainer.innerHTML = '<div class="col-span-full py-8 text-gray-500">Nenhuma notícia encontrada.</div>';
                return;
            }

            results.forEach((item, index) => {
                if (index < 3) {
                    // First item is large featured, next two are smaller featured
                    featuredContainer.innerHTML += createNewsCard(item, index === 0);
                } else {
                    latestContainer.innerHTML += createNewsCard(item, false);
                }
            });

            if(results.length >= 10) {
                 document.getElementById('load-more').classList.remove('hidden');
            }

        } catch (error) {
            console.error("Error fetching news:", error);
            const latestContainer = document.getElementById('latest-news');
            if (latestContainer) {
                latestContainer.innerHTML = '<div class="col-span-full py-8 text-red-500">Erro ao carregar as notícias. Tente novamente mais tarde.</div>';
            }
        }
    };

    fetchNews();
});