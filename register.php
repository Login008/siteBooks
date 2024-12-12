<?php
$servername = "127.0.0.1";
$username = "root";
$password = ""; 
$dbname = "SiteBD";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $firstname = $_POST['FirstName'];
    $lastname = $_POST['Surname'];
    $birthdate = $_POST['DateBirth']; 
    $email = $_POST['Email'];
    $login = $_POST['Login'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT); 

    $sql = "INSERT INTO Authorisation (Login, Password) VALUES ('$login', '$password')";
    
    if ($conn->query($sql) === TRUE) {

        $last_id = $conn->insert_id;


        $sql = "INSERT INTO `dataUsers` (`Surname`, `FirstName`, `DateBirth`, `Email`, `Login`, `Password`) 
                VALUES ('$lastname', '$firstname', '$birthdate', '$email', '$login', '$password')";
        
        if ($conn->query($sql) === TRUE) {
            echo "<script> 
            alert('Регистрация прошла успешно!'); 
				window.location.href = 'index.html';
			exit();			
          </script>";
        } else {
			echo "<script> 
            alert('Ошибка при вставке в таблицу dataUsers: ' . $conn->error;); 
            window.location.href = 'register.html'; 
          </script>";
        }
    } else {
        echo "Ошибка при вставке в таблицу Authorisation: " . $conn->error;
    }
}

$conn->close();
?>