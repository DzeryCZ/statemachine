# Statemachine Demo - implementation in PHP

This project was created in order to practice DDD, SOLID, TDD, etc... techniques.

## Build Docker image
```bash
docker build -f ./_docker/Dockerfile -t statemachine .
```

## Run transition
```bash
docker run -it \
    -v $(pwd)/app:/app \
    statemachine sh
```

## Install dependencies - inside docker container
```bash
composer install
```

## Run App - inside docker container
```bash
php /app/src/app.php
```

## Run PHPCS - inside docker container
```bash
./vendor/bin/phpcs --standard=ruleset.xml
```

## Run PHPSTAN - inside docker container
```bash
./vendor/bin/phpstan analyse src tests
```

## Todo
- Logging
- Autowiring problem
- Fix PHPSTAN
- DB integration
- Tools
    - Pre-commit hooks
- TravisCI integration
    - Test coverage
