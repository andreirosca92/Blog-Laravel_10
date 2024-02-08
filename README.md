
# Commands
php artisan storage:link

php artisan make:model Post -m -c -f
php artisan make:model Category -m -f

php artisan make:migration create_category_post_table

php artisan  migrate

php artisan db:seed
php artisan tinker

php artisan make:controller HomeController

php artisan make:component Posts/PostCard --view

php artisan livewire:make PostList

php artisan livewire:make SearchBox

composer require filament/filament:"^3.2" -W


Role:
    Member / User
    Editor -> publish post/ create categories
    Admin

php artisan make:filament-resource Category
php artisan make:filament-resource Post --soft-deletes

## Migration
    - php artisan migrate:refresh --seed 
        - rollback all and seed again
    - php artisan migrate:reset 
        - reset all
    - php artisan migrate:refresh --step=5
        - roll back and re-migrate the last five migrations