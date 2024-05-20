<?php include 'config/database.php'; ?>

<?php
    session_start();
?>

<?php

        date_default_timezone_set("Asia/Manila");
        $currentdate = date('y-m');

        $sql1 = "SELECT * FROM members WHERE member_username = '{$_SESSION['username']}'";
        $result1 = mysqli_query($conn, $sql1);
        $row = $result1->fetch_assoc();
        $id = $row['member_id'];

        $sql = "SELECT first_name, last_name, time_in, time_out FROM attendance INNER JOIN members ON members.member_id = attendance.member_id
        WHERE attendance.member_id = $id AND time_in LIKE '%$currentdate%'";
        $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="attendance.css">
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
                <h1>View Your Attendance This Month</h1>
                <i class="fav material-icons">account_circle</i>
            </div>

                    <table class="content-table">
                        <thead>
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Time-in</th>
                                <th>Time-out</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <?php

                            while($row = mysqli_fetch_assoc($result))
                            {
                            ?>
                                <td><?php echo $row['first_name']?></td>
                                <td><?php echo $row['last_name']?></td>
                                <td><?php echo $row['time_in']?></td>
                                <td><?php echo $row['time_out']?></td>
                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        </table>
                </div>
            </div>
        </section>
        </div>

</body>
</html>