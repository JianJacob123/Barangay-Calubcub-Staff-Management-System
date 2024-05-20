<?php include 'config/database.php'; ?>


<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
        <title>Manage Members</title>
        <link rel="stylesheet" href="managemembers.css">
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
                <span class="nav-item">Manage Members</span>
            </a></li>
            <li><a href="logout.php" class="logo">
                <i class="fas material-icons">exit_to_app</i>
                <span class="nav-item">Logout</span>
            </a></li>
        </ul>
        </nav>
        

        <section class="main">
            <div class="main-top">
                <h1>Assign Task</h1>
                <i class="fav material-icons">account_circle</i>
            </div>
            <div class="search">
            <form action="assigntask.php?taskid=<?php echo $_GET['taskid'];?>" method="post">
             <input type="text" class="searchbar" name="input-search" placeholder="Search">
             <button type="submit" name="search" class="btn" value="search">Search</button>
            </form>
            </div>

            <section class="sub">
                <div class="sub-bottom">
                    <h1>Member Details</h1>
                    <table class="table">
                    <?php
                    if(isset($_POST['search'])) {
                    $search = $_POST['input-search'];
                    $sql = "SELECT member_id, first_name, last_name, dob, gender, address, position_name FROM members
                    INNER JOIN position ON position.position_id = members.position_id
                    WHERE first_name LIKE '%$search%' OR position_name LIKE '%$search%'";
                    $result = mysqli_query($conn, $sql);
                    if($result){
                    if(mysqli_num_rows($result)>0){
                        echo '<thead>
                        <th>ID</th>
                        <th>First name</th>
                        <th>Last name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Address</th>
                        <th>Position</th>
                        <th>Operations</th>
                        <tr>
                        </thead>';
                        while($row=mysqli_fetch_assoc($result)){
                        echo '<tbody>
                        <tr>
                        <td>'.$row['member_id'].'</td>
                        <td>'.$row['first_name'].'</td>
                        <td>'.$row['last_name'].'</td>
                        <td>'.$row['dob'].'</td>
                        <td>'.$row['gender'].'</td>
                        <td>'.$row['address'].'</td>
                        <td>'.$row['position_name'].'</td>
                        <td>
                        <a href="assigned.php?taskid='.$_GET['taskid'].'&memberid='.$row['member_id'].'"><button>Assign</button></a>
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