# CLAUDE.md for puklipo.com

This document provides essential information about the puklipo.com repository to help Claude better understand and work with this codebase.

## Repository Overview

puklipo.com is a web application built with the following technologies:

- **Framework**: Laravel 12.x
- **Frontend**: Livewire 3.x, TailwindCSS 4.x
- **Build System**: Vite
- **Languages**: PHP 8.2+, JavaScript, Japanese localization
- **Deployment**: Laravel Vapor (AWS Lambda)
- **License**: AGPL

The site appears to be a status/post sharing platform with social media integration features.

## Project Structure

The project follows standard Laravel 12.x directory structure:

- `app/` - Contains application code
  - `Console/Commands/` - Custom Artisan commands
  - `Http/Controllers/` - Request handlers
  - `Livewire/` - Livewire components for the status system
  - `Models/` - Eloquent models
  - `Providers/` - Service providers
  - `Support/` - Helper classes
- `bootstrap/` - Application bootstrap files
- `config/` - Configuration files
- `database/` - Migrations, factories, seeders
- `lang/` - Localization files (Japanese)
- `public/` - Publicly accessible files
- `resources/` - Views, assets, etc.
- `routes/` - Route definitions
- `storage/` - File storage
- `tests/` - Unit and feature tests
- `vendor/` - Composer dependencies

## Key Features

1. **Status System**: Core functionality allowing users to create and manage statuses
2. **Authentication**: Standard Laravel authentication
3. **Sitemap Generation**: Using Spatie's Laravel Sitemap
4. **Feed Generation**: Using Spatie's Laravel Feed
5. **Livewire Components**: Various components for viewing and managing statuses
6. **Nostr Integration**: Connection to Nostr decentralized network
7. **Notifications**: Integration with Discord webhooks, Bluesky, and Threads
8. **IndexNow Integration**: For immediate search engine indexing
9. **File Attachments**: Support for file attachments on statuses

## Development Environment

### Setup

1. Install dependencies:
   ```
   composer install
   npm ci
   ```

2. Start local development:
   ```
   ./vendor/bin/sail up -d   # Laravel Sail for Docker-based development
   npm run dev                # Start Vite development server
   ```

### Local Development Workflow

The project uses Laravel Sail for local development with Docker containers. The `sail:up` and `sail:down` composer scripts simplify starting and stopping the development environment.

## Testing and Deployment

### Testing

The project uses PHPUnit for testing:
```
php artisan test
```

Feature tests cover key functionality:
- Authentication
- Status creation and display
- Sitemap generation
- Feeds
- Filtering

### Deployment

Deployment is handled via Laravel Vapor to AWS Lambda:

```
vapor deploy production
```

The deployment process includes:
1. Installing production dependencies
2. Building frontend assets
3. Running migrations

## Common Commands

### Artisan Commands

- `php artisan migrate` - Run database migrations
- `php artisan test` - Run tests
- `php artisan serve` - Start development server
- `php artisan lang:update` - Update language files

### NPM Commands

- `npm run dev` - Start Vite development server
- `npm run build` - Build frontend assets for production

### Composer Commands

- `composer install` - Install dependencies
- `composer sail:up` - Start Docker environment
- `composer sail:down` - Stop Docker environment

## Code Style and Best Practices

- PSR-12 coding standards
- Type hints and return types
- Model relationships with proper PHPDoc annotations
- Livewire components for interactive UI elements
- Proper event handling with queueable listeners

## Common File Locations

- **Main models**: `app/Models/Status.php`, `app/Models/User.php`, `app/Models/Attachment.php`
- **Livewire components**: `app/Livewire/Status*.php`
- **Controllers**: `app/Http/Controllers/`
- **Views**: `resources/views/`
- **Tests**: `tests/Feature/` and `tests/Unit/`
- **Configuration**: `config/` directory

## Database Structure

### Key Tables

1. **users** - User accounts
   - Standard Laravel user fields
   - Relationships: hasMany statuses

2. **statuses** - The main content type
   - Uses ULIDs instead of incremental IDs
   - Fields: content, title, twitter, nostr_id
   - Relationships: belongsTo user, hasOne attachment

3. **attachments** - File attachments for statuses
   - Related to statuses

## Integration Points

1. **Social Media**
   - Bluesky
   - Nostr
   - Discord Webhook
   - Threads

2. **Search Engines**
   - IndexNow for immediate indexing
   - Auto-generated sitemap

## Troubleshooting

### Common Issues

1. **Missing .env file**
   - Copy `.env.example` to `.env` and run `php artisan key:generate`

2. **Storage permissions**
   - Run `php artisan storage:link` to create the symlink for file uploads

3. **Database connection errors**
   - Check database credentials in `.env`
   - Ensure the database exists and is accessible

## Tips for Claude

- When working with the Status model, be aware of its relationships with User and Attachment
- The application uses ULIDs instead of incremental IDs for Status records
- The project has Japanese localization, so be mindful of language-specific features
- Laravel Vapor is used for deployment to AWS Lambda
- Livewire components handle most of the interactive UI elements
