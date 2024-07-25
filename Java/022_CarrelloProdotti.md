# Esercitazione: Creazione di un'applicazione di gestione del carrello prodotti con Spring Boot

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
   - Crea la classe `Product` nel pacchetto `com.example.cart.model`:
     ```java
     package com.example.cart.model;

     import javax.persistence.Entity;
     import javax.persistence.GeneratedValue;
     import javax.persistence.GenerationType;
     import javax.persistence.Id;
     import java.math.BigDecimal;

     @Entity
     public class Product {
         @Id
         @GeneratedValue(strategy = GenerationType.IDENTITY)
         private Long id;
         private String name;
         private BigDecimal price;

         // Getters and setters
     }
     ```

   - Crea la classe `Cart` nel pacchetto `com.example.cart.model`:
     ```java
     package com.example.cart.model;

     import javax.persistence.*;
     import java.util.HashSet;
     import java.util.Set;

     @Entity
     public class Cart {
         @Id
         @GeneratedValue(strategy = GenerationType.IDENTITY)
         private Long id;
         private String customerName;

         @ManyToMany
         @JoinTable(
             name = "cart_product",
             joinColumns = @JoinColumn(name = "cart_id"),
             inverseJoinColumns = @JoinColumn(name = "product_id")
         )
         private Set<Product> products = new HashSet<>();

         // Getters and setters
     }
     ```

4. **Creazione dei repository**
   - Crea l'interfaccia `ProductRepository` nel pacchetto `com.example.cart.repository`:
     ```java
     package com.example.cart.repository;

     import com.example.cart.model.Product;
     import org.springframework.data.jpa.repository.JpaRepository;
     import org.springframework.stereotype.Repository;

     @Repository
     public interface ProductRepository extends JpaRepository<Product, Long> {
     }
     ```

   - Crea l'interfaccia `CartRepository` nel pacchetto `com.example.cart.repository`:
     ```java
     package com.example.cart.repository;

     import com.example.cart.model.Cart;
     import org.springframework.data.jpa.repository.JpaRepository;
     import org.springframework.stereotype.Repository;

     @Repository
     public interface CartRepository extends JpaRepository<Cart, Long> {
     }
     ```

5. **Servizio**
   - Crea la classe `CartService` nel pacchetto `com.example.cart.service`:
     ```java
     package com.example.cart.service;

     import com.example.cart.model.Cart;
     import com.example.cart.model.Product;
     import com.example.cart.repository.CartRepository;
     import com.example.cart.repository.ProductRepository;
     import org.springframework.beans.factory.annotation.Autowired;
     import org.springframework.stereotype.Service;

     import java.util.List;

     @Service
     public class CartService {
         @Autowired
         private CartRepository cartRepository;

         @Autowired
         private ProductRepository productRepository;

         public List<Cart> getAllCarts() {
             return cartRepository.findAll();
         }

         public Cart getCartById(Long id) {
             return cartRepository.findById(id).orElse(null);
         }

         public Cart saveCart(Cart cart) {
             return cartRepository.save(cart);
         }

         public void deleteCart(Long id) {
             cartRepository.deleteById(id);
         }

         public Product addProductToCart(Long cartId, Long productId) {
             Cart cart = getCartById(cartId);
             Product product = productRepository.findById(productId).orElse(null);
             if (cart != null && product != null) {
                 cart.getProducts().add(product);
                 cartRepository.save(cart);
                 return product;
             }
             return null;
         }
     }
     ```

6. **Controller**
   - Crea la classe `CartController` nel pacchetto `com.example.cart.controller`:
     ```java
     package com.example.cart.controller;

     import com.example.cart.model.Cart;
     import com.example.cart.model.Product;
     import com.example.cart.service.CartService;
     import org.springframework.beans.factory.annotation.Autowired;
     import org.springframework.http.HttpStatus;
     import org.springframework.http.ResponseEntity;
     import org.springframework.web.bind.annotation.*;

     import java.util.List;

     @RestController
     @RequestMapping("/api/carts")
     public class CartController {
         @Autowired
         private CartService cartService;

         @GetMapping
         public ResponseEntity<List<Cart>> getAllCarts() {
             return new ResponseEntity<>(cartService.getAllCarts(), HttpStatus.OK);
         }

         @GetMapping("/{id}")
         public ResponseEntity<Cart> getCartById(@PathVariable Long id) {
             Cart cart = cartService.getCartById(id);
             if (cart != null) {
                 return new ResponseEntity<>(cart, HttpStatus.OK);
             } else {
                 return new ResponseEntity<>(HttpStatus.NOT_FOUND);
             }
         }

         @PostMapping
         public ResponseEntity<Cart> createCart(@RequestBody Cart cart) {
             return new ResponseEntity<>(cartService.saveCart(cart), HttpStatus.CREATED);
         }

         @DeleteMapping("/{id}")
         public ResponseEntity<Void> deleteCart(@PathVariable Long id) {
             cartService.deleteCart(id);
             return new ResponseEntity<>(HttpStatus.NO_CONTENT);
         }

         @PostMapping("/{cartId}/products/{productId}")
         public ResponseEntity<Product> addProductToCart(@PathVariable Long cartId, @PathVariable Long productId) {
             Product product = cartService.addProductToCart(cartId, productId);
             if (product != null) {
                 return new ResponseEntity<>(product, HttpStatus.OK);
             } else {
                 return new ResponseEntity<>(HttpStatus.NOT_FOUND);
             }
         }
     }
     ```

7. **Creazione del file schema.sql**

   - Crea un file `schema.sql` nella directory `src/main/resources` con il seguente contenuto:
     ```sql
     CREATE TABLE Product (
         id BIGINT AUTO_INCREMENT PRIMARY KEY,
         name VARCHAR(255) NOT NULL,
         price DECIMAL(10, 2) NOT NULL
     );

     CREATE TABLE Cart (
         id BIGINT AUTO_INCREMENT PRIMARY KEY,
         customerName VARCHAR(255) NOT NULL
     );

     CREATE TABLE cart_product (
         cart_id BIGINT NOT NULL,
         product_id BIGINT NOT NULL,
         PRIMARY KEY (cart_id, product_id),
         FOREIGN KEY (cart_id) REFERENCES Cart(id),
         FOREIGN KEY (product_id) REFERENCES Product(id)
     );
     ```

8. **Creazione del file data.sql**

   - Crea un file `data.sql` nella directory `src/main/resources` con il seguente contenuto:
     ```sql
     INSERT INTO Product (name, price) VALUES ('Product A', 10.99);
     INSERT INTO Product (name, price) VALUES ('Product B', 19.99);
     INSERT INTO Product (name, price) VALUES ('Product C', 5.49);
     INSERT INTO Product (name, price) VALUES ('Product D', 14.99);
     INSERT INTO Product (name, price) VALUES ('Product E', 2.99);

     INSERT INTO Cart (customerName) VALUES ('Customer 1');
     INSERT INTO Cart (customerName) VALUES ('Customer 2');

     INSERT INTO cart_product (cart_id, product_id) VALUES (1, 1);
     INSERT INTO cart_product (cart_id, product_id) VALUES (1, 3);
     INSERT INTO cart_product (cart_id, product_id) VALUES (2, 2);
     INSERT INTO cart_product (cart_id, product_id) VALUES (2, 4);
     ```

9. **Esecuzione dell'applicazione**
   - Esegui l'applicazione tramite il tuo IDE o usando il comando Maven:
     ```sh
     ./mvnw spring-boot:run
     ```

10. **Test dell'applicazione**
    - Puoi testare le API usando Postman o qualsiasi altro client HTTP. Ecco alcuni esempi di richieste:
      - **GET** `/api/carts` per ottenere tutti i carrelli
      - **GET** `/api/carts/{id}` per ottenere un carrello specifico
      - **POST** `/api/carts` per creare un nuovo carrello (fornisci un body JSON)
      - **DELETE** `/api/carts/{id}` per eliminare un carrello
      - **POST** `/api/carts/{cartId}/products/{productId}` per aggiungere un prodotto al carrello

---

Client HTML + JavaScript per interagire con le API Spring Boot del carrello di prodotti usando fetch.

### File HTML: `index.html`

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrello Prodotti</title>
    <style>
        body { font-family: Arial, sans-serif; }
        #product-list, #cart-list { margin-top: 20px; }
        .item { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Gestione del Carrello Prodotti</h1>

    <div>
        <h2>Prodotti</h2>
        <div id="product-list"></div>
    </div>

    <div>
        <h2>Carrelli</h2>
        <div id="cart-list"></div>
    </div>

    <script>
        const API_BASE_URL = 'http://localhost:8080/api';

        // Fetch and display all products
        async function fetchProducts() {
            const response = await fetch(`${API_BASE_URL}/products`);
            const products = await response.json();
            const productList = document.getElementById('product-list');
            productList.innerHTML = '';
            products.forEach(product => {
                const productItem = document.createElement('div');
                productItem.className = 'item';
                productItem.innerHTML = `
                    <strong>${product.name}</strong> - $${product.price}
                    <button onclick="addProductToCart(${product.id})">Aggiungi al Carrello</button>
                `;
                productList.appendChild(productItem);
            });
        }

        // Fetch and display all carts
        async function fetchCarts() {
            const response = await fetch(`${API_BASE_URL}/carts`);
            const carts = await response.json();
            const cartList = document.getElementById('cart-list');
            cartList.innerHTML = '';
            carts.forEach(cart => {
                const cartItem = document.createElement('div');
                cartItem.className = 'item';
                cartItem.innerHTML = `
                    <strong>${cart.customerName}'s Carrello</strong>
                    <ul>
                        ${cart.products.map(product => `<li>${product.name} - $${product.price}</li>`).join('')}
                    </ul>
                    <button onclick="deleteCart(${cart.id})">Elimina Carrello</button>
                `;
                cartList.appendChild(cartItem);
            });
        }

        // Add product to cart
        async function addProductToCart(productId) {
            const cartId = prompt('Inserisci l\'ID del carrello al quale aggiungere il prodotto:');
            if (cartId) {
                await fetch(`${API_BASE_URL}/carts/${cartId}/products/${productId}`, {
                    method: 'POST'
                });
                fetchCarts();
            }
        }

        // Delete cart
        async function deleteCart(cartId) {
            await fetch(`${API_BASE_URL}/carts/${cartId}`, {
                method: 'DELETE'
            });
            fetchCarts();
        }

        // Initialize the page
        fetchProducts();
        fetchCarts();
    </script>
</body>
</html>
```

### Integrazione con Spring Boot

Assicurati che il controller Spring Boot permetta le richieste CORS per consentire l'accesso dal client HTML. Aggiungi la seguente configurazione alla tua applicazione Spring Boot:

#### Configurazione CORS

- Crea una classe di configurazione CORS:

```java
package com.example.cart.config;

import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.web.servlet.config.annotation.CorsRegistry;
import org.springframework.web.servlet.config.annotation.WebMvcConfigurer;

@Configuration
public class WebConfig {

    @Bean
    public WebMvcConfigurer corsConfigurer() {
        return new WebMvcConfigurer() {
            @Override
            public void addCorsMappings(CorsRegistry registry) {
                registry.addMapping("/api/**")
                        .allowedOrigins("http://localhost:5500") // Modifica con l'origine del tuo client HTML se necessario
                        .allowedMethods("GET", "POST", "DELETE", "PUT", "PATCH");
            }
        };
    }
}
```

### Avvio dell'applicazione

1. Avvia l'applicazione Spring Boot.
2. Salva il file `index.html` in una directory e aprilo nel tuo browser (doppio clic sul file o usa un server locale come Live Server su VS Code).

### Verifica

Ora dovresti vedere una lista di prodotti e carrelli sul tuo client HTML. Puoi aggiungere prodotti ai carrelli e eliminare carrelli usando i pulsanti forniti.

Questa configurazione ti fornisce un semplice client HTML + JavaScript per interagire con le API di gestione del carrello prodotti create con Spring Boot.

---

### Spiegazione di `async` e `await` in JavaScript

`async` e `await` sono parole chiave introdotte in ECMAScript 2017 (ES8) che facilitano il lavoro con le operazioni asincrone in JavaScript, rendendo il codice più leggibile e simile al codice sincrono.

#### `async`:
- La parola chiave `async` viene utilizzata per dichiarare una funzione asincrona. Una funzione asincrona restituisce implicitamente una `Promise`.
- Se una funzione asincrona restituisce un valore, quel valore viene automaticamente racchiuso in una `Promise` risolta.
- Se una funzione asincrona genera un'eccezione o ritorna un `Promise` che viene rigettata, la `Promise` restituita dalla funzione asincrona viene rigettata con quell'errore.

#### `await`:
- La parola chiave `await` può essere usata solo all'interno di una funzione dichiarata con `async`.
- `await` pausa l'esecuzione della funzione asincrona fino a quando la `Promise` non viene risolta o rigettata.
- `await` restituisce il valore risolto della `Promise`.

### Esempio senza `async` e `await`

Prima dell'introduzione di `async` e `await`, le operazioni asincrone venivano gestite principalmente con `Promise` e catene di `.then()`:

```javascript
function fetchData() {
    fetch('https://api.example.com/data')
        .then(response => response.json())
        .then(data => {
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

fetchData();
```

### Esempio con `async` e `await`

Usando `async` e `await`, lo stesso codice può essere scritto in modo più leggibile e lineare:

```javascript
async function fetchData() {
    try {
        const response = await fetch('https://api.example.com/data');
        const data = await response.json();
        console.log(data);
    } catch (error) {
        console.error('Error:', error);
    }
}

fetchData();
```

### Differenze e Vantaggi

1. **Leggibilità**:
   - Con `async` e `await`, il codice assomiglia più al codice sincrono, facilitando la comprensione e la manutenzione.
   - Le operazioni asincrone appaiono sequenziali, evitando le lunghe catene di `.then()`.

2. **Gestione degli errori**:
   - Usando `async` e `await`, è possibile gestire gli errori delle operazioni asincrone con un blocco `try`/`catch`, rendendo il flusso di gestione degli errori più intuitivo.

3. **Codice meno nidificato**:
   - Senza `async` e `await`, si tende ad avere codice nidificato con molteplici `.then()`, che può diventare complesso e difficile da leggere.
   - `async` e `await` riducono la nidificazione, mantenendo il codice più piatto e leggibile.

### Esempio completo

Immaginiamo di avere una funzione che recupera i dati di un utente e poi i dati dei suoi post:

#### Con `Promise` e `.then()`

```javascript
function getUserData(userId) {
    fetch(`https://api.example.com/users/${userId}`)
        .then(response => response.json())
        .then(user => {
            console.log(user);
            return fetch(`https://api.example.com/users/${userId}/posts`);
        })
        .then(response => response.json())
        .then(posts => {
            console.log(posts);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

getUserData(1);
```

#### Con `async` e `await`

```javascript
async function getUserData(userId) {
    try {
        const userResponse = await fetch(`https://api.example.com/users/${userId}`);
        const user = await userResponse.json();
        console.log(user);

        const postsResponse = await fetch(`https://api.example.com/users/${userId}/posts`);
        const posts = await postsResponse.json();
        console.log(posts);
    } catch (error) {
        console.error('Error:', error);
    }
}

getUserData(1);
```

### Conclusione

`async` e `await` migliorano la leggibilità del codice asincrono in JavaScript, rendendolo più lineare e simile al codice sincrono. La gestione degli errori diventa più semplice e intuitiva, e il codice meno nidificato risulta più facile da mantenere.