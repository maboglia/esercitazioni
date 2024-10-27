# Esercizio Biblioteca

Realizzare un sistema software per la gestione di una biblioteca, composto dalle seguenti classi: `Libro`, `LibroPerBambini`, `Biblioteca`, e una classe di test.

## Classe Libro

La classe `Libro` rappresenta un libro generico e ha le seguenti variabili di istanza:

- `titolo`: il titolo del libro;
- `autore`: l'autore del libro;
- `inPrestito`: un booleano che indica se il libro è attualmente in prestito.

La classe `Libro` ha i seguenti metodi:

- `String getDescrizione()`: restituisce una stringa contenente il titolo e l'autore del libro;
- `boolean isInPrestito()`: restituisce true se il libro è in prestito, false altrimenti;
- `void setInPrestito(boolean stato)`: imposta lo stato del libro (in prestito o disponibile).

## Classe LibroPerBambini

La classe `LibroPerBambini` è una sottoclasse di `Libro` e aggiunge la variabile di istanza `etaConsigliata`, che rappresenta l'età consigliata per il libro.

Questa classe ridefinisce il metodo `getDescrizione()` per includere anche l'età consigliata.

## Classe Biblioteca

La classe `Biblioteca` gestisce la collezione di libri e ha una struttura dati di tipo `ArrayList<Libro>`. La classe `Biblioteca` ha i seguenti metodi:

- `void addLibro(Libro l)`: aggiunge un nuovo libro alla biblioteca;
- `boolean inBiblioteca(Libro l)`: verifica se un libro è presente nella biblioteca;
- `void prestato(Libro l)`: registra un prestito di un libro;
- `void restituito(Libro l)`: registra il ritorno di un libro;
- `int totInPrestito()`: conta il numero di libri in prestito;
- `boolean nessunPrestito()`: restituisce true se non ci sono libri in prestito;
- `int perBambini(int etaMax)`: conta quanti libri per bambini con un'età consigliata minore o uguale a `etaMax` sono presenti nella biblioteca.

## Gestione dell'eccezione

Il metodo `prestato(Libro l)` solleverà un'eccezione `EccezioneLibro` se il prestito non è possibile (il libro non è presente in biblioteca o è già in prestito).

## Classe di test

Implementare una classe di test `TestBiblioteca` che crei alcuni libri, una biblioteca e chiami tutti i metodi per verificare il corretto funzionamento del sistema.
