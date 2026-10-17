<?php
// Check if the search query is set in the URL using GET
$search_query = "";
if (isset($_GET['query'])) {
    // Store the search input safely
    $search_query = $_GET['query'];
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>Search Form</title>
</head>
<body>
    <h2>Search System</h2>

    <!-- Search Form using GET method -->
    <form method="GET" action="">
        <label>Search:</label><br>
        <input type="text" name="query" required><br><br>
        <button type="submit">Search</button>
    </form>

    <hr>

    <!-- Display the search result if the query is not empty -->
    <?php if (!empty($search_query)): ?>
        <h3>Results for: <?php echo htmlspecialchars($search_query); ?></h3>
    <?php endif; ?>
</body>
</html>