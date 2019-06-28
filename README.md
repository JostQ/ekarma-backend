# API E-Karma

## Installation

Clone this repository.

Make sure to have composer installed.

Move in the new directory.

```
$ composer install
```

Generate a .env.local and set 

```
DATABASE_URL=mysql://db_user:db_password@127.0.0.1:3306/db_name
```

Create your DB with Doctrine 
```
$ php bin/console doctrine:database:create
```

Make the migration on your database
```
$ php bin/console doctrine:migrations:migrate
```

And load the fixtures
```
$ php bin/console doctrine:fixtures:load
```

And run the server
```
$ php bin/console s:r
```

## Documentation

Render to the URL to see basics URLs
```
http://127.0.0.1:8000/api
```

### Specials resquest

Get the top two of good or worst users : 
  * For good users : `order=desc`
  * For worst users : `order=asc`
```
http://127.0.0.1:8000/api/users/top?filter=karma&order=
```

Enjoy the API !