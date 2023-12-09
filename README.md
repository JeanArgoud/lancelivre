Clone the project "lancelivre"

Download php 7.2 (thread safe):
	{Windows} https://windows.php.net/downloads/releases/archives/
(Recommended to have php folder in your root partition or it could have permission problems)
In php.ini change output buffering to On:
	output_buffering = On

Download Composer:
	https://getcomposer.org/download/
Then install Composer:
	composer install

Add php folder to windows environment variables. Test the variable:
	php -v

Install c++:
	https://aka.ms/vs/17/release/vc_redist.x64.exe

In php.ini the following extensions should be uncommented:
	extension=curl
	extension=mbstring
	extension=mysqli
	extension=openssl
	extension=pdo_mysql
	extension=pdo_pgsql
	extension=pdo_sqlite
	extension=pgsql

Download Apache dll for php to php root folder:
	https://www.dll-files.com/php7apache2_4.dll.html
Download Apache:
	https://www.apachelounge.com/download/VS17/binaries/httpd-2.4.54-win64-VS17.zip

Add/modify in httpd.conf of Apache:
	LoadModule php7_module "C:/php/php7apache2_4.dll"
	LoadFile "C:/Program Files/PostgreSQL/15/bin/libpq.dll"
	AddType application/x-httpd-php .php
	PHPIniDir "C:/php"
Also uncomment:
	LoadModule rewrite_module modules/mod_rewrite.so
	LoadModule vhost_alias_module modules/mod_vhost_alias.so

Then start apache by executing in apache24/bin:
	httpd -k start

Install postgresql:
	https://www.postgresqltutorial.com/postgresql-getting-started/install-postgresql/
Install pgadmin4 (optional):
	https://www.postgresql.org/ftp/pgadmin/pgadmin4/v6.17/windows/

Create a symbolic link for the project (it need to point to /web/ folder):
	mklink /D "C:/Apache24/htdocs/lancelivre" "F:/lancelivre/web"

In case the website throws an error about pdo_pgsql dll, download it and replace the one in the php root folder:
	https://www.dll-files.com/php_pdo_pgsql.dll.html
In case the website throws an error about libpq dll, download it and replace the one in the php root folder:
	https://www.dll-files.com/download/5c362d26f9fc1aad78af5d74084f6a86/libpq.dll.html?c=Nm5wMFFXSkJnbUZMY0l2akdsVzNpQT09

In Apache httpd.conf, inside tag  change to allowOverride to All:
	AllowOverride All

Then you should update the composer libs (on project directory):
	composer update

Edit the file config/db.php with real data, for example:
	return [
    	'class' => 'yii\db\Connection',
    	'dsn' => 'mysql:host=localhost;dbname=lancelivre',
    	'username' => 'root',
    	'password' => '',
    	'charset' => 'utf8',
	];

In Postgres, create a database named "lancelivre".
load the database dump:
	psql -U root -W -h localhost -f dump_db.sql lancelivre
	
No postgres, execute o comando SQL a seguir para poder criar a conexão com o banco:
	ALTER USER postgres WITH PASSWORD '1234';

Access website in:
	https://localhost/lancelivre/
