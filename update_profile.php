<?php
    include("config/function.php");
    if(!isset($_SESSION['user_id'])) {
        session_destroy();
        header("Location: index.php");
        die();
    }
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $profile =  view_profile($id);

        if(!$profile) {
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
    <title>Update Profile</title>
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
            unset($_SESSION['success']);
            }
            
?>
            <h1>Update Profile</h1>
            <form action="config/function.php" method="POST">
                <div class="field input">
                    <input type="hidden" name="action" value="Update_profile">
                    <input type="hidden" name="id" value="<?= $profile['id']; ?>">
                </div>
                <div class="field input">
                    <label for="First-Name">Name</label>
                    <input type="text" name="name" id="name" value="<?= $profile['name'];?>">
                </div>
                <div class="field input">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" value="<?= $profile['email'];?>">
                </div>
                <div class="field input">
                    <input type="submit" class="btn" name="submit" value="Click Updates">
                </div>
            </form>
            <div class="links">
                <a href="home.php"><button class="btn">BACK</button></a>
            </div>
        </div>
    </div>
</body>
</html>