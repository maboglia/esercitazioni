# Esercizio 6: Indicizzazione e Ricerca di Documenti di Testo

In questo esercizio si richiede la realizzazione di un servizio web per gestire l'indicizzazione e la ricerca all'interno di un insieme di documenti di testo. Il sistema dovrà permettere l'inserimento di documenti, la creazione di un indice inverso per facilitare la ricerca e l'implementazione di una funzione di ricerca basata su parole chiave. Il servizio si articolerà nelle seguenti pagine:

1. **Pagina di inserimento dei documenti**:
   - L'utente può inserire un documento specificando il **titolo** e il **testo** in un'area di testo.
   - Ogni invio del form permette l'inserimento di un singolo documento; per aggiungere più documenti, l'utente deve inviare più volte il form nella stessa sessione.

2. **Pagina di indicizzazione**:
   - Questa pagina memorizza i documenti inseriti e crea un **indice inverso** che associa ogni parola contenuta nei documenti alla lista di documenti in cui compare.
   - Per ogni parola, viene calcolata la **Frequenza del Termine (TF)**, ossia il numero di volte che la parola appare nel documento, e la **Frequenza del Documento (DF)**, cioè il numero di documenti in cui compare la parola.
   - L'indice è costruito ignorando la punteggiatura, i separatori non alfanumerici e le differenze tra maiuscole e minuscole.
   - Viene mantenuto un elenco con titolo e contenuto di ciascun documento memorizzato.

3. **Pagina di ricerca**:
   - L'utente può effettuare una ricerca inserendo una sequenza di parole chiave separate da spazi.
   - Il sistema cercherà nei documenti tutti quelli che contengono almeno uno dei termini inseriti e calcolerà un punteggio per ciascun documento.

4. **Pagina dei risultati della ricerca**:
   - Per ciascun documento che contiene almeno un termine della ricerca, viene calcolato un punteggio basato sulla formula **TF-IDF**:  
     \[
     \text{TF-IDF} = \frac{TF}{NT} \times \log \left( \frac{NDOC}{DF} \right)
     \]
     Dove:
     - **TF** è il numero di volte che il termine compare nel documento,
     - **NT** è il numero totale di termini nel documento,
     - **NDOC** è il numero totale di documenti,
     - **DF** è il numero di documenti che contengono il termine.
   - La lista dei documenti trovati viene ordinata in base al punteggio TF-IDF in ordine decrescente. Per ciascun documento viene mostrato il titolo, con un link alla pagina di visualizzazione del documento.

5. **Pagina di visualizzazione del documento**:
   - Cliccando sul titolo di un documento nei risultati di ricerca, l'utente viene indirizzato a una pagina che mostra il **titolo** e il **testo completo** del documento.
   - Il documento viene identificato tramite un ID passato come parametro **GET** nell'URL.

### Obiettivo
Implementare i form e gli script necessari per gestire l'inserimento dei documenti, la loro indicizzazione e la ricerca utilizzando **HTML** e **PHP**.