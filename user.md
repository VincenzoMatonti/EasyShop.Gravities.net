# Identity Domain

## Purpose
Gestisce autenticazione, autorizzazione e ruoli globali.

---

## Entities
- User
- Role

---

## Relations
- User N-N Role (user_role pivot)

---

## Core Concept
User rappresenta l’identità tecnica del sistema.

---

## Common Usage

### Get user roles
$user->roles

### Check permission via role
$user->roles->contains('admin')