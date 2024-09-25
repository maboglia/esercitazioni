# Esercizio 4: Gestione Punteggi Videogiochi

L’obiettivo di questo esercizio è creare un servizio web che permetta agli utenti di registrare e gestire i punteggi ottenuti nei videogiochi. Il sistema sarà composto da tre pagine principali:

1. **Pagina di inserimento punteggi**:
   - L'utente può inserire il nome di un videogioco e un punteggio numerico ottenuto.
   - Il form consente l'inserimento di un solo punteggio per volta, ma l’utente può inviare più punteggi ripetendo l’invio del form durante la stessa sessione.

2. **Pagina di registrazione dei punteggi**:
   - Questa pagina memorizza i punteggi sul server per ogni videogioco inserito dall'utente.
   - Se un videogioco viene inserito più volte nella stessa sessione con punteggi diversi, verrà memorizzato solo il punteggio più alto tra quelli inseriti.

3. **Pagina di riepilogo dei punteggi**:
   - Questa pagina mostra una lista di tutti i videogiochi con i relativi punteggi inseriti.
   - Viene evidenziato il videogioco con il punteggio massimo. In caso di parità di punteggi tra più videogiochi, verrà mostrato il primo inserito nella lista.

L'implementazione richiede l'uso di HTML e PHP, con l’invio dei dati tramite il metodo POST per la gestione del form.