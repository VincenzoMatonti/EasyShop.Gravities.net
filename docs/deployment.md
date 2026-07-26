# Deployment Strategy

## Introduction

EasyShop uses a Docker-based deployment strategy designed to deliver application services in a consistent and reproducible way.

The deployment process is separated from the build phase.

Docker images are created externally and deployment servers are responsible only for retrieving and running validated images.

This approach provides:

- Consistent deployments
- Reduced server workload
- Easier rollback operations
- Clear separation between build and runtime environments

---

# Deployment Architecture

The deployment flow follows this architecture:

```text
GitHub Container Registry

↓

Self Hosted Deployment Runner

↓

Docker Pull

↓

Container Replacement

↓

Health Check

Deployment runners never build Docker images.

They only deploy existing images produced by the CI/CD pipeline.
```

# Deployment Runners

EasyShop uses dedicated self-hosted runners for application deployment.

Current deployment runners:

Self Hosted Runners

├── Web Runner
│
└── Worker Runner

Each runner is responsible for a single application service.

This separation avoids coupling between different runtime components.

# Web Deployment

The Web Runner manages the Laravel web application.

The deployment process:

GHCR Image

↓

Web Runner

↓

Pull Docker Image

↓

Load Environment Configuration

↓

Install Certificates

↓

Restart Web Container

↓

Health Check


# Web Deployment Responsibilities

The Web deployment process handles:

Retrieving the correct Docker image
Loading environment configuration
Installing required certificates
Mounting persistent storage
Restarting the application container
Verifying container startup
Web Container

The web application runs inside a dedicated Docker container.

Container:

easyshop-web

Runtime configuration includes:

Application environment variables
Persistent storage volumes
TiDB certificates
SSL certificates
Application role configuration

Example:

Container

├── Laravel Application
├── Storage Mount
├── Certificates
└── Environment Configuration


# Worker Deployment

The Worker Runner manages background processing services.

The deployment process:

GHCR Image

↓

Worker Runner

↓

Pull Docker Image

↓

Load Worker Configuration

↓

Install Certificates

↓

Restart Worker Container

↓

Health Check


# Worker Deployment Responsibilities

The Worker deployment process handles:

Retrieving the correct Docker image
Loading worker environment configuration
Mounting persistent storage
Installing certificates
Restarting queue workers
Verifying successful execution
Worker Container

The worker application runs inside a dedicated Docker container.

Container:

easyshop-worker

Runtime configuration includes:

Queue worker configuration
Environment variables
Persistent storage
TiDB certificates
Application role configuration

Example:

Container

├── Laravel Queue Worker
├── Storage Mount
├── Certificates
└── Environment Configuration


# Environment Configuration

Deployment environments use generated configuration files.

Environment files are created during deployment using:

Repository environment templates
GitHub Environment Secrets
Deployment variables

Example:

infra/

└── oracle/

    └── dev/

        ├── base.env.example

        ├── web.env.example

        └── worker.env.example

The generated configuration is installed on the target server.


# Persistent Storage

Application data that must survive container replacement is stored outside the container lifecycle.

Mounted resources include:

Web
/var/www/easyshop-web/shared/storage
Worker
/var/www/easyshop-worker/shared/storage

This allows containers to be replaced without losing persistent data.


# Certificate Management

External service certificates are installed during deployment.

Currently managed certificates:

TiDB CA certificate
SSL certificates

Certificates are stored outside containers and mounted at runtime.

Example:

shared/certs

↓

Container Mount

↓

Application Runtime


# Container Replacement Strategy

Deployment uses a replace strategy.

Process:

Running Container

↓

Stop Old Container

↓

Remove Old Container

↓

Start New Container

↓

Health Check

The new container always starts from a specific Docker image version.


# Rollback Strategy

Because deployments use immutable Docker images, rollback can be performed by deploying a previous image version.

Example:

Current:

easyshop-app:a82f93c


Rollback:

easyshop-app:91bc442

The deployment process remains identical.

Only the Docker image reference changes.


# Deployment Verification

After deployment, the system performs runtime checks.

Verification includes:

Container running status
Container startup validation
Application logs inspection

If the container fails to start, deployment stops and returns an error.

Deployment Principles
Immutable Artifacts

Deployments always use versioned Docker images.


## Service Isolation

Web and Worker services are deployed independently.


## Environment Separation

Each environment maintains its own configuration and resources.


## Minimal Runtime Responsibility

Servers execute deployments but do not perform application builds.


## Reproducibility

The same Docker image can be deployed consistently across environments.