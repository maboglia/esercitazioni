# Esercitazione: Gestione Negozio Alimentari

Benvenuti all'esercitazione di gestione di un negozio di generi alimentari. In questa esercitazione, svilupperemo un sistema software per gestire l'inventario dei prodotti, applicare sconti promozionali e registrare le vendite.

## Gli inventari

Iniziamo definendo la classe `CassaNegozio`, che conterrà tutte le funzionalità del nostro sistema. Con questa classe, saremo in grado di definire l'inventario dei prodotti e aggiungere nuovi prodotti.

Un prodotto è caratterizzato da un codice univoco, una descrizione e un prezzo lordo di vendita. Ecco un esempio di alcuni prodotti che potremmo avere nel nostro negozio:

| Codice | Descrizione         | Prezzo |
| ------ | ------------------- | ------ |
| C00001 | Pasta Zarilla       | 0.7    |
| C00002 | Latte GattoRosso    | 1.65   |
| C00003 | Caffe' Latazza      | 2.5    |
| C00004 | Caffe' Billy        | 2.0    |
| C00005 | Biscotti Cioccolato | 2.0    |
| C00006 | Vino Rosso          | 2.0    |

### Gli sconti

Possiamo stabilire uno sconto promozionale per un particolare prodotto. Per attivare la promozione, utilizziamo il metodo `promozione()`, specificando il codice del prodotto e la percentuale di sconto da applicare.

### I prodotti venduti

Ogni volta che viene letto il codice di un prodotto, la cassa accede al listino dei prodotti per recuperarne il prezzo e la descrizione. 

Il metodo `leggi()` restituisce informazioni sul prodotto acquistato. 

Possiamo ottenere l'importo totale lordo delle tasse attraverso il metodo `totale()`. 

Inoltre, è possibile ottenere l'importo totale netto e l'ammontare dell'IVA attraverso i metodi `netto()` e `tasse()`. 

Il metodo `stampa()` consente di visualizzare l'elenco degli articoli venduti, ordinati lessicograficamente. 

Infine, il metodo `chiude()` conclude la registrazione dei prodotti venduti.

Con questa base, possiamo iniziare a implementare il nostro sistema per gestire il negozio alimentari. Buon lavoro!
