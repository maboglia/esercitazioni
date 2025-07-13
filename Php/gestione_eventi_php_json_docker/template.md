# 📁 **Struttura del progetto**

```
gestione-eventi/
│
├── index.php
├── add.php
├── edit.php
├── delete.php
│
├── includes/
│   ├── functions.php
│   ├── session.php
│   └── header.php
│
├── data/
│   └── events.json
│
├── views/
│   ├── form.php
│   └── list.php
│
└── style.css
```

---

## ✅ **Contenuto dei file principali**

### 🟩 `data/events.json`

```json
[]
```

---

### 🟩 `includes/functions.php`

```php
<?php

function load_events() {
    $file = __DIR__ . '/../data/events.json';
    if (!file_exists($file)) return [];
    $json = file_get_contents($file);
    return json_decode($json, true) ?: [];
}

function save_events($events) {
    $file = __DIR__ . '/../data/events.json';
    file_put_contents($file, json_encode($events, JSON_PRETTY_PRINT));
}

function get_event_by_id($id) {
    $events = load_events();
    foreach ($events as $event) {
        if ($event['id'] == $id) return $event;
    }
    return null;
}

function generate_id($events) {
    $ids = array_column($events, 'id');
    return $ids ? max($ids) + 1 : 1;
}
```

---

### 🟩 `includes/session.php`

```php
<?php
session_start();

if (!isset($_SESSION['user'])) {
    $_SESSION['user'] = $_GET['user'] ?? 'guest';
}

if (!isset($_SESSION['ops'])) {
    $_SESSION['ops'] = 0;
}

function increment_ops() {
    $_SESSION['ops']++;
}

function flash($key, $msg = null) {
    if ($msg !== null) {
        $_SESSION['flash'][$key] = $msg;
    } elseif (isset($_SESSION['flash'][$key])) {
        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }
    return null;
}
```

---

### 🟩 `includes/header.php`

```php
<?php include 'session.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Gestione Eventi</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Eventi PHP</h1>
    <p>Utente: <?= $_SESSION['user'] ?> | Operazioni: <?= $_SESSION['ops'] ?></p>
    <nav>
        <a href="index.php">Home</a> |
        <a href="add.php">Aggiungi evento</a>
    </nav>
</header>
<hr>
```

---

### 🟩 `views/list.php`

```php
<?php include 'includes/header.php'; ?>
<?php include 'includes/functions.php';

$events = load_events();
?>

<?php if ($msg = flash('success')): ?>
    <p style="color: green;"><?= $msg ?></p>
<?php endif; ?>

<h2>Elenco eventi</h2>
<?php if (empty($events)): ?>
    <p>Nessun evento presente.</p>
<?php else: ?>
    <ul>
        <?php foreach ($events as $event): ?>
            <li>
                <strong><?= htmlspecialchars($event['title']) ?></strong> (<?= $event['date'] ?>) <br>
                <?= nl2br(htmlspecialchars($event['description'])) ?><br>
                <a href="edit.php?id=<?= $event['id'] ?>">Modifica</a> |
                <a href="delete.php?id=<?= $event['id'] ?>">Elimina</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
</body>
</html>
```

---

### 🟩 `views/form.php` *(usato sia da `add.php` che `edit.php`)*

```php
<form method="post">
    <label>Titolo:<br>
        <input type="text" name="title" value="<?= htmlspecialchars($event['title'] ?? '') ?>" required>
    </label><br><br>

    <label>Data (YYYY-MM-DD):<br>
        <input type="date" name="date" value="<?= htmlspecialchars($event['date'] ?? '') ?>" required>
    </label><br><br>

    <label>Descrizione:<br>
        <textarea name="description" rows="4" required><?= htmlspecialchars($event['description'] ?? '') ?></textarea>
    </label><br><br>

    <button type="submit">Salva</button>
</form>
```

---

## 🟩 `index.php`

```php
<?php include 'views/list.php'; ?>
```

---

## 🟩 `add.php`

```php
<?php
include 'includes/functions.php';
include 'includes/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $events = load_events();
    $event = [
        'id' => generate_id($events),
        'title' => $_POST['title'],
        'date' => $_POST['date'],
        'description' => $_POST['description']
    ];
    $events[] = $event;
    save_events($events);
    increment_ops();
    flash('success', 'Evento aggiunto con successo!');
    header('Location: index.php');
    exit;
}

$event = [];
include 'includes/header.php';
include 'views/form.php';
```

---

## 🟩 `edit.php`

```php
<?php
include 'includes/functions.php';
include 'includes/session.php';

$id = $_GET['id'] ?? null;
$events = load_events();
$event = get_event_by_id($id);

if (!$event) {
    die("Evento non trovato.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($events as &$e) {
        if ($e['id'] == $id) {
            $e['title'] = $_POST['title'];
            $e['date'] = $_POST['date'];
            $e['description'] = $_POST['description'];
            break;
        }
    }
    save_events($events);
    increment_ops();
    flash('success', 'Evento modificato con successo!');
    header('Location: index.php');
    exit;
}

include 'includes/header.php';
include 'views/form.php';
```

---

## 🟩 `delete.php`

```php
<?php
include 'includes/functions.php';
include 'includes/session.php';

$id = $_GET['id'] ?? null;
$events = load_events();
$found = false;

foreach ($events as $i => $e) {
    if ($e['id'] == $id) {
        unset($events[$i]);
        $found = true;
        break;
    }
}

if ($found) {
    save_events(array_values($events));
    increment_ops();
    flash('success', 'Evento eliminato!');
}

header('Location: index.php');
exit;
```

---

## 🟩 `style.css` *(facoltativo ma utile)*

```css
body {
    font-family: sans-serif;
    margin: 20px;
}

input, textarea {
    width: 300px;
}
```

