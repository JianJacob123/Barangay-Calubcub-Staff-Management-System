<?php include 'config/database.php'; ?>

<?php
    session_start();
?>

<?php
$sql1 = "SELECT COUNT(member_id) as count FROM members;";
$result1 = mysqli_query($conn, $sql1);
$members = $result1->fetch_assoc()
?>


<?php
date_default_timezone_set("Asia/Manila");
$currentdate = date('y-m-d');
$sql2 = "SELECT COUNT(attendance_id) as attoday FROM attendance WHERE time_in LIKE '%$currentdate%'";
$result2 = mysqli_query($conn, $sql2);
$attoday = $result2->fetch_assoc();
?>

<?php
$sql3 = "SELECT COUNT(task_id) as totaltask FROM task";
$result3 = mysqli_query($conn, $sql3);
$totaltask = $result3->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <title>Admin Dashboard</title>
        <link rel="stylesheet" href="admindashboard.css">
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
                <h1>Hello, <?php echo $_SESSION['username']; ?></h1>
                <i class="fav material-icons">account_circle</i>
            </div>
            <div class="main-features">
                <div class="card">
                    <i class="fav material-icons">face</i>
                    <h3>Total Members:</h3>
                    <h3><?php echo $members['count']?></h3>
                </div>
                <div class="card">
                    <i class="fav material-icons">perm_contact_calendar</i>
                    <h3>Present Today:</h3>
                    <h3><?php echo $attoday['attoday']?></h3>
                </div>
                <div class="card">
                    <i class="fav material-icons">assignment</i>
                    <h3>Total Projects:</h3>
                    <h3><?php echo $totaltask['totaltask']?></h3>
                </div>
            </div>

            <section class="sub">
                <div class="sub-bottom">
                    <h1>Today's Attendance List</h1>
                    <table class="table">
                    <?php
                    date_default_timezone_set("Asia/Manila");
                    $currentdate = date('y-m-d');
                    $sql =  "SELECT attendance_id, first_name, last_name, time_in, time_out FROM attendance INNER JOIN members ON members.member_id = attendance.member_id
                    WHERE time_in LIKE '%$currentdate%'";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                    if(mysqli_num_rows($result)>0){
                        echo '<thead>
                        <th>ID</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>Time In</th>
                        <th>Time out</th>
                        <tr>
                        </thead>';
                        while($row=mysqli_fetch_assoc($result)){
                        echo '<tbody>
                        <tr>
                        <td>'.$row['attendance_id'].'</td>
                        <td>'.$row['first_name'].'</td>
                        <td>'.$row['last_name'].'</td>
                        <td>'.$row['time_in'].'</td>
                        <td>'.$row['time_out'].'</td>
                        </tr>
                        </tbody>';
                        }
                    } else {
                        echo '<h2>No attendance Yet</h2>';
                    }
                }
                ?>
                    </table>
                </div>
            
                </div>
            </section>
        </section>
        </div>


    </body>
</html>