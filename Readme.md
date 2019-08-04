# Statemachine Demo - implementation in PHP

This project was created in order to practice DDD, SOLID, TDD, etc... techniques.

## Build Docker image
```bash
docker build -f ./_docker/Dockerfile -t statemachine .
```

## Run transition
```bash
docker run -it -v $(pwd)/app:/app statemachine php -c /app/src/app.php
```

## Run PHPSTAN
```bash
vendor/bin/phpstan analyse src tests
```

## Run PHPCS
```bash
./vendor/bin/phpcs src
```

## Todo
- Finish Tools
- Logging
- TravisCI integration
    - Test coverage
