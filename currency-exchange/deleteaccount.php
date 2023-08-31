<?php
include_once('php/connection.php');

$accnumber=$_GET['accnumber'];


    $qry=mysqli_query($connection,"DELETE FROM clientaccounts WHERE accountnumber='$accnumber'");
    if ($qry) {
        echo "<script> alert('Account Deleted!');</script>";
        
        
    } else {
        echo "<script> alert('error occured');</script>"; 
        
        
    }
    header('location:accounts.php');
    


?>
