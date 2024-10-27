# Esercizio 2: Gestione Acquisto Prodotti

L'obiettivo è sviluppare un servizio web per consentire a un utente di gestire l'acquisto di vari prodotti. Il servizio comprende le seguenti pagine principali:

1. **Pagina di inserimento acquisti**:
   - L'utente può inserire il nome di un prodotto e il numero di pezzi che desidera acquistare tramite un form. 
   - Ogni invio del form registra un acquisto per volta. Se l'utente desidera acquistare più prodotti, deve inviare il form più volte nella stessa sessione.

2. **Pagina di registrazione degli acquisti**:
   - Questa pagina memorizza gli acquisti effettuati dall'utente sul server.
   - Se un prodotto viene acquistato più volte nella stessa sessione, il numero di pezzi viene aggiornato con l'ultimo valore inserito per quel prodotto.

3. **Pagina di riepilogo degli acquisti**:
   - Questa pagina mostra la lista dei prodotti acquistati e il totale complessivo dei pezzi ordinati.
   - Viene inoltre indicato il prodotto per cui è stato richiesto il maggior numero di pezzi. Se ci sono più prodotti con lo stesso numero massimo, viene mostrato il primo in ordine di inserimento.

Il form e le due pagine di raccolta degli acquisti e di riepilogo vanno implementati utilizzando HTML e PHP, con l'invio dei dati gestito tramite il metodo GET.