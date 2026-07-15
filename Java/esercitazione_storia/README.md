# Esercitazione - Archivio degli eventi storici

## Obiettivo

Realizzare un'applicazione web con Spring Boot per la gestione degli eventi storici.

L'applicazione dovrà consentire la consultazione, l'inserimento e la modifica degli eventi, oltre ad alcune funzionalità di ricerca.

---

## Tecnologie

* Java 21
* Spring Boot
* Spring MVC
* Spring Data JPA
* Thymeleaf
* Bootstrap
* MySQL

---

# Database

Tabella:

```
eventi
```

| campo       | tipo         |
| ----------- | ------------ |
| id          | bigint       |
| anno        | int          |
| titolo      | varchar(200) |
| luogo       | varchar(100) |
| civilta     | varchar(100) |
| categoria   | varchar(50)  |
| descrizione | text         |

---

# Classe Entity

```
Evento
```

---

# Repository

```
EventoRepository
```

---

# Controller

```
EventoController
```

---

# Funzionalità richieste

## Livello base

Realizzare le seguenti pagine.

* elenco eventi
* dettaglio evento
* nuovo evento
* modifica evento
* eliminazione

---

## Livello intermedio

Aggiungere una ricerca per:

* anno

oppure

* titolo

---

## Livello avanzato

Consentire la ricerca per:

* categoria

oppure

* civiltà

---

## Livello esperto

Visualizzare:

* numero totale degli eventi

* evento più antico

* evento più recente

* numero di eventi per categoria

---

## Dati json di esempio

* [storia_antica.json](storia_antica.json)
* [storia_medioevale.json](storia_medioevale.json)
* [storia_moderna.json](storia_moderna.json)
* [storia_contemporanea.json](storia_contemporanea.json)
