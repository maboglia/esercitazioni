# Testo collegato all'esercitazione su studenti, corsi ed esami

#### Introduzione:
Nell'ambito del corso di Informatica Avanzata, gli studenti dovranno implementare un sistema di gestione di studenti, corsi ed esami utilizzando il linguaggio di programmazione Java. Il sistema consentirà di memorizzare informazioni sugli studenti, sui corsi a cui sono iscritti e sui relativi esami sostenuti.

#### Requisiti del sistema:
1. Creare classi per rappresentare gli studenti, i corsi e gli esami con attributi e metodi appropriati.
2. Implementare la classe principale `GestioneEsami` che permetta di creare istanze di studenti, corsi ed esami, e di visualizzare i risultati degli esami.
3. Utilizzare una struttura dati appropriata per memorizzare gli esami svolti dagli studenti.
4. Consentire la stampa dei dettagli degli esami, inclusi il nome dello studente, la matricola, il corso e il voto ottenuto.

#### Dettagli implementativi:
1. La classe `Studente` dovrà contenere informazioni come il nome dello studente e la matricola.
2. La classe `Corso` dovrà memorizzare il nome del corso e un codice identificativo.
3. La classe `Esame` dovrà collegare uno studente a un corso con il relativo voto ottenuto.
4. La classe `GestioneEsami` dovrà creare istanze di studenti, corsi ed esami, aggiungere gli esami alla lista e stampare i dettagli degli esami.

#### Obiettivi:
- Implementare un sistema di gestione di studenti, corsi ed esami in Java.
- Dimostrare la capacità di creare classi, istanze di oggetti e utilizzare strutture dati per memorizzare informazioni.
- Esercitare la stampa dei dettagli degli esami e la visualizzazione delle informazioni relative agli studenti e ai corsi.

### Fine del testo collegato all'esercitazione.

---

Ecco un esempio di esercitazione Java a tema studenti, corsi ed esami che puoi utilizzare come base per sviluppare il tuo progetto:

```java
import java.util.ArrayList;
import java.util.List;

class Studente {
    private String nome;
    private int matricola;

    public Studente(String nome, int matricola) {
        this.nome = nome;
        this.matricola = matricola;
    }

    public String getNome() {
        return nome;
    }

    public int getMatricola() {
        return matricola;
    }
}

class Corso {
    private String nomeCorso;
    private int codiceCorso;

    public Corso(String nomeCorso, int codiceCorso) {
        this.nomeCorso = nomeCorso;
        this.codiceCorso = codiceCorso;
    }

    public String getNomeCorso() {
        return nomeCorso;
    }

    public int getCodiceCorso() {
        return codiceCorso;
    }
}

class Esame {
    private Studente studente;
    private Corso corso;
    private int voto;

    public Esame(Studente studente, Corso corso, int voto) {
        this.studente = studente;
        this.corso = corso;
        this.voto = voto;
    }

    public Studente getStudente() {
        return studente;
    }

    public Corso getCorso() {
        return corso;
    }

    public int getVoto() {
        return voto;
    }
}

public class GestioneEsami {
    public static void main(String[] args) {
        // Creazione degli studenti
        Studente studente1 = new Studente("Mario Rossi", 12345);
        Studente studente2 = new Studente("Anna Verdi", 67890);

        // Creazione dei corsi
        Corso corso1 = new Corso("Informatica", 101);
        Corso corso2 = new Corso("Matematica", 202);

        // Creazione degli esami
        Esame esame1 = new Esame(studente1, corso1, 85);
        Esame esame2 = new Esame(studente2, corso2, 78);

        // Lista degli esami
        List<Esame> elencoEsami = new ArrayList<>();
        elencoEsami.add(esame1);
        elencoEsami.add(esame2);

        // Stampare i risultati degli esami
        for (Esame esame : elencoEsami) {
            System.out.println("Studente: " + esame.getStudente().getNome() +
                    ", Matricola: " + esame.getStudente().getMatricola() +
                    ", Corso: " + esame.getCorso().getNomeCorso() +
                    ", Voto: " + esame.getVoto());
        }
    }
}
```

Questo esempio Java illustra la gestione di studenti, corsi ed esami. Puoi ampliarlo aggiungendo ulteriori funzionalità come il calcolo della media dei voti, la gestione degli esami non superati, ecc. Spero che questo esercizio ti sia utile per iniziare a lavorare su un progetto Java relativo a studenti, corsi ed esami. Buon lavoro!