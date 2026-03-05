```php
<?php
// Start a session so user information can be stored and accessed across pages
session_start();

// Check if the registration form was submitted using POST method
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Retrieve the user's name from the form and sanitize it
    $name = htmlspecialchars($_POST['name']);

    // Retrieve the user's email and sanitize it
    $email = htmlspecialchars($_POST['email']);

    // Retrieve the user's password and sanitize it
    $password = htmlspecialchars($_POST['password']);


    // Folder where uploaded profile images will be stored
    $target_dir = "uploads/";

    // Full path of the uploaded file (uploads/filename)
    $target_file = $target_dir . basename($_FILES["profile"]["name"]);


    // Check if the uploads folder exists
    if (!is_dir($target_dir)) {

        // If it does not exist, create it with full permissions
        mkdir($target_dir, 0777, true);
    }

    // Verify that the uploaded file is actually an image
    $check = getimagesize($_FILES["profile"]["tmp_name"]);

    if ($check !== false) {

        // Move the uploaded file from temporary location to uploads folder
        if (move_uploaded_file($_FILES["profile"]["tmp_name"], $target_file)) {


            // Check if the data folder exists
            if (!is_dir("data")) {

                // Create the folder if it does not exist
                mkdir("data", 0777, true);
            }

            // Check if users.txt exists inside the data folder
            if (!file_exists("data/users.txt")) {

                // Create the file if it does not exist
                file_put_contents("data/users.txt", "");
            }


            // Prepare user data to be saved in the file
            // Format: name | email | password | profile image path
            $user_data = $name . "|" . $email . "|" . $password . "|" . $target_file . "\n";

            // Save the user data to users.txt (append so existing data is not deleted)
            file_put_contents("data/users.txt", $user_data, FILE_APPEND);


            // After successful registration, redirect the user to the login page
            header("Location: login.php");

            // Stop further execution of the script
            exit;
        } else {

            // Error message if the file could not be uploaded
            $error = "File upload failed. Please try again.";
        }
    } else {

        // Error message if the uploaded file is not an image
        $error = "Only image files are allowed. Please upload a valid profile picture.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Define character encoding -->
    <meta charset="UTF-8">

    <!-- Title displayed on the browser tab -->
    <title>Student Portal - Register</title>

    <!-- Link to external CSS stylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <!-- Header section containing the system title and navigation menu -->
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

        <!-- Page heading -->
        <h2>Student Registration</h2>

        <!-- Display error message if registration fails -->
        <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>

        <!-- Registration form -->
        <!-- enctype="multipart/form-data" allows file uploads -->
        <form method="POST" enctype="multipart/form-data">

            <!-- Name input field -->
            <label>Name:</label><br>
            <input type="text" name="name" required><br><br>

            <!-- Email input field -->
            <label>Email:</label><br>
            <input type="email" name="email" placeholder="username@gmail.com" required><br><br>

            <!-- Password input field -->
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>

            <!-- File input field for uploading profile image -->
            <label>Upload Profile Image:</label><br>
            <input type="file" name="profile" accept="image/*" required><br><br>

            <!-- Submit button to register the user -->
            <button type="submit">Register</button>
        </form>
    </section>

    <!-- Footer section -->
    <footer>

        <!-- Display the current year automatically -->
        <p>&copy; <?php echo date("Y"); ?> Student Portal System - Group 13</p>
    </footer>
</body>

</html>
```