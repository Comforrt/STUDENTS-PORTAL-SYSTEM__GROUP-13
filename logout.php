<?php
// Start the session to access session variables
session_start();

// Destroy all session data (logs the user out)
session_destroy();

// Redirect user back to the home page
header("Location: index.php");
exit;
