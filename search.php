<?php
// Подключение к базе данных
$servername = "localhost"; // Имя сервера
$username = "root";        // Имя пользователя БД
$password = "";            // Пароль пользователя БД
$dbname = "SiteBD";       // Имя базы данных

// Создаем подключение
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверяем подключение
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

// Проверяем, была ли отправлена форма
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем параметр поиска из формы
    $search = $conn->real_escape_string($_POST['search']);

    // SQL-запрос для поиска книги
    $sql = "SELECT * FROM Books WHERE Name LIKE '%$search%' OR Author LIKE '%$search%' OR Genre LIKE '%$search%' OR DatePublication LIKE '%$search%' OR Publication LIKE '%$search%'";
    $result = $conn->query($sql);

    // Проверяем, есть ли результаты
    if ($result->num_rows > 0) {
        // Выводим данные о книгах
        echo "<h2>Результаты поиска:</h2>";
        echo "<table border='1'>
                <tr>
                    <th>Номер</th>
                    <th>Наименование</th>
                    <th>Автор</th>
                    <th>Жанр</th>
                    <th>Год издания</th>
                    <th>Издательство</th>
                </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["Номер"] . "</td>
                    <td>" . $row["Наименование"] . "</td>
                    <td>" . $row["Автор"] . "</td>
                    <td>" . $row["Жанр"] . "</td>
                    <td>" . $row["Год_издания"] . "</td>
                    <td>" . $row["Издательство"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Книги не найдены.</p>";
    }
}

// Закрываем подключение
$conn->close();
?>