# Getting Started

This guide will help you set up the E-commerce API Laravel project locally.

## Prerequisites

Before you begin, ensure you have the following installed:

- **Docker** and **Docker Compose** (Recommended)
- OR: PHP >= 8.3, Composer, PostgreSQL >= 16, Redis >= 7.2

## Installation (Docker - Recommended)

### 1. Clone the Repository

```bash
git clone <repository-url>
cd ecommerce-api
```

### 2. Environment Configuration

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

The `.env` file is already configured for Docker. No changes needed unless you want to customize.

### 3. Start Docker Services

```bash
docker-compose up -d --build
```

This will start:
- **Laravel Application** (PHP 8.3, Laravel)
- **PostgreSQL 16** (Database)
- **Redis 7.2** (Cache & Queue)
- **RabbitMQ** (Message Queue)
- **Adminer** (Database management UI)
- **MailCatcher** (Email testing)

### 4. Generate Application Key

```bash
docker-compose exec app php artisan key:generate
```

### 5. Run Migrations and Seeders

```bash
docker-compose exec app php artisan migrate
docker-compose exec app php artisan db:seed
```

### 6. Access the Application

- **API**: http://localhost:8000
- **Health Check**: http://localhost:8000/api/health
- **Adminer** (Database): http://localhost:8080
  - System: PostgreSQL
  - Server: postgres
  - Username: postgres
  - Password: postgres
  - Database: laravel_development
- **MailCatcher** (Emails): http://localhost:1080
- **RabbitMQ Management**: http://localhost:15672 (guest/guest)

## Installation (Without Docker)

If you prefer not to use Docker:

### 1. Install Dependencies

```bash
composer install
```

### 2. Environment Configuration

Copy `.env.example` to `.env` and configure:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel_development
DB_USERNAME=postgres
DB_PASSWORD=postgres

REDIS_HOST=127.0.0.1
REDIS_PORT=6379
```

### 3. Generate Application Key

```bash
php artisan key:generate
```

### 4. Run Migrations

```bash
php artisan migrate
php artisan db:seed
```

### 5. Start Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`.

## Running Tests

### With Docker

```bash
docker-compose exec app php artisan test
```

### Without Docker

```bash
php artisan test
```

### Run Specific Test

```bash
docker-compose exec app php artisan test --filter RoleTest
```

### With Coverage

```bash
docker-compose exec app php artisan test --coverage
```

## Health Check

Test if the API is running correctly:

```bash
curl http://localhost:8000/api/health
```

Expected response:

```json
{
  "status": "ok",
  "service": "Laravel E-commerce API",
  "timestamp": "2025-01-20T00:00:00+00:00",
  "environment": "local"
}
```

## Useful Commands

### Docker Commands

```bash
# Stop services
docker-compose down

# View logs
docker-compose logs -f app

# Access container shell
docker-compose exec app bash

# Run artisan commands
docker-compose exec app php artisan <command>

# Run queue worker
docker-compose exec app php artisan queue:work
```

### Artisan Commands

```bash
# Clear cache
php artisan cache:clear

# Clear config cache
php artisan config:clear

# Run migrations
php artisan migrate

# Run seeders
php artisan db:seed

# List routes
php artisan route:list
```

## Next Steps

1. Review the [Architecture Documentation](ARCHITECTURE.md)
2. Check out [Examples](EXAMPLES.md) for API usage examples
3. Read about [Error Handling](ERRORS.md)
4. Review the [Architecture Documentation](ARCHITECTURE.md) for project structure and patterns

## Troubleshooting

### Database Connection Issues

**With Docker:**
```bash
# Check if PostgreSQL container is running
docker-compose ps

# Check PostgreSQL logs
docker-compose logs postgres

# Test connection from container
docker-compose exec app php artisan tinker
# Then: DB::connection()->getPdo();
```

**Without Docker:**
```bash
# Ensure PostgreSQL is running
psql -U postgres -h localhost -d laravel_development
```

### Redis Connection Issues

**With Docker:**
```bash
# Check Redis container
docker-compose ps redis

# Test Redis from container
docker-compose exec app php artisan tinker
# Then: Redis::ping();
```

**Without Docker:**
```bash
redis-cli ping
# Should return: PONG
```

### Permission Issues

**With Docker:**
```bash
# Fix permissions inside container
docker-compose exec app chmod -R 775 storage bootstrap/cache
```

**Without Docker:**
```bash
chmod -R 775 storage bootstrap/cache
```

### Queue Not Processing

```bash
# Start queue worker
docker-compose exec app php artisan queue:work

# Or in background
docker-compose exec -d app php artisan queue:work
```

### Email Not Sending

1. Check MailCatcher: http://localhost:1080
2. Verify queue worker is running
3. Check `.env` mail configuration
4. View logs: `docker-compose logs -f app`

## Project Status

- ✅ **Module 1**: Authentication & Authorization (Complete)
- ⏳ **Module 2**: Products & Categories (Planned)
- ⏳ **Module 3**: Shopping Cart (Planned)
- ⏳ **Module 4**: Orders & Payments (Planned)
- ⏳ **Module 5**: Reviews & Coupons (Planned)

See [Project Status](PROJECT_STATUS.md) for current implementation status and roadmap.

