# Code Examples

> **Note**: This is a template file. Each service should provide code examples here.

## Overview

This document provides code examples for common use cases in this microservice.

## Authentication

### Login Example

```php
// POST /api/auth/login
{
  "email": "user@example.com",
  "password": "password123"
}

// Response
{
  "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "user@example.com"
  }
}
```

### Using Authentication Token

```php
// Include token in Authorization header
Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGc...
```

## API Requests

### Health Check

```bash
curl -X GET http://localhost:8000/api/health
```

### Creating a Resource

```php
// POST /api/resources
{
  "name": "Example Resource",
  "description": "This is an example"
}

// Response
{
  "id": 1,
  "name": "Example Resource",
  "description": "This is an example",
  "created_at": "2024-01-01T00:00:00.000000Z"
}
```

### Updating a Resource

```php
// PUT /api/resources/1
{
  "name": "Updated Resource",
  "description": "Updated description"
}
```

### Deleting a Resource

```php
// DELETE /api/resources/1
// Response: 204 No Content
```

## Database Queries

### Using Eloquent

```php
use App\Models\User;

// Find user
$user = User::find(1);

// Create user
$user = User::create([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'password' => bcrypt('password'),
]);

// Query with relationships
$users = User::with('posts')->get();
```

### Using Query Builder

```php
use Illuminate\Support\Facades\DB;

$users = DB::table('users')
    ->where('active', true)
    ->orderBy('name')
    ->get();
```

## Caching

### Cache a Value

```php
use Illuminate\Support\Facades\Cache;

Cache::put('key', 'value', 3600); // Cache for 1 hour
```

### Retrieve from Cache

```php
$value = Cache::get('key', 'default');
```

### Cache with Remember

```php
$users = Cache::remember('users', 3600, function () {
    return User::all();
});
```

## Queue Jobs

### Dispatch a Job

```php
use App\Jobs\ProcessOrder;

ProcessOrder::dispatch($order);
```

### Create a Job

```php
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOrder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public $order)
    {
        //
    }

    public function handle(): void
    {
        // Process the order
    }
}
```

## Events and Listeners

### Dispatch an Event

```php
use App\Events\OrderCreated;

event(new OrderCreated($order));
```

### Create an Event Listener

```php
namespace App\Listeners;

use App\Events\OrderCreated;

class SendOrderConfirmation
{
    public function handle(OrderCreated $event): void
    {
        // Send confirmation email
    }
}
```

## Validation

### Form Request Validation

```php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ];
    }
}
```

## Testing

### Feature Test Example

```php
namespace Tests\Feature;

use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_can_create_user(): void
    {
        $response = $this->postJson('/api/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
            ]);
    }
}
```

## Service Classes

### Example Service

```php
namespace App\Services;

class UserService
{
    public function createUser(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
```

