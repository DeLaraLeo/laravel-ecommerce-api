# Getting Started

This guide will help you set up the Laravel Microservices Boilerplate locally.

## Prerequisites

Before you begin, ensure you have the following installed:

- PHP >= 8.2
- Composer
- PostgreSQL >= 16 (or use Docker)
- Redis >= 7.2 (or use Docker)
- Node.js and NPM (for frontend assets)

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/your-username/laravel-microservices-boilerplate.git
cd laravel-microservices-boilerplate
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Configuration

Copy the `.env.example` file to `.env`:

```bash
cp .env.example .env
```

Update the `.env` file with your database and service configurations:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel_development
DB_USERNAME=postgres
DB_PASSWORD=postgres

REDIS_HOST=127.0.0.1
REDIS_PORT=6379

RABBITMQ_HOST=127.0.0.1
RABBITMQ_PORT=5672
RABBITMQ_USER=guest
RABBITMQ_PASSWORD=guest
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations

```bash
php artisan migrate
```

### 6. Start the Development Server

```bash
php artisan serve
```

The application will be available at `http://localhost:8000`.

## Using Docker (Recommended)

### Prerequisites

- Docker
- Docker Compose

### Quick Start with Docker

**Note**: The `docker-compose.yml` file in this boilerplate is a template. It will be used as a reference when creating the `microservices-infra` project later.

For now, you can use the Dockerfile to build and run a single service:

```bash
docker build -t laravel-boilerplate .
docker run -p 9000:9000 laravel-boilerplate
```

## Running Tests

```bash
php artisan test
```

Or with coverage:

```bash
php artisan test --coverage
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
  "service": "Laravel",
  "timestamp": "2024-01-01T00:00:00+00:00",
  "environment": "local"
}
```

## Next Steps

1. Review the [Architecture Documentation](ARCHITECTURE.md)
2. Check out [Examples](EXAMPLES.md) for code samples
3. Read about [Error Handling](ERRORS.md)

## Troubleshooting

### Database Connection Issues

Ensure PostgreSQL is running and the credentials in `.env` are correct:

```bash
psql -U postgres -h localhost -d laravel_development
```

### Redis Connection Issues

Test Redis connection:

```bash
redis-cli ping
```

Should return `PONG`.

### Permission Issues

Ensure storage and cache directories are writable:

```bash
chmod -R 775 storage bootstrap/cache
```

## Support

For issues and questions, please open an issue on GitHub.

