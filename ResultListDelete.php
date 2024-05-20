<?php 
include 'connection.php';
$prn=$_GET['id'];
$q="DELETE FROM `student` WHERE prn='$prn'";

if (mysqli_query($connection,$q))
		{
    	echo '<script type="text/javascript">'; 
		echo 'alert("Student details Delete Successfully!");'; 
		echo 'window.location.href = "./ResultListForm.php"';
		echo '</script>';
		} 
else 
		{
    	echo '<script type="text/javascript">'; 
    	echo 'alert("Student details Not Delete !");'; 
		echo 'window.location.href = "./ResultListForm.php"';
		echo '</script>';
		}
?>