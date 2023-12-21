<?php
    // include("config/db.php");
    include("config/function.php");
    if(!isset($_SESSION['user_id'])) {
        header("Location: index.php");
        session_destroy();
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
    <title>Login</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">Logo</a></p>
        </div>
        <div class="right-links">
            <a href="update_profile.php?id=<?=$_SESSION['user_id']; ?>"><button class="btn">Update profile</button></a>
            <a href="./logout.php">
                <button class="btn">Logout</button>
            </a>
        </div> 
    </div>
    <main>
        <div class="main-box top">
            <div class="top">
                <div class="box">
                    <p>Welcome, <b><?= $_SESSION['name']; ?></b></p>
                </div>
            </div>
            <div class="bottom">
                <div class="box">
<?php
            if(isset($_SESSION['success'])) {
?>
                <p><span id="success" style="color:black"><?= $_SESSION['success']; ?></p></span>
<?php
            }
            unset($_SESSION['success']);
?>
                    <p><a href="add_employee.php"><button class="btn">ADD Employee</button></a></p>
<?php
                    $employees = get_employee_list();
                    // var_dump( $employees);
?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Email</th>
                            <th scope="col">Job Title</th>
                            <th scope="col">Created</th>
                            <th scope="col">Updated</th>
                            <th scope="col" class="centered-colspan" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
<?php                     if(empty($employees)) { ?>
                            <tr>
                                <td colspan="5">No Record Found</td>
                            </tr>
<?php                       } else { ?>
<?php
                            foreach($employees as $employeeData) {
?>
                            <tr>
                            <th scope="row"><?= $employeeData['fname'];?></th>
                            <td><?= $employeeData['lname'];?></td>
                            <td><?= $employeeData['email'];?></td>
                            <td><?= $employeeData['job_title'];?></td>
                            <td><?= date('d/m/Y h:i A', strtotime($employeeData['created_at']));?></td>
                            <td><?= (!empty($employeeData['updated_at']) ? date('d/m/Y h:i A', strtotime($employeeData['updated_at'])) : '-');?></td>
                            <td>
                                <a href="edit_employee.php?id=<?php echo $employeeData['id']; ?>"><button class='btn btn-edit'>Edit</button></a>
                            </td>
                            <td>
                            <a href="delete_employee.php?id=<?php echo $employeeData['id']; ?>"><button class='btn btn-delete'>Delete</button></a>
                            </td>
                            </tr>
<?php                       } }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</body>
</html>