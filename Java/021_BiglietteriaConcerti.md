# Esercitazione Java con Spring Boot per creare un'applicazione di gestione di una biglietteria per concerti.

### Esercitazione: Creazione di un'applicazione di biglietteria per concerti con Spring Boot

#### Prerequisiti
- Java 11 o superiore
- Maven o Gradle
- IDE Java (IntelliJ IDEA, Eclipse, VS Code)
- Conoscenza di base di Spring Boot e JPA

#### Passi dell'esercitazione

1. **Creazione del progetto Spring Boot**
   - Usa [Spring Initializr](https://start.spring.io/) per creare un nuovo progetto Spring Boot con le seguenti dipendenze:
     - Spring Web
     - Spring Data JPA
     - H2 Database
   - Scarica il progetto e importalo nel tuo IDE.

2. **Configurazione del progetto**

   - Apri il file `application.properties` e configura H2 Database:
     ```properties
     spring.h2.console.enabled=true
     spring.datasource.url=jdbc:h2:mem:testdb
     spring.datasource.driverClassName=org.h2.Driver
     spring.datasource.username=sa
     spring.datasource.password=password
     spring.jpa.database-platform=org.hibernate.dialect.H2Dialect
     spring.jpa.hibernate.ddl-auto=update
     ```

3. **Modellazione del dominio**

   - Crea una classe `Concert` nel pacchetto `com.example.ticketing.model`:
     ```java
     package com.example.ticketing.model;

     import javax.persistence.Entity;
     import javax.persistence.GeneratedValue;
     import javax.persistence.GenerationType;
     import javax.persistence.Id;
     import java.time.LocalDate;

     @Entity
     public class Concert {
         @Id
         @GeneratedValue(strategy = GenerationType.IDENTITY)
         private Long id;
         private String name;
         private String artist;
         private LocalDate date;
         private int availableTickets;

         // Getters and setters
     }
     ```

4. **Creazione del repository**

   - Crea una interfaccia `ConcertRepository` nel pacchetto `com.example.ticketing.repository`:
     ```java
     package com.example.ticketing.repository;

     import com.example.ticketing.model.Concert;
     import org.springframework.data.jpa.repository.JpaRepository;
     import org.springframework.stereotype.Repository;

     @Repository
     public interface ConcertRepository extends JpaRepository<Concert, Long> {
     }
     ```

5. **Servizio**

   - Crea una classe `ConcertService` nel pacchetto `com.example.ticketing.service`:
     ```java
     package com.example.ticketing.service;

     import com.example.ticketing.model.Concert;
     import com.example.ticketing.repository.ConcertRepository;
     import org.springframework.beans.factory.annotation.Autowired;
     import org.springframework.stereotype.Service;

     import java.util.List;

     @Service
     public class ConcertService {
         @Autowired
         private ConcertRepository concertRepository;

         public List<Concert> getAllConcerts() {
             return concertRepository.findAll();
         }

         public Concert getConcertById(Long id) {
             return concertRepository.findById(id).orElse(null);
         }

         public Concert saveConcert(Concert concert) {
             return concertRepository.save(concert);
         }

         public void deleteConcert(Long id) {
             concertRepository.deleteById(id);
         }
     }
     ```

6. **Controller**

   - Crea una classe `ConcertController` nel pacchetto `com.example.ticketing.controller`:
     ```java
     package com.example.ticketing.controller;

     import com.example.ticketing.model.Concert;
     import com.example.ticketing.service.ConcertService;
     import org.springframework.beans.factory.annotation.Autowired;
     import org.springframework.http.HttpStatus;
     import org.springframework.http.ResponseEntity;
     import org.springframework.web.bind.annotation.*;

     import java.util.List;

     @RestController
     @RequestMapping("/api/concerts")
     public class ConcertController {
         @Autowired
         private ConcertService concertService;

         @GetMapping
         public ResponseEntity<List<Concert>> getAllConcerts() {
             return new ResponseEntity<>(concertService.getAllConcerts(), HttpStatus.OK);
         }

         @GetMapping("/{id}")
         public ResponseEntity<Concert> getConcertById(@PathVariable Long id) {
             Concert concert = concertService.getConcertById(id);
             if (concert != null) {
                 return new ResponseEntity<>(concert, HttpStatus.OK);
             } else {
                 return new ResponseEntity<>(HttpStatus.NOT_FOUND);
             }
         }

         @PostMapping
         public ResponseEntity<Concert> createConcert(@RequestBody Concert concert) {
             return new ResponseEntity<>(concertService.saveConcert(concert), HttpStatus.CREATED);
         }

         @DeleteMapping("/{id}")
         public ResponseEntity<Void> deleteConcert(@PathVariable Long id) {
             concertService.deleteConcert(id);
             return new ResponseEntity<>(HttpStatus.NO_CONTENT);
         }
     }
     ```

7. **Esecuzione dell'applicazione**

   - Esegui l'applicazione tramite il tuo IDE o usando il comando Maven:
     ```sh
     ./mvnw spring-boot:run
     ```

8. **Test dell'applicazione**

   - Puoi testare le API usando Postman o qualsiasi altro client HTTP. Ecco alcuni esempi di richieste:
     - **GET** `/api/concerts` per ottenere tutti i concerti
     - **GET** `/api/concerts/{id}` per ottenere un concerto specifico
     - **POST** `/api/concerts` per creare un nuovo concerto (fornisci un body JSON)
     - **DELETE** `/api/concerts/{id}` per eliminare un concerto

#### Conclusione
In questa esercitazione hai creato una semplice applicazione di biglietteria per concerti usando Spring Boot. Hai imparato a configurare un progetto Spring Boot, creare entità JPA, repository, servizi e controller REST. Questa base può essere estesa con funzionalità aggiuntive come autenticazione, gestione delle prenotazioni e altro ancora.

---

Istruzioni SQL per creare le tabelle e gli insert di prova per l'applicazione di biglietteria per concerti.

### Istruzioni SQL

#### Creazione della tabella `Concert`

```sql
CREATE TABLE Concert (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    availableTickets INT NOT NULL
);
```

#### Insert di prova

```sql
INSERT INTO Concert (name, artist, date, availableTickets) VALUES
('Concert A', 'Artist A', '2024-08-01', 100),
('Concert B', 'Artist B', '2024-09-15', 150),
('Concert C', 'Artist C', '2024-10-10', 200),
('Concert D', 'Artist D', '2024-11-20', 250),
('Concert E', 'Artist E', '2024-12-05', 300);
```

### Utilizzo del database H2

Poiché stiamo utilizzando H2 come database in memoria per questa esercitazione, è possibile eseguire le istruzioni SQL direttamente nella console H2 integrata di Spring Boot.

#### Accesso alla console H2

1. Avvia l'applicazione Spring Boot.
2. Apri un browser web e vai all'URL: `http://localhost:8080/h2-console`.
3. Inserisci le seguenti informazioni per connetterti al database:
   - **JDBC URL**: `jdbc:h2:mem:testdb`
   - **Username**: `sa`
   - **Password**: `password`
4. Clicca su "Connect".

#### Esecuzione delle istruzioni SQL

1. Una volta connesso alla console H2, copia e incolla le istruzioni SQL fornite sopra nella sezione di input della console.
2. Esegui le istruzioni SQL per creare la tabella `Concert` e inserire i dati di prova.

### Configurazione del file `import.sql`

In alternativa, puoi creare un file `import.sql` nella directory `src/main/resources` del tuo progetto Spring Boot. Questo file verrà eseguito automaticamente all'avvio dell'applicazione per popolare il database con i dati iniziali.

#### Contenuto del file `import.sql`

```sql
CREATE TABLE Concert (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    artist VARCHAR(255) NOT NULL,
    date DATE NOT NULL,
    availableTickets INT NOT NULL
);

INSERT INTO Concert (name, artist, date, availableTickets) VALUES
('Concert A', 'Artist A', '2024-08-01', 100),
('Concert B', 'Artist B', '2024-09-15', 150),
('Concert C', 'Artist C', '2024-10-10', 200),
('Concert D', 'Artist D', '2024-11-20', 250),
('Concert E', 'Artist E', '2024-12-05', 300);
```

Salva il file `import.sql` e riavvia l'applicazione Spring Boot. Le tabelle e i dati di prova verranno creati automaticamente al riavvio.

### Verifica

Puoi verificare che i dati siano stati inseriti correttamente eseguendo una query SELECT nella console H2:

```sql
SELECT * FROM Concert;
```

Questo ti mostrerà tutti i concerti inseriti nel database.

Con questi passaggi, hai configurato e popolato il database H2 per la tua applicazione di biglietteria per concerti con Spring Boot.