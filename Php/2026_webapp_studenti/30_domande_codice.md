# 1) Cosa stampa questo codice?

```php
echo "10" + "20";
```

✅ **Risposta:** stampa `30`
📌 PHP converte stringhe numeriche in numeri se usi `+`.

---

# 2) Cosa stampa?

```php
echo "10" . "20";
```

✅ **Risposta:** stampa `"1020"`
📌 `.` è concatenazione stringhe.

---

# 3) Cosa vale?

```php
var_dump("0" == false);
```

✅ **Risposta:** `bool(true)`
📌 confronto debole (`==`) converte tipi.

---

# 4) E questo?

```php
var_dump("0" === false);
```

✅ **Risposta:** `bool(false)`
📌 confronto stretto (`===`) richiede stesso tipo.

---

# 5) Cosa stampa?

```php
$a = 5;
echo $a++;
```

✅ **Risposta:** stampa `5`
📌 post-incremento: incrementa dopo.

---

# 6) Cosa stampa?

```php
$a = 5;
echo ++$a;
```

✅ **Risposta:** stampa `6`
📌 pre-incremento: incrementa prima.

---

# 7) Cosa stampa?

```php
echo 1/2;
```

✅ **Risposta:** `0.5`
📌 PHP fa divisione reale (non intera come Java in certi casi).

---

# 8) Cosa succede?

```php
$x = null;
echo isset($x);
```

✅ **Risposta:** stampa stringa vuota (false)
📌 `isset(null)` è false.

---

# 9) Cosa succede?

```php
$x = 0;
echo empty($x);
```

✅ **Risposta:** stampa `1` (true)
📌 `empty(0)` è true.

---

# 10) Differenza tra `unset($x)` e `$x = null`?

✅ **Risposta:**

* `unset($x)` elimina la variabile.
* `$x = null` la lascia esistente ma con valore null.

---

# 11) Cosa stampa?

```php
$x = "ciao";
function test() {
  echo $x;
}
test();
```

✅ **Risposta:** warning/errore di variabile non definita (o nulla)
📌 dentro funzione `$x` non esiste.

---

# 12) Cosa stampa?

```php
$x = "ciao";
function test() {
  global $x;
  echo $x;
}
test();
```

✅ **Risposta:** stampa `ciao`.

---

# 13) Cosa stampa?

```php
echo strlen("à");
```

✅ **Risposta:** spesso `2`
📌 in UTF-8 alcuni caratteri valgono più byte.
Per caratteri: `mb_strlen()`.

---

# 14) Cosa stampa?

```php
echo strlen("");
```

✅ **Risposta:** `0`

---

# 15) Cosa stampa?

```php
$arr = [1,2,3];
echo $arr;
```

✅ **Risposta:** Warning + stampa `Array`
📌 per stampare array serve `print_r()` o `var_dump()`.

---

# 16) Cosa stampa?

```php
$arr = [1,2,3];
echo count($arr);
```

✅ **Risposta:** `3`

---

# 17) Che differenza c’è tra `==` e `strcmp()`?

✅ **Risposta:**

* `==` può fare conversioni automatiche
* `strcmp()` confronta stringhe in modo preciso e ritorna:

  * 0 se uguali
  * <0 se prima minore
  * > 0 se prima maggiore

---

# 18) Cosa stampa?

```php
$x = "10abc";
echo (int)$x;
```

✅ **Risposta:** `10`
📌 cast prende la parte numerica iniziale.

---

# 19) Cosa stampa?

```php
$x = "abc10";
echo (int)$x;
```

✅ **Risposta:** `0`
📌 la stringa non inizia con numero.

---

# 20) Cosa stampa?

```php
echo true;
```

✅ **Risposta:** `1`

---

# 21) Cosa stampa?

```php
echo false;
```

✅ **Risposta:** stringa vuota (non stampa nulla)

---

# 22) Cosa stampa?

```php
var_dump(0 == "ciao");
```

✅ **Risposta:** `bool(false)` (nelle versioni moderne)
📌 in passato alcuni confronti strani potevano diventare true.
Oggi PHP è più rigido in molti casi.

---

# 23) Differenza tra `require` e `require_once`?

✅ **Risposta:**

* `require` include sempre il file
* `require_once` lo include solo una volta

📌 Se includi 2 volte una classe senza `_once` → fatal error.

---

# 24) Cosa stampa?

```php
function f($x = 10) {
  return $x;
}
echo f(null);
```

✅ **Risposta:** stampa stringa vuota (null)
📌 passing `null` NON usa il valore di default. Il default vale solo se non passi nulla.

---

# 25) Che differenza c’è tra `== null` e `is_null()`?

✅ **Risposta:**

* `== null` può dare risultati strani con conversioni.
* `is_null($x)` è più chiaro e sicuro.

---

# 26) Cosa stampa?

```php
$a = [1,2,3];
$b = $a;
$b[0] = 99;
echo $a[0];
```

✅ **Risposta:** `1`
📌 array assegnato per valore (copy-on-write).

---

# 27) Cosa stampa?

```php
$a = [1,2,3];
$b = &$a;
$b[0] = 99;
echo $a[0];
```

✅ **Risposta:** `99`
📌 `&` crea riferimento.

---

# 28) Cosa stampa?

```php
$x = 10;
$y = "10";
var_dump($x === $y);
```

✅ **Risposta:** `bool(false)`
📌 tipi diversi.

---

# 29) Cosa succede qui?

```php
header("Location: home.php");
echo "ciao";
```

✅ **Risposta:** redirect avviene, ma **non è garantito** se output è già iniziato.
📌 meglio fare:

```php
header("Location: home.php");
exit;
```

---

# 30) Perché questo è pericoloso?

```php
$sql = "SELECT * FROM users WHERE email = '$email'";
```

✅ **Risposta:** vulnerabile a SQL Injection.
📌 bisogna usare prepared statement:

```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$email]);
```

