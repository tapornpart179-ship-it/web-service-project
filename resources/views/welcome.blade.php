<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>NewsBit — มุมมองใหม่ของวันนี้</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: light;
            font-family: "DM Sans", "Leelawadee UI", sans-serif;
            color: #20352d;
            background: #f4f1e9;
            font-synthesis: none;
            --ink: #20352d;
            --deep: #173a30;
            --moss: #72856d;
            --lime: #d5e69a;
            --paper: #f4f1e9;
            --line: #e6e2d7;
            --muted: #788078;
            --white: #fffefa;
            --serif: "Playfair Display", Georgia, serif;
        }

        * { box-sizing: border-box; }
        body { min-width: 320px; margin: 0; background: var(--paper); }
        button, input, textarea, select { font: inherit; }
        button { cursor: pointer; }
        .topline { display: flex; justify-content: space-between; gap: 14px; padding: 10px max(5vw, calc((100vw - 1280px) / 2)); color: #d9e1d4; background: var(--deep); font-size: 11px; letter-spacing: .08em; text-transform: uppercase; }
        .topline strong { color: var(--lime); }
        .site-header { position: relative; z-index: 2; display: flex; justify-content: space-between; align-items: center; gap: 22px; padding: 20px max(5vw, calc((100vw - 1280px) / 2)); border-bottom: 1px solid var(--line); background: var(--paper); }
        .brand { color: var(--deep); font-family: var(--serif); font-size: 29px; font-weight: 700; letter-spacing: -.06em; }
        .brand span { color: #829548; }
        .header-actions { display: flex; align-items: center; gap: 12px; }
        .user-label { color: var(--muted); font-size: 13px; }
        .page { width: min(1280px, calc(100% - 48px)); margin: 38px auto 80px; }
        .hero { position: relative; display: grid; grid-template-columns: minmax(0, 1fr) 250px; align-items: center; gap: 34px; min-height: 340px; padding: clamp(30px, 5vw, 64px); margin-bottom: 50px; overflow: hidden; border-radius: 4px 80px 4px 4px; color: #f8f5e9; background: var(--deep); }
        .hero::before { position: absolute; top: -100px; right: 160px; width: 370px; height: 370px; border: 1px solid #ffffff1b; border-radius: 50%; content: ""; }
        .hero::after { position: absolute; top: -50px; right: 210px; width: 270px; height: 270px; border: 1px solid #ffffff1b; border-radius: 50%; content: ""; }
        .hero-copy, .hero-aside { position: relative; z-index: 1; }
        .hero-tag { display: inline-block; margin-bottom: 18px; padding: 7px 11px; border: 1px solid #d5e69a80; border-radius: 2px; color: var(--lime); font-size: 10px; font-weight: 700; letter-spacing: .17em; }
        .hero h1 { max-width: 720px; margin: 0 0 15px; font-family: var(--serif); font-size: clamp(38px, 6vw, 70px); font-weight: 600; letter-spacing: -.045em; line-height: 1.08; }
        .hero h1 em { color: var(--lime); font-weight: 600; }
        .hero p { max-width: 600px; margin: 0; color: #d0dbd0; font-size: 15px; line-height: 1.8; }
        .hero-aside { display: grid; justify-items: center; gap: 15px; padding: 20px; border-left: 1px solid #ffffff30; text-align: center; }
        .edition-mark { display: grid; width: 138px; aspect-ratio: 1; place-items: center; border: 1px solid #d5e69a; border-radius: 50%; color: var(--lime); font-family: var(--serif); font-size: 52px; line-height: 1; transform: rotate(-9deg); }
        .edition-label { color: #d0dbd0; font-size: 10px; letter-spacing: .15em; line-height: 1.8; text-transform: uppercase; }
        .toolbar { display: flex; flex-wrap: wrap; align-items: center; gap: 10px; padding: 14px; margin: 22px 0 35px; border: 1px solid var(--line); background: #ebe8dd; }
        .toolbar input, .toolbar select, .field input, .field textarea { min-height: 44px; padding: 10px 13px; border: 1px solid #d8d8cc; border-radius: 2px; outline: none; background: var(--white); color: var(--ink); }
        .toolbar input:focus, .toolbar select:focus, .field input:focus, .field textarea:focus { border-color: #84965b; box-shadow: 0 0 0 3px #84965b24; }
        .toolbar input { flex: 1 1 260px; }
        .toolbar select { flex: 0 1 190px; }
        .button { min-height: 42px; padding: 10px 17px; border: 1px solid var(--deep); border-radius: 2px; color: #f8f5e9; background: var(--deep); font-size: 13px; font-weight: 700; transition: .18s ease; }
        .button:hover { border-color: #315b4c; background: #315b4c; transform: translateY(-1px); }
        .button.secondary { border-color: #d5d8c9; color: var(--deep); background: transparent; }
        .button.secondary:hover { border-color: var(--deep); background: #ffffff80; }
        .button.danger { border-color: #a94a42; color: white; background: #a94a42; }
        .button.small { min-height: 32px; padding: 7px 10px; font-size: 11px; }
        .section-heading { display: flex; justify-content: space-between; align-items: end; gap: 12px; margin: 0 0 18px; }
        .section-heading h2 { margin: 0; color: var(--deep); font-family: var(--serif); font-size: 30px; font-weight: 600; letter-spacing: -.03em; }
        .section-heading .muted { padding-bottom: 4px; }
        .muted { color: var(--muted); font-size: 12px; }
        .notice { display: none; padding: 13px 16px; margin: 16px 0; border-left: 3px solid; line-height: 1.6; }
        .notice.visible { display: block; }
        .notice.error { border-color: #a94a42; color: #842f2a; background: #f7e6df; }
        .notice.success { border-color: #60805e; color: #315b4c; background: #e7eddd; }
        .news-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 15px; }
        .news-card { position: relative; display: flex; min-height: 100%; flex-direction: column; overflow: hidden; border: 1px solid var(--line); border-radius: 2px; background: var(--white); transition: border-color .2s, transform .2s, box-shadow .2s; }
        .news-card:hover { border-color: #bec8ae; box-shadow: 0 12px 30px #263b2b12; transform: translateY(-3px); }
        .news-card:first-child { grid-column: span 2; background: #e9ecdf; }
        .news-card img { width: 100%; height: 190px; object-fit: cover; background: #e5e7db; }
        .news-card:first-child img { height: 240px; }
        .news-card .card-body { display: flex; flex: 1; flex-direction: column; padding: 22px; }
        .news-card:first-child .card-body { padding: 27px 30px; }
        .category { align-self: flex-start; margin-bottom: 12px; color: #718348; font-size: 10px; font-weight: 700; letter-spacing: .15em; text-transform: uppercase; }
        .card-title { margin: 0 0 11px; color: var(--deep); font-family: var(--serif); font-size: 21px; font-weight: 600; letter-spacing: -.02em; line-height: 1.38; }
        .news-card:first-child .card-title { max-width: 680px; font-size: clamp(24px, 3vw, 34px); }
        .card-excerpt { flex: 1; margin: 0 0 20px; color: #68736b; font-size: 13px; line-height: 1.8; white-space: pre-line; }
        .card-meta { display: flex; justify-content: space-between; align-items: center; gap: 8px; padding-top: 13px; border-top: 1px solid var(--line); color: #81877e; font-size: 11px; }
        .card-actions { display: flex; flex-wrap: wrap; gap: 7px; margin-top: 13px; }
        .favorite { min-width: 36px; color: #708248 !important; }
        .empty-state { grid-column: 1 / -1; padding: 50px 20px; border: 1px dashed #c8cbbd; color: #69756c; text-align: center; background: #fffefa80; }
        .modal { position: fixed; inset: 0; z-index: 10; display: none; align-items: center; justify-content: center; overflow-y: auto; padding: 20px; background: #10231dcc; backdrop-filter: blur(5px); }
        .modal.open { display: flex; }
        .modal-panel { position: relative; width: min(620px, 100%); max-height: 90vh; overflow-y: auto; padding: 30px; border: 1px solid #e5e0d4; background: var(--white); box-shadow: 0 25px 90px #10231d66; }
        .modal-panel h2 { margin: 0 35px 18px 0; color: var(--deep); font-family: var(--serif); font-size: 27px; }
        .close-button { position: absolute; top: 13px; right: 15px; width: 36px; height: 36px; border: 1px solid var(--line); color: var(--deep); background: transparent; font-size: 23px; }
        .field { display: grid; gap: 6px; margin: 14px 0; }
        .field label { color: var(--deep); font-size: 12px; font-weight: 700; }
        .field textarea { min-height: 125px; resize: vertical; }
        .form-actions { display: flex; justify-content: flex-end; gap: 9px; margin-top: 18px; }
        .article-image { display: block; width: 100%; max-height: 300px; margin: 0 0 18px; object-fit: cover; background: #e5e7db; }
        #modal-meta { margin: -8px 0 18px; color: var(--muted); font-size: 12px; }
        #modal-content { color: #46574c; line-height: 1.9; white-space: pre-line; }
        @media (max-width: 850px) {
            .news-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .news-card:first-child { grid-column: span 2; }
            .hero { grid-template-columns: minmax(0, 1fr) 190px; }
            .edition-mark { width: 110px; font-size: 43px; }
        }
        @media (max-width: 600px) {
            .topline { justify-content: center; text-align: center; }
            .topline span { display: none; }
            .site-header { align-items: flex-start; flex-direction: column; padding-top: 15px; padding-bottom: 15px; }
            .header-actions { width: 100%; justify-content: space-between; gap: 8px; }
            .page { width: min(100% - 28px, 480px); margin-top: 20px; }
            .hero { grid-template-columns: 1fr; gap: 23px; min-height: auto; padding: 28px 23px; border-radius: 3px 45px 3px 3px; }
            .hero h1 { font-size: 42px; }
            .hero-aside { display: flex; justify-content: flex-start; align-items: center; padding: 16px 0 0; border-top: 1px solid #ffffff30; border-left: 0; text-align: left; }
            .edition-mark { width: 58px; font-size: 25px; }
            .toolbar { padding: 10px; }
            .toolbar input, .toolbar select { flex: 1 1 100%; }
            .toolbar .button { flex: 1; }
            .news-grid { grid-template-columns: 1fr; }
            .news-card:first-child { grid-column: auto; }
            .news-card:first-child .card-body { padding: 22px; }
            .news-card:first-child .card-title { font-size: 25px; }
            .section-heading { align-items: flex-start; flex-direction: column; }
            .modal-panel { padding: 24px 20px; }
        }
    </style>
</head>
<body>
    <div class="topline">
        <strong>NEWSBIT JOURNAL</strong>
        <span>Independent stories · Digital culture · Issue 01 / 2026</span>
    </div>
    <header class="site-header">
        <div class="brand">NEWS<span>BIT</span></div>
        <div class="header-actions">
            <span class="user-label" id="user-label">ยังไม่ได้เข้าสู่ระบบ</span>
            <button class="button" id="auth-button" type="button">เข้าสู่ระบบ</button>
            <button class="button secondary" id="logout-button" type="button" hidden>ออกจากระบบ</button>
        </div>
    </header>

    <main class="page">
        <section class="hero">
            <div class="hero-copy">
                <span class="hero-tag">A LITTLE MORE PERSPECTIVE</span>
                <h1>เรื่องราวของโลก<br>ในมุมที่ <em>ต่างออกไป</em></h1>
                <p>คัดสรรข่าว เทคโนโลยี และไอเดียใหม่ ๆ มาเล่าให้ฟังอย่างเข้าใจง่าย อ่านสบาย และเปิดมุมมองใหม่ในทุกวัน</p>
            </div>
            <aside class="hero-aside" aria-label="ฉบับประจำปี">
                <div class="edition-mark">01</div>
                <div class="edition-label">THE DAILY EDIT<br>Curiosity, collected.</div>
            </aside>
        </section>

        <div class="notice" id="notice" role="status" aria-live="polite"></div>

        <div class="toolbar">
            <input id="search-input" type="search" placeholder="ค้นหาหัวข้อ เนื้อหา หรือผู้เขียน..." aria-label="ค้นหาข่าว">
            <select id="category-filter" aria-label="กรองตามหมวดหมู่">
                <option value="">ทุกหมวดหมู่</option>
            </select>
            <button class="button secondary" id="favorites-filter" type="button" aria-pressed="false">♡ ข่าวที่บันทึกไว้</button>
            <button class="button" id="add-button" type="button" hidden>＋ เพิ่มข่าว</button>
        </div>

        <div class="section-heading" id="latest">
            <h2>ข่าวสารล่าสุด</h2>
            <span class="muted" id="result-count">กำลังเชื่อมต่อ API...</span>
        </div>
        <section class="news-grid" id="news-grid" aria-live="polite">
            <div class="empty-state">กำลังโหลดข่าวจาก API...</div>
        </section>
    </main>

    <div class="modal" id="login-modal" role="dialog" aria-modal="true" aria-labelledby="login-title">
        <div class="modal-panel">
            <button class="close-button" type="button" data-close="login-modal" aria-label="ปิด">&times;</button>
            <h2 id="login-title">เข้าสู่ระบบเพื่อจัดการข่าว</h2>
            <p class="muted">ใช้บัญชีผู้ใช้ของระบบ Laravel เพื่อรับ Sanctum API Token</p>
            <form id="login-form">
                <div class="field">
                    <label for="login-email">อีเมล</label>
                    <input id="login-email" name="email" type="email" autocomplete="username" required>
                </div>
                <div class="field">
                    <label for="login-password">รหัสผ่าน</label>
                    <input id="login-password" name="password" type="password" autocomplete="current-password" required>
                </div>
                <div class="notice" id="login-error" role="alert"></div>
                <div class="form-actions">
                    <button class="button secondary" type="button" data-close="login-modal">ยกเลิก</button>
                    <button class="button" type="submit">เข้าสู่ระบบและรับ Token</button>
                </div>
            </form>
            <p class="muted">ยังไม่มีบัญชี? <a href="/register">สมัครสมาชิก</a></p>
        </div>
    </div>

    <div class="modal" id="article-form-modal" role="dialog" aria-modal="true" aria-labelledby="article-form-title">
        <div class="modal-panel">
            <button class="close-button" type="button" data-close="article-form-modal" aria-label="ปิด">&times;</button>
            <h2 id="article-form-title">เพิ่มข่าว</h2>
            <form id="article-form">
                <input id="article-id" type="hidden">
                <div class="field">
                    <label for="article-title">หัวข้อข่าว</label>
                    <input id="article-title" name="title" maxlength="255" required>
                </div>
                <div class="field">
                    <label for="article-content">เนื้อหา</label>
                    <textarea id="article-content" name="content" required></textarea>
                </div>
                <div class="field">
                    <label for="article-category">หมวดหมู่</label>
                    <input id="article-category" name="category" maxlength="255" required>
                </div>
                <div class="field">
                    <label for="article-author">ผู้เขียน</label>
                    <input id="article-author" name="author" maxlength="255">
                </div>
                <div class="field">
                    <label for="article-image">URL รูปภาพ (ไม่บังคับ)</label>
                    <input id="article-image" name="image_url" type="url" maxlength="2048">
                </div>
                <div class="notice" id="article-form-error" role="alert"></div>
                <div class="form-actions">
                    <button class="button secondary" type="button" data-close="article-form-modal">ยกเลิก</button>
                    <button class="button" type="submit">บันทึกผ่าน API</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal" id="detail-modal" role="dialog" aria-modal="true" aria-labelledby="modal-title">
        <article class="modal-panel">
            <button class="close-button" type="button" data-close="detail-modal" aria-label="ปิด">&times;</button>
            <img class="article-image" id="modal-image" alt="" hidden>
            <span class="category" id="modal-category"></span>
            <h2 id="modal-title"></h2>
            <p id="modal-meta"></p>
            <div id="modal-content"></div>
        </article>
    </div>

    <script>
        const apiBase = '/api';
        const tokenKey = 'newsbit_api_token';
        const userKey = 'newsbit_api_user';
        const favoriteKey = 'newsbit_favorite_articles';
        let articles = [];
        let showingFavorites = false;
        let noticeTimer;

        const elements = {
            newsGrid: document.getElementById('news-grid'),
            resultCount: document.getElementById('result-count'),
            search: document.getElementById('search-input'),
            category: document.getElementById('category-filter'),
            notice: document.getElementById('notice'),
            authButton: document.getElementById('auth-button'),
            logoutButton: document.getElementById('logout-button'),
            userLabel: document.getElementById('user-label'),
            addButton: document.getElementById('add-button'),
            favoritesButton: document.getElementById('favorites-filter'),
        };

        function getToken() {
            return sessionStorage.getItem(tokenKey);
        }

        function getFavorites() {
            try {
                const stored = JSON.parse(localStorage.getItem(favoriteKey) || '[]');
                return Array.isArray(stored) ? stored.map(String) : [];
            } catch (error) {
                console.error('อ่านรายการข่าวที่บันทึกไว้ไม่สำเร็จ', error);
                return [];
            }
        }

        function showNotice(message, type = 'success') {
            clearTimeout(noticeTimer);
            elements.notice.textContent = message;
            elements.notice.className = `notice visible ${type}`;
            noticeTimer = setTimeout(() => {
                elements.notice.className = 'notice';
            }, 5000);
        }

        function showFormError(element, message) {
            element.textContent = message;
            element.className = 'notice visible error';
        }

        async function apiRequest(path, options = {}) {
            const headers = {
                Accept: 'application/json',
                ...(options.body ? { 'Content-Type': 'application/json' } : {}),
                ...(getToken() ? { Authorization: `Bearer ${getToken()}` } : {}),
                ...options.headers,
            };

            const response = await fetch(`${apiBase}${path}`, { ...options, headers });
            const payload = await response.json().catch(() => ({}));

            if (!response.ok) {
                if (response.status === 401 && getToken()) {
                    sessionStorage.removeItem(tokenKey);
                    sessionStorage.removeItem(userKey);
                    updateAuthUi();
                }

                const validationMessage = payload.errors
                    ? Object.values(payload.errors).flat().join(' ')
                    : '';
                throw new Error(validationMessage || payload.message || `คำขอ API ล้มเหลว (${response.status})`);
            }

            return payload;
        }

        function updateAuthUi() {
            const authenticated = Boolean(getToken());
            const user = sessionStorage.getItem(userKey);
            elements.authButton.hidden = authenticated;
            elements.logoutButton.hidden = !authenticated;
            elements.addButton.hidden = !authenticated;
            elements.userLabel.textContent = authenticated && user ? `เข้าสู่ระบบ: ${user}` : 'ยังไม่ได้เข้าสู่ระบบ';
            renderArticles();
        }

        function updateCategories() {
            const selected = elements.category.value;
            const categories = [...new Set(articles.map(article => article.category).filter(Boolean))].sort();
            elements.category.replaceChildren(new Option('ทุกหมวดหมู่', ''));
            categories.forEach(category => elements.category.add(new Option(category, category)));
            elements.category.value = categories.includes(selected) ? selected : '';
        }

        function createButton(label, className, onClick, ariaLabel = label) {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = className;
            button.textContent = label;
            button.setAttribute('aria-label', ariaLabel);
            button.addEventListener('click', onClick);
            return button;
        }

        function renderArticles() {
            const query = elements.search.value.trim().toLocaleLowerCase();
            const category = elements.category.value;
            const favorites = getFavorites();
            const filtered = articles.filter(article => {
                const matchesQuery = [article.title, article.content, article.author, article.category]
                    .some(value => String(value || '').toLocaleLowerCase().includes(query));
                const matchesCategory = !category || article.category === category;
                const matchesFavorite = !showingFavorites || favorites.includes(String(article.id));
                return matchesQuery && matchesCategory && matchesFavorite;
            });

            elements.newsGrid.replaceChildren();
            elements.resultCount.textContent = `แสดง ${filtered.length} จาก ${articles.length} ข่าว`;

            if (filtered.length === 0) {
                const empty = document.createElement('div');
                empty.className = 'empty-state';
                empty.textContent = articles.length
                    ? 'ไม่พบข่าวที่ตรงกับตัวกรอง ลองเปลี่ยนคำค้นหรือหมวดหมู่'
                    : 'ยังไม่มีข่าวในระบบ';
                elements.newsGrid.append(empty);
                return;
            }

            filtered.forEach(article => {
                const card = document.createElement('article');
                card.className = 'news-card';

                if (article.image_url) {
                    const image = document.createElement('img');
                    image.src = article.image_url;
                    image.alt = article.title;
                    image.loading = 'lazy';
                    image.addEventListener('error', () => image.remove(), { once: true });
                    card.append(image);
                }

                const body = document.createElement('div');
                body.className = 'card-body';
                const categoryLabel = document.createElement('span');
                categoryLabel.className = 'category';
                categoryLabel.textContent = article.category || 'ทั่วไป';
                const title = document.createElement('h3');
                title.className = 'card-title';
                title.textContent = article.title;
                const excerpt = document.createElement('p');
                excerpt.className = 'card-excerpt';
                excerpt.textContent = article.content.length > 150
                    ? `${article.content.slice(0, 150)}...`
                    : article.content;
                const meta = document.createElement('div');
                meta.className = 'card-meta';
                const author = document.createElement('span');
                author.textContent = `โดย ${article.author || 'Admin'}`;
                const id = document.createElement('span');
                id.textContent = `ID: ${article.id}`;
                meta.append(author, id);

                const actions = document.createElement('div');
                actions.className = 'card-actions';
                actions.append(createButton('อ่านรายละเอียด', 'button small secondary', () => readArticle(article.id)));

                const isFavorite = favorites.includes(String(article.id));
                actions.append(createButton(
                    isFavorite ? '♥ บันทึกแล้ว' : '♡ บันทึกข่าว',
                    'button small secondary favorite',
                    () => toggleFavorite(article.id),
                    isFavorite ? 'นำออกจากข่าวที่บันทึกไว้' : 'บันทึกข่าวนี้ไว้'
                ));

                if (getToken()) {
                    actions.append(
                        createButton('แก้ไข', 'button small secondary', () => openArticleForm(article)),
                        createButton('ลบ', 'button small danger', () => deleteArticle(article.id))
                    );
                }

                body.append(categoryLabel, title, excerpt, meta, actions);
                card.append(body);
                elements.newsGrid.append(card);
            });
        }

        async function loadArticles() {
            elements.newsGrid.innerHTML = '<div class="empty-state">กำลังโหลดข่าวจาก API...</div>';
            try {
                const result = await apiRequest('/articles');
                articles = result.data;
                updateCategories();
                renderArticles();
            } catch (error) {
                elements.newsGrid.replaceChildren();
                const failure = document.createElement('div');
                failure.className = 'empty-state';
                failure.textContent = `โหลดข่าวไม่สำเร็จ: ${error.message}`;
                elements.newsGrid.append(failure);
                elements.resultCount.textContent = 'เชื่อมต่อ API ไม่สำเร็จ';
            }
        }

        async function readArticle(id) {
            try {
                const result = await apiRequest(`/articles/${encodeURIComponent(id)}`);
                const article = result.data;
                document.getElementById('modal-category').textContent = article.category || 'ทั่วไป';
                document.getElementById('modal-title').textContent = article.title;
                document.getElementById('modal-meta').textContent =
                    `ผู้เขียน: ${article.author || 'Admin'} · ID: ${article.id}`;
                document.getElementById('modal-content').textContent = article.content;

                const image = document.getElementById('modal-image');
                image.hidden = !article.image_url;
                image.src = article.image_url || '';
                image.alt = article.title;
                image.onerror = () => { image.hidden = true; };
                openModal('detail-modal');
            } catch (error) {
                showNotice(`โหลดรายละเอียดข่าวไม่สำเร็จ: ${error.message}`, 'error');
            }
        }

        function toggleFavorite(id) {
            const favorites = getFavorites();
            const key = String(id);
            const next = favorites.includes(key)
                ? favorites.filter(favoriteId => favoriteId !== key)
                : [...favorites, key];
            localStorage.setItem(favoriteKey, JSON.stringify(next));
            renderArticles();
        }

        function openModal(id) {
            document.getElementById(id).classList.add('open');
        }

        function closeModal(id) {
            document.getElementById(id).classList.remove('open');
        }

        function openArticleForm(article = null) {
            if (!getToken()) {
                openModal('login-modal');
                return;
            }

            document.getElementById('article-form').reset();
            document.getElementById('article-form-error').className = 'notice';
            document.getElementById('article-form-title').textContent = article ? 'แก้ไขข่าว' : 'เพิ่มข่าว';
            document.getElementById('article-id').value = article ? article.id : '';
            document.getElementById('article-title').value = article ? article.title : '';
            document.getElementById('article-content').value = article ? article.content : '';
            document.getElementById('article-category').value = article ? article.category : '';
            document.getElementById('article-author').value = article ? article.author || '' : '';
            document.getElementById('article-image').value = article ? article.image_url || '' : '';
            openModal('article-form-modal');
        }

        async function deleteArticle(id) {
            const article = articles.find(item => String(item.id) === String(id));
            if (!window.confirm(`ยืนยันลบข่าว "${article ? article.title : id}" หรือไม่?`)) {
                return;
            }

            try {
                const result = await apiRequest(`/articles/${encodeURIComponent(id)}`, { method: 'DELETE' });
                showNotice(result.message || 'ลบข่าวสำเร็จ');
                await loadArticles();
            } catch (error) {
                showNotice(`ลบข่าวไม่สำเร็จ: ${error.message}`, 'error');
            }
        }

        document.getElementById('login-form').addEventListener('submit', async event => {
            event.preventDefault();
            const loginForm = event.currentTarget;
            const errorBox = document.getElementById('login-error');
            errorBox.className = 'notice';
            const form = new FormData(loginForm);

            try {
                const result = await apiRequest('/login', {
                    method: 'POST',
                    body: JSON.stringify({
                        email: form.get('email'),
                        password: form.get('password'),
                    }),
                });
                sessionStorage.setItem(tokenKey, result.token);
                sessionStorage.setItem(userKey, result.user.name || result.user.email);
                loginForm.reset();
                closeModal('login-modal');
                updateAuthUi();
                showNotice('เข้าสู่ระบบสำเร็จ ได้รับ Sanctum API Token แล้ว');
            } catch (error) {
                showFormError(errorBox, error.message);
            }
        });

        document.getElementById('article-form').addEventListener('submit', async event => {
            event.preventDefault();
            const form = new FormData(event.currentTarget);
            const id = document.getElementById('article-id').value;
            const payload = Object.fromEntries(form.entries());
            payload.author = payload.author.trim() || null;
            payload.image_url = payload.image_url.trim() || null;
            const path = id ? `/articles/${encodeURIComponent(id)}` : '/articles';

            try {
                const result = await apiRequest(path, {
                    method: id ? 'PUT' : 'POST',
                    body: JSON.stringify(payload),
                });
                closeModal('article-form-modal');
                showNotice(result.message || (id ? 'แก้ไขข่าวสำเร็จ' : 'เพิ่มข่าวสำเร็จ'));
                await loadArticles();
            } catch (error) {
                showFormError(document.getElementById('article-form-error'), error.message);
            }
        });

        elements.authButton.addEventListener('click', () => openModal('login-modal'));
        elements.logoutButton.addEventListener('click', async () => {
            try {
                const result = await apiRequest('/logout', { method: 'POST' });
                sessionStorage.removeItem(tokenKey);
                sessionStorage.removeItem(userKey);
                updateAuthUi();
                showNotice(result.message || 'ออกจากระบบสำเร็จ');
            } catch (error) {
                showNotice(`ออกจากระบบไม่สำเร็จ: ${error.message}`, 'error');
            }
        });
        elements.addButton.addEventListener('click', () => openArticleForm());
        elements.search.addEventListener('input', renderArticles);
        elements.category.addEventListener('change', renderArticles);
        elements.favoritesButton.addEventListener('click', () => {
            showingFavorites = !showingFavorites;
            elements.favoritesButton.setAttribute('aria-pressed', String(showingFavorites));
            elements.favoritesButton.textContent = showingFavorites ? '♥ แสดงข่าวทั้งหมด' : '♡ ข่าวที่บันทึกไว้';
            renderArticles();
        });
        document.querySelectorAll('[data-close]').forEach(button => {
            button.addEventListener('click', () => closeModal(button.dataset.close));
        });
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('click', event => {
                if (event.target === modal) {
                    closeModal(modal.id);
                }
            });
        });
        document.addEventListener('keydown', event => {
            if (event.key === 'Escape') {
                document.querySelectorAll('.modal.open').forEach(modal => closeModal(modal.id));
            }
        });

        updateAuthUi();
        loadArticles();
    </script>
</body>
</html>
