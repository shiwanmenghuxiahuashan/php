<?php
/**封装的基础小功能 */
class Base
{
    function __construct()
    { }
    public static function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
    }
    public static function isPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST' ? true : false;
    }
    /**
     * 构建 mysql预处理语句占位符
     *
     * @return void '?,?'
     */
    public static function buildStmt($len = 0)
    {
        $stmt = str_repeat("?,", $len);
        // string substr( string $string, int $start[, int $length] )
        //截取 0开始，字符串长度-1结束（其实就是去掉最后一位的 ","）
        return substr($stmt, 0, strlen($stmt) - 1);
    }
    /**
     * 解析md5参数
     *
     * @return string
     */
    public static function md5($md5 = '')
    {
        $md5hash = parse_ini_file('./md5hash.ini'); //每次解析都读取ini貌似不太效率，先这么写着吧

        //从md5hash返回的字符串中截取真正使用表名和数据库名--最后一个索引是真正使用的
        //end() 将 array 的内部指针移动到最后一个单元并返回其值。 mixed end( array &$array)
        return end(split('_', $md5hash[$md5]));
    }
}
