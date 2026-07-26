# Changelog

All notable changes to this project are documented in this file.

The project follows Semantic Versioning and each milestone is published through GitHub Releases.

---

# v0.9.0 - Immutable Docker Deployments & CI/CD Stabilization

## Added

- Immutable Docker image deployment strategy
- Docker images versioned using Git commit SHA
- Separate Web and Worker deployment pipelines
- GHCR image versioning workflow
- Automated deployment from GitHub Container Registry
- Environment-based deployment configuration
- TiDB SSL certificate deployment flow

## Changed

- Removed mutable Docker image tags
- Deployments now use immutable image references
- Improved rollback capability through commit-based images
- Deployment responsibilities separated between build and runtime environments

## Infrastructure

- Stabilized Oracle VM deployments
- Improved Web container deployment
- Improved Worker container deployment
- Validated secure environment generation
- Validated shared storage and certificate management

## Milestone

The project now uses a production-oriented immutable deployment workflow where Docker images are built once, stored in GHCR, and deployed consistently across environments.

---

# v0.8.0 - Containerized Deployment & DevOps Infrastructure

## Added

- Docker containerization
- GitHub Actions CI/CD pipelines
- GitHub Container Registry integration
- Oracle Cloud VM deployment
- Self-hosted deployment runners
- Worker container runtime
- Redis queue worker deployment
- TiDB TLS certificate management
- Environment-based deployment configuration

## Infrastructure

- Automated Docker image build workflow
- Automated image publishing workflow
- Web deployment automation
- Worker deployment automation
- Shared runtime storage management
- Secret-based environment generation

## Architecture

Infrastructure components were integrated while maintaining the existing Technical Layered Architecture and Domain-Oriented Organization.

Deployment and infrastructure concerns remain separated from business logic.

## Milestone

The project introduced the first complete DevOps foundation, enabling automated delivery workflows and production-oriented infrastructure evolution.

---

# v0.7.0 - Main Release Baseline

## Added

- First stable baseline release from main branch
- Authentication system
- Customer domain
- Ecommerce core domains
- Customer dashboard
- Personal profile management
- Async infrastructure
- Centralized error management

---

# v0.6.0 - Async Infrastructure & Error Management

## Added

- Mail Service
- Redis integration
- Queue workers
- Jobs
- Events
- Listeners
- Exception Logger
- Centralized Error Manager

---

# v0.5.0 - Enterprise Architecture Refactor

## Added

- Technical Layered Architecture restructuring
- Folder organization improvements
- Domain organization inside technical layers
- Query refactoring
- ViewModel refactoring
- Rules layer improvements

---

# v0.4.0 - Customer Experience

## Added

- Customer dashboard
- Personal profile management
- Address management
- Customer authorization flow
- Email verification improvements

---

# v0.3.0 - Commerce Core

## Added

- Catalog domain
- Product management
- Product variants
- Product media
- Brand management
- Categories and macro-categories
- Inventory domain
- Shopping cart foundation
- Order domain foundation

---

# v0.2.0 - Customer Domain Foundation

## Added

- Customer domain structure
- Customer profile entities
- User information management
- Company entity
- Address entity
- Phone entity
- Customer relationships
- Role system
- Authorization middleware foundation

---

# v0.1.0 - Foundation & Authentication

## Added

- Laravel project initialization
- Authentication system with Fortify
- Login and registration flow
- Initial application structure
- Database foundation

---

## Development Status

🚧 Active Development