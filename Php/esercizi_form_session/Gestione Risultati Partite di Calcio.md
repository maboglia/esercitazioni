# Esercizio 5: Gestione Risultati Partite di Calcio

Questo esercizio richiede la realizzazione di un servizio web che consenta agli utenti di inserire e gestire i risultati delle partite di calcio, con l'obiettivo di generare automaticamente una classifica in base ai risultati inseriti. Il servizio prevede tre pagine principali:

1. **Pagina di inserimento dei risultati**:
   - L'utente può selezionare la squadra di casa e quella ospite da un combobox dinamico che mostra la lista delle squadre.
   - L'utente inserisce il numero di gol per la squadra di casa e per la squadra ospite in due campi di testo separati.
   - Ogni invio del form registra un solo risultato, ma l’utente può aggiungere più risultati inviando il form più volte nella stessa sessione.

2. **Pagina di registrazione dei risultati**:
   - Questa pagina memorizza i risultati delle partite sul server.
   - Se un risultato per la stessa partita viene inserito più volte nella stessa sessione, viene memorizzato solo l'ultimo punteggio inserito.

3. **Pagina di riepilogo della classifica**:
   - Questa pagina genera e mostra una classifica aggiornata in base ai risultati inseriti.
   - Il sistema calcola la classifica assegnando:
     - 3 punti alla squadra vincente,
     - 1 punto a ciascuna squadra in caso di pareggio,
     - 0 punti alla squadra perdente.
   - La classifica è ordinata per numero di punti, con eventuali criteri secondari come la differenza reti o i gol segnati, se necessario.

L'implementazione deve essere effettuata con HTML e PHP, utilizzando il metodo POST per il form di inserimento dei risultati.