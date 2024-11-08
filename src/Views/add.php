<?php
if (!isset($data) || !isset($data['categories'])) {
    die('Data not provided.');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = '➕ Create New Post - LihimBoard';
include 'partials/head.php';
?>
<?php

?>
<body>
    <main>
        <?php include 'partials/nav.php'; ?>
        <h3>Create New Post</h3>
        <?php if (isset($data['errors']) && !empty($data['errors'])) : ?>
            <div class="errors">
                <?php foreach ($data['errors'] as $error) : ?>
                    <p style="color:red"><?php echo htmlspecialchars($error); ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <form action="/store" method="post" enctype="multipart/form-data">
            <label for="title">📝 Title</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($data['title'] ?? ''); ?>" required>
            <label for="content">📜 Content:</label>
            <textarea id="content" name="content" required><?php echo htmlspecialchars($data['content'] ?? ''); ?></textarea>
            <label for="image_url">🖼️ Image</label>
            <input type="file" id="image_url" name="image_url" accept="image/jpeg, image/png, image/gif">
            <label for="category_id">📂 Category:</label>
            <select id="category_id" name="category_id" required>
                <option value="">Select a category</option>
                <?php
                foreach ($data['categories'] as $category) {
                    $selected = ($category['category_id'] == ($data['category_id'] ?? '')) ? 'selected' : '';
                    echo '<option value="' . htmlspecialchars($category['category_id'] ?? '') . '" ' . $selected . '>' . htmlspecialchars($category['name'] ?? '') . '</option>';
                }
                ?>
            </select>
            <label for="tripcode">🔑 Tripcode (optional):</label>
            <input type="text" id="tripcode" name="tripcode" value="<?php echo htmlspecialchars($data['tripcode'] ?? ''); ?>">
            <button type="submit">Submit</button>
        </form>
        <?php require 'partials/footer.php'; ?>
    </main>
</body>

</html>