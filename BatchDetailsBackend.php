<?php
    include('connection.php');

    // total no. of students
    $q1 = "SELECT COUNT(*) AS total_students FROM `student` where batch='$Batch'";
    $result = mysqli_query($connection, $q1);
    $row = mysqli_fetch_assoc($result);
    $total_students = $row['total_students'];
    

    // total no. of FY students (N1)
    $q2 = "SELECT COUNT(*) AS fy_students FROM `student` where batch='$Batch' and not FY='DSY'";
    $result2 = mysqli_query($connection, $q2);
    $row2 = mysqli_fetch_assoc($result2);
    $fy_students = $row2['fy_students'];

    // total no. DSY students (N2)
    $DSY_students = $total_students - $fy_students;

    // FY passed
    $q3 = "SELECT COUNT(*) AS fy_passed FROM `student` where batch='$Batch' and FY='Pass'";
    $result3 = mysqli_query($connection, $q3);
    $row3 = mysqli_fetch_assoc($result3);
    $fy_passed = $row3['fy_passed'];

    // SY passed
    $q4 = "SELECT COUNT(*) AS sy_passed FROM `student` where batch='$Batch' and SY='Pass'";
    $result4 = mysqli_query($connection, $q4);
    $row4 = mysqli_fetch_assoc($result4);
    $sy_passed = $row4['sy_passed'];

    // TY passed
    $q5 = "SELECT COUNT(*) AS ty_passed FROM `student` where batch='$Batch' and TY='Pass'";
    $result5 = mysqli_query($connection, $q5);
    $row5 = mysqli_fetch_assoc($result5);
    $ty_passed = $row5['ty_passed'];

    //BE Passed
    $q6 = "SELECT COUNT(*) AS BE_passed FROM `student` where batch='$Batch' and BE='Pass'";
    $result6 = mysqli_query($connection, $q6);
    $row6 = mysqli_fetch_assoc($result6);
    $BE_passed = $row6['BE_passed'];
    

?>


