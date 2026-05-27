# Ticket Registravimo Sistema

Laravel egzamino projektas | IST-24

**GitHub:** https://github.com/osvaldasbekeris-alt/praktika-ticket-sistema

## Paleidimas

```bash
composer install
cp .env.example .env
php artisan key:generate
# Sukonfigūruok .env (DB)
php artisan migrate --seed
npm install && npm run build
php artisan serve
```

## Prisijungimas (po seed)
- Admin: admin@test.lt / password
- User: user@test.lt / password

## Funkcionalumas
- Vartotojų autentifikacija
- Bilietų kūrimas, redagavimas, trynimas
- Kategorijų valdymas (admin)
- Statuso keitimas (admin)
- Komentarai su el. pašto pranešimais
- PDF ataskaita su siuntimo galimybe
- Parametrai saugomi DB (settings lentelė)