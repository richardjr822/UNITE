# UNITE - School Event Management System

UNITE is a Laravel-based School Event Management System that centralizes school event announcements, student registrations, and participant tracking in a single authenticated web application.

## Project Scope

### In Scope
- Admin event creation, editing, cancellation (status), and deletion
- Student registration and deregistration for events
- Participant tracking per event
- Role-based access control (Admin vs Student)
- Dashboard with upcoming event overview and weekly/monthly counts

### Out of Scope
- Ticketing, QR codes, payment processing
- Calendar sync integrations (Google Calendar, iCal)
- Push notifications and email reminders
- Attendance marking during event day
- Public unauthenticated event listings

## Technical Compliance

- Framework: Laravel (latest stable in this project)
- Database: MySQL (configured through Laravel `.env`)
- Architecture: MVC
- ORM: Eloquent only (no raw SQL in app logic)
- Authentication: Laravel Breeze
- Validation: Server-side validation applied to all event and auth forms
- Relational modeling: Many-to-many via `event_user` pivot table
- Migrations and seeders included
- Git version control ready

## Core Features

- Separate auth flows by role:
	- Student: `/login/student`, `/register/student`
	- Admin: `/login/admin`, `/register/admin`
- Role-protected event management routes for admin only
- Event CRUD fields:
	- `title`, `description`, `date`, `time`, `venue`, `capacity`, `status`
- Student registration workflow:
	- One-click register/unregister
	- Duplicate registration prevention
	- Capacity enforcement (registration blocked when full)
- Event details page:
	- Full event info
	- Remaining slots
	- Participant list visible to admins
- Dashboard:
	- Upcoming event cards
	- Events this week/month
	- Registrant counts and role-based quick actions

## Database Design Notes

### Tables
- `users`
	- Includes `role` enum (`admin`, `student`)
- `events`
	- Stores event metadata and capacity
	- Includes `status` enum (`scheduled`, `cancelled`)
- `event_user`
	- Pivot table for many-to-many registration
	- Unique composite key (`user_id`, `event_id`) for duplicate prevention

### Normalization
- 1NF: Atomic columns and no repeating groups
- 2NF: Non-key attributes depend on full primary keys
- 3NF: Non-key attributes depend only on table keys, with relationship data in pivot table

## Setup Instructions

1. Install dependencies:

```bash
composer install
npm install
```

2. Configure environment:

```bash
cp .env.example .env
php artisan key:generate
```

3. Set your MySQL credentials in `.env`, then run:

```bash
php artisan migrate --seed
```

4. Build assets:

```bash
npm run build
```

For local development:

```bash
php artisan serve
npm run dev
```

## Demo Accounts (Seeded)

- Admin:
	- email: `admin@example.com`
	- password: `password`
- Student:
	- email: `student@example.com`
	- password: `password`

## Testing

Run the test suite:

```bash
php artisan test
```

## Group Members

Richard Del Carmen Jr.   
Larissa Eunice Panganiban   
Francis Emil Rosete   
Janico Gyle Sorio   
Varnard Paulo Udani   

## Submission Checklist

- GitHub repository with full commit history
- README with setup, features, and group members
- Migrations and seeders included
- Live demo prepared for final submission week
