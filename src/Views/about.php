<!DOCTYPE html>
<html lang="en">
<?php
$title = '❓ About - LihimBoard';
include 'partials/head.php';
?>

<body>
    <main>
        <nav>
            <ul>
                <li>
                    <a href="/" style="<?php echo $_SERVER['REQUEST_URI'] == '/' ? 'text-decoration: underline;' : ''; ?>">👻 LihimBoard</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="/about" style="<?php echo $_SERVER['REQUEST_URI'] == '/about' ? 'text-decoration: underline;' : ''; ?>">❓ About</a>
                </li>
                <li>
                    <button id="theme-toggle-button" onclick="toggleTheme()">🌞</button>
                </li>
            </ul>
        </nav>
        <section>
            <h3>👋 Introduction</h3>
            <p>Hello! My name is Jem. I am a recent IT graduate currently looking for a job. This project serves as a reviewer for practicing the MVC design pattern using PHP from scratch.</p>
        </section>
        <h3>📜 About the Project</h3>
        <p>This project is an imageboard application built from the ground up using PHP. It follows the <a href="https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller">MVC</a> design pattern to ensure a clean separation of concerns and maintainability. The following are its features:</p>
        <ul>
            <li>🕵️ Anonymous Posting</li>
            <li>🔑 Tripcode Identification for Users</li>
            <li>💬 Commenting System</li>
            <li>📂 Category-based Posts</li>
            <li>📄 Pagination for Posts</li>
            <li>👀 View All Posts</li>
            <li>⭐ Featured Post</li>
            <li>🔍 Search Post</li>
            <li>🎨 Color Themes / Dark Mode</li>
        </ul>
        <h3>🔧 How it works:</h3>
        <p>The imageboard allows users to post anonymously under various categories, using a tripcode for optional identification. Each post can have comments, enabling interaction between users. Users can also view all posts across categories and easily engage with the content through comments.</p>
        <p>A tripcode is a hashed version of a password that allows for user identification without storing any personal data.</p>
        <p>For more information, you can look at the <a href="https://en.wikipedia.org/wiki/Imageboard">imageboard</a></p>
        <p>Repository link: 🗃️ <a href="https:github.com/jemcv/lihimboard">jemcv/lihimboard</a></p>
    </main>
    <?php require 'partials/footer.php'; ?>
</body>

</html>