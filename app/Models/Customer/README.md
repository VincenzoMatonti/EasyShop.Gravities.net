# Customer Domain

## Scopo

Il Customer Domain rappresenta il soggetto che acquista all'interno della piattaforma.

Un CustomerProfile può essere:

* personale
* aziendale

L'utente autenticato (User) non acquista direttamente.

L'acquisto avviene sempre tramite un CustomerProfile.

---

# Entità

## UserInfo

Contiene i dati anagrafici dell'utente.

Relazione:

```text
User -> 1-1 UserInfo
```

---

## CustomerProfile

Rappresenta il soggetto che acquista.

Può essere:

```text
Personal
Business
```

Relazioni:

```text
CustomerProfile -> N-N User
CustomerProfile -> 0-1 Company
CustomerProfile -> N-N CustomerSegment
```

---

## Company

Rappresenta l'organizzazione aziendale.

Non acquista direttamente.

Viene utilizzata come contesto del CustomerProfile.

Relazioni:

```text
Company -> 1-N CustomerProfile
```

---

## CustomerSegment

Permette la classificazione commerciale dei CustomerProfile.

Esempi:

```text
VIP
Wholesale
Retail
Gold
Silver
Distributor
```

Relazioni:

```text
CustomerSegment -> N-N CustomerProfile
```

---

## Address

Entità polimorfica.

Può appartenere a:

```text
User
CustomerProfile
Company
```

Relazione:

```text
Address -> N-1 Owner
```

---

## Phone

Entità polimorfica.

Può appartenere a:

```text
User
CustomerProfile
Company
```

Relazione:

```text
Phone -> N-1 Owner
```

---

## Email

Entità polimorfica.

Può appartenere a:

```text
User
CustomerProfile
Company
```

Relazione:

```text
Email -> N-1 Owner
```

---

# Schema Concettuale

```text
User
 │
 ├── UserInfo
 │
 ├── Emails
 ├── Phones
 ├── Addresses
 │
 └── CustomerProfiles
       │
       ├── Company (optional)
       │
       ├── Emails
       ├── Phones
       ├── Addresses
       │
       └── CustomerSegments
```

---

# Principio Fondamentale

User identifica chi utilizza la piattaforma.

CustomerProfile identifica per conto di chi viene effettuato l'acquisto.

Company rappresenta il contesto aziendale del CustomerProfile.

Tutte le funzionalità commerciali future dovranno agganciarsi al CustomerProfile.
