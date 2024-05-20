<?php include 'config/database.php';
if(isset($_GET['deleteid'])){
    $id=$_GET['deleteid'];

    $sql="DELETE FROM members WHERE member_id=$id";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo '<script>alert("Member successfully removed")</script>'; 
        header('location: /website/managemembers.php');
    }
    else{
        die(mysqli_error($conn));
    }
}
?>