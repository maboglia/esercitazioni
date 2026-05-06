# 1) Mini Web App PHP (Routing + API REST)

## Obiettivo esercitazione

Creiamo una mini web app chiamata:

📌 **StudentAPI**
che gestisce studenti tramite API:

* `GET /api/students` → lista studenti
* `GET /api/students/{id}` → dettaglio studente
* `POST /api/students` → inserimento
* `PUT /api/students/{id}` → modifica
* `DELETE /api/students/{id}` → elimina

---

# 2) Struttura del progetto

```
studentapi/
│
├── public/
│   └── index.php
│
├── src/
│   ├── Router.php
│   ├── Request.php
│   ├── Response.php
│   │
│   ├── controllers/
│   │   └── StudentController.php
│   │
│   ├── services/
│   │   └── StudentService.php
│   │
│   ├── repositories/
│   │   └── StudentRepository.php
│   │
│   └── config/
│       └── database.php
│
└── storage/
    └── database.sqlite
```

---

# 3) Avvio con server built-in PHP

Dentro `studentapi/`:

```bash
php -S localhost:8000 -t public
```

Poi richiami:

* [http://localhost:8000/api/students](http://localhost:8000/api/students)

---

# 4) File `public/index.php`

```php
<?php

require_once __DIR__ . '/../src/Router.php';
require_once __DIR__ . '/../src/Request.php';
require_once __DIR__ . '/../src/Response.php';

require_once __DIR__ . '/../src/controllers/StudentController.php';
require_once __DIR__ . '/../src/services/StudentService.php';
require_once __DIR__ . '/../src/repositories/StudentRepository.php';
require_once __DIR__ . '/../src/config/database.php';

$request = new Request();
$response = new Response();

$router = new Router($request, $response);

$controller = new StudentController(
    new StudentService(
        new StudentRepository(getConnection())
    )
);

$router->get("/api/students", [$controller, "index"]);
$router->get("/api/students/{id}", [$controller, "show"]);
$router->post("/api/students", [$controller, "store"]);
$router->put("/api/students/{id}", [$controller, "update"]);
$router->delete("/api/students/{id}", [$controller, "destroy"]);

$router->dispatch();
```

---

# 5) Classe `src/Request.php`

```php
<?php

class Request
{
    public function method(): string
    {
        return $_SERVER["REQUEST_METHOD"];
    }

    public function path(): string
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        return rtrim($uri, "/") ?: "/";
    }

    public function body(): array
    {
        $data = file_get_contents("php://input");
        $json = json_decode($data, true);

        if (is_array($json)) {
            return $json;
        }

        return $_POST;
    }
}
```

---

# 6) Classe `src/Response.php`

```php
<?php

class Response
{
    public function json($data, int $status = 200): void
    {
        http_response_code($status);
        header("Content-Type: application/json; charset=UTF-8");

        echo json_encode($data, JSON_PRETTY_PRINT);
    }
}
```

---

# 7) Router `src/Router.php`

```php
<?php

class Router
{
    private array $routes = [];

    public function __construct(
        private Request $request,
        private Response $response
    ) {}

    public function get(string $path, callable $handler): void
    {
        $this->routes["GET"][] = [$path, $handler];
    }

    public function post(string $path, callable $handler): void
    {
        $this->routes["POST"][] = [$path, $handler];
    }

    public function put(string $path, callable $handler): void
    {
        $this->routes["PUT"][] = [$path, $handler];
    }

    public function delete(string $path, callable $handler): void
    {
        $this->routes["DELETE"][] = [$path, $handler];
    }

    public function dispatch(): void
    {
        $method = $this->request->method();
        $path = $this->request->path();

        $routes = $this->routes[$method] ?? [];

        foreach ($routes as [$routePath, $handler]) {

            $pattern = preg_replace("#\{[a-zA-Z]+\}#", "([0-9]+)", $routePath);
            $pattern = "#^" . $pattern . "$#";

            if (preg_match($pattern, $path, $matches)) {
                array_shift($matches);
                call_user_func_array($handler, $matches);
                return;
            }
        }

        $this->response->json(["error" => "Route not found"], 404);
    }
}
```

---

# 8) Config DB `src/config/database.php`

SQLite semplice:

```php
<?php

function getConnection(): PDO
{
    $dbPath = __DIR__ . "/../../storage/database.sqlite";

    $pdo = new PDO("sqlite:" . $dbPath);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}
```

---

# 9) Repository `src/repositories/StudentRepository.php`

```php
<?php

class StudentRepository
{
    public function __construct(private PDO $pdo) {}

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM students");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM students WHERE id = ?");
        $stmt->execute([$id]);

        $student = $stmt->fetch(PDO::FETCH_ASSOC);

        return $student ?: null;
    }

    public function insert(string $name, string $email): int
    {
        $stmt = $this->pdo->prepare("INSERT INTO students(name,email) VALUES(?,?)");
        $stmt->execute([$name, $email]);

        return (int)$this->pdo->lastInsertId();
    }

    public function update(int $id, string $name, string $email): bool
    {
        $stmt = $this->pdo->prepare("UPDATE students SET name=?, email=? WHERE id=?");
        return $stmt->execute([$name, $email, $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM students WHERE id=?");
        return $stmt->execute([$id]);
    }
}
```

---

# 10) Service `src/services/StudentService.php`

```php
<?php

class StudentService
{
    public function __construct(private StudentRepository $repo) {}

    public function getAll(): array
    {
        return $this->repo->findAll();
    }

    public function getOne(int $id): ?array
    {
        return $this->repo->findById($id);
    }

    public function create(array $data): array
    {
        if (!isset($data["name"]) || !isset($data["email"])) {
            throw new Exception("Missing fields");
        }

        $id = $this->repo->insert($data["name"], $data["email"]);
        return $this->repo->findById($id);
    }

    public function modify(int $id, array $data): ?array
    {
        $student = $this->repo->findById($id);
        if (!$student) return null;

        $name = $data["name"] ?? $student["name"];
        $email = $data["email"] ?? $student["email"];

        $this->repo->update($id, $name, $email);

        return $this->repo->findById($id);
    }

    public function remove(int $id): bool
    {
        return $this->repo->delete($id);
    }
}
```

---

# 11) Controller `src/controllers/StudentController.php`

```php
<?php

class StudentController
{
    public function __construct(private StudentService $service) {}

    public function index(): void
    {
        global $response;
        $response->json($this->service->getAll());
    }

    public function show(int $id): void
    {
        global $response;

        $student = $this->service->getOne($id);

        if (!$student) {
            $response->json(["error" => "Student not found"], 404);
            return;
        }

        $response->json($student);
    }

    public function store(): void
    {
        global $request, $response;

        try {
            $student = $this->service->create($request->body());
            $response->json($student, 201);
        } catch (Exception $ex) {
            $response->json(["error" => $ex->getMessage()], 400);
        }
    }

    public function update(int $id): void
    {
        global $request, $response;

        $student = $this->service->modify($id, $request->body());

        if (!$student) {
            $response->json(["error" => "Student not found"], 404);
            return;
        }

        $response->json($student);
    }

    public function destroy(int $id): void
    {
        global $response;

        $ok = $this->service->remove($id);

        if (!$ok) {
            $response->json(["error" => "Delete failed"], 400);
            return;
        }

        $response->json(["message" => "Deleted"]);
    }
}
```

---

# 12) Creazione tabella SQLite

Crea file:

`storage/database.sqlite`

Poi esegui:

```bash
sqlite3 storage/database.sqlite
```

Dentro sqlite:

```sql
CREATE TABLE students (
  id INTEGER PRIMARY KEY AUTOINCREMENT,
  name TEXT NOT NULL,
  email TEXT NOT NULL
);

INSERT INTO students(name,email) VALUES
('Mario Rossi','mario@email.it'),
('Giulia Bianchi','giulia@email.it');
```

---

# 13) Test API con curl

### GET lista

```bash
curl http://localhost:8000/api/students
```

### GET singolo

```bash
curl http://localhost:8000/api/students/1
```

### POST create

```bash
curl -X POST http://localhost:8000/api/students \
-H "Content-Type: application/json" \
-d '{"name":"Luca Verdi","email":"luca@email.it"}'
```

### PUT update

```bash
curl -X PUT http://localhost:8000/api/students/1 \
-H "Content-Type: application/json" \
-d '{"email":"nuova@email.it"}'
```

### DELETE

```bash
curl -X DELETE http://localhost:8000/api/students/1
```

---

# 14) Concetti PHP che ripassi con questa app

* `$_SERVER`, `$_POST`
* `php://input`
* JSON encode/decode
* `PDO` e prepared statements
* pattern MVC semplificato
* routing manuale
* HTTP verbs (GET POST PUT DELETE)
* status code (200, 201, 400, 404)

---

# 15) 30 Domande PHP stile esame

### (A) Base PHP

1. Differenza tra `echo` e `print`.
2. Differenza tra `==` e `===`.
3. Cos’è una variabile superglobale? Fai esempi.
4. Che differenza c’è tra `isset()` ed `empty()`?
5. Differenza tra `include` e `require`.
6. Differenza tra `include_once` e `include`.
7. Come funzionano gli scope delle variabili in PHP?
8. A cosa serve `global` dentro una funzione?
9. Come si definisce una costante in PHP?
10. Differenza tra costanti e variabili.

### (B) Array e stringhe

1. Differenza tra array indicizzati e associativi.
2. Differenza tra `array_push()` e `$arr[] = ...`.
3. Differenza tra `explode()` e `implode()`.
4. A cosa serve `count()`?
5. Come ordinare un array associativo per chiavi e per valori?
6. Differenza tra `sort()`, `asort()`, `ksort()`.

### (C) Funzioni e OOP

1. Differenza tra funzione e metodo.
2. Cos’è il type hinting in PHP?
3. Differenza tra `public`, `private`, `protected`.
4. A cosa serve `static` in un metodo?
5. Differenza tra `self` e `$this`.
6. A cosa serve un costruttore (`__construct`)?
7. Cos’è l’ereditarietà e come si usa `extends`?
8. Cos’è un’interfaccia e come si usa `implements`?

### (D) Web e HTTP

1. Differenza tra GET e POST.
2. A cosa serve `header()`?
3. Cos’è `php://input` e quando si usa?
4. Come si leggono parametri query string (`?id=3`) in PHP?
5. Cos’è una sessione e come si usa `session_start()`?
6. Differenza tra cookie e sessione.

