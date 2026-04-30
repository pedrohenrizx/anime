document.addEventListener('DOMContentLoaded', () => {
    const currentUser = Parse.User.current();

    if (!currentUser) {
        window.location.href = '/login';
        return;
    }

    // Populate user info
    const username = currentUser.get('username');
    document.getElementById('profile-name').textContent = username;
    document.getElementById('profile-email').textContent = currentUser.get('email') || '';
    document.getElementById('profile-avatar').src = `https://ui-avatars.com/api/?name=${username}&background=random&size=128`;

    // Load favorites
    const loadFavorites = async () => {
        const Favorite = Parse.Object.extend("Favorite");
        const query = new Parse.Query(Favorite);
        query.equalTo("user", currentUser);
        query.include("news");
        query.descending("createdAt");

        try {
            const results = await query.find();
            const container = document.getElementById('favorites-list');
            container.innerHTML = '';

            if (results.length === 0) {
                container.innerHTML = '<div class="col-span-full py-8 text-gray-500">Você ainda não salvou nenhuma notícia.</div>';
                return;
            }

            results.forEach(fav => {
                const newsItem = fav.get('news');
                if (!newsItem) return;

                const title = newsItem.get('title') || 'Sem título';
                const imageUrl = newsItem.get('imageUrl') || 'https://via.placeholder.com/600x400?text=Sem+Imagem';
                const category = newsItem.get('category') || 'Geral';
                const url = `/news/${newsItem.id}`;

                container.innerHTML += `
                    <a href="${url}" class="group block bg-white dark:bg-gray-800 rounded-xl overflow-hidden shadow-sm hover:shadow-md transition-all">
                        <div class="h-48 relative overflow-hidden">
                            <img src="${imageUrl}" alt="${title}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                             <div class="absolute top-2 left-2 bg-brand-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase">
                                ${category}
                            </div>
                        </div>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900 dark:text-white group-hover:text-brand-500 transition-colors line-clamp-2">${title}</h3>
                        </div>
                    </a>
                `;
            });

        } catch (error) {
            console.error("Error loading favorites:", error);
            document.getElementById('favorites-list').innerHTML = '<div class="col-span-full py-8 text-red-500">Erro ao carregar favoritos.</div>';
        }
    };

    loadFavorites();
});