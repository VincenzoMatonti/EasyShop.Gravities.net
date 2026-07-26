# Continuous Integration and Continuous Deployment (CI/CD)

## Introduction

EasyShop uses a CI/CD pipeline based on GitHub Actions to automate code validation, Docker image creation, and application delivery.

The pipeline is designed to separate different responsibilities:

- Continuous Integration validates application changes
- Image Build creates immutable Docker artifacts
- Continuous Deployment releases validated images into environments

This approach provides:

- Automated validation
- Reproducible deployments
- Reduced deployment errors
- Clear release traceability

---

# CI/CD Overview

The complete delivery pipeline follows this flow:

```text
Developer

↓

Feature Branch

↓

Pull Request

↓

CI Validation

↓

Merge into dev

↓

DEV CI Validation

↓

Docker Image Build

↓

Push Image to GHCR

↓

Deployment Workflow

↓

Environment Update

```

# Continuous Integration (CI)

Pull Request Validation

Every Pull Request is automatically validated before being merged.

The CI workflow runs on GitHub-hosted runners.

Purpose:

Verify code integrity
Install dependencies
Execute automated checks
Prevent unstable changes from entering shared branches

Flow:

Feature Branch

↓

Pull Request

↓

GitHub Actions CI Runner

↓

Validation

↓

Merge Allowed

Only successful CI checks allow the Pull Request to be merged.

# Development CI Pipeline

After a successful merge into the dev branch, a dedicated development validation workflow starts.

Purpose:

Verify the integrated codebase
Ensure the development branch remains stable
Prepare the application for deployment

Flow:

Merge into dev

↓

CI DEV Workflow

↓

Validation Success

↓

Build Image Workflow Trigger


# Docker Image Build Pipeline

Docker image creation is separated from deployment.

The build process runs on GitHub-hosted runners.

This avoids performing expensive build operations directly on deployment servers.

Responsibilities:

Build Docker image
Create immutable image version
Tag image using Git commit SHA
Push image to GitHub Container Registry

Flow:

CI DEV Success

↓

Build Image Workflow

↓

Docker Build

↓

Image Tag

↓

Push to GHCR


# GitHub Hosted Runners

GitHub-hosted runners are used for temporary and resource-intensive operations.

Current responsibilities:

Run CI pipelines
Install dependencies
Build Docker images
Push images to registry

Advantages:

No maintenance required
Fresh execution environment
Suitable for heavy build operations
GitHub Container Registry (GHCR)

GitHub Container Registry is used as the centralized Docker image repository.

Responsibilities:

Store application images
Version Docker artifacts
Provide images to deployment runners

Image format:

ghcr.io/<organization>/easyshop-app:<commit_sha>

Example:

ghcr.io/company/easyshop-app:a82f93c

Each image is linked to a specific Git commit.


# Continuous Deployment (CD)

After the Docker image is successfully built and pushed, deployment workflows are triggered.

Deployment does not rebuild the application.

Deployment responsibilities:

Retrieve existing Docker image
Configure environment
Start application containers
Verify application availability

Flow:

GHCR Image

↓

Deployment Workflow

↓

Self Hosted Runner

↓

Docker Pull

↓

Container Deployment


# Self Hosted Deployment Runners

EasyShop uses dedicated self-hosted runners for deployments.

Current runners:

Web Runner

Worker Runner

Each runner manages only its assigned service.

Responsibilities:

Connect to deployment server
Pull Docker images from GHCR
Execute deployment scripts
Restart containers
Deployment Separation

The CI/CD architecture separates build and deployment responsibilities.

Architecture:

GitHub Hosted Runner

        |

        |

Docker Build

        |

        |

GitHub Container Registry

        |

        |

Self Hosted Runner

        |

        |



# Environment Deployment

Benefits:

Faster deployments
Lower server workload
Same image across environments
Easier rollback process
Workflow Triggers

The pipeline uses GitHub Actions workflow chaining.

Main triggers:

Pull Request

Used for validation.

Pull Request

↓

CI Workflow


# Workflow Completion

Deployment stages are triggered after successful workflow completion.

Example:

CI DEV Completed Successfully

↓

Build DEV Image

↓

Deploy DEV

This guarantees that every deployment starts only from validated code.


# Environment Deployment Flow

The complete DEV delivery process:

Pull Request

↓

CI Validation

↓

Merge into dev

↓

CI DEV

↓

Build Docker Image

↓

Push Image to GHCR

↓

Deploy Web Environment

↓

Deploy Worker Environment


# CI/CD Principles
Automation

Validation, image creation, and deployment are automated through GitHub Actions.

Separation of Responsibilities

Each stage has a specific responsibility:

CI validates code
Build workflow creates artifacts
Deployment workflows release services
Reproducibility

Docker images guarantee that the same artifact is deployed across environments.

Traceability

Each deployment is connected to:

Git commit
Docker image
Environment
Release version
Security

Sensitive configuration is managed through GitHub Environment Secrets and never stored inside the repository.