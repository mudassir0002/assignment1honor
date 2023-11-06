<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = cleanInput($_POST["name"]);
    $email = cleanInput($_POST["email"]);
    $gender = cleanInput($_POST["gender"]);
    $city = cleanInput($_POST["city"]);

    if (empty($name) || empty($email) || empty($gender) || empty($city)) {
        echo "All fields are required.";
    } else {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO user (fullname, email, gender, city) VALUES ('$name', '$email', '$gender', '$city')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
}

function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}