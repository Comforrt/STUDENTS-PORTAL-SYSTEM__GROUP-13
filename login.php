```php
<?php
// Start a session so that user login information can be stored and accessed across pages
session_start();

// Check if the form was submitted using the POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the email entered by the user and convert special characters to prevent HTML injection
    $email = htmlspecialchars($_POST['email']);

    // Get the password entered by the user and sanitize it
    $password = htmlspecialchars($_POST['password']);

    // Safety check: make sure the users.txt file exists before trying to read it
    if (file_exists("data/users.txt")) {

        // Read the file into an array where each line represents a registered user
        $users = file("data/users.txt");
    } else {

        // If the file does not exist, create an empty array
        $users = [];
    }

    // Variable to check if a matching user account is found
    $found = false;

    // Loop through each user stored in users.txt
    foreach ($users as $user) {

        // Split each line into variables using "|" as the separator
        // Format stored in file: name | email | password | profile_image
        list($name, $u_email, $u_pass, $profile) = explode("|", trim($user));

        // Check if the entered email and password match the stored ones
        if ($email === $u_email && $password === $u_pass) {

            // Store user information in session variables so they stay logged in
            $_SESSION['name'] = $name;
            $_SESSION['email'] = $u_email;
            $_SESSION['profile'] = $profile;

            // Set found to true to indicate successful login
            $found = true;

            // Stop the loop once the correct user is found
            break;
        }
    }

    // If a matching user account was found
    if ($found) {

        // Redirect the user to the dashboard page
        header("Location: dashboard.php");

        // Stop script execution after redirect
        exit;
    } else {

        // If login credentials are incorrect, store an error message
        $error = "Invalid email or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Define character encoding -->
    <meta charset="UTF-8">

    <!-- Title displayed on the browser tab -->
    <title>Student Portal - Login</title>

    <!-- Link to external CSS file for styling -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Header section with system title and navigation menu -->
    <header>
        <h1>Student Portal System</h1>

        <nav>
            <!-- Navigation links -->
            <a href="index.php">Home</a>
            <a href="register.php">Register</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

    <!-- Main content section -->
    <section>

        <!-- Page title -->
        <h2>Student Login</h2>

        <!-- Display error message if login fails -->
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <!-- Login form -->
        <form method="POST">

            <!-- Email input field -->
            <label>Email:</label><br>
            <input type="email" name="email" placeholder="username@gmail.com" required><br><br>

            <!-- Password input field -->
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>

            <!-- Submit button to send login details -->
            <button type="submit">Login</button>
        </form>
    </section>

    <!-- Footer section -->
    <footer>

        <!-- Automatically display the current year -->
        <p>&copy; <?php echo date("Y"); ?> Student Portal System - Group 13</p>
    </footer>
</body>

</html>