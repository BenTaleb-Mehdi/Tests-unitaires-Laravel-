# Tutoriel 6.1.U2: Environnement et Isolation (Base de Test) dans Laravel

Setting up an isolated testing environment in Laravel is a crucial step to ensure your tests don't overwrite or delete your actual local development data.

Here are the step-by-step instructions to configure it perfectly.

> 💡 **Practical Implementation:** If you want to view the practical implementation in the technical project, [click here to go to the other technical project repository](https://github.com/BenTaleb-Mehdi/Projet-technique-/tree/feat/Tesing/mini-ecommerce).

---

## Step 1: Create a Dedicated Testing Environment File

Laravel automatically looks for a `.env.testing` file when you run your tests. If it finds one, it will use those variables instead of the ones in your standard `.env` file.

1. In the root of your Laravel project, duplicate your `.env` file.
2. Rename the duplicate to `.env.testing`.

---

## Step 2: Configure the Test Database

You have two main approaches for database isolation. **Approach A (SQLite In-Memory)** is the most highly recommended for testing because it is incredibly fast and cleans itself up automatically.

### Approach A: Using SQLite (In-Memory) — *Recommended*

Open your new `.env.testing` file and update the database configuration to use SQLite in memory:

```ini
DB_CONNECTION=sqlite
DB_DATABASE=:memory:
```

> **Note:** Remove or comment out `DB_HOST`, `DB_PORT`, `DB_USERNAME`, and `DB_PASSWORD` in this file to avoid confusion, as SQLite doesn't need them.

### Approach B: Using a Separate MySQL/PostgreSQL Database

If your application relies on database-specific features (like MySQL JSON operations) that SQLite doesn't support, create a separate database (e.g., `myproject_testing`) in your database manager, and configure `.env.testing` like this:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=myproject_testing
DB_USERNAME=root
DB_PASSWORD=
```

### ✅ Practical Project — Approach B via `.env.testing`

In the **mini-ecommerce** project, **Approach B** was chosen because the app relies on MySQL-specific features. The test database is configured inside `.env.testing`:

```ini
APP_NAME=Laravel
APP_ENV=testing
APP_KEY=base64:bAi3rKJ9nmZTUd87EDGyfzHgNwCKhbN3SpomH5sXeIE=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mini_ecommerce_test
DB_USERNAME=root
DB_PASSWORD=your_password_here

CACHE_STORE=array
QUEUE_CONNECTION=sync
SESSION_DRIVER=array
MAIL_MAILER=array
BROADCAST_CONNECTION=null
```

The development `.env` uses `DB_DATABASE=mini_ecommerce`, while tests run against the fully separate `mini_ecommerce_test` database — ensuring complete isolation.

> ⚠️ **Security reminder:** Never commit `.env` or `.env.testing` to Git — both contain sensitive credentials. Make sure both are listed in your `.gitignore`:
> ```bash
> echo ".env.testing" >> .gitignore
> ```

---

## Step 3: Clean Up `phpunit.xml`

Since `.env.testing` now handles all database and environment configuration, remove the DB-related lines from `phpunit.xml` to avoid conflicts. Keep only the non-sensitive defaults:

```xml
<php>
    <env name="APP_ENV" value="testing"/>
    <env name="APP_MAINTENANCE_DRIVER" value="file"/>
    <env name="BCRYPT_ROUNDS" value="4"/>
    <env name="BROADCAST_CONNECTION" value="null"/>
    <env name="CACHE_STORE" value="array"/>
    <env name="MAIL_MAILER" value="array"/>
    <env name="QUEUE_CONNECTION" value="sync"/>
    <env name="SESSION_DRIVER" value="array"/>
</php>
```

> `DB_CONNECTION` and `DB_DATABASE` are intentionally removed here — they now live in `.env.testing`. Laravel will pick them up automatically.

---

## Step 4: Implement the `RefreshDatabase` Trait

Now that your environment is isolated, you need to ensure the database is reset to a blank slate between every single test. Laravel provides a built-in trait for this.

Open a test file (e.g., `tests/Feature/ExampleTest.php`) and import the `RefreshDatabase` trait:

```php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    // 1. Add the trait inside the class
    use RefreshDatabase;

    public function test_the_application_returns_a_successful_response(): void
    {
        // 2. Write your test...
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
```

**What does this trait do?**

- When the test runs, it migrates your testing database so the schema is up to date.
- It wraps your test in a database transaction.
- When the test finishes, it rolls back the transaction, leaving the database completely empty for the next test.

---

## Step 5: Run Your Tests

You are now ready to run your tests in complete isolation. Use the Artisan command in your terminal:

```bash
php artisan test
```

Laravel will automatically detect `.env.testing` and use it instead of `.env`. Your development data stays completely safe.