# testeprivatecode
código do teste da privatecode

## Como instalar
O website foi feito com laravel 7.x

1. git clone https://github.com/fabiobap/testeprivatecode.git
1. composer install
1. npm install
   1. npm run dev
1. configure o .env pra sua database
1. php artisan key:generate
1. php artisan db:seed e siga as instruções
   1. com as seed terá sido criado entre outros usuarios normais, um usuario admin (john.admin@laravel.test / password)
   1. usuario admin tem acesso a todas funcionalidades e a possibilidade de criar grupos / adicionar usuarios a grupos 
1. todos usuarios criados normalmente pelo Register não serão admin
