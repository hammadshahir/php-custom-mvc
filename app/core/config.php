<?php
if($_SERVER['SERVER_NAME'] == 'localhost')
{
    /* Database defs. */
    define('DBNAME', 'php_mvc');
    define('DBHOST', 'localhost:8888');
    define('DBUSER', 'root');
    define('DBPASS', 'root');
    define('DBDRIVER', '');

    define ('ROOT', 'http://localhost:8888/php/php-custom-mvc/public');
} else {
    /* Database defs. */    
    define('DBNAME', 'php_mvc');
    define('DBHOST', 'localhost:8888');
    define('DBUSER', 'root');
    define('DBPASS', 'root');
    define('DBDRIVER', '');

    define ('ROOT', 'https://www.YourWebsite.com');

}

define('APP_NAME', 'HH MVC Framework in PHP');
define('APP_DESC', 'Web application created by cool Minimalist MVC in PHP');

// true means show errors. Change it to false when in production
define('DEBUG', true);

