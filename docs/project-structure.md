# Project Structure

## Introduction

EasyShop follows a Technical Layered Architecture organized by business domains and subdomains.

The project structure is designed to keep technical responsibilities separated while maintaining a clear relationship with business capabilities.

Instead of grouping files only by feature, the application is organized by technical layer first and domain context second.

---

# Application Structure

The main application structure follows this organization:

```text
app/

├── Actions/
├── DTOs/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
├── Models/
├── Queries/
├── Rules/
├── Services/
└── ViewModels/
```

Each technical area contains its own domain organization.

---

# Technical Layers Organization

## Controllers

Controllers are organized by business domain.

Example:

```text
Controllers/

├── Customer
│   ├── CustomerProfileController.php
│   └── DashboardController.php
│
├── Catalog
│
├── Inventory
│
├── Cart
│
└── Orders
```

Controllers are responsible only for handling HTTP communication and triggering application actions.

---

# Actions

Actions represent application use cases.

Structure example:

```text
Actions/

├── Customer
│   ├── CreateCustomerProfile.php
│   └── UpdateCustomerProfile.php
│
├── Catalog
│
├── Orders
```

Actions coordinate application workflows and are called by controllers.

---

# Rules

Rules contain domain business rules and constraints.

Example:

```text
Rules/

├── Customer
│
├── Orders
│
└── Catalog
```

Rules are responsible for reusable business decisions and domain validations.

---

# Services

Services contain technical services and application integrations.

Example:

```text
Services/

├── Customer
│
├── Mail
│
├── Notification
│
└── External
```

Services handle technical operations and infrastructure communication.

Examples:

- Email sending
- External APIs
- File handling
- Notifications

---

# Queries

Queries are responsible for read operations.

Example:

```text
Queries/

├── Customer
│   ├── Profile
│   └── Dashboard
│
├── Catalog
│
└── Orders
```

Queries isolate data retrieval logic from controllers and actions.

---

# DTOs

DTOs define structured data transfer between application layers.

Example:

```text
DTOs/

├── Customer
│
├── Catalog
│
└── Orders
```

DTOs create clear contracts between different parts of the application.

---

# ViewModels

ViewModels prepare data for presentation.

Example:

```text
ViewModels/

├── Customer
│   ├── Dashboard
│   └── Profile
│
├── Catalog
│
└── Orders
```

ViewModels keep presentation logic separated from business logic.

---

# Models

Models represent the persistence layer.

Example:

```text
Models/

├── Identity
│
├── Customer
│
├── Catalog
│
├── Inventory
│
├── Cart
│
└── Orders
```

Models contain:

- Database relationships
- Entity representation
- Persistence logic

---

# Current Business Domains

The current implemented domains are:

## Identity

Responsible for:

- Users
- Roles
- Authentication foundation

---

## Customer

Responsible for:

- Customer profiles
- Personal information
- Addresses
- Customer relationships

---

## Catalog

Responsible for:

- Products
- Product variants
- Brands
- Categories
- Product media

---

## Inventory

Responsible for:

- Stock management
- Inventory entities

---

## Cart

Responsible for:

- Shopping cart management
- Cart items

---

## Orders

Responsible for:

- Order foundation
- Order entities

---

# Example Feature Flow

A typical customer profile creation flow:

```text
Request

↓

Customer Controller

↓

CreateCustomerProfile Action

↓

Customer Rules

↓

Customer Services

↓

Customer Query / Models

↓

DTO

↓

ViewModel

↓

Response
```

The flow keeps responsibilities separated while allowing each domain to evolve independently.

---

# Design Principles

The project structure follows these principles:

## Separation of Concerns

Each technical layer has a dedicated responsibility.

## Domain Isolation

Business domains remain independent and organized.

## Scalability

New domains can be added without restructuring existing code.

## Maintainability

Developers can quickly locate and modify features.

## Consistency

All domains follow the same organizational pattern.

---

# Future Structure Evolution

As new ecommerce capabilities are introduced, new domains will follow the same pattern.

Possible future domains:

- Payments
- Shipping
- Seller Management
- Promotions
- Reviews
- Search
- Notifications
