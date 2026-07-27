# EasyShop

> Enterprise Ecommerce Platform built with Laravel

EasyShop is an enterprise-oriented ecommerce platform designed to simulate the architecture, development workflow, and infrastructure of a real-world production application.

The project focuses on:

- Scalability
- Maintainability
- Clean architecture principles
- Domain-oriented organization
- Automated development workflows
- Containerized infrastructure
- Production-ready deployment practices

---

# Overview

EasyShop is a complete ecommerce platform built with Laravel.

The project includes application services, background processing, infrastructure automation, and cloud deployment workflows.

The system includes:

- Authentication and authorization
- Customer management
- Product catalog
- Inventory management
- Shopping cart
- Order management
- Background job processing
- Scheduled tasks
- Event-driven workflows
- Automated CI/CD pipelines
- Container-based deployment infrastructure

---

# Tech Stack

## Backend

- PHP
- Laravel
- Laravel Fortify
- MySQL / TiDB Cloud
- Redis
- Laravel Queue System
- Laravel Scheduler

## Frontend

- Blade
- Vite

## Infrastructure & DevOps

- Docker
- Docker Compose concepts
- GitHub Actions
- GitHub Container Registry
- Self-hosted runners
- Linux servers
- Oracle Cloud Infrastructure
- Cloudflare DNS / CDN / WAF

---

# Architecture

EasyShop follows a Technical Layered Architecture combined with Domain-Oriented Organization.

The application is structured around:

- Separation of technical responsibilities
- Domain-based organization
- Independent feature evolution
- Clear application workflows
- Maintainable business logic boundaries

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

Future domains will extend the ecommerce ecosystem with additional business capabilities.

Domain documentation:

→ [Business Domains](docs/domains.md)

---

# Development Workflow

The project follows an enterprise-style Git workflow based on:

- Feature branches
- Pull Requests
- Code review process
- Automated validation
- Controlled releases
- Semantic versioning

Documentation:

→ [Git Workflow](docs/git-workflow.md)

---

# CI/CD & Automation

EasyShop uses GitHub Actions to automate the complete delivery workflow.

Current automation includes:

- Pull Request validation
- Continuous Integration
- Docker image creation
- Image publishing
- Deployment automation
- Environment-specific releases

Docker images are distributed through:

- GitHub Container Registry (GHCR)

Documentation:

→ [CI/CD Pipeline](docs/cicd.md)

---

# Deployment Infrastructure

EasyShop uses a container-based deployment architecture with separated application responsibilities.

Current services:

## Public Application Layer

- Laravel Web application
- Public HTTP/HTTPS exposure
- User-facing application services

## Private Background Layer

- Laravel Queue Worker
- Laravel Scheduler
- Redis infrastructure

Internal services communicate through a dedicated Docker network.

## Current architecture:

Public VM:

Laravel Web

Private VM:

Laravel Worker
Laravel Scheduler
Redis


Documentation:

→ [Deployment Strategy](docs/deployment.md)

---

# Cloud Infrastructure

EasyShop infrastructure is deployed on Oracle Cloud Infrastructure.

The environment is organized with separated workloads:

## Public Infrastructure

Responsible for:

- Web application exposure
- HTTPS traffic handling
- Public endpoints

## Private Infrastructure

Responsible for:

- Background processing
- Queue execution
- Scheduled operations
- Internal caching services

Network communication is controlled through:

- VM network rules
- Private service isolation
- Controlled outbound access

Documentation:

→ [Infrastructure](docs/infrastructure.md)

---

# Security & Edge Layer

Public traffic is managed through Cloudflare services.

Implemented features:

- DNS management
- CDN integration
- Edge caching
- Web Application Firewall (WAF)
- Traffic filtering and protection

The edge layer provides an additional security boundary before requests reach the application infrastructure.

---

# Environments

EasyShop uses separated environments with dedicated configurations.

Current environments:

- Development
- Worker Development
- Scheduler Development
- Staging
- Production-ready release baseline

Each environment has isolated:

- Configuration
- Secrets
- Deployment workflow
- Runtime services

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
| [Infrastructure](docs/infrastructure.md) | Cloud infrastructure, networking and services |
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

**v1.0.0 - Initial Production Release**

Release history:

Release history:

- [v1.0.0 - Production Infrastructure & Private Service Networking](CHANGELOG.md#v100---production-infrastructure--private-service-networking)
- [v0.10.0 - Scheduler Deployment and Background Infrastructure](CHANGELOG.md#v0100---scheduler-deployment-and-background-infrastructure)
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

✅ Production-ready baseline achieved

The project continues evolving with new ecommerce capabilities, business domains, infrastructure improvements, and enterprise features.

---

# License

This repository is available for educational and portfolio purposes.
