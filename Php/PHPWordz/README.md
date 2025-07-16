# 🎮 Progetto PHP: “PHPWordz – Indovina la Parola Segreta (versione web)”

### 📋 Descrizione del gioco

Crea un’applicazione **PHP web** ispirata a **Wordle**: il giocatore ha **6 tentativi** per indovinare una **parola di 5 lettere** scelta casualmente dal sistema.

Dopo ogni tentativo, il sistema mostra per ciascuna lettera:

* 🟩 **verde**: lettera giusta nella posizione giusta
* 🟨 **giallo**: lettera presente ma in posizione sbagliata
* ⬛ **grigio**: lettera assente

---

### 🛠️ Obiettivi didattici

* Gestione di **form HTML** e **metodo POST**
* Uso delle **sessioni PHP**
* Manipolazione di **stringhe e array**
* Lettura di **file di testo**
* (Opzionale) Salvataggio di punteggi in **JSON**

---

### 🎯 Requisiti funzionali

1. All’avvio, PHP sceglie una parola casuale da un file `parole.txt` (solo parole di 5 lettere).
2. L’utente inserisce un tentativo tramite un form HTML.
3. Dopo l’invio, viene mostrato il risultato con evidenziazione colore (es. con CSS).
4. L’utente ha massimo **6 tentativi**.
5. Il sistema deve riconoscere la vittoria o la sconfitta e visualizzare un messaggio finale.
6. Pulsante per **ricominciare la partita**.
7. (Extra) Possibilità di inserire il nome e salvare punteggi in un file `punteggi.json`.

---

### 🧱 Struttura suggerita

* `index.php`: logica principale e interfaccia
* `parole.txt`: lista parole (una per riga)
* `stile.css`: colori e layout dei quadrati
* (Extra) `punteggi.json`: classifica dei risultati

---

### 🧩 Logica del confronto

Per ogni lettera nel tentativo:

* Se coincide con la lettera della parola segreta **nella stessa posizione** → **verde**
* Se è contenuta **in altra posizione** → **giallo**
* Se **non è presente** → **grigio**

---

### 🎨 Suggerimento stile (CSS)

Ogni lettera può essere inserita in un `<span class="letter green|yellow|gray">A</span>`

```css
.letter {
  display: inline-block;
  width: 40px;
  height: 40px;
  margin: 4px;
  line-height: 40px;
  text-align: center;
  font-weight: bold;
  font-size: 24px;
  border-radius: 4px;
  color: white;
}
.green { background-color: #4CAF50; }
.yellow { background-color: #FFC107; }
.gray { background-color: #9E9E9E; }
```

---

### 🕓 Timeline esercitazione (4 ore)

| Tempo  | Attività                                       |
| ------ | ---------------------------------------------- |
| 30 min | Spiegazione gioco e materiali forniti          |
| 60 min | Lettura parola, gestione sessione e tentativi  |
| 45 min | Logica di confronto e visualizzazione feedback |
| 30 min | Gestione fine partita e reset                  |
| 30 min | Extra: classifica, salvataggio punteggi, CSS   |
| 45 min | Test, debug e presentazione                    |

---

### 📂 Materiale fornito

#### `parole.txt` (lista di parole di 5 lettere)

```
mappa
piano
sasso
luogo
vento
corpo
linea
caldo
tempo
campo
notte
scala
ferro
stato
cielo
porta
forma
terra
fiore
carta
```

Puoi ampliarla con un dizionario reale o usare questa per i test.

---

### 🏁 Obiettivo finale

Al termine, ogni studente avrà creato:

* Un piccolo gioco interattivo in PHP
* Un'app web che gestisce input, sessione e visual feedback
* Una base per giochi più complessi o meccaniche simili

---

## Soluzione

Ecco una **base funzionante HTML + PHP** per la versione web di **PHPWordz – Indovina la Parola**, pronta da estendere. Include:

* Lettura da `parole.txt`
* Gestione sessione
* Form di input
* Verifica parola e feedback colorato
* Fine partita
* Pulsante di reset

---

### 📁 File: `index.php`

```php
<?php
session_start();

const MAX_TENTATIVI = 6;
$messaggio = "";

// Carica parole da file
$parole = file("parole.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Inizializza gioco
if (!isset($_SESSION['parola_segreta'])) {
    $_SESSION['parola_segreta'] = strtolower(trim($parole[array_rand($parole)]));
    $_SESSION['tentativi'] = [];
}

// Gestione reset
if (isset($_GET['reset'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Gestione tentativo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tentativo = strtolower(trim($_POST['tentativo'] ?? ''));

    if (strlen($tentativo) !== 5) {
        $messaggio = "Inserisci una parola di 5 lettere.";
    } elseif (!in_array($tentativo, $parole)) {
        $messaggio = "Parola non valida.";
    } elseif (count($_SESSION['tentativi']) >= MAX_TENTATIVI) {
        $messaggio = "Hai finito i tentativi!";
    } elseif (in_array($tentativo, $_SESSION['tentativi'])) {
        $messaggio = "Hai già provato questa parola.";
    } else {
        $_SESSION['tentativi'][] = $tentativo;
    }
}

// Funzione per generare feedback stile Wordle
function confrontaParola($tentativo, $parola)
{
    $output = [];
    $tentativoArray = str_split($tentativo);
    $parolaArray = str_split($parola);
    $usate = [];

    // Verde prima
    for ($i = 0; $i < 5; $i++) {
        if ($tentativoArray[$i] === $parolaArray[$i]) {
            $output[$i] = ['lettera' => $tentativoArray[$i], 'colore' => 'green'];
            $usate[$i] = true;
        }
    }

    // Giallo e grigio
    for ($i = 0; $i < 5; $i++) {
        if (isset($output[$i])) continue;

        $found = false;
        for ($j = 0; $j < 5; $j++) {
            if (!$usate[$j] && $tentativoArray[$i] === $parolaArray[$j]) {
                $output[$i] = ['lettera' => $tentativoArray[$i], 'colore' => 'yellow'];
                $usate[$j] = true;
                $found = true;
                break;
            }
        }
        if (!$found) {
            $output[$i] = ['lettera' => $tentativoArray[$i], 'colore' => 'gray'];
        }
    }

    return $output;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>PHPWordz</title>
    <link rel="stylesheet" href="stile.css">
</head>
<body>
    <h1>🟩 PHPWordz 🟨</h1>

    <?php if ($messaggio): ?>
        <p class="messaggio"><?= htmlspecialchars($messaggio) ?></p>
    <?php endif; ?>

    <div class="griglia">
        <?php foreach ($_SESSION['tentativi'] as $tentativo): ?>
            <div class="riga">
                <?php foreach (confrontaParola($tentativo, $_SESSION['parola_segreta']) as $info): ?>
                    <span class="letter <?= $info['colore'] ?>"><?= strtoupper($info['lettera']) ?></span>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (end($_SESSION['tentativi']) === $_SESSION['parola_segreta']): ?>
        <p class="vittoria">🎉 Bravo! Hai indovinato: <?= strtoupper($_SESSION['parola_segreta']) ?></p>
        <a href="?reset=1" class="btn">Gioca ancora</a>
    <?php elseif (count($_SESSION['tentativi']) >= MAX_TENTATIVI): ?>
        <p class="sconfitta">😢 Hai perso! La parola era: <?= strtoupper($_SESSION['parola_segreta']) ?></p>
        <a href="?reset=1" class="btn">Riprova</a>
    <?php else: ?>
        <form method="post">
            <input type="text" name="tentativo" maxlength="5" autofocus autocomplete="off" required>
            <button type="submit">Invia</button>
        </form>
        <p>Tentativi rimasti: <?= MAX_TENTATIVI - count($_SESSION['tentativi']) ?></p>
    <?php endif; ?>
</body>
</html>
```

---

### 📁 File: `stile.css`

```css
body {
    font-family: Arial, sans-serif;
    text-align: center;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
}
h1 {
    margin-bottom: 20px;
}
.griglia {
    margin: 20px auto;
    width: fit-content;
}
.riga {
    margin-bottom: 5px;
}
.letter {
    display: inline-block;
    width: 40px;
    height: 40px;
    margin: 2px;
    line-height: 40px;
    text-align: center;
    font-size: 22px;
    font-weight: bold;
    color: white;
    border-radius: 5px;
}
.green { background-color: #4CAF50; }
.yellow { background-color: #FFC107; }
.gray { background-color: #9E9E9E; }

input[type="text"] {
    padding: 10px;
    font-size: 20px;
    width: 120px;
    text-transform: uppercase;
}
button {
    padding: 10px 20px;
    font-size: 18px;
    margin-left: 10px;
}
.btn {
    display: inline-block;
    margin-top: 20px;
    padding: 10px 16px;
    background-color: #333;
    color: white;
    text-decoration: none;
    border-radius: 6px;
}
.messaggio {
    color: red;
}
.vittoria {
    color: green;
    font-size: 20px;
}
.sconfitta {
    color: darkred;
    font-size: 20px;
}
```

---

### 📁 File: `parole.txt`

```
mappa
piano
sasso
luogo
vento
corpo
linea
caldo
tempo
campo
notte
scala
ferro
stato
cielo
porta
forma
terra
fiore
carta
```
