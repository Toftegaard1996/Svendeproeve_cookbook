# Opsætning af projekt
Projektet er udstyret med en test bruger og dummy data, som bliver oprettet i databasen, når den bliver opstartet. Det er også en mulighed at oprette sin egen bruger.
## Skal installeres på forhånd:
- [Docker](https://www.docker.com/), i form af docker desktop, skal være installeret på computeren
- [PHP](https://www.php.net/downloads.php?usage=web&os=windows&osvariant=windows-native&version=default) version ^8.0
  - Disse extensions skal være tilgængelig i php.ini filen
    - fileinfo
    - zip
    - pdo_mysql
    - pdo_odbc
- [Composer](https://getcomposer.org/), seneste version
- [Node.js](https://nodejs.org/en/download), seneste version

## Klargør projekt:
- Hent projektet fra [github](https://github.com/Toftegaard1996/Svendeproeve_cookbook) ned via ssh
- Open projektet i din preferred IDE, denne guide bliver skrevet til brug af phpstorm
- Naviger til src
- Kør \<npm ci\> (ci bruges for ikke at opdatere pakkerne, før det er nødvendigt)
- Kør \<composer install\>
- Kopier .env.example til .env
- Kør \<php artisan key:generate\>

## Start projekt:
Inden hjemmesiden kan tilgås, skal projektet bygges op i docker og npm.
- Naviger tilbage til Simuleret_Svendeproeve
- Kør \<docker build -t laravel:latest -f Docker/Laravel.Dockerfile .\> (Glem ikke punktummet efter Dockerfile)
- Kør \<docker compose up -d\>
- Naviger til src mappen
- Kør \<php artisan migrate –seed\> (Double dash) *
- Kør \<npm run dev\>
- Open ønskede browser og søg på localhost:1313
- Opret egen bruger, eller log ind med:
  - test@example.com
  - secret

## Fejlsøgning:
- Hvis databasen ikke vil lade sig migrere, tjek da din host fil via stien c:\Windows\System32\Drivers\etc\hosts , og sikre at host.docker.internal er sat til 127.0.0.1 (notepad skal åbnes som administrator)
  - Søg eventuelt efter: "Added by Docker Desktop"