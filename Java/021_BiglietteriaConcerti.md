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