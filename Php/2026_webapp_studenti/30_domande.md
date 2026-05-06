## 1) Che differenza c’è tra `echo` e `print`?

**Risposta:**

* `echo` può stampare più argomenti (`echo "a", "b";`) ed è leggermente più veloce.
* `print` restituisce sempre `1`, quindi può essere usato in espressioni (`$x = print("ciao");`).

---

## 2) Differenza tra `==` e `===`?

**Risposta:**

* `==` confronta solo il valore (con conversione automatica di tipo).
* `===` confronta valore **e tipo**.

Esempio:

```php
"5" == 5   // true
"5" === 5  // false
```

---

## 3) Cos’è una variabile superglobale? Fai esempi

**Risposta:**
Sono variabili disponibili in ogni scope, anche dentro funzioni.
Esempi: `$_GET`, `$_POST`, `$_SERVER`, `$_SESSION`, `$_COOKIE`, `$_FILES`.

---

## 4) Differenza tra `isset()` e `empty()`?

**Risposta:**

* `isset($x)` → true se la variabile esiste e non è `null`.
* `empty($x)` → true se la variabile è vuota (0, "", null, false, array vuoto).

---

## 5) Differenza tra `include` e `require`?

**Risposta:**

* `include`: se il file manca → warning, lo script continua.
* `require`: se il file manca → fatal error, lo script si ferma.

---

## 6) Differenza tra `include_once` e `include`?

**Risposta:**
`include_once` include il file solo una volta, evitando inclusioni multiple.

---

## 7) Cos’è lo scope di una variabile in PHP?

**Risposta:**
È la “visibilità” della variabile. Variabili definite fuori da una funzione non sono accessibili dentro la funzione, salvo usare `global` o `$GLOBALS`.

---

## 8) A cosa serve la keyword `global`?

**Risposta:**
Serve per usare una variabile globale dentro una funzione.

Esempio:

```php
$x = 10;
function test() {
  global $x;
  echo $x;
}
```

---

## 9) Come si definisce una costante in PHP?

**Risposta:**
Con `define()` oppure `const`.

```php
define("PI", 3.14);
const MAX = 100;
```

---

## 10) Differenza tra `const` e `define()`?

**Risposta:**

* `const` si usa a compile-time, spesso nelle classi.
* `define()` può essere usato anche dinamicamente.

---

## 11) Differenza tra array indicizzati e associativi?

**Risposta:**

* Indicizzati: chiavi numeriche automatiche (`[0,1,2]`)
* Associativi: chiavi stringa (`["nome"=>"Mario"]`)

---

## 12) Come aggiungere un elemento a un array?

**Risposta:**
Metodo più comune:

```php
$arr[] = 10;
```

oppure:

```php
array_push($arr, 10);
```

---

## 13) Differenza tra `explode()` e `implode()`?

**Risposta:**

* `explode(delimitatore, stringa)` → trasforma stringa in array.
* `implode(delimitatore, array)` → trasforma array in stringa.

---

## 14) A cosa serve `count()`?

**Risposta:**
Restituisce il numero di elementi di un array.

```php
count($arr);
```

---

## 15) Differenza tra `sort()`, `asort()`, `ksort()`?

**Risposta:**

* `sort()` ordina valori e **resetta le chiavi**.
* `asort()` ordina valori mantenendo le chiavi.
* `ksort()` ordina in base alle chiavi.

---

## 16) Come si gestiscono gli errori in PHP con eccezioni?

**Risposta:**
Con `try/catch`.

```php
try {
   throw new Exception("Errore!");
} catch(Exception $e) {
   echo $e->getMessage();
}
```

---

## 17) Differenza tra GET e POST?

**Risposta:**

* GET: parametri in URL, usato per lettura dati.
* POST: dati nel body, usato per inserimento/modifica dati.

---

## 18) Come leggere un parametro GET in PHP?

**Risposta:**

```php
$id = $_GET["id"];
```

---

## 19) Come leggere un parametro POST in PHP?

**Risposta:**

```php
$nome = $_POST["nome"];
```

---

## 20) Come leggere JSON inviato con POST/PUT?

**Risposta:**

```php
$data = json_decode(file_get_contents("php://input"), true);
```

---

## 21) A cosa serve `header()`?

**Risposta:**
Serve per inviare header HTTP (content type, redirect, ecc.)

Esempio:

```php
header("Content-Type: application/json");
```

---

## 22) Come fare un redirect in PHP?

**Risposta:**

```php
header("Location: login.php");
exit;
```

---

## 23) Cos’è una sessione in PHP?

**Risposta:**
È un meccanismo per mantenere dati lato server associati a un utente.

---

## 24) Come si usa una sessione?

**Risposta:**

```php
session_start();
$_SESSION["user"] = "Mario";
```

---

## 25) Differenza tra cookie e sessione?

**Risposta:**

* Cookie: salvato nel browser (client-side).
* Sessione: salvata sul server (server-side), identificata da cookie di sessione.

---

## 26) Cos’è PDO e perché si usa?

**Risposta:**
PDO è una libreria per accedere ai database in modo standard e sicuro, supportando prepared statements.

---

## 27) Perché usare prepared statements?

**Risposta:**
Per evitare SQL Injection e gestire correttamente parametri.

Esempio:

```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$email]);
```

---

## 28) Differenza tra `fetch()` e `fetchAll()` in PDO?

**Risposta:**

* `fetch()` restituisce una sola riga.
* `fetchAll()` restituisce tutte le righe.

---

## 29) Differenza tra `public`, `private`, `protected`?

**Risposta:**

* `public`: accessibile ovunque.
* `private`: accessibile solo dentro la classe.
* `protected`: accessibile nella classe e nelle sottoclassi.

---

## 30) Differenza tra `$this` e `self`?

**Risposta:**

* `$this` si riferisce all’istanza corrente (oggetto).
* `self` si riferisce alla classe stessa (metodi/attributi statici).

Esempio:

```php
class Test {
  public static $x = 10;
  public function stampa() {
     echo self::$x;
  }
}
```
