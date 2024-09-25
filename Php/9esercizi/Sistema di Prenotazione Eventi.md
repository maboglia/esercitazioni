# Esercizio 1: Sistema di Prenotazione Eventi

L'obiettivo è sviluppare un servizio web per gestire la prenotazione di eventi da parte di un utente. Il servizio prevede tre pagine principali, descritte di seguito:

1. **Form di prenotazione evento**:
   - In questa pagina, l'utente può inserire il nome di un evento (una stringa) e il numero di persone per cui vuole effettuare la prenotazione.
   - Ogni invio del form aggiunge una nuova prenotazione. Se l'utente vuole fare più prenotazioni, deve inviare più volte il form durante la stessa sessione.
   
2. **Pagina di gestione delle prenotazioni**:
   - Dopo che l'utente invia una prenotazione, questa viene memorizzata sul server.
   - Se l'utente effettua più prenotazioni per lo stesso evento nella stessa sessione, il numero di persone viene sommato a quello delle prenotazioni precedenti per lo stesso evento.

3. **Pagina di riepilogo delle prenotazioni**:
   - Questa pagina mostra l'elenco completo delle prenotazioni fatte dall'utente.
   - Viene visualizzato il totale delle persone prenotate per tutti gli eventi e l'evento con il maggior numero di prenotazioni.
   - Se ci sono più eventi con lo stesso numero massimo di prenotazioni, viene mostrato il primo in ordine di inserimento.

Il codice HTML e PHP per implementare le pagine segue quanto specificato. Si assume l'uso del metodo GET nel form.

### 1. **Form di prenotazione evento** (`prenotazione.php`)
Questa pagina consente all'utente di inserire i dati relativi alla prenotazione.

```php
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Prenotazione Eventi</title>
</head>
<body>
    <h1>Prenota il tuo evento</h1>
    <form action="gestione_prenotazioni.php" method="get">
        <label for="evento">Nome evento:</label>
        <input type="text" id="evento" name="evento" required>
        <br><br>
        <label for="persone">Numero di persone:</label>
        <input type="number" id="persone" name="persone" min="1" required>
        <br><br>
        <button type="submit">Invia Prenotazione</button>
    </form>
</body>
</html>
```

### 2. **Pagina di gestione delle prenotazioni** (`gestione_prenotazioni.php`)
Questa pagina riceve i dati inviati dal form e memorizza le prenotazioni nella sessione dell'utente. Se un evento è già stato prenotato, aggiorna il numero di persone.

```php
<?php
session_start();

if (isset($_GET['evento']) && isset($_GET['persone'])) {
    $evento = $_GET['evento'];
    $persone = intval($_GET['persone']);
    
    if (!isset($_SESSION['prenotazioni'])) {
        $_SESSION['prenotazioni'] = [];
    }
    
    // Se l'evento è già presente, somma il numero di persone
    if (isset($_SESSION['prenotazioni'][$evento])) {
        $_SESSION['prenotazioni'][$evento] += $persone;
    } else {
        $_SESSION['prenotazioni'][$evento] = $persone;
    }
}

// Reindirizza alla pagina di riepilogo
header("Location: riepilogo.php");
exit();
?>
```

### 3. **Pagina di riepilogo delle prenotazioni** (`riepilogo.php`)
Questa pagina visualizza il riepilogo delle prenotazioni, il totale delle persone prenotate e l'evento con il maggior numero di prenotazioni.

```php
<?php
session_start();

if (!isset($_SESSION['prenotazioni']) || empty($_SESSION['prenotazioni'])) {
    echo "<h1>Non ci sono prenotazioni</h1>";
    exit();
}

// Calcola il totale delle persone e l'evento con più prenotazioni
$totalePersone = 0;
$eventoMassimo = "";
$massimoPersone = 0;

foreach ($_SESSION['prenotazioni'] as $evento => $persone) {
    $totalePersone += $persone;
    if ($persone > $massimoPersone) {
        $massimoPersone = $persone;
        $eventoMassimo = $evento;
    }
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>Riepilogo Prenotazioni</title>
</head>
<body>
    <h1>Riepilogo delle tue prenotazioni</h1>
    
    <table border="1">
        <tr>
            <th>Evento</th>
            <th>Numero di persone</th>
        </tr>
        <?php foreach ($_SESSION['prenotazioni'] as $evento => $persone) : ?>
        <tr>
            <td><?php echo htmlspecialchars($evento); ?></td>
            <td><?php echo $persone; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
    <p><strong>Totale persone prenotate:</strong> <?php echo $totalePersone; ?></p>
    <p><strong>Evento con più prenotazioni:</strong> <?php echo htmlspecialchars($eventoMassimo); ?></p>
    
    <a href="prenotazione.php">Prenota un altro evento</a>
</body>
</html>
```

### Spiegazione:

- **Form di prenotazione**: L'utente inserisce il nome dell'evento e il numero di persone, e i dati vengono inviati via GET a `gestione_prenotazioni.php`.
- **Gestione delle prenotazioni**: La pagina `gestione_prenotazioni.php` raccoglie i dati e li memorizza nella sessione dell'utente. Se un evento è già stato prenotato, il numero di persone viene sommato a quello precedente.
- **Riepilogo**: La pagina `riepilogo.php` mostra tutte le prenotazioni effettuate, il totale delle persone prenotate e l'evento con il numero massimo di prenotazioni.

Questo sistema di prenotazione è semplice ed efficace, adatto per piccoli servizi di prenotazione eventi.