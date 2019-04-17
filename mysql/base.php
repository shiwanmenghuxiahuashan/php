<?php
/**封装的基础小功能 */
class base
{
    function __construct()
    {
        
    }
    public function isGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
    }
}
