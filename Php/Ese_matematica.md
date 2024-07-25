acquisire un numero intero e visualizzare i suoi divisori
Pagina html
<html>
 <head>
  <title>Divisori</title>
 </head>
 <body bgcolor="lightblue">
  <!-- acquisire un numero intero e visualizzare i suoi divisori -->

  
Digitare un numero intero

   <form action="divisori.php" method="post">

    <input type="text" size="10" maxlength="10" name="numint">

    <input type="submit" value="Invia">
    <input type="reset" value="Cancella">
   </form>
 </body>
</html>
pagina php
<?php
 echo"<html><body bgcolor='lightblue'>";
 //inizializzazione della variabile
 $numint=$_POST['numint'];
 if($numint!=floor($numint) || ($numint<=0))
  echo "Errore! Il numero digitato non è intero o non è posivivo. Ridigitare.";
 else {
  for($i=1;$i<=$numint;$i++) {
   if($numint % $i==0)
    echo  "Il numero $i è divisore di $numint.";
  
  }
 }
?>

---

Creare un programma in php che dati due numeri interi e positivi individui i numeri divisibili per sette e li memorizzi in un file di testo
Pagina html
<html>
 <head>
  <title>Numeri divisibili per sette</title>
 </head>
 <body bgcolor="lightblue">
  
Inserire due numeri interi positivi.

  <form action="divsette.php" method="post">
   <table border="0" align="center">
    <tr>
     <td align="center">Primo numero&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>
     <td align="center">Secondo numero</td>
    </tr>
    <tr>
    </tr>
    <tr>
     <td><input type="text" name="num1" size="20" maxlength="20"></td>
     <td><input type="text" name="num2" size="20" maxlength="20"></td>
    </tr>
    <tr>
    </tr>
    <tr>
     <td align="center"><input type="submit" value="Invia -->&nbsp&nbsp&nbsp&nbsp"></td>
     <td align="center"><input type="reset" value="<-- Cancella"></td>
    </tr>
   </table>
  </form>
 </body>
</html>
Pagina php
<html>
 <head>
  <title>Numeri divisibili per sette</title>
 </head>
 <body bgcolor='lightblue'>
  <?php
   // Inizializzazione delle variabili
   $num1=$_POST['num1'];
   $num=$num1;
   $num2=$_POST['num2'];
   
   /* Verifica che i numeri acquisiti siano positivi e maggiori di zero */
   if ($num1<=0 || $num2<=0) {
    echo "<span>ERRORE!! Uno o entrambi i numeri acquisiti sono minori o uguali a zero.</span>";
    echo "<span>Ridigitare i numeri richiesti.</span>";
   }
   else { // Verifica che i numeri acquisiti siano interi
    if ($num1<>floor($num1) || $num2!=floor($num2)) {
     echo "<span>ERRORE!! Uno o entrambi i numeri acquisiti non sono interi.</span>";
     echo "<span>Ridigitare i numeri richiesti.</span>";
    }
    else {
     // Scambio dei numeri se num1 > di num2
     if ($num1>$num2) {
      $tr=$num1;
      $num1=$num2;
      $num2=$tr;
     }
     /*  Visualizzazione in un browser dei numeri divisibili per sette compresi tra i due numeri acquisiti */
     // Utilizzo del ciclo di iterazione pre condizionale
     /* while ($num1<=$num2) {
      if($num1%7==0)
       echo "$num1 è divisibile per sette.";
     
      $num1++;
     } */
     // Utilizzo del ciclo di iterazione post condizionale
     /* do {
      if($num1%7==0)
       echo "$num1 è divisibile per sette.";
     
      $num1++;
     } while ($num1<=$num2); */
     // Utilizzo del ciclo di iterazione for
     for ($i=$num1;$i<=$num2;$i++) {
      if($i%7==0)
       echo "$i è divisibile per sette.";
     }
     // Memorizzazione dei dati nel file divsette.txt
     $fp=fopen("divsette.txt","a");
     //Verifica dell'esistenza di divsette.txt
     if ($fp) {
      // Blocco del file per la scrittura
      flock($fp,2);
      $nl=chr(13) . chr(10);
      for ($i=$num1;$i<=$num2;$i++) {
       if($i%7==0)
        fputs ($fp,"$i$nl");
       }
      }
      // Sblocco del file divsette.txt
      flock($fp,3);
      // Chiusura del file divsette.txt
      fclose($fp);  
     }
    }
  ?>
 </body>
</html>

---
--------------------------------------------------
Creare un programma in Php per la risoluzione di un'equazione di secondo grado
Pagina html
<html>
 <head>
 <title>Equazioni di secondo grado</title>
 </head>
  <body bgcolor="lightyellow">
  <form action="equsecondo.php" METHOD="POST">
  <input type="TEXT" name="a"> Coefficiente x^2
  <input type="TEXT" name="b"> Coefficiente x
  <input type="TEXT" name="c"> Termine noto
  <input type="SUBMIT" value="invia">
  <input type="RESET" value="cancella">
  </form>
  </body>
</html>
Pagina Php
<?php
echo"<body bgcolor='lightyellow'>";
$a=$_POST['a'];
$b=$_POST['b'];
$c=$_POST['c'];
 //Inserire a, b, c
$d=pow($b,2)-4*$a*$c;
$e=(-1*$b+sqrt($d))/2*$a;
$f=(-1*$b-sqrt($d))/2*$a;
if($a<>0){
if($d>0)
echo"Le soluzioni sono $e e $f";
if($d==0)
echo"La soluzione è $e";
if($d<0)
echo"Soluzione impossibile";
}
?>

---
-------------------------------------------------
Realizzare un programma che inserendo da modulo form un numero definisca la regola di Fibonacci
Pagina html
<html>
<head>
</head>
<body>


Quanti numeri vuoi?

<form action="fibonacci.php">

<input type="text" name="num1">

<input type="submit" value="calcola">
<input type="reset" value="cancella">
</form>
</body>
</html>
Pagina Php
<?php
echo"<body bgcolor='lightgreen'>";
 $pre=1;
 $suc=1;
 $num1=$_POST['num1'];
 if($num1<=0)
 echo "ERRORE!!! Il numero è non positivo. Ridigitare";
 else {
  if($num1!=floor($num1))
  echo "ERRORE!!! Il numero non è intero. Ridigitare";
  else {
   echo "1, ";
   while($suc<=$num1) {
   echo "$suc, ";
   $suc=$suc+$pre;
   $pre=$suc-$pre;
   }
  }
 }
?>

---
---------------------------------------------------
Dati in ingresso con il modulo form  due numeri, individuare quali di questi sono numeri primi
Pagina html
<html>
 <HEAD>
  <TITLE>Numeri primi</TITLE>
 </HEAD>
 <body bgcolor="lightyellow">

    Inserire un numero intero positivo

 <form action="n_primo.php" METHOD="post">

  <input type="TEXT" name="num1"> Digitare un numero

  <input type="TEXT" name="num2"> Digitare un numero

  <input type="SUBMIT" value="invia">
  <input type="RESET" value="cancella tutto">

 </form>
 <body>
</html>
Pagina Php
<?php
 echo"<body bgcolor='lightblue'>";
 $num1 = $_POST['num1'];
 $num2 = $_POST['num2'];
  
 if (($num1 <= 0) || ($num2 <= 0))
  echo "ERRORE!! Uno o entrambi i numeri digitati non sono positivi!";
  else {
 if ($num1!=floor($num1) || $num2!=floor($num2))
  echo "ERRORE!! Uno o entrambi i numeri digitati non sono interi!";
  else {  
 if ($num1 > $num2)
    {
    $tr=$num1;
    $num1=$num2;
    $num2=$tr;
    }
    while ($num1 <= $num2)
    {
     $di = 2;
     $flg = 1;
     while ($di < $num1)
     {
      if (($num1 % $di) == 0)
      {
       $flg = 0;
       $di = $num1;
      }
      $di = $di+1;
     }
     if ($flg == 1)
      echo "Il numero $num1 è primo ";
     $num1 = $num1+1;
    }
   }
  }
?>

---
-----------------------------------------------------
Dato un numero acquisito dall'esterno con il modulo form, individuare il fattoriale di un numero
(In matematica, se n è un intero positivo, si definisce n fattoriale e si indica con n! il prodotto dei primi n numeri interi positivi.)
formula il prodotto del risultato precedente per in numero successivo
 valori per i primi fattoriali sono riassunti nella tabella seguente.
0! 1! 2! 3! 4! 5! 6! 7! 8! 9! 10!          11!                       12!                      13!                     14!
1 1 2 6 24 120 720 5 040 40 320 362 880 3 628 800         39 916 800 479 001 600 6 227 020 800 87 178 291 200

Pagina html
<html>
 <body background="sfondo.jpg">

  <font size="5" color="navy">Fattoriale di un numero inserito</font>

  <form action="fattoriale.php" METHOD="post">

   <input type="text" name="num1"> Inserisci il numero

   <input type="submit" value="invia">
   <input type="reset" value="cancella">
  </form>
 </body>
</html>
Pagina Php
  
<?php

//variabile acquisita in ingresso
  $num1=$_POST['num1'];
echo"<body background='sfondo.jpg'>";
    if($num1<0)echo"ERRORE!!! Il numero deve essere positivo.";
    else
    if($num1!=floor($num1))echo"ERRORE!!! Il numero deve essere intero.";
    else if(($num1==0)||($num1==1)) echo"Il fattoriale di $num1 è 1";
    else { $fatt=1;
    for($i=1;$i<=$num1;$i++){
        $fatt=$fatt*$i;
        }
          echo"<font size='5'><span>Il fattoriale di $num1 è $fatt</span></font>";
    }
?>     

---
-------------------------------------------------------- 
Creare un programma in Php che determini due numeri perfetti compresi tra due numeri inseriti tramite modulo form
Pagina html
<html>
 <HEAD>
  <TITLE>Determinazione dei numeri perfetti compresi tra due numeri inseriti</TITLE>
 </HEAD>
 <body bgcolor="pink">

  
Numeri perfetti compresi tra due numeri inseriti.

  <form action="perfetti.php"  METHOD="POST">
   <TABLE>
   <TR>
    <TD><input type="Text" name="num1"></TD> <TD>Digitare un primo valore</TD>
   </TR>
   <TR>
    <TD><input type="Text" name="num2"></TD> <TD> Digitare un secondo valore</TD>
   </TR>
   </TABLE>
  
   <input type="Submit" value="Invia">
   <input type="Reset" value="Cancella">
  </form>
 </body>
</html>

pagina Php
<?php
echo"<body bgcolor='pink'>";
$num1 = $_POST['num1'];
 $num2 = $_POST['num2'];
  
 if (($num1 <= 0) || ($num2 <= 0))
  echo "ERRORE!! Uno o entrambi i numeri digitati non sono positivi!";
  else {
 if ($num1!=floor($num1) || $num2!=floor($num2))
  echo "ERRORE!! Uno o entrambi i numeri digitati non sono interi!";
  else {  
 if ($num1 > $num2)
    {
    $tr=$num1;
    $num1=$num2;
    $num2=$tr;
    }
    while ($num1 <= $num2)
    {
     $somma=0;
     for($i=1;$i<=floor($num1/2);$i++)
     {
     if(($num1%$i)==0)
     $somma=$somma+$i;
     }
     if($somma==$num1)

      echo"Il numero $num1 è perfetto
";
      $num1=$num1+1;
     }
    }
   }
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Title</h5>
    <p class="card-text">Content</p>
  </div>
  <img class="card-img-bottom" src="" alt="">
</div>
