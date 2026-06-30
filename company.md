# Company Domain

## Purpose
Gestisce struttura aziendale B2B.

---

## Entities
- Company
- CompanyLocation

---

## Relations
- Company 1-N CompanyLocation
- Company 1-N CustomerProfile

---

## Core Concept
Company è entità organizzativa, non operativa.

---

## Common Usage

### Get company profiles
$company->customerProfiles

### Get company locations
$company->locations

### Get company users
$company->customerProfiles->map(fn($p) => $p->users)