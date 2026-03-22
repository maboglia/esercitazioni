# Gestione magazzino: Esercitazione SQL

La gestione di un magazzino è il "grande classico" delle basi di dati perché permette di modellare relazioni fondamentali come **1:N** (uno-a-molti) e **N:M** (molti-a-molti).

In questa struttura utilizzeremo tre entità principali: **Prodotti**, **Categorie** e **Fornitori**.

---

## 1. Architettura e DDL (Data Definition Language)

Definiamo lo schema con i vincoli di integrità referenziale (*Foreign Keys*), vincoli di dominio (*Check*) e unicità.

```sql
-- Creazione Tabella Categorie
CREATE TABLE Categorie (
    id_categoria INT PRIMARY KEY,
    nome VARCHAR(50) NOT NULL UNIQUE,
    descrizione TEXT
);

-- Creazione Tabella Fornitori
CREATE TABLE Fornitori (
    id_fornitore INT PRIMARY KEY,
    ragione_sociale VARCHAR(100) NOT NULL,
    citta VARCHAR(50),
    email VARCHAR(100) CHECK (email LIKE '%@%')
);

-- Creazione Tabella Prodotti
CREATE TABLE Prodotti (
    id_prodotto INT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    prezzo_unitario DECIMAL(10, 2) NOT NULL CHECK (prezzo_unitario > 0),
    quantita_stock INT DEFAULT 0 CHECK (quantita_stock >= 0),
    id_categoria INT,
    id_fornitore INT,
    FOREIGN KEY (id_categoria) REFERENCES Categorie(id_categoria) ON DELETE SET NULL,
    FOREIGN KEY (id_fornitore) REFERENCES Fornitori(id_fornitore) ON DELETE CASCADE
);

```

---

## 2. Popolamento Dati (DML - Data Manipulation Language)

Inseriamo alcuni record coerenti per poter testare le query.

```sql
INSERT INTO Categorie VALUES (1, 'Elettronica', 'Dispositivi hardware e gadget');
INSERT INTO Categorie VALUES (2, 'Arredamento', 'Mobili e ufficio');

INSERT INTO Fornitori VALUES (10, 'TechSpA', 'Milano', 'info@techspa.it');
INSERT INTO Fornitori VALUES (20, 'WoodDesign', 'Torino', 'sales@wood.com');

INSERT INTO Prodotti VALUES (101, 'Laptop Pro', 1200.00, 15, 1, 10);
INSERT INTO Prodotti VALUES (102, 'Mouse Wireless', 25.50, 50, 1, 10);
INSERT INTO Prodotti VALUES (103, 'Scrivania Legno', 150.00, 5, 2, 20);
INSERT INTO Prodotti VALUES (104, 'Sedia Ergonomica', 89.99, 0, 2, 20);
INSERT INTO Prodotti VALUES (105, 'Monitor 4K', 350.00, 8, 1, 10);

INSERT INTO Categorie (id_categoria, nome, descrizione) VALUES 
(3, 'Periferiche', 'Accessori per computer e input/output'),
(4, 'Illuminazione', 'Lampade e sistemi di luce per ufficio'),
(5, 'Cancelleria', 'Materiale di consumo per ufficio');

INSERT INTO Fornitori (id_fornitore, ragione_sociale, citta, email) VALUES 
(30, 'OfficeSupply Co.', 'Bologna', 'ordini@officesupply.it'),
(40, 'LuceDesign', 'Firenze', 'contact@lucedesign.com'),
(50, 'Global Logistics', 'Milano', 'logistics@global.com'),
(60, 'Cartiera Veneta', 'Padova', 'info@cartieraveneta.it');

INSERT INTO Prodotti (id_prodotto, nome, prezzo_unitario, quantita_stock, id_categoria, id_fornitore) VALUES 
-- Elettronica & Periferiche (TechSpA)
(106, 'Tastiera Meccanica', 75.00, 25, 3, 10),
(107, 'Cuffie Noise Cancelling', 199.00, 12, 1, 10),
(108, 'Webcam HD', 45.90, 0, 3, 10),

-- Arredamento & Illuminazione (WoodDesign e LuceDesign)
(109, 'Libreria Modulare', 210.00, 3, 2, 20),
(110, 'Lampada da Scrivania LED', 35.00, 40, 4, 40),
(111, 'Piantana Alogena', 120.00, 7, 4, 40),

-- Cancelleria (OfficeSupply e Cartiera Veneta)
(112, 'Risme Carta A4 (5pz)', 22.50, 100, 5, 60),
(113, 'Set Penne Gel', 12.00, 200, 5, 30),
(114, 'Organizer da tavolo', 18.50, 15, 5, 30),

-- Altri prodotti misti
(115, 'Hard Disk Esterno 2TB', 85.00, 30, 1, 50),
(116, 'Smartphone Entry Level', 150.00, 10, 1, 50),
(117, 'Cavo HDMI 2m', 9.99, 150, 3, 50);



```

---

## 3. Esercitazione: 30 Query SQL

Ecco una lista di query divise per livello di difficoltà crescente.

### Query di Base (Selezione e Filtro)

1. Selezionare tutti i prodotti.
2. Selezionare nome e prezzo dei prodotti con prezzo superiore a 100€.
3. Elencare i fornitori di Milano.
4. Trovare i prodotti con quantità in stock pari a 0 (esauriti).
5. Selezionare i prodotti che contengono la parola 'Laptop' nel nome.
6. Elencare le categorie in ordine alfabetico.
7. Trovare i prodotti con prezzo compreso tra 50€ e 500€.
8. Mostrare i fornitori che non hanno un'email specificata (se fosse NULL).
9. Selezionare i primi 3 prodotti più costosi.
10. Calcolare il valore totale della merce (prezzo * quantità) per ogni prodotto.

### Query con Join (Relazioni tra tabelle)

1. Visualizzare nome prodotto e nome della relativa categoria.
2. Elencare i prodotti insieme alla ragione sociale del loro fornitore.
3. Trovare tutti i prodotti della categoria 'Elettronica'.
4. Mostrare i prodotti forniti da 'TechSpA'.
5. Elencare i nomi dei prodotti e le città dei loro fornitori.
6. Visualizzare i prodotti della categoria 'Arredamento' con stock > 0.
7. Mostrare le categorie che hanno almeno un prodotto fornito da un fornitore di 'Torino'.
8. Visualizzare i prodotti (nome) e il fornitore, ma solo se il prezzo è > 200€.
9. Lista completa: Nome Prodotto, Categoria, Fornitore.
10. Trovare i nomi dei fornitori che forniscono prodotti nella categoria 'Elettronica'.

### Query di Aggregazione e Funzioni (Statistiche)

1. Contare quanti prodotti ci sono in totale nel database.
2. Calcolare il prezzo medio dei prodotti.
3. Calcolare la somma totale degli articoli in magazzino.
4. Trovare il prezzo massimo per ogni categoria.
5. Contare quanti prodotti fornisce ogni fornitore.
6. Calcolare il valore totale economico del magazzino intero.
7. Mostrare le categorie che hanno più di 2 prodotti.
8. Trovare il fornitore che ha il prodotto più economico.
9. Calcolare la media dei prezzi dei prodotti per il fornitore 'TechSpA'.
10. Visualizzare le categorie e il numero di pezzi totali (somma stock) per ognuna.

---

### Esempio di risoluzione (Query 25 & 27)

Se vuoi testare la logica più complessa:

```sql
-- Query 25: Numero prodotti per fornitore
SELECT F.ragione_sociale, COUNT(P.id_prodotto) AS Totale_Prodotti
FROM Fornitori F
LEFT JOIN Prodotti P ON F.id_fornitore = P.id_fornitore
GROUP BY F.ragione_sociale;

-- Query 27: Categorie con più di 2 prodotti
SELECT C.nome, COUNT(P.id_prodotto)
FROM Categorie C
JOIN Prodotti P ON C.id_categoria = P.id_categoria
GROUP BY C.nome
HAVING COUNT(P.id_prodotto) > 2;

```

