<?php
     session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Register</title>
</head>
<body>
    <div class="container">
        <div class="box form-box">
<?php
            if(isset($_SESSION['errors'])) {
                foreach($_SESSION['errors'] as $errors) {
?>
                <span id="errors"><?= $errors; ?> </span>
<?php
                }
                unset($_SESSION['errors']);
?>
<?php
            }
?>

            <h1>Register</h1>
            <form action="config/process.php" method="POST">
                <div class="field input">
                    <input type="hidden" name="action" value="register">
                </div>
                <div class="field input">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                </div>
                <div class="field input">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                </div>
                <div class="field input">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" id="confirm_password">
                </div>
                <div class="field input">
                    <input type="submit" class="btn" name="submit" value="Register">
                </div>
                <div class="links">
                    Don't have an acount? <a href="index.php">Login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>