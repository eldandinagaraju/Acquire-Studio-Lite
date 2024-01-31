# Useful Commands

## For Migrations

### Creating Migration

- `./dev-env run ci-api phinx create MigrationName`

### Perform Migration

- `./dev-env run ci-api phinx migrate`
- `./dev-env run ci-api phinx migrate --dry-run`

### Perform Rollback

- For Rolling back the recent migration : `./dev-env run ci-api phinx rollback`
- For Rolling back all the migrations : `./dev-env run ci-api phinx rollback -t 0`

## For Seeding

### Creating a Seeder

- `./dev-env run ci-api phinx seed:create SeederName`

### Running a Seeder

- running a all the seeds : `./dev-env run ci-api phinx seed:run`
- running a single seed : `./dev-env run ci-api phinx seed:run -s SeederName`
