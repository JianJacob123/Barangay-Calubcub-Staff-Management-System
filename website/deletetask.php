<?php include 'config/database.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="DELETE FROM task WHERE task_id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo '<script>alert(Task successfully removed")</script>'; 
        header('location: /website/managetasks.php');
    }
    else{
        die(mysqli_error($conn));
    }
}
?>