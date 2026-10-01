# Room Booking API

Laravel aplikācija telpu rezervāciju pārvaldībai ar REST API un web interfeisu.

## Kas šis ir

Šis projekts ļauj:
- pārvaldīt telpas
- izveidot, rediģēt un dzēst rezervācijas
- pārbaudīt telpas pieejamību konkrētā datumā un laikā
- izmantot JSON API no citas aplikācijas vai skripta

## Uzstādīšana

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve
```

Konfigurē MySQL datubāzi `.env` failā.

## API drošība

Visiem API pieprasījumiem jānosūta `X-API-Key` galvene.

```env
API_KEY=your-very-strong-secret-key
```

Piemērs:

```bash
curl -H "X-API-Key: your-very-strong-secret-key" \
  http://localhost:8000/api/rooms
```

Ja galvene trūkst vai ir nepareiza, API atgriež `401`.

## API endpointi

### Telpas

| Metode | Endpoint | Apraksts |
|---|---|---|
| GET | `/api/rooms` | Aktīvo telpu saraksts |
| POST | `/api/rooms` | Izveidot telpu |
| GET | `/api/rooms/{room}` | Vienas telpas dati |
| PUT | `/api/rooms/{room}` | Rediģēt telpu |
| DELETE | `/api/rooms/{room}` | Dzēst telpu |
| GET | `/api/rooms/{room}/schedule/{date}` | Rezervācijas konkrētai dienai |
| GET | `/api/rooms/{room}/current` | Vai telpa šobrīd ir aizņemta |
| GET | `/api/rooms/{room}/upcoming` | Nākamās 5 rezervācijas |

### Rezervācijas

| Metode | Endpoint | Apraksts |
|---|---|---|
| POST | `/api/bookings` | Izveidot rezervāciju |
| GET | `/api/bookings/{booking}` | Vienas rezervācijas dati |
| PUT | `/api/bookings/{booking}` | Rediģēt rezervāciju |
| DELETE | `/api/bookings/{booking}` | Dzēst rezervāciju |

## Piemēri

### Izveidot telpu

```bash
curl -X POST http://localhost:8000/api/rooms \
  -H "X-API-Key: your-very-strong-secret-key" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Meeting Room A",
    "capacity": 10,
    "location": "2nd Floor"
  }'
```

### Izveidot rezervāciju

```bash
curl -X POST http://localhost:8000/api/bookings \
  -H "X-API-Key: your-very-strong-secret-key" \
  -H "Content-Type: application/json" \
  -d '{
    "room_id": 1,
    "title": "Development Team Meeting",
    "booked_by": "Toms",
    "starts_at": "2026-10-05 10:00:00",
    "ends_at": "2026-10-05 11:00:00"
  }'
```

### Rediģēt rezervāciju

```bash
curl -X PUT http://localhost:8000/api/bookings/1 \
  -H "X-API-Key: your-very-strong-secret-key" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Updated Meeting",
    "ends_at": "2026-10-05 12:00:00"
  }'
```

## Kā darbojas kods

Projekts ir Laravel MVC aplikācija.

- `routes/api.php` — definē API maršrutus
- `app/Http/Controllers/Api/*` — API loģika
- `app/Models/Room.php` — telpu modelis
- `app/Models/Booking.php` — rezervāciju modelis
- `database/migrations/` — tabulu shēmas
- `database/seeders/` — demo dati

### Kāpēc šeit ir `API key`

Šis projekts ir neliels iekšējais / skriptu bāzes serviss. Tam nav lietotāju login sistēmas vai JWT auth, tāpēc vienkāršs `X-API-Key` ir labs kompromiss:
- ātri ieviešams
- vienkārši konfigurējams
- pietiekami drošs iekšējai lietošanai
- neietver daudz papildu kodu

### Kāpēc ir pārklāšanās validācija

Rezervāciju validācijā tiek pārbaudīts, vai konkrētā telpa jau nav aizņemta konkrētajā laika periodā. Tas novērš dubulto rezervēšanu.

## Web interfeiss

Pēc `php artisan serve` var atvērt:

- `/` — pārskats
- `/rooms` — telpas
- `/bookings` — rezervācijas

## Testa dati

```bash
php artisan migrate:fresh --seed
```

Seeds izveido demo telpas un rezervācijas, lai varētu tūlīt testēt funkcionalitāti.

## Tehnoloģijas

- PHP 8.1+
- Laravel 10
- MySQL
- Vite / Blade

## Nākamie soļi

- pievienot lietotāju autentifikāciju
- pievienot role-based permissions
- uzlabot rezervāciju notifikācijas
- izveidot kalendāra skatu
