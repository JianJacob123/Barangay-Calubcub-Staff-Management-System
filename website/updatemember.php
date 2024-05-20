<?php include 'config/database.php';

session_start();

$id=$_GET['updateid'];
$sql2="SELECT first_name, last_name, dob, gender, address, member_username, member_password FROM members WHERE member_id =$id";
$result2=mysqli_query($conn,$sql2);
$row=mysqli_fetch_assoc($result2);
$firstname=$row['first_name'];
$lastname=$row['last_name'];
$dob=$row['dob'];
$gender=$row['gender'];
$address=$row['address'];
$username=$row['member_username'];
$password=$row['member_password'];

if(isset($_POST['submit'])){
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $address=$_POST['address'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $position =$_POST['position'];

    $sql="UPDATE members SET first_name='$firstname', last_name='$lastname', gender='$gender', dob='$dob', address='$address', member_username='$username', member_password='$password', position_id='$position'
    WHERE member_id =$id";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('location: /website/managemembers.php');
        echo '<script>alert("Member successfully Updated")</script>'; 
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
            <h2>DASHBOARD</h2><br>
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
                <h1>Edit Profile</h1>
                <i class="fav material-icons">account_circle</i>
            </div>
            <div class="main-features">
                <div class="card">
                    <div class="edit-profile-left">
                        <form  method="post">
                        <input type="text" name="firstname" placeholder="First Name" value="<?php echo $firstname?>"required>
                        <input type="text" class="edit-profile-right" name="lastname" placeholder="Last Name" value="<?php echo $lastname?>"required><br>
                        </div>
                        <div class="edit-profile-left">
                            <input type="text" name="gender" placeholder="Gender" value="<?php echo $gender?>"required>
                            <input type="date" class="edit-profile-right" name="dob" placeholder="Date of Birth" value="<?php echo $dob?>"required><br>
                        </div>
                        <div class="edit-profile-left">
                            <input type="text" name="address" placeholder="address" value="<?php echo $address?>"required>
                            <input type="text" class="edit-profile-right" name="username" placeholder="Email" value="<?php echo $username?>"required><br>
                            </div>
                            <div class="edit-profile-left">
                                <input type="password" name="password" placeholder="Password" value="<?php echo $password?>"required>
                                <select name="position" class="custom-select">
                            <option value="1">Captain</option>
                            <option value="2">Barangay Kagawad</option>
                            <option value="3">SK Chairman</option>
                            <option value="4">SK Kagawad</option>
                            <option value="5">Secretary</option>
                            <option value="6">Treasurer</option>
                            <option value="7">Lupong Tagapamayapa</option>
                            <option value="8">Barangay Tanod</option>
                            </select>
                            </div>

                    <button type="submit" class="main-button" name="submit">Submit</button>
                        </form>
                </div>
            </div>
        </section>
        </div>


    </body>
</html>