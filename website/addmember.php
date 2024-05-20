<?php include 'config/database.php';

session_start();

if(isset($_POST['submit'])){
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $gender=$_POST['gender'];
    $dob=$_POST['dob'];
    $address=$_POST['address'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $position=$_POST['position'];

    $sql="INSERT INTO members(first_name, last_name, dob, gender, address, member_username, member_password, position_id) VALUES ('$firstname', '$lastname',
    '$dob', '$gender', '$address', '$username', '$password', $position)";
    $result=mysqli_query($conn,$sql);
    if($result){
        
        header('location: /website/managemembers.php');
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
                <i class="fas material-icons">schedule</i>
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
                <h1>Add User</h1>
                <i class="fav material-icons">account_circle</i>
            </div>
            <div class="main-features">
                <div class="card">
                    <div class="edit-profile-left">
                        <form  method="post">
                        <input type="text" name="firstname" placeholder="First Name" required>
                        <input type="text" class="edit-profile-right" name="lastname" placeholder="Last Name" required><br>
                        </div>
                        <div class="edit-profile-left">
                            <input type="text" name="gender" placeholder="Gender" required>
                            <input type="date" class="edit-profile-right" name="dob" placeholder="Date of Birth" required><br>
                        </div>
                        <div class="edit-profile-left">
                            <input type="text" name="address" placeholder="Address" required>
                            <input type="text" class="edit-profile-right" name="username" placeholder="Username" required><br>
                            </div>
                            <div class="edit-profile-left">
                                <input type="password" name="password" placeholder="Password" required>
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