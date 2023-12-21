<?php
    session_start();
    include("db.php");

    if(isset($_POST['action']) && $_POST['action'] == "Add_employee") {
        add_employee($_POST);
    }

    if(isset($_POST['action']) && $_POST['action'] == "Update_employee") {
        update_employee($_POST);
    }

    if(isset($_POST['action']) && $_POST['action'] == "Delete_employee") {
        delete_employee($_POST);
    }

    if(isset($_POST['action']) && $_POST['action'] == "Update_profile") {
        update_profile($_POST);
    }

    function get_employee_list() {
        global $conn;

        $sql = "SELECT id, fname, lname, email, job_title, created_at, updated_at FROM sample_list ORDER BY fname DESC";
        $get_stmt = $conn->prepare($sql);
        if(!$get_stmt) {
            die("SQL error: " . $conn->error);
        }
        $get_stmt->execute();
        $result =$get_stmt->get_result();
        $employees = array();
        while($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        return  $employees;


    }

    function add_employee($add_employee) {
        global $conn;
        $fname = $conn->real_escape_string($add_employee['fname']);
        $lname = $conn->real_escape_string($add_employee['lname']);
        $emailAddress = $conn->real_escape_string($add_employee['email']);
        $jobTitle = $conn->real_escape_string($add_employee['job_title']);

        if(!filter_var($emailAddress, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../add_employee.php");
            $_SESSION['errors'][] = "Invalid Email";
            exit();
        }
        $sql = "INSERT INTO sample_list (fname, lname, email, job_title) VALUES (?,?,?,?)";
        $add_stmt = $conn->prepare($sql);
        if(!$add_stmt) {
            die("SQL error: " . $conn->error);
        }
        $add_stmt->bind_param("ssss", $fname, $lname, $emailAddress, $jobTitle);
        if($add_stmt->execute()) {
            header("Location: ../add_employee.php");
            $_SESSION['success'] = "New Employee Added";
            exit();
        } else {
            header("Location: ../add_employee.php");
            $_SESSION['errors'] = "Something went wrong";
            exit();
        }
        $conn->close();
        $add_stmt->close();
    }

    function update_employee($update_employee) {
        global $conn;
        $id = $conn->real_escape_string($update_employee['id']);
        $fname = $conn->real_escape_string($update_employee['fname']);
        $lname = $conn->real_escape_string($update_employee['lname']);
        $emailAddress = $conn->real_escape_string($update_employee['email']);
        $jobTitle = $conn->real_escape_string($update_employee['job_title']);

        $sql = "UPDATE sample_list SET fname=?, lname=?, email=?, job_title=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            die("SQL error: " . $conn->error);
        }
        $stmt->bind_param("ssssi", $fname, $lname, $emailAddress, $jobTitle, $id);
        if($stmt->execute()) {
            header("Location: ../edit_employee.php");
            $_SESSION['success'] = "Update Successfully";
            exit();
            $stmt->close();
            $conn->close();
        } else {
            header("Location: ../edit_employee.php");
            $_SESSION['errors'] = "Something went wrong";
            exit();
        }
    }

    function view_employee($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT id, fname, lname, email, job_title FROM sample_list WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $employeeData = $result->fetch_assoc();
            $stmt->close();
            return $employeeData;
        }else {
            $_SESSION['errors'] == "Profile not found";
            return false;
        }
    }
    function delete_employee($data) {
        global $conn;

        $id = $conn->real_escape_string($data['id']);
        $stmt = $conn->prepare("DELETE FROM sample_list WHERE id=?");
        $stmt->bind_param("i",$id);
        if($stmt->execute()) {
            $stmt->close();
            $conn->close();   
            header("Location: ../home.php");
            $_SESSION['success'] = "Delete Id Successfully";
        }else {
            echo "Error Deleting employee: " .$conn->error;
        }
    }

    /* ------------------------------- Profile ------------------------------ */

    function view_profile($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT id, name, email FROM users WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $employeeData = $result->fetch_assoc();
            $stmt->close();
            return $employeeData;
        }else {
            $_SESSION['errors'] == "Profile not found";
            return false;
        }
    }

    function update_profile($update_profile) {
        global $conn;
        $id = $conn->real_escape_string($update_profile['id']);
        $name = $conn->real_escape_string($update_profile['name']);
        $email = $conn->real_escape_string($update_profile['email']);

        $sql = "UPDATE users SET name=?, email=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        if(!$stmt) {
            die("SQL error: " . $conn->error);
        }
        $stmt->bind_param("ssi", $name, $email, $id);
        if($stmt->execute()) {
            $_SESSION['name'] = $name;
            header("Location: ../update_profile.php");
            $_SESSION['success'] = "Update Profile Successfully";
            exit();
            $stmt->close();
            $conn->close();
        } else {
            header("Location: ../update_profile.php");
            $_SESSION['errors'] = "Something went wrong";
            exit();
        }
    }


?>