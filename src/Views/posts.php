<!DOCTYPE html>
<html lang="en">
<?php
$title = "📝 All Posts - LihimBoard";
include 'partials/head.php';
?>

<body>
    <main>
        <?php include 'partials/nav.php'; ?>
        <h3>All Posts</h3>
        <?php if (!empty($posts)) : ?>
            <ul>
                <?php foreach ($posts as $post) : ?>
                    <article>
                        <li>
                            <p><a href="/post?id=<?= htmlspecialchars($post['post_id']) ?>"><?= htmlspecialchars($post['title']) ?></a></p>
                            <p><?= htmlspecialchars($post['content']) ?></p>
                            <?php if (!empty($post['image_url'])) : ?>
                                <img src="<?= htmlspecialchars($post['image_url']) ?>" alt="Post Image">
                            <?php endif; ?>
                            <?php if (!empty($post['tripcode'])) : ?>
                                <p>👤 Posted by: lihim#<?= htmlspecialchars($post['tripcode']) ?></p>
                                <p>
                                    📅
                                    <?php
                                    $createdAt = $post['created_at'] ?? '';
                                    if ($createdAt) {
                                        $date = new DateTime($createdAt);
                                        echo htmlspecialchars($date->format('F j, Y, g:i a'));
                                    }
                                    ?>
                                </p>
                                <p>
                            </p>
                            <?php endif; ?>
                        </li>
                    </article>
                <?php endforeach; ?>
            </ul>
        <?php else : ?>
            <p>😢 No posts available.</p>
        <?php endif; ?>
        <!-- Pagination Links -->
        <?php if ($totalPages > 1) : ?>
            <nav>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                        <li><a href="?page=<?= $i ?>" style="<?php echo isset($_GET['page']) && $_GET['page'] == $i ? 'text-decoration: underline;' : ''; ?>"><?= $i ?></a></li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </main>
    <?php require 'partials/footer.php'; ?>
</body>

</html>