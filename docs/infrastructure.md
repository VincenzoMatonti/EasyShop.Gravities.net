# Infrastructure Overview

## Introduction

EasyShop infrastructure is designed to simulate a production-oriented ecommerce environment.

The system separates application responsibilities across different environments and servers, using containerized services, automated CI/CD pipelines, private communication channels, and external managed services.

The infrastructure is based on:

- Virtual Machines
- Docker containers
- GitHub Actions
- GitHub Container Registry
- Self-hosted deployment runners
- TiDB Cloud database
- Upstash Redis
- Cloudflare R2 storage

The main goal is to achieve:

- Deployment isolation
- Scalability
- Security
- Reproducible deployments
- Clear infrastructure responsibilities

---

# Infrastructure Architecture

The current infrastructure follows this architecture:

```text
                         GitHub Repository

                                |

                         GitHub Actions

                                |

                    Pull Request Validation
                                |
                                |
                         CI Pipeline

                                |

                         Build Pipeline

                                |

                    GitHub Container Registry

                                |

              -------------------------------

              |                             |

        Web Self Hosted Runner       Worker Self Hosted Runner

              |                             |

        Web VM Environment          Worker VM Environment

              |                             |

        Docker Container            Docker Container


              -------------------------------

                                |

                         External Services

                                |

          TiDB Cloud      Upstash Redis      Cloudflare R2
```

# Server Infrastructure

EasyShop uses separated virtual machines to isolate application responsibilities.

Current infrastructure:

Public Network

    |

    |

+----------------------+
|      Web VM          |
|                      |
|  Nginx               |
|  Docker              |
|  Laravel Application |
|                      |
+----------------------+


+----------------------+
|    Worker VM         |
|                      |
|  Docker              |
|  Queue Worker        |
|  Background Jobs     |
|                      |
+----------------------+


# Web VM

The Web VM hosts the public application layer.

Responsibilities:

Serve HTTP requests
Run Laravel application
Handle web traffic
Manage application containers

Components:

Docker Engine
Laravel Container
Nginx
SSL certificates

Deployment is handled by the Web Self Hosted Runner.

Flow:

GitHub Container Registry

↓

Web Runner

↓

Docker Pull

↓

Restart Web Container

↓

Application Available


# Worker VM

The Worker VM handles asynchronous application processing.

Responsibilities:

Execute queue jobs
Process background tasks
Handle asynchronous workloads

Examples:

Email jobs
Event listeners
Future scheduled tasks

Components:

Docker Engine
Laravel Worker Container

Deployment is handled by the Worker Self Hosted Runner.

Flow:

GitHub Container Registry

↓

Worker Runner

↓

Docker Pull

↓

Restart Worker Container

↓

Background Processing Active


# Network Architecture

The infrastructure is divided between public and private communication.

## Public Network

The public network exposes only required application services.

Current exposed services:

Web application
HTTPS traffic

Example:

Internet

↓

Nginx

↓

Laravel Container

## Private Communication

Internal services communicate without being directly exposed.

Private communication is used for:

Database connections
Redis connections
Internal application services

The application servers do not expose internal infrastructure publicly.

# Docker Infrastructure

EasyShop uses Docker to provide consistent environments.

Each deployment runs the application inside containers.

Benefits:

Same environment between development and deployment
Reproducible builds
Easier scaling
Isolation between services
Container Strategy

The same Docker image is used for different services.

Image example:

ghcr.io/company/easyshop-app:<commit_sha>

The image is built once and reused by deployment runners.

This avoids rebuilding applications directly on servers.

# Docker Deployment Flow

The deployment process follows this model:

Source Code

↓

GitHub Actions Build Runner

↓

Docker Build

↓

Docker Image

↓

GitHub Container Registry

↓

Self Hosted Runner

↓

Docker Pull

↓

Container Restart

# Persistent Data

Application persistent data is stored outside containers.

The deployment uses shared directories:

Web:

/var/www/easyshop-web/shared/

Worker:

/var/www/easyshop-worker/shared/

Persistent resources:

Environment files
Storage directories
Certificates

This allows containers to be replaced without losing persistent data.

# Environment Configuration

Environment configuration is separated from Docker images.

Configuration is generated during deployment.

The deployment workflow:

GitHub Secrets

↓

Generate Environment File

↓

Install Configuration

↓

Start Container

Managed configurations include:

Application settings
Database credentials
Redis configuration
Storage credentials
Mail configuration
External Services
TiDB Cloud Database

EasyShop uses TiDB Cloud as managed database infrastructure.

Responsibilities:

Store application data
Provide scalable SQL database capabilities
Manage database availability

Connection:

Laravel Application

↓

TiDB Cloud

TLS certificates are installed during deployment.

## Upstash Redis

Redis is provided through Upstash.

Used for:

Queue backend
Cache
Application temporary data
Asynchronous processing support

Connection:

Laravel Application

↓

Upstash Redis


## Cloudflare R2 Storage

Cloudflare R2 is used for object storage.

Used for:

Product media
User files
Future ecommerce assets

Connection:

Laravel Application

↓

Cloudflare R2


# CI/CD Infrastructure Integration

The infrastructure is integrated with GitHub Actions.

Pipeline architecture:

Pull Request

↓

CI Validation

↓

Merge into dev

↓

Build Docker Image

↓

Push Image to GHCR

↓

Deploy Web Runner

↓

Deploy Worker Runner

Responsibilities are separated:

GitHub Hosted Runner:

Run CI validation
Build Docker images
Push images

Self Hosted Runners:

Deploy application services
Manage containers
Restart environments
Deployment Runners

EasyShop uses dedicated self-hosted runners.

Current runners:

## Web Runner

## Worker Runner

Each runner is responsible only for its assigned environment.

Benefits:

Deployment isolation
Better control
Reduced server load during builds
Faster deployments
Security Considerations

The infrastructure follows these principles:

## Secret Isolation

Sensitive configuration is stored in GitHub Secrets.

Examples:

Database credentials
Redis credentials
Storage credentials
Application keys
Minimal Exposure

Only required services are exposed publicly.

Internal services remain protected.

Immutable Deployments

Docker images are identified by commit SHA.

Example:

easyshop-app:a82f93c

Each deployment can be traced back to a specific source revision.
