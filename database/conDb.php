<?php
$servername = "localhost";
$username = "root";
//$password = "abc456";
$password = "";
$dbname = "nommali";
// $dbname = "nom_tra_mali";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

try{
	$conPDO = new PDO("mysql:host={$servername};dbname={$dbname};charset=utf8", $username, $password);
	$conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
	echo 'Error Code: ' . $e->getCode() . ',<br/>';
    echo 'Connection failed: ' . $e->getMessage();
}

// echo "Connected successfully";

// $conn = @mysqli_connect($servername, $username, $password, $dbname)
// 		or die(mysqli_connect_error());
// echo "Connected successfully";


// ###################### INSERT ######################
// $sql = "INSERT INTO user (username, password)
// VALUES ('$aboutUs', '$aboutUs')";

// if ($conn->query($sql) === TRUE) {
//     echo "<br/>New record created successfully";
// } else {
//     echo "<br/>Error: " . $sql . "<br>" . $conn->error;
// }
// End ###################### INSERT ######################


// ###################### Query ######################
// $sql = "SELECT id FROM users";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
// 	echo "<br/>$result->num_rows > 0<br/>";
//     // output data of each row
//     while($row = $result->fetch_assoc()) {
//         echo "id: " . $row["id"] . "<br>";
//     }
// } else {
//     echo "<br/>0 results";
// }
// End ###################### Query ######################


//mysqli_close($conn);
?>