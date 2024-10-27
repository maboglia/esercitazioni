# Biglietteria Teatro

L'applicazione che si intende progettare gestisce la vendita dei biglietti in un teatro.

## Spettacolo

Ogni spettacolo tenuto nel teatro è definito dai seguenti attributi:

- Titolo: una stringa che rappresenta il titolo dello spettacolo.
- Regista: una stringa che indica il nome del regista dello spettacolo.
- Attori: un array non vuoto di stringhe che contiene i nomi degli attori che partecipano allo spettacolo.

## Replica

Per ciascuno spettacolo sono programmate una o più repliche. Ogni replica è caratterizzata da una data e un'ora specifiche.

## Posto

I posti all'interno del teatro sono identificati per fila, numero e tipo (ad esempio: platea, palco, galleria, ecc.). 

## Biglietto

Il costo di ciascun biglietto è determinato dal tipo di posto e dallo spettacolo. Ad esempio, il costo dei posti in platea per lo spettacolo "Cats" potrebbe essere di 50 euro.

## Prenotazione

Una prenotazione è caratterizzata dai seguenti attributi:

- Nome del cliente: una stringa che rappresenta il nome del cliente che ha effettuato la prenotazione.
- Data di prenotazione: la data in cui è stata effettuata la prenotazione.
- Replica dello spettacolo: la replica dello spettacolo per cui è stata effettuata la prenotazione.
- Posti prenotati: almeno un posto che è stato prenotato tramite questa prenotazione. 

## Addetto Biglietteria

L'addetto alla biglietteria del teatro esegue i seguenti controlli:

- Dato uno spettacolo e un tipo di posto, restituisce il costo associato al tipo di posto per lo spettacolo. Se il costo è unico e specificato, altrimenti restituisce -1.
- Dato un insieme di posti e una replica, restituisce l'insieme dei posti disponibili per quella replica (cioè i posti che non sono stati prenotati per quella replica).

Questo testo descrive le principali caratteristiche e funzionalità del sistema di gestione della biglietteria del teatro.
