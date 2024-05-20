<?php include 'config/database.php';

session_start();

if(isset($_POST['submit'])){
    $taskname=$_POST['taskname'];
    $taskdate=$_POST['taskdate'];
    $taskdesc=$_POST['taskdesc'];

    $sql="INSERT INTO task(task_name, task_description, task_date) VALUES ('$taskname', '$taskdesc', '$taskdate')";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('location: /website/managetasks.php');
        echo '<script>alert("Task successfully Added")</script>'; 
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
        <title>Dashboard</title>
        <link rel="stylesheet" href="userprofile.css">
       <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
    <body>
        <div class="container">
        <nav>
        <h2>BSMS</h2><br>
        <ul>
            <li><a href="admindashboard.php" class="logo">
                <i class="fas material-icons">home</i>
                <span class="nav-item">Dashboard</span>
            </a></li>
            <li><a href="manageattendance.php" class="logo">
                <i class="fas material-icons">date_range</i>
                <span class="nav-item">Reports</span>
            </a></li>
            <li><a href="managetasks.php" class="logo">
                <i class="fas material-icons">description</i>
                <span class="nav-item">Manage Tasks</span>
            </a></li>
            <li><a href="managemembers.php" class="logo">
                <i class="fas material-icons">perm_identity</i>
                <span class="nav-item">Manage Members</span>
            </a></li>
            <li><a href="manageschedules.php" class="logo">
                <i class="fas material-icons">schedule</i>
                <span class="nav-item">Manage Schedules</span>
            </a></li>
            <li><a href="logout.php" class="logo">
                <i class="fas material-icons">exit_to_app</i>
                <span class="nav-item">Logout</span>
            </a></li>
        </ul>
        </nav>

        <section class="main">
            <div class="main-top">
                <h1>Add Task</h1>
                <i class="fav material-icons">account_circle</i>
            </div>
            <div class="main-features">
                <div class="card">
                    <div class="edit-profile-left">
                        <form  method="post">
                        <input type="text" name="taskname" placeholder="Task Name" required>
                        <input type="date" class="edit-profile-right" name="taskdate" placeholder="Task Date" required><br>
                        </div>
                        <div class="taskdesc">
                            <input type="text" class="taskdesc" name="taskdesc" placeholder="Task Description" required>
                        </div>
                    <button type="submit" class="main-button" name="submit">Submit</button>
                        </form>
                </div>
            </div>
        </section>
        </div>


    </body>
</html>