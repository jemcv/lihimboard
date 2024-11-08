<nav>
    <ul>
        <li>
            <a href="/" style="<?php echo $_SERVER['REQUEST_URI'] == '/' ? 'text-decoration: underline;' : ''; ?>">👻 LihimBoard</a>
        </li>
    </ul>
    <ul>
        <li>
            <a href="/add" style="<?php echo $_SERVER['REQUEST_URI'] == '/add' ? 'text-decoration: underline;' : ''; ?>">➕ Add Post</a>
        </li>
        <li>
            <a href="/categories" style="<?php echo $_SERVER['REQUEST_URI'] == '/categories' ? 'text-decoration: underline;' : ''; ?>">📂 Categories</a>
        </li>
        <li>
            <a href="/posts" style="<?php echo $_SERVER['REQUEST_URI'] == '/posts' ? 'text-decoration: underline;' : ''; ?>">📝 Posts</a>
        </li>
        <li>
            <a href="/search" style="<?php echo $_SERVER['REQUEST_URI'] == '/search' ? 'text-decoration: underline;' : ''; ?>">🔍 Search</a>
        </li>
        <li>
            <button id="theme-toggle-button" onclick="toggleTheme()">🌞</button>
        </li>
    </ul>
</nav>