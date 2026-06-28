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


User
 ├── UserInfo
 ├── Addresses
 ├── Emails
 ├── Phones
 ├── Roles
 ├── Companies
 └── CustomerProfiles

CustomerProfile
 ├── User
 ├── Company (optional)
 └── Segments (N:N)

Segment
 └── CustomerProfiles (N:N)

Con questo io considererei il dominio Customer chiuso per la V1.

Le evoluzioni future (punti, loyalty, sconti, CRM, marketing, customer tiers, ecc.) potranno agganciarsi a:

CustomerProfile