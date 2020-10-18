<?php
$conn = mysqli_connect("localhost","root","","test") or die(mysqli_error());
$username = $_POST['username'];
$password = $_POST['password'];

$query = $conn->query("select * from data_user where username='$username' and password='$password'");
$cek = $query->num_rows;
if ($query->num_rows == 1)
{
    foreach($query as $key => $val){
        $id=$val['id'];
    }
    $sql = "UPDATE data_user SET waktu= CURRENT_TIMESTAMP, status=1 WHERE id=" . $id;
    if(mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION['username'] = $username;
        header("Location: ../front-end/index.html");
    }else{
        header("Location: ../front-end/login.html");
    }
}
else
{
    header("Location: ../front-end/login.html");
}
$conn->close();
?>