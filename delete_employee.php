<?php
    // include("config/db.php");
    include("config/function.php");
    if(!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        session_destroy();
        die();
    }
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $employeeData =  view_employee($id);

        if(!$employeeData) {
            header("Location: home.php");
            exit();
        }
    }else{
        header("Location: home.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF 8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>
        <div class="right-links">
            <a href="update_profile.php"><button class="btn">Update profile</button></a>
            <a href="./logout.php">
                <button class="btn">Delete Employee</button>
            </a>
        </div> 
    </div>
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
            <h4>Are you sure you want to delete this informations?</h4>
            <form action="config/function.php" method="POST">
                <div class="field input">
                    <input type="hidden" name="action" value="Delete_employee">
                    <input type="hidden" name="id" value="<?= $employeeData['id']; ?>">
                </div>
                <div class="field input">
                   <p>First Name: <em><?=  $employeeData['fname']; ?></em></p>
                   <p>Last Name: <em><?=  $employeeData['lname']; ?></em></p>
                   <p>Email Address: <em><?=  $employeeData['email']; ?></em></p>
                   <p>Job Title: <em><?=  $employeeData['job_title']; ?></em></p>
                </div>
                <div class="field input">
                    <input type="submit" class="btn btn-delete" name="submit" value="DELETE">
                </div>
            </form>
            <div class="links">
                <a href="home.php"><button class="btn">BACK</button></a>
            </div>
        </div>
    </div>
</body>
</html>