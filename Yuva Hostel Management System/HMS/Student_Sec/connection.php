
<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "loginweb";
$conn = mysqli_connect($host, $user, $pass,$db);
if($conn){
    echo "Connection Success";
}else{
    echo "Connection failed";
}
?>