<?php
// Start the session to track user login state and store user information
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Character encoding for proper text display -->
    <meta charset="UTF-8">

    <!-- Title that appears on the browser tab -->
    <title>Student Portal - Home</title>

    <!-- Link to the external CSS stylesheet for page styling -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Header section containing the system title and navigation menu -->
    <header>
        <h1>Student Portal System</h1>

        <!-- Navigation bar -->
        <nav>

            <!-- Link to the home page -->
            <a href="index.php">Home</a>

            <!-- Check if the user is NOT logged in -->
            <?php if (!isset($_SESSION['name'])): ?>

                <!-- Show Register and Login links when the user is not logged in -->
                <a href="register.php">Register</a>
                <a href="login.php">Login</a>

            <?php else: ?>

                <!-- If the user IS logged in, show Dashboard and Logout links -->
                <a href="dashboard.php">Dashboard</a>
                <a href="logout.php">Logout</a>

            <?php endif; ?>
        </nav>
    </header>

    <!-- Main content section of the page -->
    <section>

        <!-- Check if the user is logged in -->
        <?php if (isset($_SESSION['name'])): ?>

            <!-- Display a welcome message using the user's name -->
            <h2>Welcome back, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>

            <!-- Display the email of the logged-in user -->
            <p>You are logged in with email: <?php echo htmlspecialchars($_SESSION['email']); ?>.</p>

            <!-- Link to the dashboard where users can manage their profile -->
            <p>
                <a href="dashboard.php">Manage your profile</a>
                (view your details, uploaded image, and settings).
            </p>

        <?php else: ?>

            <!-- Message shown when the user is not logged in -->
            <h2>Welcome to the Student Portal</h2>

            <!-- Brief description of the system -->
            <p>This portal allows students to register, log in, and manage their profile.</p>

            <!-- Links to register or login -->
            <p>Please <a href="register.php">register</a> if you are new, or <a href="login.php">login</a> if you already have an account.</p>

        <?php endif; ?>
    </section>

    <!-- Footer section -->
    <footer>

        <!-- Display the current year automatically -->
        <p>&copy; <?php echo date("Y"); ?> Student Portal System - Group 13</p>
    </footer>

</body>

</html>