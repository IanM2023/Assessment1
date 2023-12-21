<?php
    include("config/function.php");
    if(!isset($_SESSION['user_id'])) {
        session_destroy();
        header("Location: index.php");
        die();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF 8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Add New Employee</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>
        <div class="right-links">
            <a href="update_profile.php"><button class="btn">Update profile</button></a>
            <a href="./logout.php">
                <button class="btn">Logout</button>
            </a>
        </div> 
    </div>
    <div class="container">
        <div class="box form-box1">
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
<?php
            if(isset($_SESSION['success'])) {
?>
                <span id="success"><?= $_SESSION['success']; ?> </span>
<?php
           
            }
            unset($_SESSION['success']);
            
?>
            <h1>Add New Employee</h1>
            <form action="config/function.php" method="POST">
                <div class="field input">
                    <input type="hidden" name="action" value="Add_employee">
                </div>
                <div class="field input">
                    <label for="First-Name">First Name</label>
                    <input type="text" name="fname" id="fname">
                </div>
                <div class="field input">
                    <label for="Last-Name">Last Name</label>
                    <input type="text" name="lname" id="lname">
                </div>
                <div class="field input">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email">
                </div>
                <div class="field input">
                    <label for="Job-Title">Job Title</label>
                    <input type="text" name="job_title" id="job_title">
                </div>
                <div class="field input">
                    <input type="submit" class="btn" name="submit" value="Click Add">
                </div>
            </form>
            <div class="links">
                <a href="home.php"><button class="btn">BACK</button></a>
            </div>
        </div>
    </div>
</body>
</html>