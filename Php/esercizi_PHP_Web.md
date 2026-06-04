# Esercitazioni PHP – Raccolta Progressiva Ordinata per Difficoltà
## Introduzione
Questa raccolta contiene esercizi PHP organizzati dal livello più semplice al più avanzato. Gli argomenti trattati includono:
* Variabili e output
* Form HTML e gestione dei dati POST
* Strutture di controllo
* Cicli
* Array indicizzati
* Array associativi
* Manipolazione di stringhe
* Gestione URL e server
* File di testo
* Funzioni personalizzate
* Algoritmi numerici
---
# LIVELLO 1 – Fondamenti PHP
## Esercizio 1 – Visualizzare il nome del file corrente
### Obiettivo
Visualizzare il nome del file PHP in esecuzione.
```php
<?php
$current_file_name = basename($_SERVER['PHP_SELF']);
echo $current_file_name;
?>
```
---
## Esercizio 2 – Visualizzare il Browser dell'utente
### Obiettivo
Mostrare il browser utilizzato dall'utente.
```php
<?php
echo "User Agent: " . $_SERVER['HTTP_USER_AGENT'];
?>
```
---
## Esercizio 3 – Ottenere l'indirizzo IP del client
### Obiettivo
Visualizzare l'indirizzo IP del visitatore.
```php
<?php
if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
	$ip_address = $_SERVER['HTTP_CLIENT_IP'];
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
	$ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
}
else {
	$ip_address = $_SERVER['REMOTE_ADDR'];
}

echo $ip_address;
?>
```
---
## Esercizio 4 – Verificare HTTP o HTTPS
### Obiettivo
Controllare se il sito è raggiunto tramite protocollo HTTPS.
```php
<?php
if (!empty($_SERVER['HTTPS'])) {
	echo "HTTPS attivo";
}
else {
	echo "HTTPS non attivo";
}
?>
```
---
# LIVELLO 2 – Form HTML e Input Utente
## Esercizio 5 – Form di Benvenuto
### Obiettivo
Acquisire il nome dell'utente e visualizzare un messaggio di benvenuto.
### Pagina PHP
```php
<!DOCTYPE html>
<html>
<body>
<form method="POST">
    <h2>Inserisci il tuo nome:</h2>
    <input type="text" name="name">
    <input type="submit" value="Invia">
</form>
<?php

$name = $_POST['name'] ?? '';

if($name != ''){
	echo "<h3>Ciao $name</h3>";
}

?>
</body>
</html>
```
---
## Esercizio 6 – Inserimento dati azienda
### Obiettivo
Acquisire e visualizzare i dati di una ditta.
### Form HTML
```html
<form action="ditta.php" method="POST">
<input type="text" name="Nome">
<input type="text" name="Ragionesociale">
<input type="text" name="Indirizzo">
<input type="text" name="Partitaiva">
<input type="submit">
</form>
```
### Elaborazione PHP
```php
<?php

echo "Nome: ".$_POST['Nome'];
echo "Ragione Sociale: ".$_POST['Ragionesociale'];
echo "Indirizzo: ".$_POST['Indirizzo'];
echo "Partita IVA: ".$_POST['Partitaiva'];

?>
```
---
## Esercizio 7 – Controllo formale Codice Fiscale
### Obiettivo
Verificare che il codice fiscale inserito abbia esattamente 13 caratteri.
```php
<?php

$codice = $_POST['codice'];

if(strlen($codice) != 13)
{
	echo "Codice fiscale non valido";
}
else
{
	echo "Codice fiscale corretto";
}

?>
```
---
# LIVELLO 3 – Cicli
## Esercizio 8 – Tabellina di un numero
### Obiettivo
Stampare la tabellina del numero inserito.
```php
<?php

$a = $_POST['a'];

for ($i=1;$i<=10;$i++)
{
	echo "$a x $i = ".($a*$i)."<br>";
}

?>
```
---
## Esercizio 9 – Tabellina del 2 con While
```php
<?php

$a = 2;
$i = 1;

while($i <= 10)
{
	echo "$a x $i = ".($a*$i)."<br>";
	$i++;
}

?>
```
---
# LIVELLO 4 – Stringhe e Validazioni
## Esercizio 10 – Validazione Email
```php
<?php

$email = "mail@example.com";

if(filter_var($email,FILTER_VALIDATE_EMAIL))
{
	echo "Email valida";
}
else
{
	echo "Email non valida";
}

?>
```
---
## Esercizio 11 – Colorare la prima lettera di ogni parola
```php
<?php

$text = "PHP Tutorial";

$text = preg_replace(
    '/(\b[a-z])/i',
    '<span style="color:red;">\1</span>',
    $text
);

echo $text;

?>
```
---
# LIVELLO 5 – URL e Navigazione
## Esercizio 12 – Analizzare una URL
```php
<?php

$url = parse_url(
'http://www.w3resource.com/php-exercises/php-basic-exercises.php'
);

echo $url['scheme'];
echo $url['host'];
echo $url['path'];

?>
```
---
## Esercizio 13 – Reindirizzamento Pagina
```php
<?php

header("Location: http://www.w3resource.com/");

?>
```
---
# LIVELLO 6 – Tabelle HTML
## Esercizio 14 – Visualizzare dati in una tabella
```php
<?php

$a = 1000;
$b = 1200;
$c = 1400;

echo "
<table border='1'>
<tr>
<td>Sig. A</td>
<td>$a</td>
</tr>
<tr>
<td>Sig. B</td>
<td>$b</td>
</tr>
<tr>
<td>Sig. C</td>
<td>$c</td>
</tr>
</table>
";

?>
```
---
# LIVELLO 7 – Array Indicizzati
## Esercizio 15 – Temperature settimanali
```php
<?php

$tp = array(
17.5,
19.2,
21.8,
21.6,
17.5,
20.2,
16.6
);

for ($i=0;$i<count($tp);$i++)
{
	echo $tp[$i]."<br>";
}

?>
```
---
## Esercizio 16 – Nome ed età
```php
<?php

$nome = array(
"Paolo",
"Marco",
"Giovanna",
"Maurizio",
"Francesca",
"Maria"
);

$eta = array(
47,
21,
42,
54,
51,
17
);

for ($i=0;$i<count($nome);$i++)
{
	echo $nome[$i]." - ".$eta[$i]." anni<br>";
}

?>
```
---
## Esercizio 17 – Ordinamento di un array
```php
<?php

$persone = array(
"Eleonora",
"Alessandra",
"Francesca",
"Andrea",
"Marco",
"Gabriele",
"Michele",
"Zorro"
);

rsort($persone);

foreach($persone as $persona)
{
	echo $persona."<br>";
}

?>
```
---
# LIVELLO 8 – Array Associativi
## Esercizio 18 – Province e sigle
### Obiettivo
Creare un array associativo contenente:
* Provincia
* Sigla
```php
<?php

$province = array(

"Novara" => "NO",
"Torino" => "TO",
"Milano" => "MI",
"Roma" => "RM"

);

foreach($province as $nome => $sigla)
{
	echo "$nome : $sigla<br>";
}

?>
```
---
## Esercizio 19 – Ordinamento Array Associativi
```php
<?php

$regioni = array(

"LA" => "Roma",
"LO" => "Milano",
"CA" => "Napoli",
"PI" => "Torino"

);

asort($regioni);

foreach($regioni as $k => $v)
{
	echo "$k - $v<br>";
}

?>
```
---
# LIVELLO 9 – Gestione File
## Esercizio 20 – Contare le righe di un file
```php
<?php

$file = "testo.txt";

$numeroRighe = count(
file($file)
);

echo $numeroRighe;

?>
```
---
## Esercizio 21 – Data ultima modifica
```php
<?php

$file = "testo.txt";

echo date(
"d/m/Y H:i",
filemtime($file)
);

?>
```
---
## Esercizio 22 – Visualizzare il sorgente di una pagina web
```php
<?php

$all_lines = file(
"http://www.example.com/"
);

foreach($all_lines as $line)
{
	echo htmlspecialchars($line);
}

?>
```
---
# LIVELLO 10 – Salvataggio dati su file
## Esercizio 23 – Anagrafe con file TXT
### Obiettivi
* Acquisire dati da form
* Validare CAP
* Salvare i dati su file CSV/TXT
### Campi richiesti
* Nome
* CAP
* Località
* Provincia
* Sesso
* Interessi
### Salvataggio
```php
<?php

$fp = fopen("anagrafe.txt","a");

if($fp)
{
	flock($fp,LOCK_EX);
	
	fputs(
			        $fp,
			        "$nome,$cap,$local,$prov,$sesso\n"
			    );
	
	flock($fp,LOCK_UN);
	
	fclose($fp);
}

?>
```
---
# LIVELLO 11 – Funzioni e Algoritmi
## Esercizio 24 – Verificare se un numero è potenza di 2
```php
<?php

function isPowerOfTwo($n)
{
	return ($n & ($n-1)) == 0;
}

?>
```
---
## Esercizio 25 – Verificare se un numero è potenza di 3
```php
<?php

function isPowerOfThree($n)
{
	while($n % 3 == 0)
			    {
		$n /= 3;
	}
	
	return $n == 1;
}

?>
```
---
## Esercizio 26 – Verificare se un numero è potenza di 4
```php
<?php

function isPowerOfFour($n)
{
	while($n % 4 == 0)
			    {
		$n /= 4;
	}
	
	return $n == 1;
}

?>
```
---
## Esercizio 27 – Verificare se un numero è potenza di un altro
```php
<?php

function isPower($x,$y)
{
	while($x % $y == 0)
			    {
		$x /= $y;
	}
	
	return $x == 1;
}

?>
```
---
# LIVELLO 12 – Algoritmi su Array
## Esercizio 28 – Numeri mancanti in una sequenza
```php
<?php

function missingNumber($num_list)
{
	$new_arr = range(
			        $num_list[0],
			        max($num_list)
			    );
	
	return array_diff(
			        $new_arr,
			        $num_list
			    );
}

print_r(
missingNumber(
[1,2,3,6,7,8]
));

?>
```
---
# Proposte di Estensione
Dopo aver completato tutti gli esercizi, sviluppare:
1. Rubrica contatti con file CSV
2. Registro studenti con array associativi
3. Gestione prodotti e carrello
4. Sistema login con sessioni
5. Upload immagini
6. CRUD completo con MySQL e PDO
7. API REST in PHP
8. Gestione JSON
9. Sistema prenotazioni
10. Mini gestionale web MVC
Questi esercizi costituiscono una progressione naturale verso PHP moderno, PDO, Composer e framework come Laravel.
