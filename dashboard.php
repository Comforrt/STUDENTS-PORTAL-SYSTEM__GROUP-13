<?php
// Start session to access user data
session_start();

// If user is not logged in, redirect to login page
if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Portal - Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <header>
        <h1>Student Portal Dashboard</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="dashboard.php">Dashboard</a>
            <!-- Logout link in navigation -->
            <a href="logout.php">Logout</a>
        </nav>
    </header>

    <section>
        <!-- Personalized welcome message -->
        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
        <p>Email: <?php echo htmlspecialchars($_SESSION['email']); ?></p>

        <!-- Display uploaded profile image -->
        <p>Your Profile Image:</p>
        <img src="<?php echo $_SESSION['profile']; ?>" width="150" alt="Profile Image"><br><br>

        <!-- Logout link inside dashboard content -->
        <a href="logout.php">Logout</a>
    </section>

    <footer>
        <!-- footer display's current year and group name -->
        <p>&copy; <?php echo date("Y"); ?> Student Portal System - Group 13</p>
    </footer>
</body>

</html>