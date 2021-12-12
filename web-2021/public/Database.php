<?php

class Database extends PDO{
    protected static $instance;

    public function __construct(){
        parent::__construct("mysql:host=".DB_HOST."; dbname=".DB_NAME,  DB_USER, DB_PASS,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $this->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    public static function instance(){
        if(self::$instance == null){
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __call($method, $args){
        call_user_func_array(array($this->pdo,$method), $args);
    }
}