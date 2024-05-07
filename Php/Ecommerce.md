 **Esercitazione PHP: Creazione di un Carrello E-commerce con Prodotti**

In questa esercitazione, impareremo a creare un semplice carrello e-commerce utilizzando PHP. Creeremo una lista di prodotti e consentiremo agli utenti di aggiungerli al carrello. Vediamo come procedere:

1. **Creazione dei Prodotti**
   - Definiamo alcuni prodotti di esempio. Ad esempio, possiamo avere:
     - Prodotto 1: **Scarpe da Ginnastica Nike** - Prezzo: **$79.99**
     - Prodotto 2: **Maglietta a Maniche Corte** - Prezzo: **$24.99**
     - Prodotto 3: **Occhiali da Sole Polarizzati** - Prezzo: **$59.99**

2. **Struttura del Carrello**
   - Creiamo un array associativo per rappresentare il carrello. Ogni elemento dell'array avrà i seguenti campi:
     - `"nome"`: Nome del prodotto.
     - `"prezzo"`: Prezzo del prodotto.
     - `"quantità"`: Quantità selezionata dall'utente (inizialmente 0).

3. **Aggiunta al Carrello**
   - Quando l'utente clicca su "Aggiungi al Carrello" per un prodotto, incrementiamo la quantità nel carrello.
   - Possiamo anche visualizzare un messaggio di conferma.

4. **Visualizzazione del Carrello**
   - Mostreremo i prodotti presenti nel carrello con i rispettivi prezzi e quantità.
   - Calcoleremo il totale del carrello sommando i prezzi dei prodotti moltiplicati per le quantità.

5. **Opzioni Aggiuntive**
   - Possiamo implementare funzionalità come la rimozione di un prodotto dal carrello o la modifica della quantità.
   - Salviamo il carrello in sessione o database per persistenza.

Ecco un esempio di codice PHP per la creazione di un carrello e-commerce con i prodotti sopra menzionati:

```php
<?php
// Definizione dei prodotti
$products = [
    "Scarpe da Ginnastica Nike" => 79.99,
    "Maglietta a Maniche Corte" => 24.99,
    "Occhiali da Sole Polarizzati" => 59.99
];

// Inizializzazione del carrello
$cart = [];

// Funzione per aggiungere un prodotto al carrello
function addToCart($product, $quantity) {
    global $cart, $products;
    if (array_key_exists($product, $products)) {
        if (!isset($cart[$product])) {
            $cart[$product] = 0;
        }
        $cart[$product] += $quantity;
        echo "Prodotto \"$product\" aggiunto al carrello.";
    } else {
        echo "Prodotto non trovato.";
    }
}

// Esempio di utilizzo
addToCart("Scarpe da Ginnastica Nike", 2);
addToCart("Maglietta a Maniche Corte", 1);

// Visualizzazione del carrello
echo "\nCarrello:\n";
foreach ($cart as $product => $quantity) {
    $totalPrice = $products[$product] * $quantity;
    echo "$product (Quantità: $quantity) - Prezzo Totale: $$totalPrice\n";
}
?>
```

---

¹[1][Esercizi PHP con Soluzione](https://codegrind.it/esercizi/php)
²[2][Esercizi pratici PHP - Go coding](https://gocoding.org/it/Esercizi-pratici-php/)
³[3][Esercizi Classi PHP | Codegrind](https://codegrind.it/esercizi/php/classi/)
