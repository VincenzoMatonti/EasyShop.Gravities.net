# EasyShop

> Enterprise Ecommerce Platform built with Laravel

EasyShop is a portfolio ecommerce platform designed to simulate the architecture, development workflow, and infrastructure of a real-world enterprise application.

The project focuses on:

- Scalability
- Maintainability
- Clean architecture principles
- Automated development workflows
- Production-oriented infrastructure

---

# Overview

EasyShop is an ecommerce platform currently under active development.

The goal is to build a complete enterprise-style system including:

- Authentication and authorization
- Customer management
- Product catalog
- Inventory management
- Shopping cart
- Order management
- Background processing
- Event-driven workflows
- Automated deployment infrastructure

---

# Tech Stack

## Backend

- PHP
- Laravel
- Laravel Fortify
- MySQL / TiDB
- Redis

## Frontend

- Blade
- Vite

## Infrastructure & DevOps

- Docker
- GitHub Actions
- GitHub Container Registry
- Self-hosted runners
- Linux servers

---

# Architecture

EasyShop follows a Technical Layered Architecture combined with Domain-Oriented Organization.

The application is structured around:

- Separation of technical responsibilities
- Domain-based organization
- Independent feature evolution
- Clear application workflows

Full documentation:

→ [Architecture](docs/architecture.md)

→ [Project Structure](docs/project-structure.md)

---

# Business Domains

Current implemented domains:

- Identity
- Customer
- Catalog
- Inventory
- Cart
- Orders

Domain documentation:

→ [Business Domains](docs/domains.md)

---

# Development Workflow

The project follows an enterprise-style development workflow based on:

- Feature branches
- Pull Requests
- Automated validation
- Controlled releases

Documentation:

→ [Git Workflow](docs/git-workflow.md)

---

# CI/CD & Automation

EasyShop uses GitHub Actions to automate:

- Pull Request validation
- Continuous Integration
- Docker image creation
- Image publishing
- Deployment triggers

Documentation:

→ [CI/CD Pipeline](docs/cicd.md)

---

# Deployment Infrastructure

The application is deployed using Docker-based services with separated runners.

Current deployment architecture:

- Web service
- Worker service
- Docker images from GHCR
- Self-hosted deployment runners

Documentation:

→ [Deployment Strategy](docs/deployment.md)

---

# Infrastructure

The infrastructure documentation describes:

- Server architecture
- Network organization
- Docker environment
- External services
- Storage strategy
- Runtime components

Documentation:

→ [Infrastructure](docs/infrastructure.md)

---

# Environments

EasyShop uses separated environments with dedicated configurations.

Current environments:

- Development
- Worker Development
- Staging
- Production (planned)

Documentation:

→ [Environments](docs/environments.md)

---

# Project Documentation

Complete technical documentation:

| Document | Description |
|---|---|
| [Architecture](docs/architecture.md) | Application architecture principles |
| [Project Structure](docs/project-structure.md) | Code organization and technical layers |
| [Business Domains](docs/domains.md) | Ecommerce domains and responsibilities |
| [Git Workflow](docs/git-workflow.md) | Branch strategy and development process |
| [CI/CD](docs/cicd.md) | Automation pipelines and workflows |
| [Deployment](docs/deployment.md) | Docker deployment strategy |
| [Infrastructure](docs/infrastructure.md) | Servers, networking and services |
| [Environments](docs/environments.md) | Environment configuration strategy |
| [Roadmap](docs/roadmap.md) | Future development plans |
| [Changelog](CHANGELOG.md) | Release history |

---

# Releases

EasyShop follows Semantic Versioning:

vMAJOR.MINOR.PATCH



Each release represents an important project milestone and includes:

- Git tag
- GitHub Release
- Changelog entry

Current version:

**v0.9.0 - Immutable Docker Deployments & CI/CD Stabilization**

Release history:

- [v0.9.0 - Immutable Docker Deployments & CI/CD Stabilization](CHANGELOG.md#v090---immutable-docker-deployments--cicd-stabilization)
- [v0.8.0 - Containerized Deployment & DevOps Infrastructure](CHANGELOG.md#v080---containerized-deployment--devops-infrastructure)
- [v0.7.0 - Main Release Baseline](CHANGELOG.md#v070---main-release-baseline)
- [v0.6.0 - Async Infrastructure & Error Management](CHANGELOG.md#v060---async-infrastructure--error-management)
- [v0.5.0 - Enterprise Architecture Refactor](CHANGELOG.md#v050---enterprise-architecture-refactor)
- [v0.4.0 - Customer Experience](CHANGELOG.md#v040---customer-experience)
- [v0.3.0 - Commerce Core](CHANGELOG.md#v030---commerce-core)
- [v0.2.0 - Customer Domain Foundation](CHANGELOG.md#v020---customer-domain-foundation)
- [v0.1.0 - Foundation & Authentication](CHANGELOG.md#v010---foundation--authentication)

---

# Development Status

🚧 Active Development

The project is continuously evolving with new ecommerce capabilities, infrastructure improvements, and enterprise features.

---

# License

This repository is available for educational and portfolio purposes.
