# Customer Domain - Common Usage

## Recuperare UserInfo

```php
$user->userInfo;
```

---

# Customer Profiles

## Tutti i profili dell'utente

```php
$user->customerProfiles;
```

---

## Profilo di default

```php
$user->defaultCustomerProfile()->first();
```

---

## Tutti gli utenti associati ad un profilo

```php
$customerProfile->users;
```

---

## Ruolo dell'utente nel profilo

```php
$user->customerProfiles
     ->first()
     ->pivot
     ->role;
```

---

## Verificare il tipo di profilo

```php
$customerProfile->isPersonal();
```

```php
$customerProfile->isBusiness();
```

---

# Company

## Azienda associata al profilo

```php
$customerProfile->company;
```

---

## Tutti i profili della company

```php
$company->customerProfiles;
```

---

# Customer Segments

## Segmenti assegnati ad un profilo

```php
$customerProfile->segments;
```

---

## Profili appartenenti ad un segmento

```php
$segment->customerProfiles;
```

---

# Emails

## Recuperare email di un User

```php
$user->emails;
```

---

## Recuperare email di un CustomerProfile

```php
$customerProfile->emails;
```

---

## Recuperare email di una Company

```php
$company->emails;
```

---

## Creare una email

```php
$user->emails()->create([
    'label' => LabelEmail::Personal,
    'email' => 'mario@example.com'
]);
```

---

# Phones

## Recuperare telefoni di un User

```php
$user->phones;
```

---

## Recuperare telefoni di un CustomerProfile

```php
$customerProfile->phones;
```

---

## Recuperare telefoni di una Company

```php
$company->phones;
```

---

## Creare un telefono

```php
$user->phones()->create([
    'label' => LabelPhone::Mobile,
    'prefix' => '+39',
    'number' => '3331234567'
]);
```

---

# Addresses

## Recuperare indirizzi di un User

```php
$user->addresses;
```

---

## Recuperare indirizzi di un CustomerProfile

```php
$customerProfile->addresses;
```

---

## Recuperare indirizzi di una Company

```php
$company->addresses;
```

---

## Creare un indirizzo

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

# Scope

## CustomerProfile Business

```php
CustomerProfile::business()->get();
```

---

## CustomerProfile Personal

```php
CustomerProfile::personal()->get();
```

---

## CustomerProfile Eliminati

```php
CustomerProfile::deleted()->get();
```

---

## Address Attivi

```php
Address::active()->get();
```

---

## Phone Attivi

```php
Phone::active()->get();
```

---

## Email Attive

```php
Email::active()->get();
```

---

# Relazioni Polimorfiche

Per capire il proprietario di un contatto:

```php
$email->emailable;
```

```php
$phone->phoneable;
```

```php
$address->addressable;
```

Laravel restituirà automaticamente:

```php
User
```

oppure

```php
CustomerProfile
```

oppure

```php
Company
```

a seconda del proprietario reale del record.
