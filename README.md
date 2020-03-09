# Laravel Crud Generator
Generate CRUD operations with only 1 command

How To Use
-------------
1. git clone https://github.com/maxteroit/crudgenerator.git
2. Open crudgenerator folder with your text editor
3. run command : ***composer install***
4. run command to generate CRUD :
>***php artisan crud:generate YourCRUDName***
For example :
>***php artisan crud:generate Animal***

Just for example, edit VerifyCsrfToken.php, and add your route to $except variable,

Example :
>protected $except = [

        '/animals'

];
