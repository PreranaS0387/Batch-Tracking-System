<?php
session_start();

$connection = mysqli_connect('localhost', 'root', '');
mysqli_set_charset($connection,"utf8");

if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'result');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

// include('connection.php');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

// getting batch
$batch=$_POST['batch'];
$sem = $_POST['sem'];

if(isset($_POST['save_excel_data']))
{
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls','csv','xlsx'];

    if(in_array($file_ext, $allowed_ext))
    {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileNamePath);
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        foreach($data as $row)
        {
            if($count > 6)
            {
                echo $prn = $row['2'];
                $student_name = $row['3'];
                $result = $row['12'];
                $cgpa = $row['11'];
                

                // Check if record exists
                $q = "SELECT * FROM student WHERE prn = '$prn'";
                $tmp = mysqli_query($connection, $q);

                if (mysqli_num_rows($tmp) > 0) {
                // Record exists, perform update
                    // $q = "UPDATE student SET student_name = '$student_name', FY = '$FY', SY = '$SY', TY = '$TY', BE = '$BE' WHERE prn = '$prn'";
                    if($sem==1 || $sem==2){
                        $q = "UPDATE student SET student_name = '$student_name', FY = '$result', cgpa = '$cgpa' WHERE prn = '$prn'";
                    }
                    if($sem==3 || $sem==4){
                        $q = "UPDATE student SET student_name = '$student_name', SY = '$result', cgpa = '$cgpa' WHERE prn = '$prn'";
                    }
                    if($sem==5 || $sem==6){
                        $q = "UPDATE student SET student_name = '$student_name', TY = '$result', cgpa = '$cgpa' WHERE prn = '$prn'";
                    }
                    if($sem==7 || $sem==8){
                        $q = "UPDATE student SET student_name = '$student_name', BE = '$result', cgpa = '$cgpa' WHERE prn = '$prn'";
                    }
                    mysqli_query($connection, $q);
                } else {
                    // Record does not exist, perform insert
                    if(($sem==1 || $sem==2) && $student_name!=NULL && $prn!=NULL){
                    $q = "INSERT INTO student (prn, student_name, FY,cgpa,batch) VALUES ('$prn', '$student_name', '$result','$cgpa', '$batch')";
                    }

                    if(($sem==3 || $sem==4)  && $student_name!=NULL && $prn!=NULL){
                        $q = "INSERT INTO student (prn, student_name, FY,SY,cgpa,batch) VALUES ('$prn', '$student_name','DSY', '$result','$cgpa', '$batch')";
                        }
                    mysqli_query($connection, $q);
                }
                
              
                $msg = true;
            }
            else
            {
                $count ++;
            }
        }

        if(isset($msg))
        {
            $_SESSION['message'] = "Successfully Imported";
            header('Location: ResultListForm.php');
            exit(0);
        }
        else
        {
            $_SESSION['message'] = "Not Imported";
            alert("not imported");
            header('Location: Resultmaster.php');
            exit(0);
        }
    }
    else
    {
        $_SESSION['message'] = "Invalid File";
        header('Location: error.php');
        exit(0);
    }
}
?>