<?php include 'includes/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Management System</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f8f9fa; /* Light gray background */
    }
    .container {
        max-width: 800px;
        margin-top: 50px;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .table img {
        width: 100px; /* Set width */
        height: 70px; /* Set height */
        object-fit: cover; /* Ensures the image fills the rectangle without distortion */
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
    }
</style>

</head>
<body>
    <div class="container">
        <h1>Contact Management System</h1>
        <div class="mb-3 text-end">
            <a href="add.php" class="btn btn-primary">Add New Contact</a>
        </div>
        <form method="GET" action="" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search contacts" value="<?php echo $_GET['search'] ?? ''; ?>">
                <button type="submit" class="btn btn-outline-secondary">Search</button>
            </div>
        </form>
        
        <?php
        $search = $_GET['search'] ?? '';
        $stmt = $conn->prepare("SELECT * FROM contacts WHERE name LIKE :search ORDER BY created_at DESC");
        $stmt->execute(['search' => "%$search%"]);
        $contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($contacts as $contact): ?>
                    <tr>
                        <td>
                            <img src="images/<?php echo $contact['profile_pic'] ?: 'default.png'; ?>" alt="Profile" width="50">
                        </td>
                        <td><?php echo htmlspecialchars($contact['name']); ?></td>
                        <td><?php echo htmlspecialchars($contact['email']); ?></td>
                        <td><?php echo htmlspecialchars($contact['phone']); ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $contact['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="delete.php?id=<?php echo $contact['id']; ?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
