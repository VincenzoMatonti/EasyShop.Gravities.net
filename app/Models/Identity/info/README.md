# Identity Domain

## Scopo

L'Identity Domain gestisce:

* autenticazione
* autorizzazione
* identità dell'utente
* accesso alla piattaforma

Questo dominio NON contiene logiche commerciali.

Ordini, carrelli, aziende, clienti e acquisti appartengono ai rispettivi domini.

---

# Entità

## User

Rappresenta una persona che può accedere alla piattaforma.

L'utente:

* effettua il login
* possiede credenziali
* può avere uno o più ruoli
* può operare tramite uno o più CustomerProfile

L'utente NON acquista direttamente.

Gli acquisti vengono sempre effettuati tramite un CustomerProfile.

---

## Role

Rappresenta un ruolo applicativo.

Esempi:

```text
admin
manager
customer
```

I ruoli definiscono i permessi e le aree accessibili della piattaforma.

---

# Relazioni

## User

```text
User
 ├── UserInfo (1:1)
 ├── Roles (N:N)
 ├── CustomerProfiles (N:N)
 ├── Emails (Polymorphic)
 ├── Phones (Polymorphic)
 └── Addresses (Polymorphic)
```

---

## Role

```text
Role
 └── Users (N:N)
```

---

# Schema Concettuale

```text
User
 │
 ├── UserInfo
 │
 ├── Roles
 │
 ├── CustomerProfiles
 │
 ├── Emails
 ├── Phones
 └── Addresses
```

---

# Soft Delete Logico

Gli utenti non vengono eliminati fisicamente.

Viene utilizzato:

```php
is_deleted
```

Valori:

```text
false = utente attivo
true  = utente disabilitato
```

---

# Login Flow

```text
Login
   ↓
Credenziali corrette
   ↓
Controllo is_deleted
   ↓
false → accesso consentito
true  → logout immediato
```

---

# Ruoli Applicativi

## Admin

Accesso completo alla piattaforma.

---

## Manager

Gestione operativa delle funzionalità autorizzate.

---

## Customer

Utente standard che opera tramite uno o più CustomerProfile.

---

# Separazione delle Responsabilità

Identity Domain risponde alla domanda:

"Chi sta usando il sistema?"

Customer Domain risponde alla domanda:

"Per conto di chi sta operando?"

Questa separazione permette di supportare:

* utenti personali
* utenti aziendali
* aziende con più operatori
* profili multipli per lo stesso utente
* organizzazioni condivise
* espansioni future B2B
