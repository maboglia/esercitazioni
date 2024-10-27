# Gestione Dipendenti

## Dipendente

La classe `Dipendente` rappresenta un dipendente dell'azienda e ha i seguenti attributi:

- `matricola`: una stringa che indica il numero di matricola del dipendente,
- `stipendio`: un numero decimale che indica lo stipendio base del dipendente,
- `straordinario`: un numero decimale che rappresenta l'importo dovuto per ciascuna ora di straordinario effettuata dal dipendente.

### Metodi della classe `Dipendente`

- `getStipendio()`: restituisce il valore dell'attributo stipendio.
- `paga(int oreStraordinario)`: calcola e restituisce il valore totale dello stipendio del dipendente, considerando anche le ore di straordinario indicate come parametro.
- `stampa()`: stampa i valori degli attributi della classe.

## DipendenteA

La classe `DipendenteA` è una sottoclasse di `Dipendente` e aggiunge l'attributo `malattia`, che rappresenta i giorni di malattia presi dal dipendente.

### Metodi aggiuntivi della classe `DipendenteA`

- `prendiMalattia(int giorni)`: aggiorna il numero di giorni di malattia del dipendente.
- `paga(int oreStraordinario)`: calcola e restituisce il valore totale dello stipendio del dipendente, considerando anche le ore di straordinario, ma riducendo lo stipendio in caso di malattia.
- `stampaMalattia()`: stampa il numero di giorni di malattia del dipendente.

## CalcolaStipendi (Classe Main)

La classe `CalcolaStipendi` contiene il metodo `main`, dove vengono istanziati oggetti delle classi `Dipendente` e `DipendenteA` e vengono testati i relativi metodi.

### Passaggi

1. Istanzia un oggetto di tipo `Dipendente` con matricola 00309, stipendio 1000,00 e straordinario 7,50.
2. Chiama il metodo `paga` con parametro pari a 10 e stampa il valore dello stipendio.
3. Istanzia un oggetto di tipo `DipendenteA` con matricola 00201, stipendio 1500,0 e straordinario 8,50.
4. Chiama il metodo `prendiMalattia` con parametro pari a 5, il metodo `paga` con parametro pari a 3 e il metodo `stampaMalattia`.
