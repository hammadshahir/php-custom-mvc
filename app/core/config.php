<?php
if($_SERVER['SERVER_NAME'] == 'localhost')
{
    define ('ROOT', 'http://localhost:8888/php/php-custom-mvc/public');
} else {
    define ('ROOT', 'https://www.YourWebsite.com');
}