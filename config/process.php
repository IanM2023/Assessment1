<?php
  session_start();
  $cons = require __DIR__ . "/db.php";
  if(isset($_POST['action']) && $_POST['action'] == "register") {
    register_user($_POST);
  }elseif(isset($_POST['action']) && $_POST['action'] == "login") {
    login_user($_POST);
  } else {
    session_destroy();
    header("Location: index.php");
    die();
  }

  function register_user($post) {
    global $cons;

    $_SESSION['errors'] = array();
    if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm_password']))  {
        $_SESSION['errors'][] = "Empty field cannot be empty!";
    } elseif(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors'][] = "Invalid Email Address";
    }elseif(strlen($_POST['password']) < 8 ) {
        $_SESSION['errors'][] = "Password must contain atleast 8 characters";
    }elseif(!preg_match("/[a-z]/i", $_POST['password'])) {
        $_SESSION['errors'][] = "Password must contain atleast one letter";
    }elseif(!preg_match("/[0-9]/", $_POST['password'])) {
        $_SESSION['errors'][] = "Password must contain atleast one number";
    }elseif($_POST['password'] !== $_POST['confirm_password']) {
        $_SESSION['errors'][] = "Password must match";
    }

    if(count($_SESSION['errors']) > 0 ) {
        header('Location: ../register.php');
        die();
    } else {
        
        $email = $_POST['email'];
        $sqlEmail = "SELECT id FROM users WHERE email=?";
        $checkEmail = $cons->prepare($sqlEmail); 
        if(!$checkEmail) {
            die("SQL error:" . $cons->error);
        }
        $checkEmail->bind_param("s", $email);
        $checkEmail->execute();
        $checkEmail->store_result();
        if($checkEmail->num_rows > 0) {
            $_SESSION['errors'][] = "Email is already taken";
            header("Location: ../register.php");
            exit();
        }
        $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name, email, password_hash) VALUES (?,?,?)";
        $stmt= $cons->prepare($sql);
        if(!$stmt) {
            die("SQL error:" . $cons->error);
        }
        $stmt->bind_param("sss", $_POST['name'],  $_POST['email'], $password_hash);
        if($stmt->execute()) {
            $_SESSION['success'] = "Sign up successfully, Login now!";
            header("Location: ../index.php");
            exit();
        } else {
            die("Failed to insert user: " . $cons->error);
        }
    }

  }

  function login_user($post) {
    global $cons;
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT id, name, password_hash FROM users WHERE email=?";
    $stmt = $cons->prepare($sql);
    if(!$stmt) {
        die("SQL error: " . $cons->error);
    }
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($user_id, $name, $stored_password_hash);
    $stmt->fetch();

    if(password_verify($password, $stored_password_hash)) {
        $_SESSION['user_id'] = $user_id;
        $_SESSION['name'] = $name;
        header("Location: ../home.php");
        exit();
    }else {
        $_SESSION['errors'][] = "Invalid or Email Password";
        header("Location: ../index.php");
        exit();
    }
  }


?>

