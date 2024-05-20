<?php
include('connection.php');

$query = "SELECT DISTINCT SUBSTRING_INDEX(batch, '-', 1) AS admission_year FROM `student`";
$result = mysqli_query($connection, $query);

$admission_years = array();
while ($row = mysqli_fetch_assoc($result)) {
    $admission_years[] = $row['admission_year'];
}

// Print the array to see the distinct admission years
// print_r($admission_years[0]);



    

?>
