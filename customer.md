# Customer Domain

## Purpose
Gestisce utenti operativi (buyer), aziende e contatti.

---

## Entities
- UserInfo
- Address
- Phone
- Email
- Company
- CompanyLocation
- CustomerProfile

---

## Relations

### User
- User 1-1 UserInfo
- User N-N CustomerProfile

### CustomerProfile
- CustomerProfile 0-1 Company
- CustomerProfile 1-1 Cart
- CustomerProfile 1-N Orders

### Company
- Company 1-N CompanyLocation
- Company 1-N CustomerProfile

### Polymorphic Contacts
- Address N-1 (User | CompanyLocation | CustomerProfile)
- Phone N-1 (User | CompanyLocation | CustomerProfile)
- Email N-1 (User | CompanyLocation | CustomerProfile)

---

## Core Concept
CustomerProfile è il soggetto operativo che effettua acquisti.

---

## Common Usage

### Get user profiles
$user->customerProfiles

### Get company of profile
$profile->company

### Get company locations
$profile->company->locations

### Get user contact info
$user->addresses / phones / emails