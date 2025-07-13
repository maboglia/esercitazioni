<?php
// ===========================
// ESERCITAZIONE 1: Rubrica (CRUD con PDO)
// ===========================

// connessione.php
$pdo = new PDO("mysql:host=localhost;dbname=rubrica", "root", "", [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
]);

// login.php
session_start();
if ($_POST['user'] === 'admin' && $_POST['pass'] === '1234') {
    $_SESSION['logged'] = true;
    header("Location: index.php");
    exit;
} else {
    echo "Credenziali errate";
}

// index.php
session_start();
if (!$_SESSION['logged']) die("Accesso negato");
require 'connessione.php';
$contatti = $pdo->query("SELECT * FROM contatti")->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- HTML per visualizzazione tabella + form inserimento -->

// add.php
require 'connessione.php';
$stmt = $pdo->prepare("INSERT INTO contatti (nome, cognome, email, telefono) VALUES (?, ?, ?, ?)");
$stmt->execute([$_POST['nome'], $_POST['cognome'], $_POST['email'], $_POST['telefono']]);
header("Location: index.php");

// delete.php?id=xx
require 'connessione.php';
$stmt = $pdo->prepare("DELETE FROM contatti WHERE id = ?");
$stmt->execute([$_GET['id']]);
header("Location: index.php");


// ===========================
// ESERCITAZIONE 2: Diario (Lettura/Scrittura File)
// ===========================

// login.php: uguale a esercitazione 1

// index.php
session_start();
if (!$_SESSION['logged']) die("Accesso negato");
$files = glob("diario/*.txt");
?>
<!-- HTML per elencare file e aprire un diario -->

// scrivi.php
$filename = 'diario/' . $_POST['data'] . '.txt';
$text = strip_tags($_POST['testo']);
file_put_contents($filename, $text);
header("Location: index.php");

// leggi.php?file=YYYY-MM-DD.txt
$content = file_get_contents("diario/" . basename($_GET['file']));
echo nl2br(htmlspecialchars($content));


// ===========================
// ESERCITAZIONE 3: Upload Immagini
// ===========================

// index.php
session_start();
if (!$_SESSION['logged']) die("Accesso negato");
$imgs = glob("upload/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
?>
<!-- HTML per form upload e visualizzazione immagini -->

// upload.php
$targetDir = "upload/";
$filename = uniqid() . "_" . basename($_FILES["file"]["name"]);
$targetFile = $targetDir . $filename;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
if (in_array($imageFileType, ["jpg", "jpeg", "png"]) && $_FILES["file"]["size"] < 2*1024*1024) {
    move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile);
    header("Location: index.php");
} else {
    echo "File non valido.";
}


// ===========================
// ESERCITAZIONE 4: API Task Manager
// ===========================

// api/tasks.php
header("Content-Type: application/json");
require '../connessione.php';

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        $stmt = $pdo->query("SELECT * FROM tasks");
        echo json_encode(["status" => "ok", "data" => $stmt->fetchAll(PDO::FETCH_ASSOC)]);
        break;

    case 'POST':
        $data = json_decode(file_get_contents("php://input"), true);
        $stmt = $pdo->prepare("INSERT INTO tasks (titolo, descrizione) VALUES (?, ?)");
        $stmt->execute([$data['titolo'], $data['descrizione']]);
        echo json_encode(["status" => "ok"]);
        break;

    case 'PUT':
        parse_str(file_get_contents("php://input"), $data);
        $stmt = $pdo->prepare("UPDATE tasks SET completato = ? WHERE id = ?");
        $stmt->execute([$data['completato'], $data['id']]);
        echo json_encode(["status" => "ok"]);
        break;

    case 'DELETE':
        parse_str(file_get_contents("php://input"), $data);
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(["status" => "ok"]);
        break;
}
