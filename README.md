## Backend part

1. Clone project
2. Copy `.env.example` to `.env`
3. Run `php artisan key:generate`
4. Create a new empty db and connect via updating the `.env` file with your database credentials in the `DB_` section
5. Run `composer install`
6. Run `php artisan migrate`
7. Run `php artisan db:seed`
8. The Openapi docs are located in `[YOUR-URL]/openapi/index.html`
9. Once you set up this go to [Frontend part](https://github.com/Kristiansky/blog-frontend/) and follow instructions there
