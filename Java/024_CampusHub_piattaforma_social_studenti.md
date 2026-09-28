# Progetto: **CampusHub – piattaforma social per studenti**

L'idea è realizzare una web application che permetta agli studenti di **scoprire eventi, organizzare attività e trovare persone con interessi comuni**.

Il progetto è particolarmente adatto a 5 gruppi perché consente di separare chiaramente le responsabilità e, soprattutto, introduce un elemento interessante: **due gruppi sviluppano servizi REST che gli altri gruppi devono realmente consumare**.

### Scenario

Immaginiamo una piattaforma utilizzata dagli studenti di un campus:

* eventi universitari
* concerti e serate
* sport
* workshop
* gruppi di studio
* attività organizzate dagli studenti
* iscrizione agli eventi
* profili e interessi
* recensioni e valutazioni

La web application finale dovrà sembrare un'unica applicazione, anche se dietro le quinte sarà composta da componenti sviluppati dai diversi gruppi.

---

# 1. Architettura generale

```text
                         ┌─────────────────────┐
                         │      Browser        │
                         │  Web Application    │
                         └──────────┬──────────┘
                                    │
                              HTTP / REST
                                    │
                ┌───────────────────┼───────────────────┐
                │                   │                   │
                ▼                   ▼                   ▼
        ┌──────────────┐    ┌──────────────┐    ┌──────────────┐
        │ Event Service│    │ User Service │    │ Activity API │
        │   Gruppo 1   │    │   Gruppo 2   │    │   Gruppo 3   │
        └──────┬───────┘    └──────┬───────┘    └──────────────┘
               │                   │
               ▼                   ▼
           MySQL DB            MySQL DB


        ┌──────────────────┐      ┌──────────────────┐
        │ Recommendation   │      │ Web Application  │
        │ Service          │      │ / Integration    │
        │    Gruppo 4      │      │    Gruppo 5      │
        └────────┬─────────┘      └────────┬─────────┘
                 │                         │
                 └────────── REST ─────────┘
```

Non è necessario imporre una vera architettura a microservizi.

Anzi, didatticamente suggerirei di parlare di **servizi indipendenti** e di lasciare agli studenti la possibilità di sviluppare ciascun componente come una normale applicazione Spring Boot.

---

# 2. I cinque gruppi

## 🟦 Gruppo 1 – Event Service

### Responsabilità

Realizza il servizio REST dedicato agli **eventi**.

Entità principali:

```text
Event
 ├── id
 ├── title
 ├── description
 ├── category
 ├── location
 ├── dateTime
 ├── maxParticipants
 ├── organizerId
 └── status
```

Categorie possibili:

```text
PARTY
SPORT
MUSIC
STUDY
WORKSHOP
CULTURE
OTHER
```

### API REST

Ad esempio:

```http
GET    /api/events
GET    /api/events/{id}
POST   /api/events
PUT    /api/events/{id}
DELETE /api/events/{id}
```

Filtri:

```http
GET /api/events?category=MUSIC
GET /api/events?location=Torino
GET /api/events?from=2026-10-01
```

### API obbligatoria per gli altri gruppi

Il Gruppo 1 deve produrre una documentazione delle API, preferibilmente con **OpenAPI/Swagger**.

---

# 3. Gruppo 2 – User & Profile Service

Il secondo gruppo realizza un'altra API REST che gestisce gli utenti.

### Entità

```text
User
 ├── id
 ├── username
 ├── email
 ├── name
 ├── surname
 ├── birthDate
 ├── university
 └── bio
```

e:

```text
Interest
 ├── id
 └── name
```

Relazione:

```text
User ──────── * Interest
```

### API

```http
GET    /api/users
GET    /api/users/{id}
POST   /api/users
PUT    /api/users/{id}
DELETE /api/users/{id}
```

Interessi:

```http
GET /api/users/{id}/interests
POST /api/users/{id}/interests
DELETE /api/users/{id}/interests/{interestId}
```

Ricerca:

```http
GET /api/users?university=...
GET /api/users?interest=music
```

Anche questo servizio deve essere documentato con Swagger/OpenAPI.

---

# 4. Gruppo 3 – Activity / Booking Service

Questo gruppo deve **consumare le API dei Gruppi 1 e 2**.

Qui introduciamo una parte molto interessante dal punto di vista didattico.

Il servizio gestisce la partecipazione degli utenti agli eventi.

```text
Booking
 ├── id
 ├── userId
 ├── eventId
 ├── bookingDate
 └── status
```

Il servizio **non deve avere nella propria base dati tutte le informazioni sull'utente e sull'evento**.

Deve utilizzare le API REST degli altri gruppi.

Ad esempio:

```text
POST /api/bookings
```

riceve:

```json
{
    "userId": 15,
    "eventId": 42
}
```

Prima di creare la prenotazione:

```text
Activity Service
       │
       ├── GET User API ───────► esiste user 15?
       │
       └── GET Event API ──────► esiste event 42?
                                  │
                                  ▼
                             posti disponibili?
                                  │
                                  ▼
                           crea Booking
```

Questo obbliga gli studenti a confrontarsi con un problema reale:

> **un servizio non possiede necessariamente tutti i dati di cui ha bisogno.**

---

# 5. Gruppo 4 – Recommendation Service

Questo è il gruppo più "AI-oriented", ma senza obbligare a utilizzare realmente l'AI.

Il servizio deve proporre eventi agli utenti.

La logica iniziale può essere molto semplice.

Esempio:

```text
utente:

interessi:
    MUSIC
    SPORT
    TECHNOLOGY

eventi:

Concert → MUSIC        +++
Football → SPORT      +++
Hackathon → TECHNOLOGY +++
Yoga → SPORT          ++
Painting → CULTURE     -
```

Il servizio interroga:

```text
User API
     │
     ▼
interessi dell'utente
     │
     ▼
Event API
     │
     ▼
eventi disponibili
     │
     ▼
algoritmo di ranking
     │
     ▼
raccomandazioni
```

API:

```http
GET /api/recommendations/user/{userId}
```

Risposta:

```json
[
    {
        "eventId": 42,
        "title": "Tech Night",
        "score": 0.92,
        "reason": "Matches your interest in technology"
    },
    {
        "eventId": 17,
        "title": "Campus Football",
        "score": 0.75,
        "reason": "Matches your interest in sport"
    }
]
```

### Estensione opzionale

Se il corso riguarda anche AI, il gruppo può successivamente sostituire il semplice algoritmo con un sistema più evoluto.

Ad esempio:

```text
interessi
   +
eventi precedentemente frequentati
   +
categorie preferite
   +
popolarità evento
          ↓
      ranking
```

---

# 6. Gruppo 5 – Web Application / Integration

Questo gruppo realizza la **facciata web dell'intero sistema**.

Può utilizzare:

* HTML
* CSS
* Bootstrap
* JavaScript
* Thymeleaf

oppure una soluzione frontend più moderna se già prevista nel corso.

Il requisito fondamentale è che **non acceda direttamente ai database degli altri gruppi**.

Comunica esclusivamente attraverso le API.

### Dashboard

La home potrebbe essere:

```text
┌──────────────────────────────────────────────────────┐
│ CampusHub                               👤 Mauro     │
├──────────────────────────────────────────────────────┤
│                                                      │
│  🔎 Cerca eventi                                     │
│                                                      │
│  Categorie                                           │
│  [Music] [Sport] [Study] [Party] [Workshop]         │
│                                                      │
├──────────────────────────────────────────────────────┤
│  EVENTI CONSIGLIATI                                  │
│                                                      │
│  🎵 Tech Night                                       │
│  📍 Torino                                           │
│  📅 12 ottobre                                       │
│  [Scopri]                                            │
│                                                      │
│  ⚽ Campus Football                                  │
│  📍 Campus                                            │
│  📅 15 ottobre                                       │
│  [Scopri]                                            │
└──────────────────────────────────────────────────────┘
```

---

# 7. Stack tecnologico obbligatorio

Per tutti i gruppi:

### Backend

```text
Java
Spring Boot
Spring Web
Spring Data JPA
Hibernate
Maven
```

### Database

```text
MySQL
```

### Comunicazione

```text
REST
HTTP
JSON
```

### Documentazione

```text
OpenAPI / Swagger
```

### Versionamento

```text
Git
GitHub
```

### Frontend

A scelta:

```text
HTML
CSS
Bootstrap
JavaScript
Thymeleaf
```

oppure, se già affrontato nel corso:

```text
Angular
```

---

# 8. Regola fondamentale: i database sono separati

Questa è una parte che renderei **obbligatoria**.

Non vogliamo:

```text
              MySQL
                │
       ┌────────┼────────┐
       │        │        │
       ▼        ▼        ▼
     Team 1   Team 2   Team 3
```

ma:

```text
┌──────────────┐      ┌──────────────┐
│ Event Service│      │ User Service │
│              │      │              │
│   MySQL      │      │    MySQL     │
└──────┬───────┘      └──────┬───────┘
       │                     │
       │ REST                │ REST
       │                     │
       └──────────┬──────────┘
                  ▼
          Activity Service
```

Questo permette di introdurre concretamente il concetto di:

**service ownership**

Ogni gruppo è proprietario dei propri dati.

Gli altri gruppi **non possono fare SELECT direttamente sulle sue tabelle**.

---

# 9. Contratto API

Prima di iniziare lo sviluppo, i Gruppi 1 e 2 devono produrre il **contratto delle API**.

Per esempio:

```http
GET /api/events/42
```

Risposta:

```json
{
    "id": 42,
    "title": "Tech Night",
    "category": "TECHNOLOGY",
    "location": "Torino",
    "dateTime": "2026-10-12T20:30:00",
    "maxParticipants": 100
}
```

Il Gruppo 3 può sviluppare utilizzando questo contratto **anche prima che il servizio sia terminato**.

È un ottimo punto didattico:

> API-first development.

---

# 10. Requisiti funzionali minimi

La piattaforma finale deve permettere almeno di:

### Utente

* visualizzare utenti
* visualizzare il profilo
* modificare il profilo
* gestire interessi

### Eventi

* visualizzare eventi
* cercare eventi
* filtrare per categoria
* filtrare per data
* creare evento
* modificare evento

### Partecipazione

* iscriversi a un evento
* annullare iscrizione
* visualizzare le proprie iscrizioni
* controllare disponibilità posti

### Recommendation

* visualizzare eventi consigliati
* visualizzare il motivo della raccomandazione

---

# 11. Requisiti tecnici Spring Boot

Ogni backend dovrebbe utilizzare almeno:

```text
Controller
    ↓
Service
    ↓
Repository
    ↓
Entity
```

Ad esempio:

```text
EventController
       ↓
EventService
       ↓
EventRepository
       ↓
Event
```

e DTO:

```text
EventRequest
EventResponse
```

Quindi evitare:

```java
@GetMapping
public List<Event> getEvents() {
    return repository.findAll();
}
```

come unica architettura.

L'obiettivo è far esercitare:

* Dependency Injection
* REST Controller
* DTO
* Service Layer
* Repository
* JPA
* Entity relationships
* validation
* exception handling

---

# 12. Comunicazione REST tra servizi

Per esempio il Gruppo 3 potrebbe utilizzare:

```java
RestClient
```

di Spring Framework.

Schema:

```text
ActivityService
       │
       │ HTTP GET
       ▼
http://user-service/api/users/15
       │
       ▼
     JSON
       │
       ▼
UserResponse
```

e:

```text
ActivityService
       │
       │ HTTP GET
       ▼
http://event-service/api/events/42
       │
       ▼
     JSON
       │
       ▼
EventResponse
```

Questo permette di introdurre anche:

* timeout
* gestione errori
* HTTP status code
* retry
* servizi non disponibili

senza dover trasformare il progetto in un corso completo di microservizi.

---

# 13. Suddivisione dei 5 studenti di ogni gruppo

Anche all'interno del gruppo assegnerei ruoli.

| Ruolo                 | Responsabilità             |
| --------------------- | -------------------------- |
| Backend developer 1   | Controller / REST          |
| Backend developer 2   | Service / business logic   |
| Database developer    | MySQL / JPA                |
| Integration developer | API / DTO / test           |
| Frontend / QA         | UI / test / documentazione |

I ruoli possono naturalmente ruotare.

L'obiettivo è evitare il classico problema:

> uno programma e quattro guardano.

---

# 14. Fasi dell'esercitazione

La imposterei in **5 sprint**.

### Sprint 1 – Analisi

Ogni gruppo produce:

* requisiti
* use case
* modello dati
* API specification
* Git repository

---

### Sprint 2 – Database + Backend

Implementazione:

```text
Entity
Repository
Service
Controller
```

e primi test.

---

### Sprint 3 – API integration

I gruppi iniziano a consumare le API degli altri.

Qui possono emergere problemi molto realistici:

```text
404
400
401
500
timeout
JSON incompatibile
campo mancante
```

---

### Sprint 4 – Web Application

Realizzazione dell'interfaccia.

```text
Login
Dashboard
Eventi
Dettaglio evento
Profilo
Prenotazioni
Raccomandazioni
```

---

### Sprint 5 – Integration & Demo

Tutti i gruppi devono consegnare una **singola demo integrata**.

Scenario di demo:

```text
1. Mario accede alla piattaforma

2. Visualizza il proprio profilo

3. I suoi interessi sono:
   MUSIC
   TECHNOLOGY

4. CampusHub mostra gli eventi

5. Il Recommendation Service
   propone "Tech Night"

6. Mario apre l'evento

7. Clicca "Partecipa"

8. Activity Service verifica:
       User API
       Event API

9. Crea la prenotazione

10. La dashboard mostra:
       "Partecipazione confermata"
```

---

# 15. Criteri di valutazione

Potresti utilizzare una griglia da **100 punti**:

| Area                       |   Punti |
| -------------------------- | ------: |
| Analisi e progettazione    |      10 |
| Database / modello dati    |      15 |
| Spring Boot / architettura |      20 |
| REST API                   |      15 |
| Integrazione tra servizi   |      15 |
| Web application            |      10 |
| Testing                    |       5 |
| Git / collaborazione       |       5 |
| Documentazione             |       5 |
| **Totale**                 | **100** |

Una cosa importante: **l'integrazione deve essere valutata a livello individuale e di gruppo**. Altrimenti rischi che il progetto funzioni ma che gli studenti non sappiano spiegare cosa hanno realmente fatto.

---

## Equivalenza con un progetto professionale

Il progetto ha una progressione naturale:

```text
                 CAMPUSHUB
                     │
          ┌──────────┴──────────┐
          │                     │
       PERSONE                EVENTI
          │                     │
          └──────────┬──────────┘
                     │
                PARTECIPAZIONI
                     │
                     ▼
              RACCOMANDAZIONI
                     │
                     ▼
               WEB APP
```

permette di partire da una normale applicazione **Spring Boot + MySQL + REST** per arrivare gradualmente a concetti più avanzati:

**OOP → Spring → JPA → REST → JSON → API integration → servizi distribuiti → frontend → testing → Git → eventuale AI.**

È quindi sufficientemente realistico da poter essere presentato come **progetto software professionale**, non come semplice esercizio CRUD.
