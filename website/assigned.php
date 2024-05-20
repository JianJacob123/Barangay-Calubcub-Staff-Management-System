<?php include 'config/database.php';
if(isset($_GET['taskid']) && isset($_GET['memberid'])){
    $taskid=$_GET['taskid'];
    $memberid=$_GET['memberid'];

    $sql="INSERT INTO schedule(task_id, member_id, is_active) VALUES ($taskid, $memberid, true)";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo '<script>alert("Task successfully assigned")</script>'; 
        header('location: /website/managetasks.php');
    }
    else{
        die(mysqli_error($conn));
    }
}
?>