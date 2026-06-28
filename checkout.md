# 📦 Ecommerce Architecture – Current State (Checkpoint)

## 🧠 STATUS GENERALE
Sistema in fase avanzata di modellazione domain-driven:

- Authentication già gestita con Laravel Fortify
- Soft delete logico (`is_deleted`)
- Role system via pivot table
- Base customer domain modellato
- Struttura pronta per onboarding + checkout evolution

---

# 🔐 AUTH FLOW (ATTUALE)

## Login
- User tenta login
- Fortify intercetta autenticazione
- Custom logic:

```txt
if user.is_deleted = true
→ logout immediato
→ blocco accesso

# ⚠️ Stato attuale
Account cancellato = NON riattivabile automaticamente
Nessun flow di reactivation ancora implementato