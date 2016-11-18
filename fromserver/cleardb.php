<?php 
require "config.php";
$sql="TRUNCATE TABLE class";
mysqli_query($conn,$sql);
$sql="TRUNCATE TABLE classroom";
mysqli_query($conn,$sql);
$sql="TRUNCATE TABLE course";
mysqli_query($conn,$sql);
$sql="TRUNCATE TABLE grades";
mysqli_query($conn,$sql);
$sql="TRUNCATE TABLE grading_criteria";
mysqli_query($conn,$sql);
$sql="TRUNCATE TABLE students_information";
mysqli_query($conn,$sql);
$sql="TRUNCATE TABLE subjecs";
mysqli_query($conn,$sql);
$sql="TRUNCATE TABLE teacher_information";
mysqli_query($conn,$sql);
$sql="TRUNCATE TABLE users";
mysqli_query($conn,$sql);
echo 'DB CLEARED. CLOSE THIS PAGE NOW';
?>