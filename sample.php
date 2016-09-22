<?php 
if(isset($_POST['submit'])){
echo mysqli_real_escape_string($_POST['user']);
}
?>
<?php 

foreach (range('A', 'ZZ') as $x) {
    echo $x . "\n";
}
?>
<form action ="sample.php" method="post">
<input type="text" name="user" >
<input type="submit" name="submit" >
</form> 