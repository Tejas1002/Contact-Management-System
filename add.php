<?php include 'includes/db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $profilePic = $_FILES['profile_pic']['name'];
    $targetDir = 'images/';
    $targetFile = $targetDir . basename($profilePic);

    if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetFile)) {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, profile_pic) VALUES (:name, :email, :phone, :profile_pic)");
        $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'profile_pic' => $profilePic]);
        header("Location: index.php");
    } else {
        echo "Failed to upload profile picture.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Contact</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #EAF0F1; /* Light Grayish Green Background */
            color: #34495E; /* Dark Gray Text */
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 400px;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 1.5rem;
            color: #1ABC9C; /* Teal */
        }
        .form-control {
            border-radius: 5px;
        }
        .btn-success {
            background-color: #16A085; /* Darker Teal */
            border-color: #16A085;
        }
        .btn-success:hover {
            background-color: #1ABC9C; /* Teal */
            border-color: #1ABC9C;
        }
        .btn-secondary {
            background-color: #BDC3C7; /* Light Gray */
            border-color: #BDC3C7;
        }
        .btn-secondary:hover {
            background-color: #95A5A6; /* Slightly Darker Gray */
            border-color: #95A5A6;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Contact</h1>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control">
            </div>
            <div class="mb-3">
                <label for="profile_pic" class="form-label">Profile Picture</label>
                <input type="file" id="profile_pic" name="profile_pic" class="form-control">
            </div>
            <div class="btn-container">
                <button type="submit" class="btn btn-success w-100 me-2">Add</button>
                <a href="index.php" class="btn btn-secondary w-100">Cancel</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
