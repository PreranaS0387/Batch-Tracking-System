<?php
    include('connection.php');

    // $batch = $_POST['batch'];

    $q = "SELECT * From `student` where batch='$batch'";
    $ResultData=mysqli_query($connection,$q); 

?>