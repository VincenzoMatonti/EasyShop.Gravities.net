# Infrastructure Overview

## Introduction

EasyShop infrastructure is designed to simulate a production-oriented ecommerce environment.

The system separates public application traffic from private background processing services using isolated cloud environments, containerized workloads, internal Docker networking, automated CI/CD pipelines and managed external services.

The infrastructure is based on:

- Oracle Cloud Infrastructure
- Virtual Machines
- Docker containers
- Private Docker networking
- GitHub Actions
- GitHub Container Registry
- Self-hosted deployment runners
- TiDB Cloud database
- Cloudflare R2 object storage
- Cloudflare DNS, CDN and WAF

The main goals are:

- Deployment isolation
- Security through network separation
- Reproducible deployments
- Service scalability
- Clear infrastructure responsibilities

---

# Infrastructure Architecture

                                      Internet
                                         |
                                         |
                              Cloudflare Edge Network
                                         |
                    -----------------------------------------
                    |                                       |
              DNS Management                         CDN / Cache
                    |
              WAF / Security Rules
                    |
              SSL Termination
                    |
                    |
                              Public HTTPS Traffic
                                         |
                                         |
                              +-------------------+
                              |      Web VM       |
                              |   Public Network  |
                              |                   |
                              |  Docker Engine    |
                              |                   |
                              |  Laravel Web      |
                              |  Container        |
                              |                   |
                              +-------------------+
                                         |
                                         |
                          Private Cloud Network
                          (Internal VM Communication)
                                         |
                                         |
                              +-------------------+
                              |  Background VM    |
                              | Private Network   |
                              |                   |
                              | Docker Engine     |
                              |                   |
                              |  Docker Network   |
                              | easyshop-network  |
                              |                   |
                              |  +-------------+  |
                              |  | Scheduler   |  |
                              |  | Container   |  |
                              |  +-------------+  |
                              |         |         |
                              |  +-------------+  |
                              |  | Worker      |  |
                              |  | Container   |  |
                              |  +-------------+  |
                              |         |         |
                              |  +-------------+  |
                              |  | Redis       |  |
                              |  | Container   |  |
                              |  +-------------+  |
                              |                   |
                              +-------------------+
                                         |
                                         |
                         Outbound Secure Connections
                                         |
        ----------------------------------------------------------------
        |                         |                    |                |
        |                         |                    |                |
   TiDB Cloud              Cloudflare R2          Mail Provider    External APIs
   Database                Object Storage         SMTP Services
        |                         |                    |
        ----------------------------------------------------------------


CI/CD Pipeline

                    GitHub Repository
                            |
                            |
                    GitHub Actions
                            |
              --------------------------------
              |                              |
        CI Validation                 Build Pipeline
              |                              |
              |                              |
       Tests / Checks              Docker Image Build
                                             |
                                             |
                              GitHub Container Registry
                                             |
                         --------------------------------
                         |                              |
                  Web Self Hosted Runner      Background Self Hosted Runner
                         |                              |
                         |                              |
                    Deploy Web VM              Deploy Background VM
                         |                              |
                         |                              |
                 Pull Immutable Image          Pull Immutable Image
                         |                              |
                         |                              |
                 Restart Web Container          Restart Services
                                                        |
                                      --------------------------------
                                      |              |               |
                                  Worker        Scheduler        Redis


## Network Model

The infrastructure is divided into three communication layers:

### Public Layer

Handles external user traffic.

Components:

- Cloudflare Edge Network
- DNS
- CDN
- WAF
- SSL
- Web VM

Only HTTPS traffic reaches the public application layer.


### Private Cloud Layer

Used for communication between virtual machines.

Responsibilities:

- Internal service communication
- Secure database access
- Private backend connectivity

The Background VM is not publicly exposed.


### Container Internal Layer

Inside the Background VM, Docker provides an isolated internal network:

easyshop-network

Connected services:

- Laravel Queue Worker
- Laravel Scheduler
- Redis

Containers communicate through Docker service discovery using container names.

Example:

Worker/Scheduler → easyshop-redis:6379


Internal services are never exposed directly to the internet.                                  

# Server Infrastructure

EasyShop uses separated virtual machines to isolate public traffic and internal processing workloads.

Current infrastructure:

Oracle Cloud Infrastructure

Public Subnet

+--------------------------+
| Web VM |
| |
| Docker |
| Laravel Application |
| Nginx / HTTPS |
+--------------------------+

Private Subnet

+--------------------------+
| Background VM |
| |
| Docker |
| Laravel Worker |
| Laravel Scheduler |
| Redis |
+--------------------------+


The public VM handles user-facing traffic.

The private VM handles asynchronous workloads and internal services.


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


# Background VM

The Background VM hosts private application services.

Responsibilities:

- Execute queue workers
- Execute scheduled tasks
- Provide internal Redis services
- Process asynchronous workloads


Components:

- Docker Engine
- Laravel Worker Container
- Laravel Scheduler Container
- Redis Container


Deployment is handled by the Background Self Hosted Runner.


# Network Architecture

The infrastructure is divided between public and private communication.

# Internal Docker Networking

Private application services communicate through a dedicated Docker bridge network.

Network:

easyshop-network


Services attached:


easyshop-worker

easyshop-scheduler

easyshop-redis


Docker internal DNS is used for service discovery.

Example:


REDIS_HOST=easyshop-redis


Services communicate internally without exposing Redis publicly to the internet.

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

## Redis

Redis runs as a private Docker container inside the Background VM.

Used for:

- Queue backend
- Cache
- Temporary application data
- Asynchronous processing support


Connection:

Laravel Worker

↓

Redis Container


Laravel Scheduler

↓

Redis Container


Laravel Web

↓

Private Cloud Network

↓

Redis service exposed by Background VM

Laravel Web communicates with Redis through the private cloud network.

Redis is not exposed publicly and is reachable only through internal infrastructure communication.


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

# Cloudflare Edge Layer

Public application traffic is managed through Cloudflare.

Implemented services:

- DNS management
- CDN
- Edge caching
- Web Application Firewall
- Traffic filtering


Flow:

Internet

↓

Cloudflare

↓

Public VM

↓

Laravel Application


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

## Network Isolation

The infrastructure separates:

- Public web traffic
- Private background services
- Internal container communication


Only required application endpoints are publicly reachable.

Internal services such as Redis are not directly exposed.