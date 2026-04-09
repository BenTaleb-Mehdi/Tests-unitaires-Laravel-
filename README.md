# 🧪 Tests Unitaires Laravel

A structured learning repository covering the fundamentals of unit and feature testing in Laravel. Each folder corresponds to a specific tutorial topic, with explanations, configuration examples, and practical notes.

> 💡 **Practical Implementation:** The concepts covered in this repository are applied in a real Laravel project — [mini-ecommerce](https://github.com/BenTaleb-Mehdi/Projet-technique-/tree/feat/Tesing/mini-ecommerce).

---

## 📁 Repository Structure

```
Tests-unitaires-Laravel-/
├── Environnement et Isolation (Base de Test)/
│   └── Tutorial on setting up an isolated test environment
├── Pattern-AAA/
│   └── Tutorial on the Arrange-Act-Assert pattern
└── README.md
```

---

## 📚 Topics Covered

### 1. 🔧 Environnement et Isolation (Base de Test)
How to configure a fully isolated testing environment in Laravel so your tests never touch your real development data.

**Key concepts:**
- Creating a `.env.testing` file
- Configuring a separate test database (SQLite in-memory or MySQL)
- Cleaning up `phpunit.xml` to avoid config conflicts
- Using the `RefreshDatabase` trait to reset the DB between each test

---

### 2. 🔁 Pattern AAA (Arrange – Act – Assert)
The AAA pattern is the standard structure for writing clean, readable, and maintainable tests.

**Key concepts:**
- **Arrange** — set up the data and context needed for the test
- **Act** — execute the action being tested
- **Assert** — verify the result matches expectations

---

## ⚙️ Requirements

- PHP >= 8.1
- Laravel >= 10.x
- Composer
- MySQL (for Approach B) or SQLite (for Approach A)

---

## 🚀 Getting Started

```bash
# 1. Clone the repository
git clone https://github.com/BenTaleb-Mehdi/Tests-unitaires-Laravel-.git
cd Tests-unitaires-Laravel-

# 2. Install dependencies
composer install

# 3. Copy and configure your environment files
cp .env.example .env
cp .env.example .env.testing

# 4. Edit .env.testing with your test database settings
# DB_DATABASE=your_project_test

# 5. Create the test database in MySQL
# CREATE DATABASE your_project_test;

# 6. Run the tests
php artisan test
```

---

## 🔒 Security

- Never commit `.env` or `.env.testing` to Git — they contain sensitive credentials.
- Make sure both are listed in your `.gitignore`:

```
.env
.env.testing
```

---

## 👤 Author

**BenTaleb Mehdi**
[GitHub Profile](https://github.com/BenTaleb-Mehdi)