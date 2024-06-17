# This Repo consists of the API Authentication implementation using passport
# and then the basic CRUD operation is done.


# SETTING UP PASSPORT For first Time #

Setting up Passport (https://laravel.com/docs/8.x/passport#loading-keys-from-the-environment)

# Setting up passport in an existing repo with passport configured
composer install
php artisan migrate
php artisan passport:install
(Save the keys generated after this step, The first pair of id and secret known as access client need to set up in .env of api along with the encryption keys and the Password grant client (second pair) will be used for login related activities at client side (sending request for login etc))
