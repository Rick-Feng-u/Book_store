<!DOCTYPE html>
<html>
<body>
    <h1>Submit Successful, Thank you!</h1>
<?php

echo "<h1> Name: ". $_POST['name'] . "</h1>";
echo "<h1> Phone number: ". $_POST['phone'] . "</h1>";
echo "<h1> Address: ". $_POST['address'] . "</h1>";
echo "<h1> Email: ". $_POST['email'] . "</h1>";
echo "<h1> Message: ". $_POST['msg'] . "</h1>";

$host = "127.0.0.1";
$user = "root";
$database = "80830912_db";
$password = "";

// this only works if the database has being created. Therefore, plz create a db called 80830912_db to verfiy.
$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();

$name = mysqli_real_escape_string($connection,$_POST['name']);
$phone = mysqli_real_escape_string($connection,$_POST['phone']);
$address = mysqli_real_escape_string($connection,$_POST['address']);
$email = mysqli_real_escape_string($connection,$_POST['email']);
$message = mysqli_real_escape_string($connection,$_POST['msg']);



if ($error != null) {
    $output = "<p>Unable to connect to server!</p>";
    exit($output);
}
else{

$sqlTable = "CREATE TABLE contact (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(30) NOT NULL,
    phone int(10) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(50) NOT NULL,
    message VARCHAR(150) NOT NULL
    )";
    
    if ($connection->query($sqlTable) === TRUE) {
        echo "Table contact created successfully";
    } else {
        echo "table has being created: " . $connection->error;
    }

    $sql = "INSERT INTO Mcontact (name, phone, address, email, message)
VALUES ($name, $phone, $address, $email, $message)";

if ($connection->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

$connection->close();
}



?>
</body>
</html>