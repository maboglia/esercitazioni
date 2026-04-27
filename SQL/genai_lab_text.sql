-- ============================================================

-- CORSO: Intelligenza Artificiale Generativa

-- ESERCITAZIONE SQL COMPLETA (SQLite)

-- Contenuti:

--  - Creazione schema relazionale (>= 3 tabelle)

--  - Inserimento dati di prova

--  - Trigger

--  - 30 query SQL (SELECT, JOIN, GROUP BY, HAVING, ORDER BY,

--    COUNT, SUM, AVG, SUBQUERY)

-- Database target: SQLite

-- Esecuzione consigliata:

--   sqlite3 genai_lab.db < genai_lab.sql

-- ============================================================

-- ============================================================

-- 1) DROP TABLES (per rerun script)

-- ============================================================

-- ============================================================

-- 2) CREAZIONE TABELLE

-- ============================================================

-- Utenti della piattaforma GenAI

-- Modelli GenAI disponibili (LLM)

-- Prompt repository (prompt engineering)

-- Conversazioni (sessioni chat)

-- Log utilizzo: ogni prompt eseguito produce un usage log

-- ============================================================

-- 3) TRIGGER

-- ============================================================

-- Trigger 1: calcola total_tokens automaticamente (input+output)

-- Trigger 2: blocca usage log con input_tokens troppo basso (esempio didattico)

-- Regola: input_tokens deve essere >= 5 (per evitare log "vuoti")

-- ============================================================

-- 4) DATI DI PROVA

-- ============================================================

-- USERS

-- MODELS

-- PROMPTS

-- CONVERSATIONS

-- USAGE_LOGS

-- NOTA: total_tokens viene calcolato dal trigger.

-- ============================================================

-- 5) QUERY SQL (30 ESERCIZI)

-- ============================================================

-- ============================================================

-- LIVELLO 1 - SELECT BASE (1-6)

-- ============================================================

-- Q1) Elenca tutti gli utenti (username e ruolo)

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q2) Elenca tutti i modelli ordinati per costo crescente

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q3) Mostra i prompt con difficulty >= 3

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q4) Elenca le conversazioni con topic contenente la parola "cyber"

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q5) Conta quanti prompt esistono nel repository

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q6) Calcola la media difficulty dei prompt

-- RISPOSTA:

-- ------------------------------------------------------------

-- ============================================================

-- LIVELLO 2 - JOIN BASE (7-12)

-- ============================================================

-- Q7) Elenca le conversazioni con username e modello usato

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q8) Elenca tutti i prompt con autore (created_by)

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q9) Mostra i usage_logs con topic conversazione e titolo prompt

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q10) Mostra i log di utilizzo solo per il modello "gpt-4o-mini"

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q11) Mostra tutti gli studenti che hanno almeno una conversazione

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q12) Mostra tutte le conversazioni fatte da "alice"

-- RISPOSTA:

-- ------------------------------------------------------------

-- ============================================================

-- LIVELLO 3 - GROUP BY + COUNT/SUM/AVG (13-18)

-- ============================================================

-- Q13) Numero di conversazioni per utente

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q14) Numero di usage logs per modello

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q15) Totale token consumati per utente (SUM total_tokens)

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q16) Token medi per log (AVG total_tokens) per modello

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q17) Qualità media risposta per categoria prompt

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q18) Numero di prompt per categoria

-- RISPOSTA:

-- ------------------------------------------------------------

-- ============================================================

-- LIVELLO 4 - HAVING + ORDER BY (19-22)

-- ============================================================

-- Q19) Mostra solo categorie con almeno 2 prompt

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q20) Utenti che hanno consumato più di 600 token totali

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q21) Modelli con costo maggiore di 1.00 e token medi per log > 400

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q22) Studenti che hanno almeno 2 conversazioni

-- RISPOSTA:

-- ------------------------------------------------------------

-- ============================================================

-- LIVELLO 5 - SUBQUERY (23-27)

-- ============================================================

-- Q23) Mostra gli utenti che hanno un consumo token sopra la media generale

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q24) Mostra il prompt più usato (più presente nei usage_logs)

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q25) Mostra la conversazione con più token totali consumati

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q26) Elenca i prompt con difficulty sopra la media difficulty

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q27) Mostra i modelli che sono stati usati almeno una volta

-- RISPOSTA:

-- ------------------------------------------------------------

-- ============================================================

-- LIVELLO 6 - QUERY AVANZATE + ANALISI (28-30)

-- ============================================================

-- Q28) Per ogni utente mostra:

-- - numero log

-- - token totali

-- - qualità media

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q29) Individua la categoria più costosa in termini di token medi consumati

-- RISPOSTA:

-- ------------------------------------------------------------

-- Q30) Mostra il modello con miglior rapporto qualità/token

-- (qualità media divisa token medio)

-- RISPOSTA:

-- ------------------------------------------------------------

-- ============================================================

-- FINE ESERCITAZIONE

-- ============================================================

-- Suggerimento didattico:

-- Provare a inserire un nuovo usage_log con input_tokens < 5

-- per verificare il trigger di validazione:

-- INSERT INTO usage_logs(conversation_id, prompt_id, input_tokens, output_tokens, response_quality)

-- VALUES (1, 1, 2, 50, 3);

-- Deve fallire con errore: input_tokens troppo basso: minimo 5

-- Provare invece con input_tokens >= 5 e vedere total_tokens calcolato.
