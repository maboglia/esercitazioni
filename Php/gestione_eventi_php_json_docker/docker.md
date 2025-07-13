# 📦 **Struttura aggiornata del progetto**

```
gestione-eventi/
│
├── docker-compose.yml
├── Dockerfile
├── apache/
│   └── 000-default.conf
│
├── src/                ← Tutto il codice PHP va qui dentro
│   ├── index.php
│   ├── add.php
│   ├── ...
│   ├── includes/
│   ├── data/
│   ├── views/
│   └── style.css
```

---

## 🛠️ **1. Dockerfile**

```Dockerfile
# Usa immagine PHP con Apache
FROM php:8.2-apache

# Abilita mod_rewrite (se utile)
RUN a2enmod rewrite

# Copia configurazione Apache personalizzata
COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

# Copia codice PHP nella cartella di Apache
COPY src/ /var/www/html/

# Imposta permessi scrittura sulla cartella dati
RUN chown -R www-data:www-data /var/www/html/data
```

---

## 📄 **2. apache/000-default.conf** (configurazione VirtualHost Apache)

```apache
<VirtualHost *:80>
    DocumentRoot /var/www/html

    <Directory /var/www/html>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

---

## 🐳 **3. docker-compose.yml**

```yaml
version: '3.8'

services:
  php-apache:
    build: .
    container_name: eventi_php
    ports:
      - "8080:80"
    volumes:
      - ./src:/var/www/html
    restart: always
```

---

## ✅ **4. Comandi per avviare il progetto**

Nel terminale, dalla cartella `gestione-eventi/`:

```bash
docker-compose up --build
```

Poi apri il browser su:
👉 `http://localhost:8080`

---

## 🧪 **5. Test e modifica live**

* Ogni modifica ai file nella cartella `src/` sarà **immediatamente visibile**.
* I dati scritti in `data/events.json` saranno **persistenti** nel volume locale (cartella `src/data/`).

---

## ✅ Requisiti sul PC

* Docker e Docker Compose installati
* Nessun altro servizio web in ascolto sulla porta `8080`

---

### 🔒 Permessi sulla cartella `data/`

Assicurati che `src/data/events.json` sia scrivibile. Puoi forzarlo così:

```bash
chmod 777 src/data/events.json
```

(o meglio: `chown` corretto in ambienti Unix-like)

---

* Codice PHP CRUD funzionante
* Configurazione Docker (`Dockerfile`, `docker-compose.yml`)
* Apache configurato
* File `events.json` vuoto
* Mini-CSS base

Per eseguire il progetto:

```bash
docker-compose up --build
```

Apri poi il browser su: [http://localhost:8080](http://localhost:8080)

