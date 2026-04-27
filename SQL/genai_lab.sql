-- ============================================================
-- CORSO: Intelligenza Artificiale Generativa
-- ESERCITAZIONE SQL COMPLETA (SQLite)
--
-- Contenuti:
--  - Creazione schema relazionale (>= 3 tabelle)
--  - Inserimento dati di prova
--  - Trigger
--  - 30 query SQL (SELECT, JOIN, GROUP BY, HAVING, ORDER BY,
--    COUNT, SUM, AVG, SUBQUERY)
--
-- Database target: SQLite
-- Esecuzione consigliata:
--   sqlite3 genai_lab.db < genai_lab.sql
-- ============================================================

PRAGMA foreign_keys = ON;

-- ============================================================
-- 1) DROP TABLES (per rerun script)
-- ============================================================

DROP TABLE IF EXISTS usage_logs;
DROP TABLE IF EXISTS conversations;
DROP TABLE IF EXISTS prompts;
DROP TABLE IF EXISTS models;
DROP TABLE IF EXISTS users;

-- ============================================================
-- 2) CREAZIONE TABELLE
-- ============================================================

-- Utenti della piattaforma GenAI
CREATE TABLE users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    role TEXT NOT NULL CHECK(role IN ('student','teacher','admin')),
    created_at TEXT NOT NULL DEFAULT (datetime('now'))
);

-- Modelli GenAI disponibili (LLM)
CREATE TABLE models (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    model_name TEXT NOT NULL UNIQUE,
    provider TEXT NOT NULL,
    max_tokens INTEGER NOT NULL CHECK(max_tokens > 0),
    cost_per_1k_tokens REAL NOT NULL CHECK(cost_per_1k_tokens >= 0)
);

-- Prompt repository (prompt engineering)
CREATE TABLE prompts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    title TEXT NOT NULL,
    category TEXT NOT NULL,
    prompt_text TEXT NOT NULL,
    difficulty INTEGER NOT NULL CHECK(difficulty BETWEEN 1 AND 5),
    created_by INTEGER NOT NULL,
    created_at TEXT NOT NULL DEFAULT (datetime('now')),

    FOREIGN KEY(created_by) REFERENCES users(id)
        ON DELETE CASCADE
);

-- Conversazioni (sessioni chat)
CREATE TABLE conversations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user_id INTEGER NOT NULL,
    model_id INTEGER NOT NULL,
    topic TEXT NOT NULL,
    started_at TEXT NOT NULL DEFAULT (datetime('now')),

    FOREIGN KEY(user_id) REFERENCES users(id)
        ON DELETE CASCADE,

    FOREIGN KEY(model_id) REFERENCES models(id)
        ON DELETE CASCADE
);

-- Log utilizzo: ogni prompt eseguito produce un usage log
CREATE TABLE usage_logs (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    conversation_id INTEGER NOT NULL,
    prompt_id INTEGER NOT NULL,

    input_tokens INTEGER NOT NULL CHECK(input_tokens >= 0),
    output_tokens INTEGER NOT NULL CHECK(output_tokens >= 0),
    total_tokens INTEGER NOT NULL DEFAULT 0,

    response_quality INTEGER NOT NULL CHECK(response_quality BETWEEN 1 AND 5),
    created_at TEXT NOT NULL DEFAULT (datetime('now')),

    FOREIGN KEY(conversation_id) REFERENCES conversations(id)
        ON DELETE CASCADE,

    FOREIGN KEY(prompt_id) REFERENCES prompts(id)
        ON DELETE CASCADE
);

-- ============================================================
-- 3) TRIGGER
-- ============================================================

-- Trigger 1: calcola total_tokens automaticamente (input+output)
DROP TRIGGER IF EXISTS trg_calc_total_tokens;

CREATE TRIGGER trg_calc_total_tokens
AFTER INSERT ON usage_logs
BEGIN
    UPDATE usage_logs
    SET total_tokens = NEW.input_tokens + NEW.output_tokens
    WHERE id = NEW.id;
END;

-- Trigger 2: blocca usage log con input_tokens troppo basso (esempio didattico)
-- Regola: input_tokens deve essere >= 5 (per evitare log "vuoti")
DROP TRIGGER IF EXISTS trg_validate_input_tokens;

CREATE TRIGGER trg_validate_input_tokens
BEFORE INSERT ON usage_logs
WHEN NEW.input_tokens < 5
BEGIN
    SELECT RAISE(ABORT, 'input_tokens troppo basso: minimo 5');
END;

-- ============================================================
-- 4) DATI DI PROVA
-- ============================================================

-- USERS
INSERT INTO users(username, role) VALUES
('alice', 'student'),
('marco', 'student'),
('sara', 'student'),
('giulia', 'student'),
('prof_rossi', 'teacher'),
('admin', 'admin');

-- MODELS
INSERT INTO models(model_name, provider, max_tokens, cost_per_1k_tokens) VALUES
('gpt-4o-mini', 'OpenAI', 128000, 0.15),
('gpt-4o', 'OpenAI', 128000, 2.50),
('claude-3.5-sonnet', 'Anthropic', 200000, 3.00),
('llama3-70b', 'Meta', 8192, 0.40);

-- PROMPTS
INSERT INTO prompts(title, category, prompt_text, difficulty, created_by) VALUES
('Riassunto articolo', 'Summarization', 'Riassumi il seguente testo in 5 righe...', 1, 5),
('Classificazione email phishing', 'Cybersecurity', 'Classifica questa email: phishing o legittima...', 2, 5),
('Generazione codice Python', 'Coding', 'Scrivi uno script Python che legge un CSV...', 2, 5),
('Prompt chain-of-thought', 'Reasoning', 'Risolvi passo passo questo problema...', 4, 5),
('Creazione quiz cyber', 'Education', 'Genera 10 domande su SQL injection...', 3, 5),
('Traduzione tecnica', 'Translation', 'Traduci questo testo in inglese tecnico...', 1, 5),
('Analisi log SOC', 'Cybersecurity', 'Analizza questi log e individua anomalie...', 5, 5);

-- CONVERSATIONS
INSERT INTO conversations(user_id, model_id, topic, started_at) VALUES
(1, 1, 'Riassunto AI Ethics', '2026-03-01 09:10:00'),
(2, 1, 'Prompting per cybersecurity', '2026-03-02 11:00:00'),
(3, 2, 'Generazione codice Python', '2026-03-03 15:30:00'),
(4, 3, 'Traduzione manuale tecnico', '2026-03-04 10:00:00'),
(1, 2, 'Analisi log SOC', '2026-03-05 17:20:00'),
(2, 4, 'Esperimenti con Llama', '2026-03-06 09:00:00'),
(3, 1, 'Quiz cyber automatico', '2026-03-07 13:40:00');

-- USAGE_LOGS
-- NOTA: total_tokens viene calcolato dal trigger.
INSERT INTO usage_logs(conversation_id, prompt_id, input_tokens, output_tokens, response_quality, created_at) VALUES
(1, 1, 220, 120, 4, '2026-03-01 09:11:10'),
(1, 6, 150, 90, 5, '2026-03-01 09:20:00'),
(2, 2, 300, 140, 3, '2026-03-02 11:05:10'),
(2, 7, 420, 210, 4, '2026-03-02 11:25:10'),
(3, 3, 180, 220, 5, '2026-03-03 15:31:00'),
(3, 4, 350, 310, 4, '2026-03-03 15:55:00'),
(4, 6, 120, 80, 4, '2026-03-04 10:10:00'),
(5, 7, 500, 250, 5, '2026-03-05 17:22:00'),
(6, 3, 210, 190, 3, '2026-03-06 09:10:00'),
(6, 4, 260, 230, 4, '2026-03-06 09:25:00'),
(7, 5, 320, 170, 4, '2026-03-07 13:41:00'),
(7, 2, 280, 120, 3, '2026-03-07 13:50:00');

-- ============================================================
-- 5) QUERY SQL (30 ESERCIZI)
-- ============================================================

-- ============================================================
-- LIVELLO 1 - SELECT BASE (1-6)
-- ============================================================

-- Q1) Elenca tutti gli utenti (username e ruolo)
SELECT username, role
FROM users;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q2) Elenca tutti i modelli ordinati per costo crescente
SELECT model_name, provider, cost_per_1k_tokens
FROM models
ORDER BY cost_per_1k_tokens ASC;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q3) Mostra i prompt con difficulty >= 3
SELECT id, title, category, difficulty
FROM prompts
WHERE difficulty >= 3;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q4) Elenca le conversazioni con topic contenente la parola "cyber"
SELECT *
FROM conversations
WHERE topic LIKE '%cyber%';

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q5) Conta quanti prompt esistono nel repository
SELECT COUNT(*) AS total_prompts
FROM prompts;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q6) Calcola la media difficulty dei prompt
SELECT ROUND(AVG(difficulty), 2) AS avg_difficulty
FROM prompts;

-- RISPOSTA:
-- ------------------------------------------------------------



-- ============================================================
-- LIVELLO 2 - JOIN BASE (7-12)
-- ============================================================

-- Q7) Elenca le conversazioni con username e modello usato
SELECT c.id AS conversation_id, u.username, m.model_name, c.topic, c.started_at
FROM conversations c
JOIN users u ON c.user_id = u.id
JOIN models m ON c.model_id = m.id
ORDER BY c.started_at;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q8) Elenca tutti i prompt con autore (created_by)
SELECT p.id, p.title, p.category, u.username AS created_by
FROM prompts p
JOIN users u ON p.created_by = u.id;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q9) Mostra i usage_logs con topic conversazione e titolo prompt
SELECT ul.id, c.topic, p.title, ul.input_tokens, ul.output_tokens, ul.total_tokens
FROM usage_logs ul
JOIN conversations c ON ul.conversation_id = c.id
JOIN prompts p ON ul.prompt_id = p.id
ORDER BY ul.id;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q10) Mostra i log di utilizzo solo per il modello "gpt-4o-mini"
SELECT ul.id, m.model_name, ul.total_tokens, ul.response_quality
FROM usage_logs ul
JOIN conversations c ON ul.conversation_id = c.id
JOIN models m ON c.model_id = m.id
WHERE m.model_name = 'gpt-4o-mini';

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q11) Mostra tutti gli studenti che hanno almeno una conversazione
SELECT DISTINCT u.username
FROM users u
JOIN conversations c ON c.user_id = u.id
WHERE u.role = 'student';

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q12) Mostra tutte le conversazioni fatte da "alice"
SELECT c.id, u.username, c.topic, c.started_at
FROM conversations c
JOIN users u ON c.user_id = u.id
WHERE u.username = 'alice';

-- RISPOSTA:
-- ------------------------------------------------------------



-- ============================================================
-- LIVELLO 3 - GROUP BY + COUNT/SUM/AVG (13-18)
-- ============================================================

-- Q13) Numero di conversazioni per utente
SELECT u.username, COUNT(c.id) AS total_conversations
FROM users u
LEFT JOIN conversations c ON c.user_id = u.id
GROUP BY u.username
ORDER BY total_conversations DESC;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q14) Numero di usage logs per modello
SELECT m.model_name, COUNT(ul.id) AS total_logs
FROM models m
LEFT JOIN conversations c ON c.model_id = m.id
LEFT JOIN usage_logs ul ON ul.conversation_id = c.id
GROUP BY m.model_name
ORDER BY total_logs DESC;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q15) Totale token consumati per utente (SUM total_tokens)
SELECT u.username, SUM(ul.total_tokens) AS total_tokens_used
FROM users u
JOIN conversations c ON c.user_id = u.id
JOIN usage_logs ul ON ul.conversation_id = c.id
GROUP BY u.username
ORDER BY total_tokens_used DESC;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q16) Token medi per log (AVG total_tokens) per modello
SELECT m.model_name, ROUND(AVG(ul.total_tokens), 2) AS avg_tokens_per_log
FROM models m
JOIN conversations c ON c.model_id = m.id
JOIN usage_logs ul ON ul.conversation_id = c.id
GROUP BY m.model_name
ORDER BY avg_tokens_per_log DESC;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q17) Qualità media risposta per categoria prompt
SELECT p.category, ROUND(AVG(ul.response_quality), 2) AS avg_quality
FROM usage_logs ul
JOIN prompts p ON ul.prompt_id = p.id
GROUP BY p.category
ORDER BY avg_quality DESC;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q18) Numero di prompt per categoria
SELECT category, COUNT(*) AS total_prompts
FROM prompts
GROUP BY category
ORDER BY total_prompts DESC;

-- RISPOSTA:
-- ------------------------------------------------------------



-- ============================================================
-- LIVELLO 4 - HAVING + ORDER BY (19-22)
-- ============================================================

-- Q19) Mostra solo categorie con almeno 2 prompt
SELECT category, COUNT(*) AS total_prompts
FROM prompts
GROUP BY category
HAVING COUNT(*) >= 2
ORDER BY total_prompts DESC;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q20) Utenti che hanno consumato più di 600 token totali
SELECT u.username, SUM(ul.total_tokens) AS total_tokens_used
FROM users u
JOIN conversations c ON c.user_id = u.id
JOIN usage_logs ul ON ul.conversation_id = c.id
GROUP BY u.username
HAVING SUM(ul.total_tokens) > 600
ORDER BY total_tokens_used DESC;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q21) Modelli con costo maggiore di 1.00 e token medi per log > 400
SELECT m.model_name,
       m.cost_per_1k_tokens,
       ROUND(AVG(ul.total_tokens), 2) AS avg_tokens
FROM models m
JOIN conversations c ON c.model_id = m.id
JOIN usage_logs ul ON ul.conversation_id = c.id
GROUP BY m.model_name, m.cost_per_1k_tokens
HAVING m.cost_per_1k_tokens > 1.00
   AND AVG(ul.total_tokens) > 400;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q22) Studenti che hanno almeno 2 conversazioni
SELECT u.username, COUNT(c.id) AS total_conversations
FROM users u
JOIN conversations c ON c.user_id = u.id
WHERE u.role = 'student'
GROUP BY u.username
HAVING COUNT(c.id) >= 2;

-- RISPOSTA:
-- ------------------------------------------------------------



-- ============================================================
-- LIVELLO 5 - SUBQUERY (23-27)
-- ============================================================

-- Q23) Mostra gli utenti che hanno un consumo token sopra la media generale
SELECT u.username, SUM(ul.total_tokens) AS total_tokens_used
FROM users u
JOIN conversations c ON c.user_id = u.id
JOIN usage_logs ul ON ul.conversation_id = c.id
GROUP BY u.username
HAVING SUM(ul.total_tokens) > (
    SELECT AVG(total_tokens)
    FROM usage_logs
);

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q24) Mostra il prompt più usato (più presente nei usage_logs)
SELECT p.id, p.title, COUNT(*) AS usage_count
FROM usage_logs ul
JOIN prompts p ON ul.prompt_id = p.id
GROUP BY p.id, p.title
ORDER BY usage_count DESC
LIMIT 1;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q25) Mostra la conversazione con più token totali consumati
SELECT c.id, c.topic, SUM(ul.total_tokens) AS total_tokens
FROM conversations c
JOIN usage_logs ul ON ul.conversation_id = c.id
GROUP BY c.id, c.topic
ORDER BY total_tokens DESC
LIMIT 1;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q26) Elenca i prompt con difficulty sopra la media difficulty
SELECT id, title, difficulty
FROM prompts
WHERE difficulty > (SELECT AVG(difficulty) FROM prompts)
ORDER BY difficulty DESC;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q27) Mostra i modelli che sono stati usati almeno una volta
SELECT model_name
FROM models
WHERE id IN (SELECT DISTINCT model_id FROM conversations);

-- RISPOSTA:
-- ------------------------------------------------------------



-- ============================================================
-- LIVELLO 6 - QUERY AVANZATE + ANALISI (28-30)
-- ============================================================

-- Q28) Per ogni utente mostra:
-- - numero log
-- - token totali
-- - qualità media
SELECT u.username,
       COUNT(ul.id) AS logs_count,
       SUM(ul.total_tokens) AS total_tokens_used,
       ROUND(AVG(ul.response_quality), 2) AS avg_quality
FROM users u
JOIN conversations c ON c.user_id = u.id
JOIN usage_logs ul ON ul.conversation_id = c.id
GROUP BY u.username
ORDER BY total_tokens_used DESC;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q29) Individua la categoria più costosa in termini di token medi consumati
SELECT p.category,
       ROUND(AVG(ul.total_tokens), 2) AS avg_tokens
FROM usage_logs ul
JOIN prompts p ON ul.prompt_id = p.id
GROUP BY p.category
ORDER BY avg_tokens DESC
LIMIT 1;

-- RISPOSTA:
-- ------------------------------------------------------------


-- Q30) Mostra il modello con miglior rapporto qualità/token
-- (qualità media divisa token medio)
SELECT m.model_name,
       ROUND(AVG(ul.response_quality), 2) AS avg_quality,
       ROUND(AVG(ul.total_tokens), 2) AS avg_tokens,
       ROUND(AVG(ul.response_quality) / AVG(ul.total_tokens), 5) AS quality_per_token
FROM models m
JOIN conversations c ON c.model_id = m.id
JOIN usage_logs ul ON ul.conversation_id = c.id
GROUP BY m.model_name
ORDER BY quality_per_token DESC;

-- RISPOSTA:
-- ------------------------------------------------------------


-- ============================================================
-- FINE ESERCITAZIONE
-- ============================================================

-- Suggerimento didattico:
-- Provare a inserire un nuovo usage_log con input_tokens < 5
-- per verificare il trigger di validazione:
--
-- INSERT INTO usage_logs(conversation_id, prompt_id, input_tokens, output_tokens, response_quality)
-- VALUES (1, 1, 2, 50, 3);
--
-- Deve fallire con errore: input_tokens troppo basso: minimo 5
--
-- Provare invece con input_tokens >= 5 e vedere total_tokens calcolato.
