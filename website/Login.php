<?php
    include 'config/database.php';
?>

<?php
if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM members WHERE member_username = '$username' AND member_password = '$password'" ;
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) === 1){

        $logged_in = mysqli_fetch_assoc($result);

        if($logged_in['position_id'] == 1){
        session_start();

        $username = filter_input(INPUT_POST, 'username',
        FILTER_SANITIZE_SPECIAL_CHARS);
            $_SESSION['username'] = $username;
            header('Location: /website/admindashboard.php');
        }
        else {
            session_start();
            $username = filter_input(INPUT_POST, 'username',
        FILTER_SANITIZE_SPECIAL_CHARS);
            $_SESSION['username'] = $username;
            header('Location: /website/dashboard.php');
        }
}

    else
    {
        echo 'invalid login';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <title> Login </title>
        <link rel="stylesheet" href="login.css">
    </head>

    <body>
<div class="Login">
<h1> BSMS PORTAL</h1>
    <form action="Login.php" method="post">
        <div class="input-login">
        <input type="text" name="username" placeholder="Username" required><br>
        </div>
        <div class="input-login">
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit" name="submit"class="btn" value="login">Login</button>
            
    </form>
</div>
    </body>
</html>