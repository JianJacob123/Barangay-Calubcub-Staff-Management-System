<?php include 'config/database.php';
if(isset($_GET['scheduleid'])){
    $scheduleid=$_GET['scheduleid'];

    $sql="UPDATE schedule SET is_active = false WHERE schedule_id = '$scheduleid'";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo '<script>alert("Task successfully assigned")</script>'; 
        header('location: /website/manageschedules.php');
    }
    else{
        die(mysqli_error($conn));
    }
}
?>