# 🧠 Ecommerce Architecture (Clean Version)

---

# 🔐 AUTH FLOW

Attualmente l’app gestisce utenti soft-deleted così:

- `is_deleted = true`
- login tentato → logout immediato
- accesso negato

👉 TODO FUTURO:
- riattivazione account (reactivation flow)
- eventuale restore guidato utente

---

# 🛡️ ROLE MIDDLEWARE (ESEMPI)

```php
Route::middleware(['auth'])->group(function () {

    // SOLO ADMIN
    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', fn () => 'Admin dashboard');
    });

    // ADMIN + MANAGER
    Route::middleware(['role:admin,manager'])->group(function () {
        Route::get('/backoffice', fn () => 'Backoffice area');
    });

    // SOLO CUSTOMER
    Route::middleware(['role:customer'])->group(function () {
        Route::get('/account', fn () => 'User account');
    });

});


User
 ├── UserInfo (0..1)
 ├── Roles (N:N via user_role)
 ├── Companies (N:N via user_company)
 ├── CustomerProfiles (1..N)
 ├── Addresses (0..N)
 ├── Emails (0..N)
 └── Phones (0..N)


 Role
 └── Users (N:N)

 user_role
- user_id
- role_id
- timestamps

✔ Permessi applicativi (admin, manager, customer)

Company
 └── Users (N:N via user_company)

 user_company
- user_id
- company_id
- role (owner | admin | employee)
- timestamps

✔ Multi-azienda per utente o multiutente per azienda

CustomerProfile
- id
- user_id (OBBLIGATORIO)
- company_id (nullable)
- name
- type (personal | business)
- is_default
- is_deleted

Segment
- id
- name

Segment
- id
- name

✔ Classificazione dinamica clienti