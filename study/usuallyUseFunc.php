<?php
// PHP常用函数总结
header("Content-Type: text/html;charset=utf-8");
function logthis($v, $desc = "无描述")
{
    echo '<p>', $desc, ': ', $v, '</p><br/><br/><br/><br/>';
}
// 数学函数
// 1.abs(): 求绝对值
logthis(abs(-4), ' 求绝对值');

//  2.ceil(): 进一法取整 返回不小于 value 的下一个整数，value 如果有小数部分则进一位。 
logthis(ceil(9.4), ' 进一法取整');
 
// 3.floor(): 舍去法取整 浮点数直接舍去小数部分

logthis(floor(9.59), '舍去法取整'); 

// 4.fmod(): 浮点数取余

// 5.pow(): 返回数的n次方

logthis(pow(3, 2), '返回数的n次方'); // 1 基础数|n次方乘方值

// 6.round(): 浮点数四舍五入 一个数值|保留小数点后多少位,默认为 0 舍入后的结果

logthis(round(1.95583, 2), '浮点数四舍五入'); 

// 7.sqrt(): 求平方根

logthis(sqrt(9), '求平方根'); //3 被开方的数平方根

// 8.max(): 求最大值 数组也可
$maxArr = [1, 3, 5, 6, 7];

logthis(max($maxArr), '求最大值');// 7

// 9.min(1, 3, 5, 6, 7): 求最小值
logthis(min(1, 3, 5, 6, 7), '求最小值');

// 10.mt_rand(): 更好的随机数,mt_rand 的速度比 rand 快四倍 // 输入: 最小|最大, 输出: 随机数随机返回范围内的值 
logthis(mt_rand(0, 9), '更好的随机数');

// 11.rand(): 随机数 输入: 最小|最大, 输出: 随机数随机返回范围内的值
logthis(rand(0, 9), '随机数');

// 12.pi(): 获取圆周率值

logthis(pi(), 'π');

// 13.trim(): 删除字符串两端的空格或其他预定义字符
// 此函数返回字符串 str 去除首尾空白字符后的结果。如果不指定第二个参数，trim() 将去除这些字符： 
// ◦ " " (ASCII 32 (0x20))，普通空格符。  
// ◦ "\t" (ASCII 9 (0x09))，制表符。  
// ◦ "\n" (ASCII 10 (0x0A))，换行符。  
// ◦ "\r" (ASCII 13 (0x0D))，回车符。  
// ◦ "\0" (ASCII 0 (0x00))，空字节符。  
// ◦ "\x0B" (ASCII 11 (0x0B))，垂直制表符。 


logthis(trim('   去空格  '), '   \\n 去空格\\n             ');

// 14.rtrim(): 删除字符串右边的空格或其他预定义字符
// 15.chop(): rtrim()的别名
// 16.ltrim(): 删除字符串左边的空格或其他预定义字符

// 17.dirname(): 返回路径中的目录部分-就是不包含文件
logthis(dirname("c:/testweb/tests/home.php"), '返回路径中的目录部分');


// 18.str_pad(): 把字符串填充为指定的长度 输入: 要填充的字符串|新字符串的长度|供填充使用的字符串, 默认是空白
$str1111 = "Hello World";

logthis(str_pad($str1111, 20, "6"));

//19.str_repeat(): 重复使用指定字符串
logthis(str_repeat("烫", 100)); // 要重复的字符串|字符串将被重复的次数13个点

// 20.str_split(): 把字符串分割到数组中 输入: 要分割的字符串|每个数组元素的长度，默认1

var_dump(str_split("Hello", 3));

// 21.strrev(): 反转字符串  处理中文会有乱码

logthis(strrev("!dlroW olleH"), '反转字符-> !dlroW olleH'); // !dlroW olleH

//22.wordwrap(): 按照指定长度对字符串进行折行处理 这个要查看HTML源码才能看出来，打断字符串为指定数量的字串

$str2222 = "An example on a long word is:Supercalifragulistic";
echo (wordwrap($str2222, 5, '<br/>'));

// 23.str_shuffle(): 随机地打乱字符串中所有字符,输入: 目标字符串顺序 输出: 打乱后的字符串 不能处理中文

logthis(str_shuffle("Hello World"), '随机地打乱字符串中所有字符');

// 24.parse_str(): 将字符串解析成变量 输入 : 要解析的字符串 | 存储变量的数组名称

echo '<br/>';
parse_str("id=23&name=John%20Adams", $myArray);
print_r($myArray);//  输出 : 返回Array([id] => 23 [name] => John Adams
echo '<br/>';
//下面是V3的RUL参数
parse_str('seg=%7B"clvlid":"21","cbtid":"31","bcountryid":"101"%7D&time=2010,2018&drop=%7B"dropdown":"all","type":"pct"%7D', $v3arr);
echo '<br/>';

var_dump($v3arr);//成功解析为关联数组

$seg=json_decode($v3arr['seg']);//解析JSON字符串为对象
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
echo '<br/>';
var_dump($seg->clvlid);//转成对象后不能像关联数组那样调用值了！

// 25.number_format(): 通过千位分组来格式化数字 输入: 要格式化的数字|规定多少个小数|规定用作小数点的字符 串|规定用作千位分隔符的字符串
//输出: 1,000,000 1,000,000.00 1.000.000,00


logthis(number_format(123456,2,'百','千'));

// 26.strtolower(): 字符串转为小写 目标字符串 小写字符串

    logthis(strtolower("Hello WORLD!"),"字符串转为小写,Hello WORLD!->");


// 27.strtoupper(): 字符串转为大写 输出: 大写字符串
logthis(strtoupper("Hello WORLD!"),"字符串转为大写,Hello WORLD!->");


// 28.ucfirst(): 字符串首字母大写
logthis(ucfirst("hello world!"),"字符串首字母大写,hello world!->");

// 29.ucwords(): 字符串每个单词首字符转为大写
logthis(ucwords("hello world! test"),"字符串每个单词首字符转为大写,hello world!->");

// 30.htmlentities(): 把字符转为HTML实体  就是有标签的显示标签
$str3333 = "A 'quote' is bold";

logthis(htmlentities($str3333, ENT_COMPAT),'把字符转为HTML实体 '); // John & 'Adams'

// 31.htmlspecialchars(): 预定义字符转html编码 转义

// 32.nl2br(): \n转义为<br>标签
echo nl2br("\nOne line.\nAnother line.");

//33.strip_tags(): 剥去 HTML、XML 以及 PHP 的标签 获取纯text文本，去除评论 标签 
$text = '<p>Test paragraph.</p><!-- Comment --> <a href="#fragment">Other text</a>';
logthis(strip_tags($text),'剥去 HTML、XML 以及 PHP 的标签 获取纯text文本');//输出：Test paragraph. Other text
//他有第二个参数，allowable_tags 允许的标签
echo strip_tags($text, '<p><a>');//允许<p><a>
//https://www.jb51.net/article/101179.htm


// 允许 <p> 和 <a>
