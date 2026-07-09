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

login.store

---

## 2. Autenticazione personalizzata

Fortify utilizza:

App\Actions\Fortify\AuthenticateUser

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

----------------------------------------------------------------------------------------------------------------------------

🔀 REDIRECT POST LOGIN

Fortify utilizza:

App\Http\Responses\LoginResponse

che implementa:

Laravel\Fortify\Contracts\LoginResponse

Dopo il login:

$request->user()->homeRoute()

determina la destinazione.

🏠 User homeRoute()

Il modello:

App\Models\Identity\User

contiene:

public function homeRoute(): string

che utilizza il ruolo dell'utente.

Esempio:

ADMIN
 |
 v
admin.index


MANAGER
 |
 v
manager.index


CUSTOMER
 |
 v
customer.index

Fallback:

home.index
👤 Registrazione utenti

Fortify utilizza:

App\Actions\Fortify\CreateNewUser

Durante la registrazione:

POST /register

viene creato:

User
 |
 + email
 + password

e automaticamente assegnato il ruolo:

CUSTOMER

tramite:

roles()

relazione many-to-many.

🛡️ ROLE SYSTEM

I ruoli sono gestiti tramite Enum:

App\Enum\Identity\IdentityRole

Esempio:

IdentityRole::ADMIN
IdentityRole::MANAGER
IdentityRole::CUSTOMER
🔐 Middleware autorizzazioni

Le rotte protette utilizzano:

auth
+
role

Esempio:

Route::middleware([
    'auth',
    'role:' . IdentityRole::ADMIN->value
])
->group(function () {

    Route::get('/admin',
        AdminController::class
    );

});
RoleMiddleware

Classe:

App\Http\Middleware\RoleMiddleware

Controlla se l'utente autenticato possiede il ruolo richiesto.

Flusso:

Request
 |
 v
Auth Middleware
 |
 v
RoleMiddleware
 |
 +--> ruolo corretto
 |        |
 |        v
 |      Controller
 |
 |
 +--> ruolo errato
          |
          v
       redirect homeRoute()
🧩 Model User

Il modello:

App\Models\Identity\User

gestisce:

Ruoli
roles()

Relazione:

users
 |
 |
 user_role
 |
 |
 roles
Helper ruoli

Sono disponibili:

isAdmin()

isManager()

isCustomer()

che utilizzano:

hasRole()
🔄 Flusso completo autenticazione
                LOGIN
                  |
                  v
        AuthenticatedSessionController
                  |
                  v
          AuthenticateUser
                  |
        +---------+---------+
        |                   |
   credenziali OK       credenziali KO
        |                   |
        v                   v
     LoginResponse       Validation Error
        |
        v
     homeRoute()
        |
        +-------------+
        |             |
        v             v
     Dashboard      Redirect
     ruolo          fallback


📌 Stato attuale

Implementato:

✅ Laravel Fortify
✅ Login custom
✅ Register custom
✅ Redirect dinamico per ruolo
✅ Enum Role System
✅ Middleware Role
✅ Soft delete utenti
✅ Customer automatico alla registrazione
