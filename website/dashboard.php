<?php include 'config/database.php'; ?>

<?php
    session_start();
?>



<?php

    $sql1 = "SELECT * FROM members WHERE member_username = '{$_SESSION['username']}'";
    $result1 = mysqli_query($conn, $sql1);
    $row = $result1->fetch_assoc();
    $id = $row['member_id'];

    $asstasksql = "SELECT COUNT(schedule_id) as assign FROM schedule WHERE member_id = $id AND is_active = true";
    $asstaskresult = mysqli_query($conn, $asstasksql);
    $assignedtask = $asstaskresult->fetch_assoc()
?>

<?php
    $sql1 = "SELECT * FROM members WHERE member_username = '{$_SESSION['username']}'";
    $result1 = mysqli_query($conn, $sql1);
    $row = $result1->fetch_assoc();
    $id = $row['member_id'];

    $fintasksql = "SELECT COUNT(schedule_id) as finished FROM schedule WHERE member_id = $id AND is_active = false";
    $fintaskresult = mysqli_query($conn, $fintasksql);
    $finishedtask = $fintaskresult->fetch_assoc()


?>

<?php
    if(isset($_POST['time-in'])) {

        $sql1 = "SELECT * FROM members WHERE member_username = '{$_SESSION['username']}'";
        $result1 = mysqli_query($conn, $sql1);
        $row = $result1->fetch_assoc();
        $id = $row['member_id'];

        date_default_timezone_set("Asia/Manila");
        $currentdate = date('y-m-d H:i:s');
        $recentdate = date('y-m-d');
        $sql = "INSERT INTO attendance(member_id, time_in) VALUES('$id', '$currentdate')";
        $result = mysqli_query($conn, $sql);
            if($result){
            echo '<script>alert("Attendance has been recorded")</script>'; 
            }
            else{
               die(mysqli_error($conn));
            }

    }
    

    if(isset($_POST['time-out'])) {
        
        $sql1 = "SELECT * FROM members WHERE member_username = '{$_SESSION['username']}'";
        $result1 = mysqli_query($conn, $sql1);
        $row = $result1->fetch_assoc();
        $id = $row['member_id'];

        $query = "SELECT MAX(attendance_id) as attendance_id FROM attendance WHERE member_id = $id;";
        $result2 = mysqli_query($conn, $query);
        $row2 = $result2->fetch_assoc();
        $attid = $row2['attendance_id'];

        date_default_timezone_set("Asia/Manila");
        $currentdate = date('y-m-d H:i:s');
        $sql2 = "UPDATE attendance SET time_out = '$currentdate' WHERE attendance_id = $attid";
        $result3 = mysqli_query($conn, $sql2);
        
        if($result3){
        echo '<script>alert("Attendance has been recorded")</script>';
        }
        else{
            die(mysqli_error($conn));
        }

    }

?>

<?php

//To disable the button when timein for the day is recorded
$sql1 = "SELECT * FROM members WHERE member_username = '{$_SESSION['username']}'";
$result1 = mysqli_query($conn, $sql1);
$row = $result1->fetch_assoc();
$id = $row['member_id'];

date_default_timezone_set("Asia/Manila");
$currentdate = date('y-m-d');
$rectimeinsql = "SELECT * FROM attendance WHERE time_in LIKE '%$currentdate%' AND member_id = '$id'";
$rectimeinresult = mysqli_query($conn, $rectimeinsql);
$rectimeinrow = $rectimeinresult->fetch_assoc();

if(isset($rectimeinrow)){
$rectimein = $rectimeinrow['time_in'];
}

//To disable the button when timeout for the day is recorded
$rectimeoutsql = "SELECT * FROM attendance WHERE time_out LIKE '%$currentdate%' AND member_id = '$id'";
$rectimeoutresult = mysqli_query($conn, $rectimeoutsql);
$rectimeoutrow = $rectimeoutresult->fetch_assoc();

if(isset($rectimeoutrow)){
    $rectimeout = $rectimeoutrow['time_out'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link rel="stylesheet" href="dashboard.css">
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
                <h1>Hello, <?php echo $_SESSION['username']; ?></h1>
                <i class="fav material-icons">account_circle</i>
            </div>
            <div class="main-features">
                <div class="card">
                    <i class="fav material-icons">work</i>
                    <h3>Time-In</h3>
                    <p>Time-In To Mark Your Attendance</p>
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <button type="submit" name="time-in" class="main-button"<?php if(isset($rectimein)) { ?> Disabled <?php } ?>>Time-In</button>
                    </form>
                </div>
                <div class="card">
                    <i class="fav material-icons">home</i>
                    <h3>Time-out</h3>
                    <p>Time-Out To Mark Your Attendance</p>
                    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <button type="submit" name="time-out" class="main-button"<?php if(isset($rectimeout)) { ?> Disabled <?php } ?>>Time-out</button>
                    </form>
                </div>
            </div>

            <section class="sub">
                <div class="sub-bottom">
                    <h1>Tasks</h1>
                </div>
                    <div class="sub-features">
                    <div class="bottom-card">
                        <h3 class="ass-tasks">Assigned:</h3>
                        <h3 class="ass-tasknum"><?php echo $assignedtask['assign']?></h3>
                        <h3 class="com-tasks">Completed:</h3>
                        <h3 class="com-tasknum"><?php echo $finishedtask['finished']?></h3>
                        <button class="sub-button" name="task">Check Tasks</button>
                    </div>

                    </div>
                </div>
            </section>
        </section>
        </div>


    </body>
</html>