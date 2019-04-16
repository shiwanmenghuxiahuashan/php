<?php

class Database
{
    private static $_instance;
    private static $parameters;
    private $_connection = null; //数据库连接对象
    private $DB_ini_path = './setup.ini';
    private $DB_driver = "mysql"; //数据库驱动类型

    /**
     * 初始化实例对象
     *
     * @return void
     */
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
    /**
     * 获取数据库连接对象
     *
     * @return void 
     */
    public function connect()
    {

        return $this->_connection ? $this->_connection : null;
    }
    /**
     * 查询query
     *
     * @return void 
     */
    public static function query()
    {
        print_r('query');
    }
    public static function Insert($tableName, $fields, $values)
    {
        self::$parameters = array();
        $stmt = "";
        $values = split(',', $values);
        foreach ($values as $key => $value) {
            $stmt .= "?,";
        }
        // string substr( string $string, int $start[, int $length] )
        //截取 0开始，字符串长度-1结束（其实就是去掉最后一位的 ","）
        $stmt = substr($stmt, 0, strlen($stmt) - 1);

        $sqlexe = "INSERT INTO " . $tableName . "(" . $fields . ") VALUES(" . $stmt . ")";
        // echo $sqlexe;

        $_instance = self::init();

        $dbh = $_instance->connect();
        //INSERT INTO user(name,age) VALUES(?,?,)
        $sth = $dbh->prepare($sqlexe);
        // //PDOStatement::execute — 执行一条预处理语句  bool PDOStatement::execute([ array $input_parameters] )
        $fact = $sth->execute($values);

        return $fact;
        /**
         * 什么是预处理语句？
         * 可以把它看作是想要运行的 SQL 的一种编译过的模板，它可以使用变量参数进行定制。预处理语句可以带来两大好处： 
         * 
         * 1.查询仅需解析（或预处理）一次，但可以用相同或不同的参数执行多次。当查询准备好后，数据库将分析、编译和优化执行该查询的计划。
         * 
         * 2.提供给预处理语句的参数不需要用引号括起来，驱动程序会自动处理。
         * 
         * （照搬手册里的）
         */
    }
}

// var_dump(Database::Insert('user', 'name,age', '李重楼,27'));
// //测试类是否可用
// $DB_instance = new Database(); //获取类实列

// $DB_connect = $DB_instance->connect();//获取数据库连接对象

// foreach($DB_connect->query('SELECT * from user') as $row) {
//     var_dump($row);
// }

// $DB_connect=null;//释放实例
