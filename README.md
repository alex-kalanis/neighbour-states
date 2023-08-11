# neighbour-states

This is a testing project for running data about neighbour states with land border crossings.
For these purposes it discards things like EuroTunnel or that there is no crossing between
Panama and Colombia and more such things.

## Laravel inside

This docker contains following parts:

- The application itself
- Postgres database
- [Adminer](http://localhost:40409/) for database lookup
- [Swagger](http://localhost:40400/api/documentation) for endpoint hints

The whole project is built on Laravel framework

## Getting started

To get this docker just run:

```bash
git clone https://github.com/alex-kalanis/neighbour-states.git neighbour-states       # get the docker setting
cd neighbour-states                                               # into project
./install.sh                                                      # do the all necessary steps
```

### Tests

are under Artisan and can be run from CLI.

```bash
docker exec -it testing-neighbour-states-php8 php8.1 artisan test
```

*Beware!* They use the same tables as main application; so running tests truncate all data!
After running tests it became necessary to reintroduce the main data!

PHPStan is also available:

```bash
docker exec -it testing-neighbour-states-php8 /application/composer.phar analyse
```

And at last CS fixer:

```bash
docker exec -it testing-neighbour-states-php8 /application/composer.phar cs-fixer
```
