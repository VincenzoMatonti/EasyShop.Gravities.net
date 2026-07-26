# Environment Strategy

## Introduction

EasyShop uses separated environments to simulate a production-oriented software lifecycle.

Each environment has a specific purpose and independent configuration.

The environment strategy separates:

- Development activities
- Validation processes
- Stable releases
- Deployment configurations

This approach improves:

- Security
- Stability
- Testing reliability
- Deployment control

---

# Environment Overview

The project follows this environment structure:

```text
Development

dev

↓

Staging

staging

↓

Production

main


Each environment has its own:

Configuration
Secrets
Deployment process
Infrastructure resources
```

# Development Environment

Purpose

The development environment is used for active feature development and integration testing.

It represents the first shared environment after feature development.

Main goals:

Integrate completed features
Validate application behavior
Test new implementations
Detect integration issues
Development Flow

The development lifecycle:

Feature Branch

↓

Pull Request

↓

CI Validation

↓

Merge into dev

↓

## DEV Deployment

After a successful merge into dev, the deployment pipeline is triggered automatically.

DEV Infrastructure

The development environment currently uses:

DEV Environment

        |

        |

+----------------+
| Web VM         |
|                |
| Laravel Web    |
| Docker         |
+----------------+

        |

+----------------+
| Worker VM      |
|                |
| Queue Worker   |
| Docker         |
+----------------+

        |

External Services

- TiDB Cloud
- Upstash Redis
- Cloudflare R2

## DEV Configuration

The DEV environment uses dedicated configuration files.

Examples:

infra/

└── oracle/

    └── dev/

        ├── base.env.example

        ├── web.env.example

        └── worker.env.example

During deployment:

GitHub Secrets

↓

Environment File Generation

↓

Install Configuration

↓

Docker Container Start

## DEV Secrets

DEV secrets are managed through GitHub Actions environments.

Examples:

Application:

APP_KEY
APP_URL

Database:

DB_HOST
DB_PORT
DB_DATABASE
DB_USERNAME
DB_PASSWORD

## Infrastructure:

REDIS configuration
Storage credentials
Mail credentials
Certificates

Secrets are never stored inside the repository.

## Web DEV Environment

The Web environment handles HTTP application traffic.

Responsibilities:

Serve Laravel application
Handle user requests
Provide public access

Deployment:

Build Image

↓

GHCR

↓

Web Self Hosted Runner

↓

Docker Pull

↓

Restart Container

Container:

easyshop-web

## Worker DEV Environment

The Worker environment handles asynchronous processing.

Responsibilities:

Execute queue jobs
Process background tasks
Handle asynchronous workloads

Examples:

Email sending
Event listeners
Future scheduled tasks

Deployment:

Build Image

↓

GHCR

↓

Worker Self Hosted Runner

↓

Docker Pull

↓

Restart Container

Container:

easyshop-worker


# Staging Environment

Purpose

The staging environment represents a production-like validation environment.

It is used before creating stable releases.

Main goals:

Validate complete features
Test integrated changes
Verify deployment reliability
Prepare releases
Staging Flow
dev

↓

Merge into staging

↓

CI Validation

↓

Build Docker Image

↓

Push Image to GHCR

↓

Deploy Staging

## Production Environment

Purpose

The production environment represents the stable application version.

Only approved and tested releases are deployed.

Production receives changes only from:

staging

↓

main

## Production Flow

staging

↓

Final Validation

↓

Merge into main

↓

Create Version Tag

↓

GitHub Release

↓

Production Deployment


# Environment Isolation

Each environment maintains independent resources.

Isolation includes:

Configuration

Different environment files:

dev.env

staging.env

production.env

# Secrets

Each environment has independent secrets.

Examples:

Database credentials
Redis credentials
Storage credentials
API keys
Deployment

Each environment has its own deployment process.

Example:

DEV

↓

DEV Runner


STAGING

↓

STAGING Runner


PRODUCTION

↓

Production Runner


# Environment Variables Management

Environment variables are generated during deployment.

The repository contains only templates.

Example:

.env.example

Real values are injected through:

GitHub Environment Secrets

## Deployment workflows

This avoids exposing sensitive information.

Deployment Image Strategy

All environments use Docker images stored in GitHub Container Registry.

Image format:

ghcr.io/company/easyshop-app:<commit_sha>

The image is immutable and linked to a specific Git commit.

Example:

Commit

↓

Docker Image

↓

Environment Deployment

This guarantees reproducible deployments.

# Environment Lifecycle

Complete lifecycle:

Feature Development

↓

Pull Request

↓

CI Validation

↓

dev Environment

↓

staging Environment

↓

Production Release

↓

main


# Environment Principles

Separation

Each environment has a dedicated purpose.

Security

Sensitive data is isolated through environment secrets.

Reproducibility

Docker images guarantee consistent deployments.

Stability

Only validated changes move toward production.

Traceability

Every deployment is linked to:

Git commit
Docker image
Environment
Release version