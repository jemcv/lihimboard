<?php
if (!isset($data)) {
    die('Data not provided.');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = $data['category']['name'] ?? 'Category';
include 'partials/head.php';
?>

<body>
    <main>
        <?php include 'partials/nav.php'; ?>
        <?php if (!empty($data['category']['name'])) : ?>
            <h3>Posts in <?php echo htmlspecialchars($data['category']['name']); ?></h3>
            <div id="posts">
                <?php
                if (empty($data['posts'])) {
                    echo '<p>No posts yet.</p>';
                } else {
                    foreach ($data['posts'] as $post) {
                        echo '<details>';
                        echo '<summary><a href="/post?id=' . htmlspecialchars($post['post_id'] ?? '') . '">' . htmlspecialchars($post['title'] ?? '') . '</a></summary>';
                        echo '<p>' . htmlspecialchars($post['content'] ?? '') . '</p>';
                        if (!empty($post['image_url'])) {
                            echo '<img src="' . htmlspecialchars($post['image_url'] ?? '') . '" alt="Post Image">';
                        }
                        if (!empty($post['tripcode'])) {
                            echo '<p>👤 Posted by: ' . htmlspecialchars($post['tripcode'] ?? '') . '</p>';
                        }
                        echo '</details>';
                    }
                }
                ?>
            </div>
        <?php else : ?>
            <p>💔 Category not found.</p>
        <?php endif; ?>
    </main>
    <?php require 'partials/footer.php'; ?>
</body>

</html>