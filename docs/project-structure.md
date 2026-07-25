# Project Structure

## Introduction

EasyShop follows a Technical Layered Structure organized by business domains.

The project is organized by technical responsibility first and by domain context second.

This approach keeps the codebase consistent and scalable as new ecommerce capabilities are introduced.

---

# Application Structure

The main application structure:

```text
app/

├── Actions/
├── DTOs/
├── Enum/
├── Events/
├── Exceptions/
├── Http/
│   ├── Controllers/
│   ├── Middleware/
│   └── Requests/
├── Jobs/
├── Listeners/
├── Mail/
├── Models/
├── Providers/
├── Queries/
├── Rules/
├── Services/
├── View/
└── ViewModels/

Each layer contains its own business domain organization.

Actions/

├── Customer/
├── Catalog/
├── Orders/

Services/

├── Customer/
├── Mail/
├── Notification/

Models/

├── Identity/
├── Customer/
├── Catalog/
├── Inventory/
├── Cart/
└── Orders/