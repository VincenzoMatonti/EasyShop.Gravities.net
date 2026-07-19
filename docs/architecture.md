# Architecture Overview

## Introduction

EasyShop is built using a **Technical Layered Architecture** combined with a **Domain-Oriented Organization approach**.

The main goal of this architecture is to maintain a clear separation of technical responsibilities while keeping business domains and subdomains organized, scalable, and easy to maintain.

The project is designed to evolve as a long-term enterprise ecommerce platform, following principles focused on maintainability, scalability, and clean separation of concerns.

---

# Architectural Approach

The application structure follows two main principles:

1. Technical Layer Separation
2. Domain Organization

---

# Technical Layer Separation

The first level of organization is based on technical responsibility.

Each layer has a specific role inside the application lifecycle.

Current technical layers include:

- Controllers
- Requests
- Middleware
- Actions
- Rules
- Services
- Queries
- DTOs
- ViewModels
- Models

Each layer is responsible for a specific type of operation, avoiding excessive coupling between different application responsibilities.

---

# Domain Organization

Inside each technical layer, code is organized by business domains and subdomains.

Example:

```text
Controllers/

├── Customer
├── Catalog
├── Inventory
├── Cart
└── Orders
```

The same organizational principle is applied across the other technical layers.

Example:

```text
Actions/

├── Customer
├── Catalog
├── Orders
```

Example:

```text
Services/

├── Customer
├── Catalog
├── Inventory
```

This approach allows each business domain to grow independently while keeping a consistent project structure.

---

# Application Flow

A typical application request follows this flow:

```text
HTTP Request

↓

Middleware

↓

Request Validation

↓

Controller

↓

Action

↓

Rules / Services / Queries

↓

DTOs

↓

Models

↓

ViewModels

↓

Response
```

Each component has a defined responsibility inside the application workflow.

---

# Layer Responsibilities

## Controllers

Controllers represent the HTTP entry point of the application.

Responsibilities:

- Receive HTTP requests
- Coordinate application actions
- Return responses

Controllers should remain lightweight and should not contain business logic.

---

# Requests

Requests handle incoming data validation and authorization.

Responsibilities:

- Validate user input
- Authorize operations
- Prepare request data

Requests keep validation rules separated from controllers.

---

# Middleware

Middleware handles cross-cutting concerns related to HTTP requests.

Responsibilities:

- Authentication
- Authorization
- Route protection
- Request filtering

Examples:

- Auth middleware
- Role middleware
- Ownership middleware

---

# Actions

Actions represent application use cases.

They are the main application operations executed by controllers.

Responsibilities:

- Execute specific workflows
- Coordinate multiple components
- Represent business operations from an application perspective

Examples:

- CreateCustomerProfile
- UpdateCustomerAddress
- CreateOrder

Actions avoid putting complex workflows directly inside controllers.

---

# Rules

Rules contain domain-specific business rules and constraints.

Responsibilities:

- Validate business conditions
- Apply domain decisions
- Encapsulate reusable business logic

Examples:

- Customer ownership rules
- Domain validation rules
- Business constraints

Rules keep domain logic independent from controllers and infrastructure.

---

# Services

Services contain technical services and application support operations.

Responsibilities:

- Handle technical operations
- Communicate with external systems
- Provide reusable application services

Examples:

- Mail Service
- Notification Service
- File Service
- External API communication

Services are focused on technical operations and infrastructure support, not business decisions.

---

# Queries

Queries are responsible for data retrieval operations.

Responsibilities:

- Retrieve application data
- Handle complex reads
- Prepare optimized data access flows

Queries separate read operations from application workflows.

---

# DTOs

DTOs (Data Transfer Objects) are structured objects used to transfer data between application layers.

Responsibilities:

- Provide clear data contracts
- Move data between components
- Reduce direct dependencies between layers

---

# ViewModels

ViewModels prepare data specifically for the presentation layer.

Responsibilities:

- Shape data required by views
- Separate UI requirements from application logic
- Simplify presentation handling

---

# Models

Models represent the persistence layer.

Responsibilities:

- Database entities
- Relationships
- Data persistence

Models are responsible for representing stored data and its relationships.

---

# Current Business Domains

The currently implemented business domains are:

- Identity
- Customer
- Catalog
- Inventory
- Cart
- Orders

Future domains will follow the same architectural organization.

---

# Architectural Benefits

This architecture provides:

- Clear separation of responsibilities
- Scalable domain organization
- Better code discoverability
- Reduced coupling
- Easier maintenance
- Independent feature development
- Consistent project evolution

---

# Future Evolution

The architecture is designed to support future platform evolution, including:

- Payment systems
- Seller management
- Search engine integration
- Notification systems
- External APIs
- Advanced ecommerce workflows

---

# Conclusion

EasyShop architecture combines technical layer separation with domain-oriented organization.

This approach allows the project to maintain a clean structure while growing from a simple ecommerce application into a scalable enterprise platform.
