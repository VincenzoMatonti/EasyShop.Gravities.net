# Identity Domain - Common Usage

# Recuperare un Utente

```php
$user = User::find(1);
```

---

# Scope

## Utenti attivi

```php
User::active()->get();
```

Equivalente:

```php
User::where('is_deleted', false)->get();
```

---

# UserInfo

## Recuperare dati anagrafici

```php
$user->userInfo;
```

---

## Creare UserInfo

```php
$user->userInfo()->create([
    'name' => 'Mario',
    'surname' => 'Rossi'
]);
```

---

# Roles

## Recuperare tutti i ruoli

```php
$user->roles;
```

---

## Assegnare un ruolo

```php
$user->roles()->attach($roleId);
```

---

## Rimuovere un ruolo

```php
$user->roles()->detach($roleId);
```

---

## Sincronizzare ruoli

```php
$user->roles()->sync([
    1,
    2
]);
```

---

## Ottenere lista nomi ruoli

```php
$user->getRoles();
```

Risultato:

```php
[
    'admin',
    'customer'
]
```

---

# Verifiche Ruolo

## Admin

```php
$user->isAdmin();
```

---

## Manager

```php
$user->isManager();
```

---

## Customer

```php
$user->isCustomer();
```

---

## Verifica multipla

```php
$user->hasAnyRole([
    'admin',
    'manager'
]);
```

---

# Customer Profiles

## Recuperare tutti i profili

```php
$user->customerProfiles;
```

---

## Recuperare profilo predefinito

```php
$user->defaultCustomerProfile()->first();
```

---

## Collegare un profilo

```php
$user->customerProfiles()->attach(
    $customerProfileId,
    [
        'role' => RoleCustomerProfile::owner,
        'is_default' => true
    ]
);
```

---

## Scollegare un profilo

```php
$user->customerProfiles()->detach(
    $customerProfileId
);
```

---

## Recuperare ruolo nel profilo

```php
$user->customerProfiles
     ->first()
     ->pivot
     ->role;
```

Risultato:

```php
RoleCustomerProfile::owner
```

oppure

```php
RoleCustomerProfile::buyer
```

oppure

```php
RoleCustomerProfile::accountant
```

---

# Emails

## Recuperare email

```php
$user->emails;
```

---

## Creare email

```php
$user->emails()->create([
    'label' => LabelEmail::Personal,
    'email' => 'mario@example.com'
]);
```

---

# Phones

## Recuperare telefoni

```php
$user->phones;
```

---

## Creare telefono

```php
$user->phones()->create([
    'label' => LabelPhone::Mobile,
    'prefix' => '+39',
    'number' => '3331234567'
]);
```

---

# Addresses

## Recuperare indirizzi

```php
$user->addresses;
```

---

## Creare indirizzo

```php
$user->addresses()->create([
    'label' => LabelAddress::Home,
    'street' => 'Via Roma',
    'number' => '10',
    'zip_code' => '20100',
    'city' => 'Milano',
    'province' => 'MI',
    'country' => 'Italia'
]);
```

---

# Proprietario dei Contatti

Grazie alle relazioni polimorfiche:

```php
$email->emailable;
```

```php
$phone->phoneable;
```

```php
$address->addressable;
```

Laravel restituirà automaticamente il proprietario corretto.

Possibili risultati:

```php
User
```

```php
CustomerProfile
```

```php
Company
```

---

# Eager Loading Consigliato

Per evitare query N+1:

```php
User::with([
    'userInfo',
    'roles',
    'customerProfiles'
])->get();
```

---

# Pattern Consigliato

Controller
↓

Action
↓

Domain Service
↓

DTO
↓

Model

I controller non dovrebbero contenere logica di business.
La logica applicativa dovrebbe essere delegata ad Action e Domain Service.
