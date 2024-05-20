<?php include 'config/database.php'; ?>

<?php
    session_start();
?>

<?php
    if(isset($_POST['submit'])){
    $password = $_POST['changepassword'];

    $sql1 = "SELECT * FROM members WHERE member_username = '{$_SESSION['username']}'";
    $result1 = mysqli_query($conn, $sql1);
    $row = $result1->fetch_assoc();
    $id = $row['member_id'];

    $sql="UPDATE members SET member_password = '$password' WHERE member_id =$id";
    $result=mysqli_query($conn,$sql);

    if($result){
        echo '<script>alert("Password Successfully Changed")</script>';
    }
    else{
        die(mysqli_error($conn));
    }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Account</title>
        <link rel="stylesheet" href="userprofile.css">
       <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
    <body>
        <div class="container">
        <nav>
            <h2>BSMS</h2><br>
        <ul>
         <li><a href="dashboard.php" class="logo">
                <i class="fas material-icons">home</i>
                <span class="nav-item">Dashboard</span>
            </a></li>
            <li><a href="attendance.php" class="logo">
                <i class="fas material-icons">date_range</i>
                <span class="nav-item">Attendance</span>
            </a></li>
            <li><a href="schedule.php" class="logo">
                <i class="fas material-icons">schedule</i>
                <span class="nav-item">Schedules</span>
            </a></li>
            <li><a href="userprofile.php" class="logo">
                <i class="fas material-icons">perm_identity</i>
                <span class="nav-item">Account</span>
            </a></li>
            <li><a href="logout.php" class="logo">
                <i class="fas material-icons">exit_to_app</i>
                <span class="nav-item">Logout</span>
            </a></li>
        </ul>
        </nav>

        <section class="main">
            <div class="main-top">
                <h1>Update Account Credentials</h1>
                <i class="fav material-icons">account_circle</i>
            </div>
            <div class="main-features">
                <div class="card">
                    <div class="edit-profile-left">
                        <form method="post">
                        <input type="text" name="changepassword" placeholder="Change Password" required>
                        </div>
                        <button class="main-button" name="submit">Submit</button>
                        </form> 
                </div>
            </div>
        </section>
        </div>


    </body>
</html>