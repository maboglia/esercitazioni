# Esercizi Web

## Stampa del contenuto di un form

Sviluppare un'applicazione web che permetta all'utente di compilare un form contenente i dati anagrafici di una persona e di inviare i dati al server che dovrà stamparne un riassunto sullo schermo. L'applicazione deve essere organizzata come segue:

`viewImmissioneDati`
deve contenere un form costituito da:

* una casella di testo per l'inserimento del Cognome
* una casella di testo per l'inserimento del Nome
* una casella di testo per l'inserimento della Data di nascita (sotto forma di stringa) il pulsante “invia”, la cui pressione faccia in modo che il form invii le informazioni alla pagina `viewDatiImmessi`

`viewConfermaRegistrazione`
deve visualizzare un riepilogo di tutte le informazioni di registrazione:

* Cognome Nome
* Data di nascita
* Opzionalmente, stampare un messaggio nel caso in cui la data inserita non sia valida.

## Gestione data e ora

La pagina web `esercizio0` deve:

* visualizzare l'ora e la data corrente
* contenere un form che permetta di inserire una data ed inviare tale informazione alla pagina stessa.
* Se la pagina riceve come parametro una data deve visualizzare un messaggio che indichi quanti giorni sono passati o dovranno passare dalla data corrente.

## Il numero e radice

La pagina web `esercizio1` deve:

* contenere un form che permetta di inserire un numero e di inviarlo alla pagina stessa.
* Quando la pagina riceve il numero deve nascondere il form e visualizzare "Il numero ricevuto è " valore ricevuto " e la sua radice quadrata é " valore della radice del numero

## Conta pressione bottone

La pagina `esercizio2` deve contenere un form che permetta di contare quante volte è stato premuto il bottone di submit.

## Registrazione utente simulata

La pagina `esercizio3` deve contenere un form che permetta di simulare una registrazione guidata di un utente, tale form invia i dati alla pagina stessa. In particolare:

* nel caso non siano passati parametri alla pagina: visualizzare due caselle di testo che permettano l'inserimento del nome e cognome
* nel caso si ricevano come parametri il nome e il cognome richieda la password e di confermare la password
* nel caso si ricevano come parametri la password e la conferma della password non visualizzare il form e presentare un riepilogo di tutte le informazioni inserite
