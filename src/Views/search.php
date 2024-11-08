<!DOCTYPE html>
<html lang="en">
<?php
$title = "🔍 Search - LihimBoard";
include 'partials/head.php';
?>

<body>
    <main>
        <?php
        include 'partials/nav.php';
        ?>
        <form action="/search" method="GET">
            <label for="tripcode">
                <h3>Search by Tripcode:</h3>
            </label>
            <input type="text" id="tripcode" name="tripcode" required>
            <button type="submit">Search</button>
        </form>
        <?php if (!empty($posts)) : ?>
            <h3>Search Results:</h3>
            <ul>
                <?php foreach ($posts as $post) : ?>
                    <li>
                        <a href="/post?id=<?php echo htmlspecialchars($post['post_id']); ?>">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>💔 No posts found for this tripcode.</p>
        <?php endif; ?>
    </main>
    <?php require 'partials/footer.php'; ?>
</body>

</html>