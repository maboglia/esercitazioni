# Esercizio MVC: Gestione di Prodotto e Carrello

Realizzate un'applicazione Java per la gestione di un carrello della spesa, seguendo il modello MVC (Model-View-Controller). L'applicazione dovrà consentire agli utenti di aggiungere prodotti al carrello, visualizzare il totale degli acquisti, il totale degli acquisti in promozione e altre informazioni pertinenti.

## Modello (Model)

La classe `Prodotto` rappresenterà un prodotto che può essere aggiunto al carrello. Avrà i seguenti attributi:

- `descrizione`: una stringa che rappresenta la descrizione del prodotto,
- `prezzo`: un numero in virgola mobile che indica il prezzo del prodotto,
- `inPromozione`: un booleano che indica se il prodotto è in promozione o meno.

La classe `Carrello` rappresenterà il carrello della spesa. Avrà i seguenti attributi:

- `cliente`: una stringa che rappresenta il nome del cliente che ha effettuato l'ordine,
- `prodottiOrdinati`: un elenco di oggetti `ProdottoQuantita`, ciascuno dei quali contiene un prodotto e la quantità ordinata.

La classe `ProdottoQuantita` rappresenterà una coppia di prodotto e quantità nel carrello. Avrà i seguenti attributi:

- `prodotto`: un riferimento a un oggetto `Prodotto`,
- `quantita`: un numero intero che rappresenta la quantità del prodotto nel carrello.

## Vista (View)

La vista sarà costituita da un'interfaccia utente che consente agli utenti di interagire con il sistema. In questo esercizio, utilizzeremo una semplice visualizzazione tramite console.

## Controllore (Controller)

Il controllore sarà responsabile di gestire le interazioni tra la vista e il modello. Riceverà gli input dell'utente dalla vista, elaborerà le richieste utilizzando il modello e restituirà i risultati alla vista.

## Metodi e Funzionalità

Le funzionalità dell'applicazione includeranno:

1. Aggiunta di un prodotto al carrello: gli utenti potranno aggiungere un prodotto al carrello specificando la descrizione, il prezzo e se è in promozione.
2. Calcolo del totale dell'ordine: gli utenti potranno visualizzare il totale dell'ordine, che sarà la somma dei prezzi di tutti i prodotti nel carrello.
3. Calcolo del totale degli acquisti in promozione: gli utenti potranno visualizzare il totale degli acquisti in promozione, che sarà la somma dei prezzi dei prodotti in promozione nel carrello.
4. Visualizzazione dei prodotti nel carrello: gli utenti potranno visualizzare l'elenco dei prodotti nel carrello, insieme alla quantità ordinata di ciascun prodotto.
5. Altre funzionalità a vostra scelta, come la rimozione di un prodotto dal carrello o la visualizzazione del numero totale di prodotti nel carrello.

Implementate l'applicazione seguendo il modello MVC, separando la logica di business (modello) dalla visualizzazione e dall'interazione dell'utente (vista e controllore). Utilizzate classi, metodi e attributi appropriati per garantire la modularità e la manutenibilità del codice.
