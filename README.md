# Saacid Clinic Management System

A Laravel 12 clinic operations starter with staff sign-in and roles, patient records, doctor directory, appointment scheduling, reception queue check-ins, consultations, prescriptions, and invoice payments. It is built for PHP 8.2+ and can use XAMPP MySQL.

## Local setup (XAMPP)

1. Start Apache and MySQL from the XAMPP Control Panel.
2. Create a MySQL database named `saacid_clinic` (or change the DB values in `.env`).
3. From this folder run:

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Open `http://127.0.0.1:8000`. Bootstrap, Bootstrap Icons, Chart.js and fonts are loaded from CDNs, so internet access is needed for those UI assets. A Node build is not required for the current UI.

## Development accounts

The seeder creates synthetic sample users. Sign in with one of these accounts and change the password before using the application beyond local development:

| Role | Email | Password |
| --- | --- | --- |
| Administrator | `admin@saacidclinic.test` | `Clinic123!` |
| Receptionist | `reception@saacidclinic.test` | `Clinic123!` |
| Doctor | `doctor@saacidclinic.test` | `Clinic123!` |

Do not use the seeded credentials in a public deployment. Set `APP_DEBUG=false`, configure HTTPS, use a private database credential, and create real staff accounts first.

## Included workflows

- Live database dashboard statistics and seven-day appointment/payment charts.
- Patient registration, search, profile, appointment and consultation history.
- Doctor and department assignment, availability and active status.
- Appointment create/edit, server validation, unique doctor/time constraint, status updates and queue check-in numbering.
- Role-restricted consultation notes and prescription item capture.
- Invoice generation, discounts, partial payments, receipts, balance calculation and print view.
- Administrator staff provisioning, activation controls and clinic contact/currency settings.
- Responsive Bootstrap layout, validation feedback, success notices and pagination.

## Roles

`administrator`, `receptionist`, `doctor`, and `nurse` are stored on each user. Route middleware enforces role restrictions on the server. Patient and appointment access is available to signed-in users; clinical detail creation is restricted to administrators/doctors and consultation list access to administrators/doctors/nurses; billing and financial pages are restricted to administrators/receptionists.

## Current scope and limitations

- This is a local first implementation. Automated workflow tests, CSV reports, calendar month view, prescription printing, password self-service, configurable service/department administration, refunds, and a detailed audit trail still need implementation.
- Doctor/user association is supported in the schema and seeded doctor profile, but the doctor form does not yet link an existing staff account.
- Seeded patient/doctor/service data is synthetic and intended only for development.
- The default currency is USD. Invoice totals are stored as numeric amounts; clinic currency is configurable in settings but presentation uses a dollar sign in the initial billing views.
- Application assets use CDN libraries; they should be vendored locally for an offline installation.
- Do not use this starter for real patient data until access policies, backup, privacy, auditing, deployment security, and local regulatory requirements have been reviewed.

## Verification

The project was scaffolded on Laravel 12 using PHP 8.2. Run `php artisan route:list`, `php artisan migrate --seed`, and `php artisan test` after configuring the local database. MySQL migrations have not been run automatically so this project will not modify a developer database without their action.
