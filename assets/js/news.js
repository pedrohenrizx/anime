document.addEventListener('DOMContentLoaded', () => {
    if (!newsId) {
        window.location.href = '/';
        return;
    }

    const loadNews = async () => {
        const News = Parse.Object.extend("News");
        const query = new Parse.Query(News);

        try {
            const newsItem = await query.get(newsId);

            // Populate DOM
            document.getElementById('news-image').src = newsItem.get('imageUrl') || 'https://via.placeholder.com/1200x600?text=Sem+Imagem';
            document.getElementById('news-category').textContent = newsItem.get('category') || 'Geral';
            document.getElementById('news-date').innerHTML = `<i class="fa-regular fa-calendar"></i> ${App.formatDate(newsItem.get('createdAt'))}`;
            document.getElementById('news-title').textContent = newsItem.get('title') || 'Sem título';

            // Content (convert newlines to <p> for simple rendering)
            let content = newsItem.get('content') || '';
            content = content.split('\n').map(p => p.trim() ? `<p class="mb-4">${p}</p>` : '').join('');
            document.getElementById('news-content').innerHTML = content;

            // Tags
            const tags = newsItem.get('tags');
            if (tags && Array.isArray(tags)) {
                const tagsHtml = tags.map(tag => `<span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 px-3 py-1 rounded-md text-sm">#${tag}</span>`).join('');
                document.getElementById('news-tags').innerHTML = tagsHtml;
            }

            // Show article, hide loader
            document.getElementById('loading-indicator').classList.add('hidden');
            document.getElementById('news-article').classList.remove('hidden');
            document.getElementById('comments-section').classList.remove('hidden');

            // Set up comments and favorites
            setupComments();
            setupFavorite(newsItem);

        } catch (error) {
            console.error("Error fetching news detail:", error);
            document.getElementById('loading-indicator').innerHTML = `
                <div class="text-red-500">
                    <i class="fa-solid fa-triangle-exclamation text-4xl mb-4"></i>
                    <p>Notícia não encontrada ou ocorreu um erro.</p>
                    <a href="/" class="text-brand-500 hover:underline mt-4 inline-block">Voltar ao início</a>
                </div>
            `;
        }
    };

    const setupFavorite = async (newsItem) => {
        const currentUser = Parse.User.current();
        const favBtn = document.getElementById('btn-favorite');
        const favIcon = favBtn.querySelector('i');

        if (!currentUser) {
            favBtn.addEventListener('click', () => {
                alert("Faça login para salvar notícias favoritas.");
                window.location.href = '/login';
            });
            return;
        }

        // Check if already favorited
        const Favorite = Parse.Object.extend("Favorite");
        const query = new Parse.Query(Favorite);
        query.equalTo("user", currentUser);
        query.equalTo("news", newsItem);

        try {
            let favRecord = await query.first();
            if (favRecord) {
                favIcon.classList.remove('fa-regular');
                favIcon.classList.add('fa-solid', 'text-brand-500');
            }

            favBtn.addEventListener('click', async () => {
                try {
                    if (favRecord) {
                        // Remove favorite
                        await favRecord.destroy();
                        favRecord = null;
                        favIcon.classList.remove('fa-solid', 'text-brand-500');
                        favIcon.classList.add('fa-regular');
                    } else {
                        // Add favorite
                        const newFav = new Favorite();
                        newFav.set("user", currentUser);
                        newFav.set("news", newsItem);
                        favRecord = await newFav.save();
                        favIcon.classList.remove('fa-regular');
                        favIcon.classList.add('fa-solid', 'text-brand-500');
                    }
                } catch (e) {
                    console.error("Error toggling favorite:", e);
                }
            });
        } catch (e) {
            console.error("Error checking favorite status:", e);
        }
    };

    const setupComments = () => {
        const currentUser = Parse.User.current();
        if (currentUser) {
            document.getElementById('comment-form').classList.remove('hidden');
        } else {
            document.getElementById('auth-prompt').classList.remove('hidden');
        }

        loadComments();

        document.getElementById('comment-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            const text = document.getElementById('comment-text').value.trim();
            if (!text) return;

            const Comment = Parse.Object.extend("Comment");
            const newComment = new Comment();

            const News = Parse.Object.extend("News");
            const newsRef = new News();
            newsRef.id = newsId;

            newComment.set("text", text);
            newComment.set("author", currentUser);
            newComment.set("news", newsRef);

            try {
                // Disable button
                const btn = e.target.querySelector('button');
                const origText = btn.textContent;
                btn.textContent = 'Enviando...';
                btn.disabled = true;

                await newComment.save();

                document.getElementById('comment-text').value = '';
                btn.textContent = origText;
                btn.disabled = false;

                loadComments(); // reload
            } catch (error) {
                console.error("Error posting comment:", error);
                alert("Erro ao enviar comentário.");
                e.target.querySelector('button').disabled = false;
            }
        });
    };

    const loadComments = async () => {
        const Comment = Parse.Object.extend("Comment");
        const query = new Parse.Query(Comment);

        const News = Parse.Object.extend("News");
        const newsRef = new News();
        newsRef.id = newsId;

        query.equalTo("news", newsRef);
        query.include("author"); // fetch user info
        query.descending("createdAt");

        try {
            const comments = await query.find();
            const list = document.getElementById('comments-list');
            list.innerHTML = '';

            if (comments.length === 0) {
                list.innerHTML = '<p class="text-gray-500">Seja o primeiro a comentar!</p>';
                return;
            }

            // Simple escape function to prevent XSS
            const escapeHtml = (unsafe) => {
                return (unsafe || '').toString()
                     .replace(/&/g, "&amp;")
                     .replace(/</g, "&lt;")
                     .replace(/>/g, "&gt;")
                     .replace(/"/g, "&quot;")
                     .replace(/'/g, "&#039;");
            };

            comments.forEach(comment => {
                const author = comment.get("author");
                const rawAuthorName = author ? author.get("username") : "Usuário Anônimo";
                const authorName = escapeHtml(rawAuthorName);
                const text = escapeHtml(comment.get("text"));
                const date = App.formatDate(comment.get("createdAt"));

                list.innerHTML += `
                    <div class="bg-gray-50 dark:bg-gray-800/50 p-4 rounded-lg flex gap-4">
                        <img src="https://ui-avatars.com/api/?name=${encodeURIComponent(rawAuthorName)}&background=random" alt="${authorName}" class="w-10 h-10 rounded-full">
                        <div>
                            <div class="flex items-baseline gap-2 mb-1">
                                <h5 class="font-bold text-gray-900 dark:text-white">${authorName}</h5>
                                <span class="text-xs text-gray-500">${date}</span>
                            </div>
                            <p class="text-gray-700 dark:text-gray-300 text-sm whitespace-pre-line">${text}</p>
                        </div>
                    </div>
                `;
            });
        } catch (error) {
            console.error("Error loading comments:", error);
        }
    };

    loadNews();
});