


<!-- PHP Exercises : Create a html form and accept the user name and display the name


PHP : Esercizio n.4 con Soluzione

Crea un form html con un campo input per il nome, poi con uno script PHP ricevi il parametro passato
via post e stampalo a video con un messaggio di benvenuto.
Sample Output :

sample html form

Sample Solution: -

PHP Code:
-->

    <!DOCTYPE html>  
    <html>  
    <head>  
       <title></title>  
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">  
       </head>  
       <body>  
       <form method='POST'>  
       <h2>Please input your name:</h2>  
     <input type="text" name="name">  
     <input type="submit" value="Submit name">  
     </form>  
    <?php  
    //Retrieve name from query string and store to a local variable  
    $name = $_POST['name'];  
    echo "<h3> Hello $name </h3>";  
    ?>  
    </body>  
    </html>  


<!-- *********************************************************************************************** -->



<!-- PHP Exercises: Get the client IP address

PHP : Esercizio n.5 con Soluzione

Write a PHP script to get the client IP address.

Sample Solution: -

PHP Code:
-->


    <?php  
    //whether ip is from share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP']))     
      {  
        $ip_address = $_SERVER['HTTP_CLIENT_IP'];  
      }  
    //whether ip is from proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))    
      {  
        $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];  
      }  
    //whether ip is from remote address  
    else  
      {  
        $ip_address = $_SERVER['REMOTE_ADDR'];  
      }  
    echo $ip_address;  
    ?>  








<!-- *********************************************************************************************** -->


<!-- PHP Exercises : PHP browser detection script

PHP : Esercizio n.6 con Soluzione

Write a simple PHP browser detection script.
Sample Output : Your User Agent is :Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (Khtml, like Gecko) Chrome/35.0.1916.114 Safari/537.36

Sample Solution: -

PHP Code:
-->


    <?php  
    echo "Your User Agent is :" . $_SERVER ['HTTP_USER_AGENT'];  
    ?>  



<!-- *********************************************************************************************** -->


<!-- PHP Exercises : Get the current file name

PHP : Esercizio n.7 con Soluzione

Write a PHP script to get the current file name.

Sample Solution: -

PHP Code:
-->


    <?php  
    $current_file_name = basename($_SERVER['PHP_SELF']);  
    echo $current_file_name."\n";  
    ?>  



<!-- *********************************************************************************************** -->

<!-- PHP Exercises : Return some components of an url

PHP : Esercizio n.8 con Soluzione

Write a PHP script, which will return the following components of the url 'http://www.w3resource.com/php-exercises/php-basic-exercises.php'.

List of components : Scheme, Host, Path
Expected Output :
Scheme : http
Host : www.w3resource.com
Path : /php-exercises/php-basic-exercises.php

Sample Solution: -

PHP Code:
-->


    <?php  
    $url = 'http://www.w3resource.com/php-exercises/php-basic-exercises.php';  
    $url=parse_url($url);  
    echo 'Scheme : '.$url['scheme']."\n";  
    echo 'Host : '.$url['host']."\n";  
    echo 'Path : '.$url['path']."\n";  
    ?>  


<!-- *********************************************************************************************** -->

<!-- PHP Exercises : Change the color of first character of a word

PHP : Esercizio n.9 con Soluzione

Write a PHP script, which change the color of first character of a word.

Sample string : PHP Tutorial
Expected Output :
PHP Tutorial

Sample Solution: -

PHP Code:
-->


    <?php  
    $text = 'PHP Tutorial';  
    $text = preg_replace('/(\b[a-z])/i','<span style="color:red;">\1</span>',$text);  
    echo $text;  
    ?>  



<!-- *********************************************************************************************** -->

<!-- PHP Exercises : Check whether the page is called from 'https' or 'http'

PHP : Esercizio n.10 con Soluzione

Write a PHP script, to check whether the page is called from 'https' or 'http'.

Sample Solution: -

PHP Code:
-->


    <?php  
    if (!empty($_SERVER['HTTPS']))   
    {  
      echo 'https is enabled';  
    }  
    else  
    {  
    echo 'http is not enabled'."\n";  
    }  
    ?>  


<!-- *********************************************************************************************** -->

<!-- PHP Exercises : Redirect a user to a different page

PHP : Esercizio n.11 con Soluzione

Write a PHP script to redirect a user to a different page .

Expected output : Redirect the user to http://www.w3resource.com/

Sample Solution: -

PHP Code:
-->


    <?php  
    header('Location: http://www.w3resource.com/');  
    ?>  


<!-- *********************************************************************************************** -->

<!-- PHP Exercises : Email validation

PHP : Esercizio n.12 con Soluzione

Write a simple PHP program to check that emails are valid.

Hints : Use FILTER_VALIDATE_EMAIL filter that validates value as an e-mail address.
Note : The PHP documentation does not saying that FILTER_VALIDATE_EMAIL should pass the RFC5321.

Sample Solution: -

PHP Code:
-->


    <?php  
    // pass valid/invalid emails  
    $email = "mail@example.com";  
    if (filter_var($email, FILTER_VALIDATE_EMAIL))   
    {  
         echo '"' . $email . '" = Valid'."\n";  
    }  
    else   
    {  
         echo '"' . $email . '" = Invalid'."\n";  
    }  
    ?>  

<!-- *********************************************************************************************** -->

<!-- PHP Exercises : Display string, values within a table

PHP : Esercizio n.13 con Soluzione

Write a e PHP script to display string, values within a table.

Note : Use html table elements into echo.
Expected Output :
php table

Sample Solution: -

PHP Code
-->


    <?php  
    $a=1000;  
    $b=1200;  
    $c=1400;  
    echo "<table border=1 cellspacing=0 cellpading=0>  
    <tr> <td><font color=blue>Salary of Mr. A is</td> <td>$a$</font></td></tr>   
    <tr> <td><font color=blue>Salary of Mr. B is</td> <td>$b$</font></td></tr>  
    <tr> <td><font color=blue>Salary of Mr. C is</td> <td>$c$</font></td></tr>  
    </table>";  
    ?>  


<!-- *********************************************************************************************** -->

<!-- PHP Exercises : Display source code of a webpage

PHP : Esercizio n.14 con Soluzione

Write a PHP script to display source code of a webpage (e.g. "http://www.example.com/").

Sample Solution: -

PHP Code:
-->


    <?php  
    $all_lines = file('http://www.w3resource.com/');  
    foreach ($all_lines as $line_num => $line)  
     {  
        echo "Line No.-{$line_num}: " . htmlspecialchars($line) . "\n";  
     }  
    ?>  


<!-- *********************************************************************************************** -->

<!-- PHP Exercises : Get last modified information of a file

PHP : Esercizio n.15 con Soluzione

Write a PHP script to get last modified information of a file.

Sample filename : php-basic-exercises.php
Sample Output : Last modified Monday, 09th June, 2014, 06:45am

Sample Solution: -

PHP Code:
-->


    <?php  
    $current_file_name = basename($_SERVER['PHP_SELF']);  
    $file_last_modified = filemtime($current_file_name);   
    echo "Last modified " . date("l, dS F, Y, h:ia", $file_last_modified)."\n";  
    ?>  

<!-- *********************************************************************************************** -->

<!-- PHP Exercises : Count number of lines in a file

PHP : Esercizio n.16 con Soluzione

Write a PHP script to count lines in a file.

Note : Store a text file name into a variable and count the number of lines of text it has.

Sample Solution: -

PHP Code:
-->


    <?php  
    $file = basename($_SERVER['PHP_SELF']);   
    $no_of_lines = count(file($file));   
    echo "There are $no_of_lines lines in $file"."\n";  
    ?>  


<!-- PHP Challenges********************************************************************************* -->



<!--
PHP Challenges: Check if a given positive integer is a power of two

PHP Challenges - 1: Esercizio n.1 con Soluzione

Write a PHP program to check if a given positive integer is a power of two.

Input : 4
Output :4 is power of 2

Explanation :

PHP: Check if a given positive integer is a power of two



PHP Code :
-->


    <?php  
    function is_Power_of_two($n)  
    {  
       if(($n & ($n - 1)) == 0)  
        {  
            return "$n is power of 2";  
        }  
       else  
        {  
            return "$n is not power of 2";  
        }  
    }  
    print_r(is_Power_of_two(4)."\n");  
    print_r(is_Power_of_two(36)."\n");  
    print_r(is_Power_of_two(16)."\n");  
    ?>  








<!-- *********************************************************************************************** -->


<!--
PHP Challenges: Check if an given positive integer is a power of three

PHP Challenges - 1: Esercizio n.2 con Soluzione

Write a PHP program to check if a given positive integer is a power of three.

Input : 9
Output : 9 is power of 3

Explanation :

PHP: Check if an given positive integer is a power of three



PHP Code :
-->


    <?php  
    function is_Power_of_three($n)  
    {  
          $x = $n;  
          while ($x % 3 == 0) {  
          $x /= 3;  
         }  
             
        if($x == 1)  
        {  
            return "$n is power of 3";  
        }  
        else  
        {  
            return "$n is not power of 3";  
        }  
        
    }  
    print_r(is_Power_of_three(9)."\n");  
    print_r(is_Power_of_three(81)."\n");  
    print_r(is_Power_of_three(21)."\n");  
    ?>  


<!-- *********************************************************************************************** -->

<!--
PHP Challenges: Check if a given positive integer is a power of four

PHP Challenges - 1: Esercizio n.3 con Soluzione

Write a PHP program to check if a given positive integer is a power of four.

Input : 4
Output : 4 is power of 4

Explanation :

PHP: Check if a given positive integer is a power of four



PHP Code :
-->


    <?php  
    function is_Power_of_four($n)  
    {  
          $x = $n;  
          while ($x % 4 == 0) {  
          $x /= 4;  
         }  
             
        if($x == 1)  
        {  
            return "$n is power of 4";  
        }  
        else  
        {  
            return "$n is not power of 4";  
        }  
        
    }  
    print_r(is_Power_of_four(4)."\n");  
    print_r(is_Power_of_four(36)."\n");  
    print_r(is_Power_of_four(16)."\n");  
    ?>  

<!-- *********************************************************************************************** -->


<!--
PHP Challenges: Check if an integer is the power of another integer

PHP Challenges - 1: Esercizio n.4 con Soluzione

Write a PHP program to check if an integer is the power of another integer.

Input : 16, 2
Output : 16 is power of 2

Example: For x = 16 and y = 2 the answer is "true", and for x = 12 and y = 2 "false"

Explanation :

PHP: Check if an integer is the power of another integer



PHP Code :
-->

    <?php  

    function is_Power($x, $y)  
    {  
          $a = $x;  
          $b = $y;  
          while ($x % $y == 0) {  
           $x = $x / $y;  
         }  
             
        if($x == 1)  
        {  
            return "$a is power of $b";  
        }  
        else  
        {  
            return "$a is not power of $b";  
        }  
        
    }  
    print_r(is_Power(16,2)."\n");  
    print_r(is_Power(12,2)."\n");  
    print_r(is_Power(81,3)."\n");  
    ?>  

<!-- *********************************************************************************************** -->


<!--
PHP Challenges: Find a missing number(s) from an array

PHP Challenges - 1: Esercizio n.5 con Soluzione

Write a PHP program to find a missing number(s) from an array.

Input : 1,2,3,6,7,8
Output : Array
(
[3] => 4
[4] => 5
)

Explanation :

PHP: Find a missing number(s) from an array



PHP Code :
-->

        <?php  

    function missing_number($num_list)  
    {  
       
    // construct a new array  
    $new_arr = range($num_list[0],max($num_list));                                                      
      
    // use array_diff to find the missing elements   
    return array_diff($new_arr, $num_list);  
      
    }  
      
    print_r(missing_number(array(1,2,3,6,7,8)));  
    print_r(missing_number(array(10,11,12,14,15,16,17)));  
    ?>  

<!-- *********************************************************************************************** -->




Creare la tabellina del numero acquisito dal modulo form
<?php
$a=$_POST['a'];
echo "La tabellina del $a:\n";
for ($i = 1; $i<=10;$i++){
echo "$a per $i = ". ($a*$i) ."\n";
}

?>
-------------------------------------------------------------------------------------------
Creare la tabellina del due senza modulo form usando il ciclo while
<?php
$a = 2;
$b = 0;
$i = 1;
echo " La tabellina del $a  ". "\n";
while($b<20)
{
    $b = $a * $i;
    echo "$a per $i = $b\n";
    $i++;
}
 ?>
-------------------------------------------------------------------------------------------
Creare un programma in php cche controlli formalmente se sono stati digitati i 13 elementi del codice fiscale
pagina html
<html>
 <head>
  <title>Cosice Fiscale</title>
 </head>
 <body>
 <form action="codicefiscale.php" method="POST">

 
Controllo del codice fiscale

 <input type="text" size="13" maxlength="13" name="codice"> Inserire qui il codice fiscale
 <input type="submit" value="invia"><input type="reset" value="cancella">
 </form>
 </body>
</html>

seconda pagina in php:
<?php
 $codice=$_POST['codice'];
 if(strlen($codice)!=13;
 echo "Il codice non è valido. Ridigitare!";
 else echo"$codice";



 ?>
--------------------------------------------------------------------------------------------
Inserire da modulo form i dati di un'azienda
pagina html
<html>
<body>
<form action="ditta.php"  METHOD="POST">
<input type="Text" name="Nome"> Nome
<input type="Text" name="Ragionesociale"> Ragione sociale
<input type="Text" name="Indirizzo"> Indirizzo
<input type="Text" name="Partitaiva"> Partita IVA
<input type="Submit" value="invia">
<input type="Reset" value="cancella">
</form>
</body>
</html>
pagina php
<html>
<body>
<?php
   
$Nome=$_POST['Nome'];
$Ragionesociale=$_POST['Ragionesociale'];
$Indirizzo=$_POST['Indirizzo'];
$Partitaiva=$_POST['Partitaiva'];
echo"Nome: $Nome ";
echo"Ragione sociale: $Ragionesociale ";
echo"Indirizzo: $Indirizzo ";
echo"Partita IVA: $Partitaiva";
?>
</body>
</html>

Esercizi con i vettori
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Title</h5>
    <p class="card-text">Content</p>
  </div>
  <img class="card-img-bottom" src="" alt="">
</div>
Primo esercizio
<?php
 $tp=array(17.5, 19.2, 21.8, 21.6, 17.5);
 $tp[5]=20.2;
 $tp[6]=16.6;
 for($i=0;$i<=6;$i++)
 {
  echo"$tp[$i]";
 }
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Title</h5>
    <p class="card-text">Content</p>
  </div>
  <img class="card-img-bottom" src="" alt="">
</div>
Secondo esercizio
<?php
 $nome=array("Paolo","Marco","Giovanna","Maurizio","Francesca","Maria");
 $eta=array(47,21,42,54,51,17);
 for($i=0;$i<=5;$i++)
 {
  echo"$nome[$i], $eta[$i] anni";
 }
?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Title</h5>
    <p class="card-text">Content</p>
  </div>
  <img class="card-img-bottom" src="" alt="">
</div>
<?php
 $tp=array(Eleonora, Alessandra, Francesca, Andrea, Marco, Gabriele, Andrea, Michele, Zorro);
  $nl=8;

 for($i=0;$i<=$nl;$i++) {
  echo"$tp[$i] ";
 }

 echo"
";
 rsort($tp);
 //Ordinamento crescente degli elementi del vettore
 /*for($i=1;$i<=$nl;$i++) {
  for($j=$nl;$j>=$i;$j--) {
   if($tp[$j-1]<$tp[$j]) {
    $tr=$tp[$j-1];
    $tp[$j-1]=$tp[$j];
    $tp[$j]=$tr;
   }
  }
 }
 */
 for($i=0;$i<=$nl;$i++) {
  echo"$tp[$i] ";
 }

?>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Title</h5>
    <p class="card-text">Content</p>
  </div>
  <img class="card-img-bottom" src="" alt="">
</div>
Array Associativi (esempio diverso dell'esercizio)
Si tratta di un array i cui elementi sono accessibili mediante nomi, quindi stringhe anziché indici puramente numerici. Questo non comporta però l'obbligo di utilizzare solo un tipo di indice: alcuni elementi dell'array possono avere un indice numerico, altri un indice di tipo stringa.
Segue un esempio in linguaggio PHP:
$auto["marca"] = 'FIAT';
$auto["modello"] = '500L';
$auto["colore"] = 'Blu';
$auto["anno"] = 1956;
$auto["revisionata"] = true;
L'indice, racchiuso tra le parentesi quadre è l'elemento attraverso il quale è possibile accedere al valore corrispondente dell'array. In PHP poi, come con altri linguaggi interpretati, gli array possono avere valori di tipo diverso. Nell'esempio abbiamo valori di tipo stringa, intero, booleano.
Scrivere un programma  con un array associativo contenente Provincia - sigla della regione
Esercizio in Php senza modulo form
<html>
<HEAD> </HEAD>
<body>
Prova Array associativi !

<?php
// array con indice numerico
echo("");
echo(" array con indice numerico");
echo("");
$regioni[0]="Roma";
$regioni[1]="Milano";
$regioni[2]="Napoli";
$regioni[4]="Torino";
for($xx=0;$xx<=3;$xx++)
{
echo($regioni[$xx]);
echo("");
}
$N=count($regioni);
for ($i = 0; $i < $N; $i++) {;
$Riga = each($regioni);
$N2 = $Riga[key] + 1;
echo "<tr><td>regione $N2 :</td><td>$Riga[value] </td></tr>";
}
(list($aa,$bb)=each($regioni));
{echo"$aa-$bb";}
echo("");
echo(" array associativo");
echo("");
echo(" ciclo for non visualizza niente");
$regioAS["la"]="Roma";
$regioAS["lo"]="Milano";
$regioAS["ca"]="Napoli";
$regioAS["pi"]="Torino";
$N=count($regioAS);
$N=count($regioAS);
for ($i = 0; $i < $N; $i++) {
$Elemento = (each($regioAS));
echo"chiave: $Elemento[key]";
echo"&nbspvalore: $Elemento[value]";
}
echo("");
echo(" array in tabella");
echo("");
for ($i = 0; $i < $N; $i++) {;
$Riga = each($regioAS);
$N2 = $Riga[key] + 1;
echo "<tr><td>regione $N2 :</td><td>$Riga[value] </td></tr>";
}

for($xx=1;$xx<=3;$xx++)
{
echo($regioAS[$xx]);
echo("");
}
echo(" ciclo con list e each ");
while(list($aa,$bb)=each($regioAS))
{echo"$aa-$bb";}
echo("");
echo(" elemento singolo");
echo("");
echo($regioAS["pi"]);
echo($regioAS[pi]);
echo("");
echo("");
echo("ordinamento asort : in base al contenuto array associativo ");
echo("");
asort($regioAS);
while(list($aa,$bb)=each($regioAS))
{echo"$aa-$bb";}
echo("");
echo("");
echo("ordinamento ksort : in base al contenuto key  associativo ");
echo("");
ksort($regioAS);
while(list($aa,$bb)=each($regioAS))
{echo"$aa-$bb";}
echo("");
echo("");
echo("ordinamento sort: in base al contenuto array indeicizzato");
echo("");
sort($regioni);
for($xx=0;$xx<=3;$xx++)
{
echo"$regioni[$xx]";
}


?>
</body>
</body>
</html>


<div class="card">
  <div class="card-body">
    <h5 class="card-title">Title</h5>
    <p class="card-text">Content</p>
  </div>
  <img class="card-img-bottom" src="" alt="">
</div>
Esercizio con il file .txt
Creare una simulazione in Php per l'inserimento dei dati anagrafici e memorizzarli in file txt
Pagina html di inserimento
<html>
 <head>
  <title>Anagrafe</title>
 </head>
 <body bgcolor="lightskyblue">
 <font color="darkred">
ANAGRAFE
</font>

 <font color="darkred">
Inserire i dati richiesti
</font>

  <form action="anagrafe.php" method="post">
   <table border="0">
    <tr>

     <td>Cognome e nome</td>

     <td>   </td>
     <td>CAP</td>

    </tr>
    <tr>

     <td><input type="text" name="nome" size="30" maxlength="30"></td>
     <td>   </td>
     <td><input type="text" name="cap" size="5" maxlength="5"></td>
    </tr>
    <tr>

     <td>Località</td>

     <td>   </td>

     <td>Provincia</td>

     <td></td>
    </tr>
    <tr>
     <td><input type="text" name="local" size="30" maxlength="30"></td>
     <td>   </td>
     <td><input type="text" name="prov" size="20" maxlength="20"></td>
    </tr>
    <tr>

     <td>Sesso</td>
 
     <td>   </td>
     <td>Interessi</td>
    </tr>
    <tr>
     <td><input type="radio" name="sesso" value="maschio" "checked">Maschile<input type="radio" name="sesso" value="femmina">Femminile</td>
     <td>   </td>
     <td><input type="checkbox" name="sport" value="sport">Sport<input type="checkbox" name="lett" value="letteratura">Letteratura<input type="checkbox" name="scienze" value="scienze">Scienze</td>
    </tr>
   </table>

   <input type="submit" value="invia"><input type="reset" value="cancella tutto">
  </form>
 </body>

</html>

  
Pagina in PHP
<?php

echo"<body bgcolor='lightgreen'>";
$nome=$_POST['nome'];
$cap=$_POST['cap'];
$local=$_POST['local'];
$prov=$_POST['prov'];
$sesso=$_POST['sesso'];
$sport=$_POST['sport'];
$lett=$_POST['lett'];
$scienze=$_POST['scienze'];
$x=strlen($cap);
if ($x!=5)
 echo"
Errore!
Il CAP deve avere 5 caratteri. Ridigitare!";

  else {
   echo"Ecco il riepilogo dei dati che ha inserito:
    Cognome e nome: $nome
    Località: $local
    Provincia: $prov
    CAP: $cap
    Sesso: $sesso

    Interessi: $sport $lett $scienze
";  

    $fp=fopen("anagrafe.txt","a");

    if($fp) {
     flock($fp,2);
    
      $nl=chr(13).chr(10);
    
       fputs ($fp, "$nome,$cap,$local,$prov,$sesso,$sport,$lett,$scienze$nl");
     
        echo"I dati sono stati salvati correttamente!";
       
         flock($fp,3);
    }
     else echo"Non è stato possibile memorizzare i dati. Il file non esiste";
  }

?>
     <td>   </td>
     <td>Interessi</td>
    </tr>
    <tr>
     <td><input type="radio" name="sesso" value="maschio" "checked">Maschile<input type="radio" name="sesso" value="femmina">Femminile</td>
     <td>   </td>
     <td><input type="checkbox" name="sport" value="sport">Sport<input type="checkbox" name="lett" value="letteratura">Letteratura<input type="checkbox" name="scienze" value="scienze">Scienze</td>
    </tr>
   </table>

   <input type="submit" value="invia"><input type="reset" value="cancella tutto">
  </form>
 </body>


</html>


  
Pagina in PHP
<?php

echo"<body bgcolor='lightgreen'>";
$nome=$_POST['nome'];
$cap=$_POST['cap'];
$local=$_POST['local'];
$prov=$_POST['prov'];
$sesso=$_POST['sesso'];
$sport=$_POST['sport'];
$lett=$_POST['lett'];
$scienze=$_POST['scienze'];
$x=strlen($cap);
if ($x!=5)
 echo"
Errore!
Il CAP deve avere 5 caratteri. Ridigitare!";

  else {
   echo"Ecco il riepilogo dei dati che ha inserito:
    Cognome e nome: $nome
    Località: $local
    Provincia: $prov
    CAP: $cap
    Sesso: $sesso

    Interessi: $sport $lett $scienze
";  
 
 
   $fp=fopen("anagrafe.txt","a");
    if($fp) {
     flock($fp,2);
    
      $nl=chr(13).chr(10);
    
       fputs ($fp, "$nome,$cap,$local,$prov,$sesso,$sport,$lett,$scienze$nl");
     
        echo"I dati sono stati salvati correttamente!";
       
         flock($fp,3);
    }
     else echo"Non è stato possibile memorizzare i dati. Il file non esiste";
  }

?>





