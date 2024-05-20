<?php include 'config/database.php'; ?>


<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <title>Manage Tasks</title>
        <link rel="stylesheet" href="managetasks.css">
    <title>Hello, world!</title>
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
                <h1>Manage Tasks</h1>
                <i class="fav material-icons">account_circle</i>
            </div>
            <div class="search">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
             <input type="text" class="searchbar" name="input-search" placeholder="Search">
             <button type="submit" name="search" class="btn" value="search">Search</button>
            </form>
            <a href="addtask.php"><button class="nxtbtn" value="add-user"> + Add Task</button></a>
            </div>

            <section class="sub">
                <div class="sub-bottom">
                    <h1>Tasks</h1>
                    <table class="table">
                    <?php
                    if(isset($_POST['search'])) {
                    $search = $_POST['input-search'];
                    $sql = "SELECT * FROM task WHERE task_name LIKE '%$search%'";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                    if(mysqli_num_rows($result)>0){
                        echo '<thead>
                        <th>ID</th>
                        <th>Task Name</th>
                        <th>Task Description</th>
                        <th>task_date</th>
                        <th>Operations</th>
                        <tr>
                        </thead>';
                        while($row=mysqli_fetch_assoc($result)){
                        echo '<tbody>
                        <tr>
                        <td>'.$row['task_id'].'</td>
                        <td>'.$row['task_name'].'</td>
                        <td>'.$row['task_description'].'</td>
                        <td>'.$row['task_date'].'</td>
                        <td>
                        <a href="assigntask.php?taskid='.$row['task_id'].'"><button>Assign</button></a>
                        <a href="deletetask.php?deleteid='.$row['task_id'].'"><button>Delete</button></a>
                        </td>
                        </tr>
                        </tbody>';
                        }
                    } else {
                        echo '<h2> Data not Found</h2>';
                    }
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