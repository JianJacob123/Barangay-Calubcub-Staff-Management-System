<?php
    include 'config/database.php';
?>

<?php
    session_start();
?>

<?php
    $sql1 = "SELECT * FROM members WHERE member_username = '{$_SESSION['username']}'";
    $result1 = mysqli_query($conn, $sql1);
    $row = $result1->fetch_assoc();
    $id = $row['member_id'];

    $sql = "SELECT task_name, task_date, task_description, is_active FROM schedule
    inner join task
    on task.task_id = schedule.task_id
    inner join members
    on members.member_id = schedule.member_id
    WHERE schedule.member_id = $id AND is_active = true";
    $result = mysqli_query($conn, $sql);
    $schedule = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <title>Tasks</title>
        <link rel="stylesheet" href="schedule.css">
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
                <h1>Your Assigned Tasks</h1>
                <i class="fav material-icons">account_circle</i>
            </div>
            <?php if(empty($schedule)): ?>
                <p> You have no Task </p>
                <?php endif; ?>
                
            <?php foreach($schedule as $item): ?>
            <div class="main-features">
                <div class="card">
                    <h3>Task Title: <?php echo $item['task_name']?></h3>
                    <h3>When: <?php echo $item['task_date']?></h3>
                    <p><?php echo $item['task_description']?></p>
                </div>
            </div>
            <?php endforeach ?>
        </section>
        </div>


    </body>
</html>