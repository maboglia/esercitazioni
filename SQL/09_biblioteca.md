# **Gestione di una Biblioteca Comunale**

---

## 1. Architettura e DDL (Data Definition Language)

Creiamo tre tabelle: **Libri**, **Autori** e **Prestiti**. Noterai l'uso di `ON DELETE CASCADE` per mantenere la coerenza se un libro viene rimosso.

```sql
-- Tabella Autori
CREATE TABLE Autori (
    id_autore INT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    nazionalita VARCHAR(50),
    anno_nascita INT
);

-- Tabella Libri
CREATE TABLE Libri (
    id_libro INT PRIMARY KEY,
    titolo VARCHAR(150) NOT NULL,
    genere VARCHAR(50),
    anno_pubblicazione INT,
    id_autore INT,
    copie_disponibili INT DEFAULT 1 CHECK (copie_disponibili >= 0),
    FOREIGN KEY (id_autore) REFERENCES Autori(id_autore) ON DELETE SET NULL
);

-- Tabella Prestiti
CREATE TABLE Prestiti (
    id_prestito INT PRIMARY KEY,
    id_libro INT,
    nome_utente VARCHAR(100) NOT NULL,
    data_inizio DATE NOT NULL,
    data_fine_prevista DATE,
    restituito BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_libro) REFERENCES Libri(id_libro) ON DELETE CASCADE
);
```

---

## 2. DML (Data Manipulation Language)

Popoliamo la biblioteca con dati variegati.

```sql
INSERT INTO Autori VALUES (1, 'Italo Calvino', 'Italiana', 1923);
INSERT INTO Autori VALUES (2, 'George Orwell', 'Britannica', 1903);
INSERT INTO Autori VALUES (3, 'J.K. Rowling', 'Britannica', 1965);

INSERT INTO Libri VALUES (10, 'Il barone rampante', 'Narrativa', 1957, 1, 3);
INSERT INTO Libri VALUES (11, '1984', 'Distopia', 1949, 2, 0); -- Esaurito
INSERT INTO Libri VALUES (12, 'La fattoria degli animali', 'Satira', 1945, 2, 5);
INSERT INTO Libri VALUES (13, 'Harry Potter e la Pietra Filosofale', 'Fantasy', 1997, 3, 10);
INSERT INTO Libri VALUES (14, 'Lezioni Americane', 'Saggistica', 1988, 1, 2);

INSERT INTO Prestiti VALUES (1, 10, 'Mario Rossi', '2024-01-10', '2024-02-10', TRUE);
INSERT INTO Prestiti VALUES (2, 11, 'Luigi Bianchi', '2024-03-01', '2024-04-01', FALSE);
INSERT INTO Prestiti VALUES (3, 13, 'Anna Verdi', '2024-03-05', '2024-04-05', FALSE);

INSERT INTO Autori (id_autore, nome, nazionalita, anno_nascita) VALUES 
(4, 'Gabriel García Márquez', 'Colombiana', 1927),
(5, 'Virginia Woolf', 'Britannica', 1882),
(6, 'Umberto Eco', 'Italiana', 1932),
(7, 'Isaac Asimov', 'Americana', 1920),
(8, 'Agatha Christie', 'Britannica', 1890);

INSERT INTO Libri (id_libro, titolo, genere, anno_pubblicazione, id_autore, copie_disponibili) VALUES 
-- Umberto Eco (Italiano)
(15, 'Il nome della rosa', 'Giallo Storico', 1980, 6, 4),
(16, 'Il pendolo di Foucault', 'Saggistica', 1988, 6, 2),

-- Isaac Asimov (Fantascienza/Distopia)
(17, 'Fondazione', 'Fantascienza', 1951, 7, 6),
(18, 'Io, Robot', 'Fantascienza', 1950, 7, 3),

-- Agatha Christie (Giallo)
(19, 'Dieci piccoli indiani', 'Giallo', 1939, 8, 1),
(20, 'Assassinio sull''Orient Express', 'Giallo', 1934, 8, 0), -- Esaurito

-- Altri classici
(21, 'Cent''anni di solitudine', 'Narrativa', 1967, 4, 2),
(22, 'Gita al faro', 'Narrativa', 1927, 5, 3),
(23, 'La svastica sul sole', 'Distopia', 1962, NULL, 1); -- Autore non nel DB per testare i JOIN

INSERT INTO Prestiti (id_prestito, id_libro, nome_utente, data_inizio, data_fine_prevista, restituito) VALUES 
(4, 15, 'Mario Rossi', '2024-03-10', '2024-04-10', FALSE), -- Mario ha due libri
(5, 17, 'Elena Neri', '2024-02-15', '2024-03-15', TRUE),
(6, 19, 'Elena Neri', '2024-03-20', '2024-04-20', FALSE), -- Elena ha restituito uno e preso un altro
(7, 12, 'Paolo Gialli', '2024-01-05', '2024-02-05', TRUE),
(8, 10, 'Paolo Gialli', '2024-03-22', '2024-04-22', FALSE),
(9, 15, 'Giulia Blu', '2024-03-15', '2024-04-15', FALSE), -- Altra copia de Il nome della rosa
(10, 18, 'Marco Viola', '2024-03-18', '2024-04-18', FALSE);

```

---

## 3. Esercitazione: 30 Query SQL (Biblioteca)

### Selezione e Filtri (Base)
1. Selezionare tutti i titoli dei libri disponibili.
2. Elencare gli autori nati prima del 1950.
3. Trovare i libri pubblicati tra il 1940 e il 1960.
4. Visualizzare i prestiti non ancora restituiti (`restituito = FALSE`).
5. Selezionare i libri il cui titolo inizia con 'Harry'.
6. Elencare i generi letterari presenti (senza duplicati).
7. Trovare gli autori di nazionalità 'Britannica'.
8. Mostrare i libri che hanno più di 4 copie disponibili.
9. Selezionare i prestiti effettuati nel mese di Marzo 2024.
10. Ordinare i libri dal più recente al più vecchio.

### Join e Relazioni
11. Visualizzare il titolo del libro e il nome del suo autore.
12. Elencare i libri di genere 'Narrativa' con il nome dell'autore.
13. Mostrare tutti i prestiti indicando il nome dell'utente e il titolo del libro prestato.
14. Trovare i nomi degli autori che hanno libri attualmente in prestito.
15. Visualizzare i titoli dei libri scritti da autori di nazionalità 'Italiana'.
16. Elencare gli utenti che hanno preso in prestito libri di 'George Orwell'.
17. Mostrare i libri (titolo) che non sono mai stati prestati (usando `LEFT JOIN`).
18. Visualizzare i prestiti scaduti (dove `data_fine_prevista` è passata rispetto a oggi).
19. Trovare l'autore del libro con `id_prestito = 2`.
20. Elencare titolo e genere dei libri attualmente non disponibili (`copie_disponibili = 0`).

### Aggregazione e Logica Avanzata
21. Contare il numero totale di libri presenti in biblioteca.
22. Calcolare la media dell'anno di pubblicazione dei libri.
23. Trovare l'autore che ha scritto il libro più antico in catalogo.
24. Contare quanti libri ha scritto ogni autore.
25. Calcolare il numero totale di copie fisiche presenti in biblioteca (somma `copie_disponibili`).
26. Mostrare gli autori che hanno scritto più di un libro in catalogo.
27. Trovare il genere letterario più diffuso (con più titoli).
28. Calcolare quanti prestiti sono stati effettuati da ogni utente.
29. Visualizzare gli autori la cui età media dei libri (rispetto all'anno corrente) è superiore a 50 anni.
30. Trovare il titolo del libro che è stato prestato più volte.

---

### Esempio di Risoluzione della Query 30 (La più difficile)
Questa query richiede di contare i record nella tabella `Prestiti` raggruppandoli per libro:

```sql
SELECT L.titolo, COUNT(P.id_prestito) AS Numero_Prestiti
FROM Libri L
JOIN Prestiti P ON L.id_libro = P.id_libro
GROUP BY L.titolo
ORDER BY Numero_Prestiti DESC
LIMIT 1;
```

