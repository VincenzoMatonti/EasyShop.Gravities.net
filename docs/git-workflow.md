# Git Workflow

## Introduction

EasyShop uses a structured Git workflow designed to simulate an enterprise development process.

The workflow separates:

- Development
- Code validation
- Docker image creation
- Deployment
- Release management

The repository integrates:

- GitHub Branch Strategy
- Pull Requests
- GitHub Actions
- GitHub Hosted Runners
- Docker
- GitHub Container Registry (GHCR)
- Self-hosted Deployment Runners

The goal is to create a reproducible and automated delivery pipeline.

---

# Branch Strategy

The repository follows this structure:

```text
main

↑

staging

↑

dev

↑

feature branches

Each branch has a specific responsibility.

```

# Feature Branches

All new features and improvements are developed using dedicated feature branches.

Examples:

feature/customer-profile

feature/mail-service

feature/error-management

feature/scheduler

Feature branches are created from the dev branch.

Development flow:

Feature Branch

↓

Pull Request

↓

dev

Each feature branch should contain a focused change or a complete logical improvement.


# Pull Request Workflow

Pull Requests are the entry point for code integration.

Before merging a feature into dev, GitHub Actions automatically runs the CI validation pipeline.

Flow:

Developer

↓

Feature Branch

↓

Pull Request

↓

GitHub Actions CI

↓

Validation Success

↓

Merge Allowed

↓

Merge into dev

The Pull Request validation ensures that only valid code enters the development branch.

Pull Requests provide:

Automated validation
Safer integration
Cleaner history
Controlled code changes
Continuous Integration (CI)

EasyShop uses GitHub Actions for Continuous Integration.

The CI pipeline runs on GitHub Hosted Runners.

Responsibilities:

Install dependencies
Validate application setup
Run automated tests
Check code integrity

Flow:

Pull Request

↓

GitHub Hosted Runner

↓

CI Pipeline

↓

Validation Result

↓

Merge Permission

A failed CI pipeline blocks the merge.


#  Development Branch Workflow

The dev branch represents the active development environment.

After a successful Pull Request merge, the development deployment workflow starts.

Flow:

Merge into dev

↓

DEV Validation Pipeline

↓

Validation Success

↓

# Docker Image Build Pipeline

The dev branch contains only validated changes.

# Docker Image Build Workflow

Docker image creation is separated from deployment.

The image build runs on GitHub Hosted Runners.

The workflow starts only after successful DEV validation.

Flow:

DEV Validation Success

↓

Build Image Workflow

↓

GitHub Hosted Runner

↓

Docker Build

↓

Docker Image Tag

↓

# Push to GHCR

The Docker image is tagged using the Git commit SHA.

Example:

ghcr.io/company/easyshop-app:<commit_sha>

Using the commit SHA guarantees traceability between:

Source code
Docker image
Deployment version
GitHub Container Registry (GHCR)

GitHub Container Registry is used as the centralized Docker image repository.

Responsibilities:

Store Docker images
Version application builds
Provide images to deployment runners

# Architecture:

GitHub Hosted Runner

↓

Docker Image Build

↓

GitHub Container Registry

↓

Self-hosted Deployment Runners

The deployment servers never build images.

They only consume already validated images.

# Deployment Workflow

Deployment is handled by dedicated self-hosted runners.

Current runners:

Web Runner

Worker Runner

Each runner manages only its assigned service.

# Web Deployment

The Web Runner deploys the Laravel web application.

Flow:

GHCR Image

↓

Web Self-hosted Runner

↓

Pull Docker Image

↓

Load Environment Configuration

↓

Restart Web Container

↓

Health Check

Responsibilities:

Authenticate with GHCR
Pull the correct image version
Install environment configuration
Mount persistent storage
Install certificates
Restart application container
Verify container startup
Worker Deployment

# The Worker Runner deploys background processing services

Flow:

GHCR Image

↓

Worker Self-hosted Runner

↓

Pull Docker Image

↓

Load Worker Configuration

↓

Restart Worker Container

↓

Health Check

Responsibilities:

Authenticate with GHCR
Pull the correct image version
Configure queue worker environment
Mount persistent storage
Install certificates
Restart worker process
Verify successful startup
Environment Strategy

EasyShop uses separated environments.

# Current environments:

dev

worker.dev

Each environment has independent configuration.

Isolation includes:

Secrets
Environment variables
Database configuration
Redis configuration
Storage configuration
Deployment settings

This prevents configuration conflicts between services.

# Staging Workflow

The staging branch represents the pre-release environment.

Purpose:

Validate complete features
Test production-like behavior
Verify stability before release

Flow:

dev

↓

staging

↓

CI Validation

↓

Build Image

↓

Deploy Staging

Only validated changes should reach staging.

# Main Branch and Releases

The main branch represents stable versions.

Only approved changes are merged into main.

## Release flow:

staging

↓

main

↓

Version Tag

↓

GitHub Release

↓

# Production Deployment

Each release includes:

Semantic version tag
GitHub Release
Changelog update
Versioning Strategy

EasyShop follows Semantic Versioning.

Format:

vMAJOR.MINOR.PATCH

Examples:

v0.1.0

v0.5.0

v0.7.0

v1.0.0

Version numbers represent important development milestones.

Complete Delivery Lifecycle

The complete workflow:

Feature Branch

↓

Pull Request

↓

GitHub Actions CI Validation

↓

Merge into dev

↓

DEV Validation Pipeline

↓

Docker Image Build

↓

Push Image to GHCR

↓

Deploy Web Runner

+

Deploy Worker Runner

↓

DEV Environment Validation

↓

Merge into staging

↓

Release Preparation

↓

Merge into main

↓

Create Version Tag

↓

GitHub Release
Workflow Principles
Automation

Build, validation, and deployment processes are automated through GitHub Actions.

## Separation of Responsibilities

Each stage has a dedicated responsibility:

CI validates code
Build workflow creates Docker images
GHCR stores application images
Self-hosted runners deploy services
Reproducibility

Docker images guarantee consistent deployments across environments.

Traceability

Every deployment is connected to:

Git commit SHA
Docker image tag
Deployment process
GitHub Release
Changelog entry