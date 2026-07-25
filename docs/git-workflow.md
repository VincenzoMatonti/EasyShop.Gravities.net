# Git Workflow

## Introduction

EasyShop uses a structured Git workflow designed to simulate an enterprise development process.

The workflow separates active development, testing, and stable releases.

---

# Branch Strategy

The repository uses the following branch structure:

```text
main

↑

staging

↑

dev

↑

feature branches
```

---

# Feature Development

New features are developed using dedicated feature branches.

Example:

```text
feature/customer-profile
feature/mail-service
feature/error-handling
```

The development flow is:

```text
Feature Branch

↓

dev

↓

staging

↓

main
```

---

# Development Branch

The `dev` branch contains active development.

Purpose:

- Implement new features
- Integrate completed tasks
- Test development changes

---

# Staging Branch

The `staging` branch represents a pre-release environment.

Purpose:

- Validate integrated features
- Verify stability before production release
- Prepare main releases

---

# Main Branch

The `main` branch represents stable releases.

Only validated versions are merged into main.

Each important milestone receives:

- Semantic version tag
- GitHub Release
- Changelog entry

---

# Versioning Strategy

The project follows Semantic Versioning.

Format:

```
vMAJOR.MINOR.PATCH
```

Examples:

```
v0.1.0
v0.5.0
v0.7.0
```

Current releases represent major development milestones.

---

