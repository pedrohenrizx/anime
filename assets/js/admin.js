document.addEventListener('DOMContentLoaded', () => {
    const currentUser = Parse.User.current();

    if (!currentUser) {
        window.location.href = '/login';
        return;
    }

    const form = document.getElementById('news-form');
    const msgEl = document.getElementById('admin-message');

    // Only bind if the form exists (user is authenticated via PHP)
    if (!form) return;

    const showMessage = (msg, isError = false) => {
        msgEl.textContent = msg;
        msgEl.className = `p-4 rounded-md mb-6 font-medium ${isError ? 'bg-red-50 text-red-600' : 'bg-green-50 text-green-600'}`;
        msgEl.classList.remove('hidden');

        setTimeout(() => {
            msgEl.classList.add('hidden');
        }, 5000);
    };

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const title = document.getElementById('title').value;
        const category = document.getElementById('category').value;
        const imageUrl = document.getElementById('imageUrl').value;
        const summary = document.getElementById('summary').value;
        const content = document.getElementById('content').value;
        const tagsInput = document.getElementById('tags').value;

        const tags = tagsInput.split(',').map(t => t.trim()).filter(t => t);
        const slug = App.generateSlug(title);

        const btn = document.getElementById('submit-btn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Salvando...';

        try {
            const News = Parse.Object.extend("News");
            const newsItem = new News();

            newsItem.set("title", title);
            newsItem.set("slug", slug);
            newsItem.set("category", category);
            newsItem.set("imageUrl", imageUrl);
            newsItem.set("summary", summary);
            newsItem.set("content", content);
            newsItem.set("tags", tags);
            newsItem.set("author", currentUser);

            await newsItem.save();

            showMessage("Notícia publicada com sucesso!");
            form.reset();

        } catch (error) {
            console.error("Error saving news:", error);
            showMessage("Erro ao publicar notícia: " + error.message, true);
        } finally {
            btn.disabled = false;
            btn.textContent = 'Publicar Notícia';
        }
    });
});