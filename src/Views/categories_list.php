<?php
if (!isset($data)) {
    die('Data not provided.');
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
$title = '📂 Categories - LihimBoard';
include 'partials/head.php';
?>

<body>
    <main>
        <?php include 'partials/nav.php'; ?>
        <h3>All Categories</h3>
        <ul>
            <?php
            foreach ($data['categories'] as $category) {
                echo '<li><a href="/category/' . htmlspecialchars($category['category_id'] ?? '') . '">' . htmlspecialchars($category['name'] ?? '') . '</a></li>';
            }
            ?>
        </ul>
    </main>
    <?php require 'partials/footer.php'; ?>
</body>

</html>