<?php 
ini_set('display_errors',1);
error_reporting(E_ALL);
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = 'blog';
$conn = mysqli_connect($servername,$username,$password,$dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }


$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case "GET":
        // Zapytanie SQL
        $sql = "SELECT name, entries.id, entries.title, entries.description, entries.date, entries.user_id
                FROM users
                INNER JOIN entries ON users.id = entries.user_id";

        // Wykonanie zapytania
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            die('Query failed: ' . mysqli_error($conn));  // Logowanie błędu zapytania SQL
        }

        // Sprawdzenie, czy zapytanie zwróciło jakiekolwiek dane
        if (mysqli_num_rows($result) > 0) {
            $arr = [];
            while ($row = mysqli_fetch_assoc($result)) {
                // Przygotowanie odpowiedzi
                $response = array(
                    "id" => $row['id'],
                    "title" => $row['title'],
                    "description" => $row['description'],
                    "dateData" => $row['date'],
                    "userName" => $row["name"],
                    "userId" => $row["user_id"]
                );
                
                // Dodanie do tablicy wyników
                array_push($arr, $response);
            }
            // Zwrócenie odpowiedzi jako JSON
            echo json_encode($arr);
        } else {
            // Jeśli brak wyników, zwróć komunikat
            echo json_encode(["message" => "No entries found"]);
        }
        break;

    default:
        // W przypadku innych metod HTTP
        echo json_encode(["message" => "Method not supported"]);
        break;
}
?>