<?php
session_start();
require_once __DIR__ . "/includes/config.php";
require_once __DIR__ . "/includes/functions.php";

if (empty($_SESSION["admin"])) {
    header("Location: admin_login.php");
    exit;
}

if (($_GET["action"] ?? "") === "logout") {
    unset($_SESSION["admin"]);
    session_destroy();
    header("Location: admin_login.php");
    exit;
}

if (isset($_GET["delete"])) {
    deleteUser($_GET["delete"]);
    header("Location: admin.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["old_email"])) {
    $newEmail = trim($_POST["email"]);
    $newName  = trim($_POST["name"]);
    updateUser($_POST["old_email"], ["email" => $newEmail, "name" => $newName]);
    header("Location: admin.php");
    exit;
}

$users = getUser();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f4f6f9; padding: 20px; }
        .table-container { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Admin Dashboard</h2>
        <a href="admin.php?action=logout" class="btn btn-danger">Logout</a>
    </div>

    <div class="table-container">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Date Created</th>
                    <th>Last Login</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $index => $u): ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo htmlspecialchars($u["name"] ?? "-"); ?></td>
                        <td><?php echo htmlspecialchars($u["email"] ?? "-"); ?></td>
                        <td>••••••••</td>
                        <td><?php echo htmlspecialchars($u["created_at"] ?? "-"); ?></td>
                        <td><?php echo htmlspecialchars($u["last_login"] ?? "Never"); ?></td>
                        
                        <td>
                            <form method="POST" class="d-flex gap-2">
                                <input type="hidden" name="old_email" value="<?php echo htmlspecialchars($u["email"] ?? ""); ?>">
                                <input type="text" name="name" class="form-control form-control-sm" value="<?php echo htmlspecialchars($u["name"] ?? ""); ?>" required style="width: 100px;">
                                <input type="email" name="email" class="form-control form-control-sm" value="<?php echo htmlspecialchars($u["email"] ?? ""); ?>" required style="width: 150px;">
                                <button type="submit" class="btn btn-sm btn-primary">Save</button>
                            </form>
                        </td>

                        <td>
                            <a href="admin.php?delete=<?php echo urlencode($u["email"] ?? ""); ?>" 
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Are you sure you want to delete this user?');">
                               Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <?php if (empty($users)): ?>
            <p class="text-center text-muted">No users found in the database.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>