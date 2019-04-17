class base{
public function isGet(){
return $_SERVER['REQUEST_METHOD'] == 'GET' ? true : false;
}
}