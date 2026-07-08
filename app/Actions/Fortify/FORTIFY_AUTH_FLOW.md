# 🧠 Ecommerce Architecture

## Clean Architecture - Authentication Flow

---

# 🔐 AUTH FLOW

L'applicazione utilizza **Laravel Fortify** come sistema di autenticazione.

La gestione dell'autenticazione è stata personalizzata per supportare:

- utenti con ruoli diversi
- redirect dinamici dopo login/register
- gestione utenti soft deleted
- controllo accessi tramite middleware di ruolo

---

# 🚪 LOGIN FLOW

## 1. Richiesta login

L'utente invia il form:

Fortify gestisce automaticamente la rotta:


---

## 2. Autenticazione personalizzata

Fortify utilizza:


Questa classe sostituisce il comportamento standard di autenticazione.

Flusso:

LoginRequest
|
v
AuthenticateUser
|
+--> Cerca User tramite email
|
+--> Verifica password
|
+--> Controlla is_deleted
|
+--> Restituisce User autenticato


---

## 3. Controllo password

La verifica password viene effettuata tramite:

```php
Hash::check()

La password nel database rimane sempre hashata.

4. Gestione utenti eliminati

Gli utenti vengono gestiti tramite soft delete applicativo:

Campo database:

users.is_deleted

Comportamento:

is_deleted = false
        |
        v
Login consentito


is_deleted = true
        |
        v
Login negato

Gli utenti eliminati non possono autenticarsi.

TODO FUTURO

Possibili evoluzioni:

riattivazione account
restore guidato utente
invio email di recupero account
gestione motivazione cancellazione