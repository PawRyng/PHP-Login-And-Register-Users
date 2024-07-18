# Aplikacja Logowania i Rejestracji

## Opis

To aplikacja webowa, która pozwala na rejestrację i logowanie użytkowników. Użytkownicy są przechowywani w bazie danych MySQL, a ich hasła są hashowane z użyciem soli. Po zalogowaniu, użytkownicy mają dostęp do panelu, a zarejestrowani użytkownicy nie mogą ponownie wejść do panelu logowania ani rejestracji.

## Technologie
-	**Frontend**: SCSS, jQuery
-  **Backend**: PHP
-  **Baza danych**: MySQL
-  **Konteneryzacja**: Docker, Docker Compose
  
## Wymagania

-   Docker
-   Docker Compose

## Instalacja

1.  **Sklonuj repozytorium**
    
   ```bash
git clone https://github.com/twoja-nazwa-repozytorium.git cd twoja-nazwa-repozytorium
```
2. Skonfiguruj plik `.env`
Skopiuj przykładowy plik konfiguracyjny `.env-example` do `.env` i dostosuj ustawienia zgodnie z potrzebami:
```bash
cp .env-example .env
```
Przykładowy plik `.env`:
```bash
MYSQL_ROOT_PASSWORD=rootpassword
MYSQL_DATABASE=mydatabase
MYSQL_USER=myuser
MYSQL_PASSWORD=mypassword
PMA_PORT=8081
WEB_PORT=8080
```
3. Uruchom aplikację
Użyj Docker Compose do zbudowania i uruchomienia aplikacji:
```bash
docker-compose up --build
```
Kontenery zostaną uruchomione, a aplikacja będzie dostępna pod adresem `http://localhost:<WEB_PORT>`.


## Struktura katalogów
```bash
/
│   .env								# Plik konfiguracyjny środowiska
│   .env-example						# Przykładowy plik konfiguracyjny
│   docker-compose.yml					# Plik Docker Compose
│   Dockerfile							# Plik konfiguracyjny Docker
│   index.php							# Plik główny aplikacji
│   login.php							# Strona logowania użytkowników.
│   readme.md							# Plik README
│   register.php						# Strona rejestracji użytkowników.
│
├───.vscode		# Katalog z ustawieniami VS Code
│       settings.json
│
├───css		# Katalog na pliki CSS
│   │   home.css
│   │   login.css
│   │   register.css
│   │
│   └───scss 	# Katalog na pliki SCSS
│           home.scss
│           login.scss
│           register.scss
│           _variables.scss
│
├───db		# Katalog zawiera skrypty SQL do inicjalizacji bazy danych
│       init.sql
│
├───js		# Katalog na pliki JavaScript
│       login.js
│       register.js
│
└───php		# Katalog na pliki PHP (back-end)
        db.php
        login.php
        logout.php
        register.php

```

## Konfiguracja

### `.env`

Plik `.env` zawiera konfigurację bazy danych oraz portu aplikacji. Upewnij się, że ustawienia są poprawne przed uruchomieniem kontenerów.

### `Dockerfile`

Plik `Dockerfile` definiuje obraz Docker dla aplikacji. Jest używany do budowania obrazu kontenera, który zawiera środowisko PHP i konfigurację Apache.

### `docker-compose.yml`

Plik `docker-compose.yml` definiuje konfigurację dla serwisów Docker, w tym dla aplikacji webowej i bazy danych MySQL.

## Bezpieczeństwo

-   Hasła użytkowników są hashowane z użyciem soli, co zwiększa bezpieczeństwo przechowywanych danych.
-   Użytkownicy, którzy są już zalogowani, nie mają dostępu do stron logowania i rejestracji.

## Kontakt

Jeśli masz pytania lub uwagi, skontaktuj się z nami pod adresem p_ryng@wp.pl.
