<?php 
if(isset($_POST['submit'])){
echo mysqli_real_escape_string($_POST['user']);
}
?>

<form action ="sample.php" method="post">
<input type="text" name="user" >
<input type="submit" name="submit" >
</form> 