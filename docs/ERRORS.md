# Error Codes

> **Note**: This is a template file. Each service should document its specific error codes here.

## Overview

This document lists all error codes and their meanings for this microservice.

## HTTP Status Codes

### 2xx Success

- `200 OK` - Request successful
- `201 Created` - Resource created successfully
- `204 No Content` - Request successful, no content to return

### 4xx Client Errors

- `400 Bad Request` - Invalid request format or parameters
- `401 Unauthorized` - Authentication required or invalid credentials
- `403 Forbidden` - Insufficient permissions
- `404 Not Found` - Resource not found
- `422 Unprocessable Entity` - Validation failed
- `429 Too Many Requests` - Rate limit exceeded

### 5xx Server Errors

- `500 Internal Server Error` - Unexpected server error
- `503 Service Unavailable` - Service temporarily unavailable

## Custom Error Codes

Document your custom error codes here:

### Authentication Errors

| Code | Message | Description |
|------|---------|-------------|
| `AUTH_001` | Invalid credentials | Email or password incorrect |
| `AUTH_002` | Token expired | JWT token has expired |
| `AUTH_003` | Token invalid | JWT token is invalid |

### Validation Errors

| Code | Message | Description |
|------|---------|-------------|
| `VAL_001` | Required field missing | A required field was not provided |
| `VAL_002` | Invalid format | Field format is invalid |
| `VAL_003` | Value out of range | Field value is outside allowed range |

### Business Logic Errors

| Code | Message | Description |
|------|---------|-------------|
| `BIZ_001` | Resource not found | Requested resource does not exist |
| `BIZ_002` | Operation not allowed | Operation is not permitted |
| `BIZ_003` | Conflict | Resource conflict detected |

## Error Response Format

All errors follow this format:

```json
{
  "error": {
    "code": "AUTH_001",
    "message": "Invalid credentials",
    "details": {
      "field": "email",
      "reason": "Email not found"
    }
  }
}
```

## Handling Errors

Document how to handle errors in your service:

1. **Client Errors (4xx)**: Fix the request and retry
2. **Server Errors (5xx)**: Retry with exponential backoff
3. **Rate Limiting (429)**: Wait for the specified retry-after period

## Logging

Errors are logged with the following information:

- Error code
- Error message
- Stack trace (for 5xx errors)
- Request context
- User information (if authenticated)

## Troubleshooting

Common error scenarios and solutions:

### Database Connection Errors

**Error**: `SQLSTATE[HY000] [2002] Connection refused`

**Solution**: Check database configuration in `.env` and ensure PostgreSQL is running.

### Redis Connection Errors

**Error**: `Connection refused`

**Solution**: Verify Redis is running and check `REDIS_HOST` and `REDIS_PORT` in `.env`.

### Authentication Errors

**Error**: `401 Unauthorized`

**Solution**: Ensure valid JWT token is provided in Authorization header.

