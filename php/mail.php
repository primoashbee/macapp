<?php 
require "config.php";
$sql ="SELECT g.*,si.`firstname`,si.`lastname`,c.`name`,c.`description` FROM grade_summary g INNER JOIN students_information si ON g.student_id = si.id INNER JOIN course c ON si.course = c.id WHERE student_id=13";
$res = mysqli_query($conn,$sql);
$for_fetch = mysqli_fetch_array(mysqli_query($conn,$sql));
$name = $for_fetch['firstname'].' '.$for_fetch['lastname'];
$course = $for_fetch['name'];
echo $name;
echo $course;
?>