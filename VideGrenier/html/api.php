<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Database connection
$host = 'mysql_db';
$dbname = 'mydatabase';
$user = 'myuser';
$pass = 'mypassword';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$method = $_SERVER['REQUEST_METHOD'];
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch($method) {
    case 'GET':
        if($id) {
            $stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
            $stmt->execute([$id]);
        } else {
            $stmt = $pdo->query("SELECT * FROM items");
        }
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        $stmt = $pdo->prepare("INSERT INTO items (name, description, price) VALUES (?, ?, ?)");
        if($stmt->execute([$data['name'], $data['description'], $data['price']])) {
            http_response_code(201);
            echo json_encode(['message' => 'Item created', 'id' => $pdo->lastInsertId()]);
        }
        break;

    case 'PUT':
        if($id) {
            $data = json_decode(file_get_contents('php://input'), true);
            $stmt = $pdo->prepare("UPDATE items SET name = ?, description = ?, price = ? WHERE id = ?");
            if($stmt->execute([$data['name'], $data['description'], $data['price'], $id])) {
                echo json_encode(['message' => 'Item updated']);
            }
        }
        break;

    case 'DELETE':
        if($id) {
            $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
            if($stmt->execute([$id])) {
                echo json_encode(['message' => 'Item deleted']);
            }
        }
        break;
}
?>