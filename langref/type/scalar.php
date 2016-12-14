<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-13
 * Time: 13:38
 */

/*
 * PHP 支持 8 种原始数据类型。
 * 四种标量类型
 * boolean（布尔型）
 * integer（整型）
 * float（浮点型，也称作 double)
 * string（字符串）
 * 两种复合类型：
 * array（数组）
 * object（对象）
 * 两种特殊类型：
 * resource（资源）
 * NULL（无类型）
 * 伪类型：
 * mixed（混合类型）
 * number（数字类型）
 * callback（回调类型）
 * 伪变量 $
 * 变量的类型通常不是由程序员设定的，确切地说，是由 PHP 根据该变量使用的上下文在运行时决定的。 // 弱类型语言
 * 如果想查看某个表达式的值和类型，用 var_dump() 函数。
 * 如果只是想得到一个易读懂的类型的表达方式用于调试，用 gettype() 函数。要查看某个类型，不要用 gettype()，而用 is_type 函数。
 */
/* boolean
 * 要明确地将一个值转换成 boolean，用 (bool) 或者 (boolean) 来强制转换。但是很多情况下不需要用强制转换，
 * 因为当运算符，函数或者流程控制结构需要一个 boolean 参数时，该值会被自动转换。
 * 参见类型转换的判别。
 * 当转换为 boolean 时，以下值被认为是 FALSE：
 * 布尔值 FALSE 本身
 * 整型值 0（零）
 * 浮点型值 0.0（零）
 * 空字符串，以及字符串 "0"
 * 不包括任何元素的数组
 * 不包括任何成员变量的对象（仅 PHP 4.0 适用）
 * 特殊类型 NULL（包括尚未赋值的变量）
 * 从空标记生成的 SimpleXML 对象
 * 所有其它值都被认为是 TRUE（包括任何资源）。
 */
var_dump((bool)"");    // bool(false)
var_dump((bool)1);     // bool(true)
var_dump((bool)-2);    // bool(true)
var_dump((bool)"foo");   // bool(true)
var_dump((bool)2.3e5);   // bool(true)
var_dump((bool)array(12)); // bool(true)
var_dump((bool)array());  // bool(false)
var_dump((bool)"false");  // bool(true)

/*
 * 整型值可以使用十进制，十六进制，八进制或二进制表示，前面可以加上可选的符号（- 或者 +）。
 * 要使用八进制表达，数字前必须加上 0（零）。要使用十六进制表达，数字前必须加上 0x。要使用二进制表达，数字前必须加上 0b。
 *
 */
$a = 1234; // 十进制数
$a = -123; // 负数
$a = 0123; // 八进制数 (等于十进制 83)
$a = 0x1A; // 十六进制数 (等于十进制 26)

/*
 * PHP 中没有整除的运算符。1/2 产生出 float 0.5。值可以舍弃小数部分强制转换为 integer，或者使用 round() 函数可以更好地进行四舍五入。
 */
var_dump(25 / 7);     // float(3.5714285714286) 
var_dump((int)(25 / 7)); // int(3)
var_dump(round(25 / 7)); // float(4) 

/*
 * 要明确地将一个值转换为 integer，用 (int) 或 (integer) 强制转换。不过大多数情况下都不需要强制转换，
 * 因为当运算符，函数或流程控制需要一个 integer 参数时，值会自动转换。还可以通过函数 intval() 来将一个值转换成整型。
 * boolean 类型：FALSE 将产生出 0（零），TRUE 将产生出 1（壹）。
 * 浮点数类型：转换成整数时，将向下取整
 */

/*
 * 浮点型（也叫浮点数 float，双精度数 double 或实数 real）可以用以下任一语法定义：
 */
$a = 1.234;
$b = 1.2e3;
$c = 7E-10;
/*
 * 比较浮点数：$a 和 $b 在小数点后五位精度内都是相等的。
 */
$a = 1.23456789;
$b = 1.23456780;
$epsilon = 0.00001;

if (abs($a - $b) < $epsilon) {
    echo "true";
}
/*
 * 某些数学运算会产生一个由常量 NAN 所代表的结果。此结果代表着一个在浮点数运算中未定义或不可表述的值。
 * 任何拿此值与其它任何值进行的松散或严格比较的结果都是 FALSE。
 * 由于 NAN 代表着任何不同值，不应拿 NAN 去和其它值进行比较，包括其自身，应该用 is_nan() 来检查。
 */

/*
 * 一个字符串 string 就是由一系列的字符组成，其中每个字符等同于一个字节。
 * 一个字符串可以用 4 种方式表达：
 * 单引号
 * 双引号
 * heredoc 语法结构
 * nowdoc 语法结构（自 PHP 5.3.0 起）
 *
 * 要表达一个单引号自身，需在它的前面加个反斜线（\）来转义。要表达一个反斜线自身，则用两个反斜线（\\）。
 * 其它任何方式的反斜线都会被当成反斜线本身：也就是说如果想使用其它转义序列例如 \r 或者 \n，并不代表任何特殊含义，就单纯是这两个字符本身。
 * 不像双引号和 heredoc 语法结构，在单引号字符串中的变量和特殊字符的转义序列将不会被替换。
 */
echo 'this is a simple string';

// 可以录入多行
echo 'You can also have embedded newlines in 
strings this way as it is
okay to do';

// 输出： Arnold once said: "I'll be back"
echo 'Arnold once said: "I\'ll be back"';

// 输出： You deleted C:\*.*?
echo 'You deleted C:\\*.*?';

// 输出： You deleted C:\*.*?
echo 'You deleted C:\*.*?';

// 输出： This will not expand: \n a newline
echo 'This will not expand: \n a newline';

// 输出： Variables do not $expand $either
echo 'Variables do not $expand $either';

/*
 * 如果字符串是包围在双引号（"）中， PHP 将对一些特殊的字符进行解析
 * 用双引号定义的字符串最重要的特征是变量会被解析
 * Heredoc 结构就象是没有使用双引号的双引号字符串
 * 就象 heredoc 结构类似于双引号字符串，Nowdoc 结构是类似于单引号字符串的
 *
 * 当字符串用双引号或 heredoc 结构定义时，其中的变量将会被解析。
 * 共有两种语法规则：一种简单规则，一种复杂规则。
 * 简单的语法规则是最常用和最方便的，它可以用最少的代码在一个 string 中嵌入一个变量，一个 array 的值，或一个 object 的属性。
 * 复杂规则语法的显著标记是用花括号包围的表达式。
 */
/*
 * 当 PHP 解析器遇到一个美元符号（$）时，它会和其它很多解析器一样，去组合尽量多的标识以形成一个合法的变量名。可以用花括号来明确变量名的界线。
 */
$juice = "apple";

echo "He drank some $juice juice." . PHP_EOL;
// Invalid. "s" is a valid character for a variable name, but the variable is $juice.
echo "He drank some juice made of $juices.";

/*
 * 类似的，一个 array 索引或一个 object 属性也可被解析。数组索引要用方括号（]）来表示索引结束的边际，对象属性则是和上述的变量规则相同。
 */
$juices = array("apple", "orange", "koolaid1" => "purple");

echo "He drank some $juices[0] juice." . PHP_EOL;
echo "He drank some $juices[1] juice." . PHP_EOL;
echo "He drank some juice made of $juice[0]s." . PHP_EOL; // Won't work
echo "He drank some $juices[koolaid1] juice." . PHP_EOL;

class people
{
    public $john = "John Smith";
    public $jane = "Jane Smith";
    public $robert = "Robert Paulsen";
    public $smith = "Smith";
}

$people = new people();

echo "$people->john drank some $juices[0] juice." . PHP_EOL;
echo "$people->john then said hello to $people->jane." . PHP_EOL;
echo "$people->john's wife greeted $people->robert." . PHP_EOL;
echo "$people->robert greeted the two $people->smiths."; // Won't work

/*
 * 复杂（花括号）语法
 * 任何具有 string 表达的标量变量，数组单元或对象属性都可使用此语法。
 * 只需简单地像在 string 以外的地方那样写出表达式，然后用花括号 { 和 } 把它括起来即可。
 * 由于 { 无法被转义，只有 $ 紧挨着 { 时才会被识别。可以用 {\$ 来表达 {$。
 */
// 显示所有错误
error_reporting(E_ALL);

$great = 'fantastic';

// 无效，输出: This is { fantastic}
echo "This is { $great}";

// 有效，输出： This is fantastic
echo "This is {$great}";
echo "This is ${great}";

// 有效
echo "This square is {$square->width}00 centimeters broad.";

// 有效，只有通过花括号语法才能正确解析带引号的键名
echo "This works: {$arr['key']}";

// 有效
echo "This works: {$arr[4][3]}";

// 这是错误的表达式，因为就象 $foo[bar] 的格式在字符串以外也是错的一样。
// 换句话说，只有在 PHP 能找到常量 foo 的前提下才会正常工作；这里会产生一个
// E_NOTICE (undefined constant) 级别的错误。
echo "This is wrong: {$arr[foo][3]}";

// 有效，当在字符串中使用多重数组时，一定要用括号将它括起来
echo "This works: {$arr['foo'][3]}";

// 有效
echo "This works: " . $arr['foo'][3];

echo "This works too: {$obj->values[3]->name}";

echo "This is the value of the var named $name: {${$name}}";

echo "This is the value of the var named by the return value of getName(): {${getName()}}";

echo "This is the value of the var named by the return value of \$object->getName(): {${$object->getName()}}";

// 无效，输出： This is the return value of getName(): {getName()}
echo "This is the return value of getName(): {getName()}";

/*
 * 也可以在字符串中用此语法通过变量来调用类的属性。
 */

class foo
{
    var $bar = 'I am bar.';
}

$foo = new foo();
$bar = 'bar';
$baz = array('foo', 'bar', 'baz', 'quux');
echo "{$foo->$bar}\n";
echo "{$foo->$baz[1]}\n";

/*
 * 存取和修改字符串中的字符
 * string 中的字符可以通过一个从 0 开始的下标，用类似 array 结构中的方括号包含对应的数字来访问和修改，
 * 比如 $str[42]。可以把 string 当成字符组成的 array。函数 substr() 和 substr_replace() 可用于操作多于一个字符的情况。
 * 字符串示例
 */
// 取得字符串的第一个字符
$str = 'This is a test.';
$first = $str[0];

// 取得字符串的第三个字符
$third = $str[2];

// 取得字符串的最后一个字符
$str = 'This is still a test.';
$last = $str[strlen($str) - 1];

// 修改字符串的最后一个字符
$str = 'Look at the sea';
$str[strlen($str) - 1] = 'e';

/*
 * 用 [] 或 {} 访问任何其它类型（不包括数组或具有相应接口的对象实现）的变量只会无声地返回 NULL
 */

/*
 * 字符串 函数
addcslashes — 以 C 语言风格使用反斜线转义字符串中的字符
addslashes — 使用反斜线引用字符串
bin2hex — 函数把包含数据的二进制字符串转换为十六进制值
chop — rtrim 的别名
chr — 返回指定的字符
chunk_split — 将字符串分割成小块
convert_cyr_string — 将字符由一种 Cyrillic 字符转换成另一种
convert_uudecode — 解码一个 uuencode 编码的字符串
convert_uuencode — 使用 uuencode 编码一个字符串
count_chars — 返回字符串所用字符的信息
crc32 — 计算一个字符串的 crc32 多项式
crypt — 单向字符串散列
echo — 输出一个或多个字符串
explode — 使用一个字符串分割另一个字符串
fprintf — 将格式化后的字符串写入到流
get_html_translation_table — 返回使用 htmlspecialchars 和 htmlentities 后的转换表
hebrev — 将逻辑顺序希伯来文（logical-Hebrew）转换为视觉顺序希伯来文（visual-Hebrew）
hebrevc — 将逻辑顺序希伯来文（logical-Hebrew）转换为视觉顺序希伯来文（visual-Hebrew），并且转换换行符
hex2bin — 转换十六进制字符串为二进制字符串
html_entity_decode — Convert all HTML entities to their applicable characters
htmlentities — Convert all applicable characters to HTML entities
htmlspecialchars_decode — 将特殊的 HTML 实体转换回普通字符
htmlspecialchars — Convert special characters to HTML entities
implode — 将一个一维数组的值转化为字符串
join — 别名 implode
lcfirst — 使一个字符串的第一个字符小写
levenshtein — 计算两个字符串之间的编辑距离
localeconv — Get numeric formatting information
ltrim — 删除字符串开头的空白字符（或其他字符）
md5_file — 计算指定文件的 MD5 散列值
md5 — 计算字符串的 MD5 散列值
metaphone — Calculate the metaphone key of a string
money_format — 将数字格式化成货币字符串
nl_langinfo — Query language and locale information
nl2br — 在字符串所有新行之前插入 HTML 换行标记
number_format — 以千位分隔符方式格式化一个数字
ord — 返回字符的 ASCII 码值
parse_str — 将字符串解析成多个变量
print — 输出字符串
printf — 输出格式化字符串
quoted_printable_decode — 将 quoted-printable 字符串转换为 8-bit 字符串
quoted_printable_encode — 将 8-bit 字符串转换成 quoted-printable 字符串
quotemeta — 转义元字符集
rtrim — 删除字符串末端的空白字符（或者其他字符）
setlocale — 设置地区信息
sha1_file — 计算文件的 sha1 散列值
sha1 — 计算字符串的 sha1 散列值
similar_text — 计算两个字符串的相似度
soundex — Calculate the soundex key of a string
sprintf — Return a formatted string
sscanf — 根据指定格式解析输入的字符
str_getcsv — 解析 CSV 字符串为一个数组
str_ireplace — str_replace 的忽略大小写版本
str_pad — 使用另一个字符串填充字符串为指定长度
str_repeat — 重复一个字符串
str_replace — 子字符串替换
str_rot13 — 对字符串执行 ROT13 转换
str_shuffle — 随机打乱一个字符串
str_split — 将字符串转换为数组
str_word_count — 返回字符串中单词的使用情况
strcasecmp — 二进制安全比较字符串（不区分大小写）
strchr — 别名 strstr
strcmp — 二进制安全字符串比较
strcoll — 基于区域设置的字符串比较
strcspn — 获取不匹配遮罩的起始子字符串的长度
strip_tags — 从字符串中去除 HTML 和 PHP 标记
stripcslashes — 反引用一个使用 addcslashes 转义的字符串
stripos — 查找字符串首次出现的位置（不区分大小写）
stripslashes — 反引用一个引用字符串
stristr — strstr 函数的忽略大小写版本
strlen — 获取字符串长度
strnatcasecmp — 使用“自然顺序”算法比较字符串（不区分大小写）
strnatcmp — 使用自然排序算法比较字符串
strncasecmp — 二进制安全比较字符串开头的若干个字符（不区分大小写）
strncmp — 二进制安全比较字符串开头的若干个字符
strpbrk — 在字符串中查找一组字符的任何一个字符
strpos — 查找字符串首次出现的位置
strrchr — 查找指定字符在字符串中的最后一次出现
strrev — 反转字符串
strripos — 计算指定字符串在目标字符串中最后一次出现的位置（不区分大小写）
strrpos — 计算指定字符串在目标字符串中最后一次出现的位置
strspn — 计算字符串中全部字符都存在于指定字符集合中的第一段子串的长度。
strstr — 查找字符串的首次出现
strtok — 标记分割字符串
strtolower — 将字符串转化为小写
strtoupper — 将字符串转化为大写
strtr — 转换指定字符
substr_compare — 二进制安全比较字符串（从偏移位置比较指定长度）
substr_count — 计算字串出现的次数
substr_replace — 替换字符串的子串
substr — 返回字符串的子串
trim — 去除字符串首尾处的空白字符（或者其他字符）
ucfirst — 将字符串的首字母转换为大写
ucwords — 将字符串中每个单词的首字母转换为大写
vfprintf — 将格式化字符串写入流
vprintf — 输出格式化字符串
vsprintf — 返回格式化字符串
wordwrap — 打断字符串为指定数量的字串
 */

/*
 * url 函数
base64_decode — 对使用 MIME base64 编码的数据进行解码
base64_encode — 使用 MIME base64 对数据进行编码
get_headers — 取得服务器响应一个 HTTP 请求所发送的所有标头
get_meta_tags — 从一个文件中提取所有的 meta 标签 content 属性，返回一个数组
http_build_query — 生成 URL-encode 之后的请求字符串
parse_url — 解析 URL，返回其组成部分
rawurldecode — 对已编码的 URL 字符串进行解码
rawurlencode — 按照 RFC 3986 对 URL 进行编码
urldecode — 解码已编码的 URL 字符串
urlencode — 编码 URL 字符串
 */

/*
 * 也有加密／解密字符串的函数（mcrypt 和 mhash）。
 */
/*
 * 两个字符串（string）运算符。第一个是连接运算符（“.”），它返回其左右参数连接后的字符串。
 * 第二个是连接赋值运算符（“.=”），它将右边参数附加到左边的参数之后。
 */
/*
 * 转换成字符串
 *
 * 一个值可以通过在其前面加上 (string) 或用 strval() 函数来转变成字符串。在一个需要字符串的表达式中，会自动转换为 string。
 * 比如在使用函数 echo 或 print 时，或在一个变量和一个 string 进行比较时，就会发生这种转换。
 * 类型和类型转换可以更好的解释下面的事情，也可参考函数 settype()。
 *
 * 一个布尔值 boolean 的 TRUE 被转换成 string 的 "1"。Boolean 的 FALSE 被转换成 ""（空字符串）。
 * 这种转换可以在 boolean 和 string 之间相互进行。
 *
 * 一个整数 integer 或浮点数 float 被转换为数字的字面样式的 string（包括 float 中的指数部分）。
 * 使用指数计数法的浮点数（4.1E+6）也可转换。
 *
 * 数组 array 总是转换成字符串 "Array"，因此，echo 和 print 无法显示出该数组的内容。
 * 要显示某个单元，可以用 echo $arr['foo'] 这种结构。要显示整个数组内容见下文。
 *
 * 在 PHP 4 中对象 object 总是被转换成字符串 "Object"，如果为了调试原因需要打印出对象的值，请继续阅读下文。
 * 为了得到对象的类的名称，可以用 get_class() 函数。自 PHP 5 起，适当时可以用 __toString 方法。
 *
 * 资源 resource 总会被转变成 "Resource id #1" 这种结构的字符串，其中的 1 是 PHP 在运行时分配给该 resource 的唯一值。
 * 不要依赖此结构，可能会有变更。要得到一个 resource 的类型，可以用函数 get_resource_type()。
 *
 * NULL 总是被转变成空字符串。
 *
 * 如上面所说的，直接把 array，object 或 resource 转换成 string 不会得到除了其类型之外的任何有用信息。
 * 可以使用函数 print_r() 和 var_dump() 列出这些类型的内容。
 *
 * 大部分的 PHP 值可以转变成 string 来永久保存，这被称作串行化，可以用函数 serialize() 来实现。
 * 如果 PHP 引擎设定支持 WDDX，PHP 值也可被串行化为格式良好的 XML 文本。
 */

/*
 * 字符串转换为数值
 * 如果该字符串没有包含 '.'，'e' 或 'E' 并且其数字值在整型的范围之内（由 PHP_INT_MAX 所定义），
 * 该字符串将被当成 integer 来取值。其它所有情况下都被作为 float 来取值。
 * 该字符串的开始部分决定了它的值。如果该字符串以合法的数值开始，则使用该数值。否则其值为 0（零）。
 * 合法数值由可选的正负号，后面跟着一个或多个数字（可能有小数点），再跟着可选的指数部分。指数部分由 'e' 或 'E' 后面跟着一个或多个数字构成。
 */
$foo = 1 + "10.5";        // $foo is float (11.5)
$foo = 1 + "-1.3e3";       // $foo is float (-1299)
$foo = 1 + "bob-1.3e3";      // $foo is integer (1)
$foo = 1 + "bob3";        // $foo is integer (1)
$foo = 1 + "10 Small Pigs";    // $foo is integer (11)
$foo = 4 + "10.2 Little Piggies"; // $foo is float (14.2)
$foo = "10.0 pigs " + 1;     // $foo is float (11)
$foo = "10.0 pigs " + 1.0;    // $foo is float (11)     
