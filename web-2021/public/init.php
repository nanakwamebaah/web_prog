<?php
spl_autoload_register(function($class){
    require $class. '.php';
});
   //include "Database.php";
   define("DB_HOST", "db");
   define("DB_NAME", "web");
   define("DB_USER", "root");
   define("DB_PASS", "superpass321!");
   define("BASE_URL", "http://localhost:8080/");

   $validate = new Validate;
   $userObj = new User;

