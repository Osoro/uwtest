# Larevel API

## Install

-   Create `.env` file from `.env.example` and configure it
-   Run `composer install` and `php artisane migrate`
-   Run `php artisan key:generate --ansi` for generate application key

## Start

-   Run `php artisan serve` or setting up any web server
-   Run `php artisan queue:work` for start queue

## Testing

-   Run `php artisan test` for run Unit test

## Manual checkup

-   Send POST request to `{yourHost}/api/submission` with body

```
{
    "name": "John Doe",
    "email": "john.doe@example.com",
    "message": "This is a test message."
}
```

-   After the request is complete, you can check for proper operation as follows:
    -   In database table `submission` exist new record with your data from request
    -   Exist file `storage/logs/submission.log` and contain message about success saving submission and `name` and `email` from your request
