# Room Booking API

## Projekta apraksts



## Uzstādīšana

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Konfigurē MySQL pieslēgumu `.env` failā. `.env` failu repozitorijā nepublicē.

## API endpointi

| Metode | Endpoint | Apraksts |
|---|---|---|
| GET | `/api/rooms` | Aktīvās telpas |
| POST | `/api/rooms` | Izveidot telpu |
| GET | `/api/rooms/{room}` | Viena telpa |
| GET | `/api/rooms/{room}/schedule/{date}` | Dienas grafiks (`YYYY-MM-DD`) |
| POST | `/api/bookings` | Izveidot rezervāciju |
| GET | `/api/rooms/{room}/current` | Pašreizējais telpas statuss |
| GET | `/api/rooms/{room}/upcoming` | Nākamās 5 rezervācijas |

Visi API pieprasījumi un atbildes izmanto JSON. Ja rezervācijas laiks pārklājas ar esošu rezervāciju, API atgriež validācijas kļūdu un rezervācija netiek saglabāta.

## Testa dati

```bash
php artisan migrate:fresh --seed
```

Seeder izveido 5 telpas un 15 rezervācijas.

## Web saskarne

Pēc `php artisan serve` palaišanas atver:

- `/` — pārskats
- `/rooms` — telpas
- `/bookings` — rezervācijas

## Piemērs

```json
{
  "room_id": 1,
  "title": "Development Team Meeting",
  "booked_by": "Toms",
  "starts_at": "2026-10-05 10:00:00",
  "ends_at": "2026-10-05 11:00:00"
}
```

## Tehnoloģijas

- PHP 8.1+
- Laravel 10
- MySQL
- JSON REST API
