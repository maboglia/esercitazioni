# Esercizio 3: Gestione Preferenze Film

L’obiettivo di questo esercizio è creare un servizio web che consenta agli utenti di registrare e gestire le proprie preferenze su una serie di film. Il sistema sarà composto da tre pagine principali:

1. **Pagina di inserimento valutazioni**:
   - L'utente può inserire il titolo di un film e assegnare una valutazione numerica, che può andare da 1 a 5. 
   - Il form consente l'inserimento di una valutazione per volta, ma l’utente può inviare più valutazioni ripetendo l’invio del form nella stessa sessione.
   
2. **Pagina di registrazione delle valutazioni**:
   - Questa pagina memorizza le valutazioni sul server per ogni film inserito dall'utente.
   - Se un film viene valutato più volte nella stessa sessione, il sistema memorizza il valore massimo delle valutazioni inserite per quel film.

3. **Pagina di riepilogo delle valutazioni**:
   - In questa pagina vengono elencate tutte le valutazioni inserite, insieme alla media delle valutazioni per tutti i film.
   - Viene inoltre indicato il film che ha ottenuto la valutazione massima. Se più film hanno ricevuto il valore massimo, viene mostrato il primo inserito nella lista.

L’implementazione di questo sistema prevede l’uso di HTML e PHP, con invio dei dati tramite il metodo POST per la gestione del form.