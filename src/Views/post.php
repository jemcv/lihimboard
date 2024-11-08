<?php
if (!isset($data) || !isset($data['post'])) {
    die('Data not provided.');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = $data['post']['title'] ?? '💔 Post Not Found';
include 'partials/head.php';
?>

<body>
    <main>
        <nav>
            <ul>
                <li>
                    <a href="/">👻 LihimBoard</a>
                </li>
            </ul>
            <ul>
                <li>
                    <a href="/category/<?php echo htmlspecialchars($data['post']['category_id'] ?? ''); ?>">📂 View Category</a>
                </li>
                <li>
                    <button id="theme-toggle-button" onclick="toggleTheme()">🌞</button>
                </li>
            </ul>
        </nav>
        <div id="post">
            <blockquote><?php echo htmlspecialchars($data['post']['title'] ?? '💔 Post Not Found'); ?></blockquote>
            <?php if (!empty($data['post']['image_url'])) : ?>
                <img style="width: auto" src="<?php echo htmlspecialchars($data['post']['image_url'] ?? ''); ?>" alt="Post Image">
            <?php endif; ?>
            <article><?php echo htmlspecialchars($data['post']['content'] ?? ''); ?></article>
            <?php if (!empty($data['post']['tripcode'])) : ?>
                <p>👤 Posted by: lihim#<?php echo htmlspecialchars($data['post']['tripcode'] ?? ''); ?></p>
                <p> 📅
                    <?php
                    $createdAt = $data['post']['created_at'] ?? '';
                    if ($createdAt) {
                        $date = new DateTime($createdAt);
                        echo htmlspecialchars($date->format('F j, Y, g:i a'));
                    }
                    ?>
                </p>
            <?php endif; ?>
        </div>
        <h6>💬 Comments</h6>
        <div id="comments">
            <?php
            if (!empty($data['comments'])) {
                foreach ($data['comments'] as $comment) {
                    echo '<article class="comment">';
                    echo '<p>👻: ' . htmlspecialchars($comment['comment_text'] ?? '') . '</p>'; // Fixed line
                    echo '</article>';
                }
            } else {
                echo '<p>🤔 No comments yet.</p>';
            }
            ?>
        </div>
        <hr>
        <h4>✍️ Write a Comment</h4>
        <form action="/comment" method="POST">
            <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($data['post']['post_id'] ?? ''); ?>">
            <textarea name="comment_text" placeholder="Add a comment..." required></textarea>
            <button type="submit">Submit</button>
        </form>
    </main>
    <?php require 'partials/footer.php'; ?>
</body>

</html>