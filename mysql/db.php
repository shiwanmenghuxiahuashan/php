<?php

class Database
{
    private static $_instance;
    private $_connection; //数据库连接对象
    private $DB_ini_path = './setup.ini';
    private $DB_driver = "mysql"; //数据库驱动类型

    public static function init()
    {
        try {
            if (is_null(self::$_instance) || empty(self::$_instance)) {
                self::$_instance = new self();
                return self::$_instance;
            } else {
                return self::$_instance;
            }
        } catch (Exception $e) {
            return self::class;
        }
    }

    function __construct()
    {
        echo '构造函数启用';

        $dbConfig = parse_ini_file($this->DB_ini_path);
        try {
            if (is_null($this->_connection) || empty($this->_connection)) {
                //注意$dbConfig中的数据不可以通过  ->  访问，要用  [key]  访问
                //数据库驱动类型:链接地址=host;数据库名：db,用户名，密码
                $this->_connection = new PDO($this->DB_driver . ':host=' . $dbConfig->host . ';dbname=' . $dbConfig['db'], $dbConfig['user'], $dbConfig['pwd']);
            }
        } catch (Exception $e) {
            $this->_connection = $e;
        }
    }

    public function connect()
    {
        return $this->_connection ? $this->_connection : null;
    }
    public function test()
    {
        print_r('test函数');
    }
}

//测试类是否可用
$DB_instance = new Database(); //获取类实列

$DB_connect = $DB_instance->connect();//获取数据库连接对象

foreach($DB_connect->query('SELECT * from user') as $row) {
    var_dump($row);
}

$DB_connect=null;//释放实例
