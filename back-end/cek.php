<?php
$conn = mysqli_connect("localhost","root","","test") or die(mysqli_error());
if (!isset($_SESSION['$username'])){
    $row['status']="gagal";
}else {
    $sql = "select * from data_user where username=".$_SESSION['$username'];
    $result = $conn->query($sql);
    if ($result->num_rows == 1) {
        foreach ($result as $key => $val) {
            $row['username'] = $val['username'];
            $row['waktu'] = $val['waktu'];
            $row['status'] = "sukses";
        }
    } else {
        $row['status'] = "gagal";
    }
}
$response = $row;
$conn->close();
echo json_encode($response);
?>