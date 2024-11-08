<?php
date_default_timezone_set('Asia/Manila'); // Set your TimeZone
?>
<!DOCTYPE html>
<html lang="en">
<?php require 'partials/head.php'; ?>

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
            <ul>
                <select id="color-select" name="select" aria-label="Select Color Theme" required>
                    <option selected disabled value="">Select a Color</option>
                    <option value="red">Red 🌹</option>
                    <option value="pink">Pink 🌸</option>
                    <option value="fuchsia">Fuchsia 🌺</option>
                    <option value="purple">Purple 🍇</option>
                    <option value="violet">Violet 🔮</option>
                    <option value="indigo">Indigo 🌀</option>
                    <option value="blue">Blue 🌊</option>
                    <option value="cyan">Cyan 🌀</option>
                    <option value="jade">Jade 🍃</option>
                    <option value="green">Green 🌿</option>
                    <option value="lime">Lime 🍋</option>
                    <option value="yellow">Yellow 🐝</option>
                    <option value="amber">Amber 🍯</option>
                    <option value="pumpkin">Pumpkin 🎃</option>
                    <option value="orange">Orange 🍊</option>
                    <option value="sand">Sand 🏖️</option>
                    <option value="grey">Grey 🌫️</option>
                    <option value="zinc">Zinc ⚙️</option>
                </select>
            </ul>
        </nav>
        <h3>Maligayang Pagdating sa LihimBoard</h3>
        <h4>Mag-post sa Board</h4>
        <a href="/add">➕ Add a new post</a>
        <br>
        <br>
        <div class="container">
            <div class="left-side">
                <h3>👉 Pick a Category</h3>
                <ul>
                    <?php
                    foreach ($categories as $category) {
                        echo '<li><a href="/category/' . htmlspecialchars($category['category_id'] ?? '') . '">' . htmlspecialchars($category['name'] ?? '') . '</a></li>';
                    }
                    ?>
                </ul>
                <h3>🔥 Recent Posts</h3>
                <ul>
                <?php
                if (!empty($posts)) {
                    foreach ($posts as $post) {
                        $postId = htmlspecialchars($post['post_id'] ?? '');
                        $postTitle = htmlspecialchars($post['title'] ?? '');
                        $createdAt = $post['created_at'] ?? '';

                        // Calculate the time difference
                        if ($createdAt) {
                            $postDate = new DateTime($createdAt);
                            $currentDate = new DateTime();
                            $interval = $currentDate->diff($postDate);

                            if ($interval->y > 0) {
                                $timeAgo = $interval->y . ' year' . ($interval->y > 1 ? 's' : '') . ' ago';
                            } elseif ($interval->m > 0) {
                                $timeAgo = $interval->m . ' month' . ($interval->m > 1 ? 's' : '') . ' ago';
                            } elseif ($interval->d > 0) {
                                $timeAgo = $interval->d . ' day' . ($interval->d > 1 ? 's' : '') . ' ago';
                            } elseif ($interval->h > 0) {
                                $timeAgo = $interval->h . ' hour' . ($interval->h > 1 ? 's' : '') . ' ago';
                            } elseif ($interval->i > 0) {
                                $timeAgo = $interval->i . ' minute' . ($interval->i > 1 ? 's' : '') . ' ago';
                            } else {
                                $timeAgo = 'just now';
                            }
                        } else {
                            $timeAgo = '';
                        }

                        echo '<li><a href="/post?id=' . $postId . '">' . $postTitle . '</a> - ' . $timeAgo . '</li>';
                    }
                } else {
                    echo '<li>😢 No recent posts available.</li>';
                }
                ?>
                </ul>
            </div>
            <div class="right-side">
                <article>
                    <h3>🌟 Featured Post 🌟</h3>
                    <?php if (!empty($mostCommentedPost)) : ?>
                        <div class="featured-post">
                        <img src="<?php echo htmlspecialchars($mostCommentedPost['image_url'] ?? ''); ?>" alt="Featured Post Image" class="post-image" width="280px">
                        <div class="post-details">
                            <p>📅 
                                <?php
                                $createdAt = $mostCommentedPost['created_at'] ?? '';
                                if ($createdAt) {
                                    $date = new DateTime($createdAt);
                                    echo htmlspecialchars($date->format('F j, Y, g:i a'));
                                }
                                ?>
                            </p>
                            <p>📌 Title: <?php echo htmlspecialchars($mostCommentedPost['title'] ?? ''); ?></p>
                            <p>👤 Posted by: <?php echo htmlspecialchars($mostCommentedPost['tripcode'] ?? ''); ?></p>
                            <p>💬 Comments: <?php echo htmlspecialchars($mostCommentedPost['comment_count'] ?? '0'); ?></p>
                            <p>🔗 <a href="/post?id=<?php echo htmlspecialchars($mostCommentedPost['post_id'] ?? ''); ?>">View Post</a></p>
                        </div>
                    </div>
                    <?php else : ?>
                        <p>😢 No featured post available.</p>
                    <?php endif; ?>
                </article>
            </div>
        </div>
        <?php require 'partials/footer.php'; ?>
    </main>
</body>

</html>