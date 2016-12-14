<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-13
 * Time: 17:56
 */

/*
 * 变量
 */
/*
 * 基础
 * PHP 中的变量用一个美元符号后面跟变量名来表示。变量名是区分大小写的。
 * 变量名与 PHP 中其它的标签一样遵循相同的规则。
 * 一个有效的变量名由字母或者下划线开头，后面跟上任意数量的字母，数字，或者下划线。
 * 按照正常的正则表达式，它将被表述为：'[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*'。
 * 在此所说的字母是 a-z，A-Z，以及 ASCII 字符从 127 到 255（0x7f-0xff）。
 * $this 是一个特殊的变量，它不能被赋值。
 */
/*
 * 变量 函数
boolval — 获取变量的布尔值
debug_zval_dump — Dumps a string representation of an internal zend value to output
doubleval — floatval 的别名
empty — 检查一个变量是否为空
floatval — 获取变量的浮点值
get_defined_vars — 返回由所有已定义变量所组成的数组
get_resource_type — 返回资源（resource）类型
gettype — 获取变量的类型
import_request_variables — 将 GET／POST／Cookie 变量导入到全局作用域中
intval — 获取变量的整数值
is_array — 检测变量是否是数组
is_bool — 检测变量是否是布尔型
is_callable — 检测参数是否为合法的可调用结构
is_double — is_float 的别名
is_float — 检测变量是否是浮点型
is_int — 检测变量是否是整数
is_integer — is_int 的别名
is_long — is_int 的别名
is_null — 检测变量是否为 NULL
is_numeric — 检测变量是否为数字或数字字符串
is_object — 检测变量是否是一个对象
is_real — is_float 的别名
is_resource — 检测变量是否为资源类型
is_scalar — 检测变量是否是一个标量
is_string — 检测变量是否是字符串
isset — 检测变量是否设置
print_r — 打印关于变量的易于理解的信息。
serialize — 产生一个可存储的值的表示
settype — 设置变量的类型
strval — 获取变量的字符串值
unserialize — 从已存储的表示中创建 PHP 的值
unset — 释放给定的变量
var_dump — 打印变量的相关信息
var_export — 输出或返回一个变量的字符串表示
 */
$var = 'Bob';
$Var = 'Joe';
echo "$var, $Var";      // 输出 "Bob, Joe"

//$4site = 'not yet';     // 非法变量名；以数字开头
$_4site = 'not yet';    // 合法变量名；以下划线开头
$i站点is = 'mansikka';   // 合法变量名；可以用中文

/*
 * 变量默认总是传值赋值。那也就是说，当将一个表达式的值赋予一个变量时，整个原始表达式的值被赋值到目标变量。
 * 这意味着，例如，当一个变量的值赋予另外一个变量时，改变其中一个变量的值，将不会影响到另外一个变量。
 * 有关这种类型的赋值操作，请参阅表达式一章。
 * http://php.net/manual/zh/language.expressions.php
 *
 * PHP 也提供了另外一种方式给变量赋值：引用赋值。这意味着新的变量简单的引用（换言之，“成为其别名” 或者 “指向”）了原始变量。
 * 改动新的变量将影响到原始变量，反之亦然。
 * 使用引用赋值，简单地将一个 & 符号加到将要赋值的变量前（源变量）。例如，下列代码片断将输出“My name is Bob”两次：
 */
$foo = 'Bob';              // 将 'Bob' 赋给 $foo
$bar = &$foo;              // 通过 $bar 引用 $foo
$bar = "My name is $bar";  // 修改 $bar 变量
echo $bar;
echo $foo;                 // $foo 的值也被修改

/*
 * 有一点重要事项必须指出，那就是只有有名字的变量才可以引用赋值。
 */
$foo = 25;
$bar = &$foo;      // 合法的赋值
//$bar = &(24 * 7);  // 非法; 引用没有名字的表达式

function test()
{
    return 25;
}

//$bar = &test();// 非法

/*
 * 虽然在 PHP 中并不需要初始化变量，但对变量进行初始化是个好习惯。
 * 未初始化的变量具有其类型的默认值 - 布尔类型的变量默认值是 FALSE，
 * 整形和浮点型变量默认值是零，字符串型变量（例如用于 echo 中）默认值是空字符串以及数组变量的默认值是空数组。
 * 未初始化变量的默认值
 */
// Unset AND unreferenced (no use context) variable; outputs NULL
//var_dump($unset_var);

// Boolean usage; outputs 'false' (See ternary operators for more on this syntax)
//echo($unset_bool ? "true\n" : "false\n");

// String usage; outputs 'string(3) "abc"'
//$unset_str .= 'abc';
//var_dump($unset_str);

// Integer usage; outputs 'int(25)'
//$unset_int += 25; // 0 + 25 => 25
//var_dump($unset_int);

// Float/double usage; outputs 'float(1.25)'
//$unset_float += 1.25;
//var_dump($unset_float);

// Array usage; outputs array(1) {  [3]=>  string(3) "def" }
$unset_arr[3] = "def"; // array() + array(3 => "def") => array(3 => "def")
var_dump($unset_arr);

// Object usage; creates new stdClass object (see http://www.php.net/manual/en/reserved.classes.php)
// Outputs: object(stdClass)#1 (1) {  ["foo"]=>  string(3) "bar" }
//$unset_obj->foo = 'bar';
//var_dump($unset_obj);

/*
 * 依赖未初始化变量的默认值在某些情况下会有问题，例如把一个文件包含到另一个之中时碰上相同的变量名。
 * 另外把 register_globals 打开是一个主要的安全隐患。
 * 使用未初始化的变量会发出 E_NOTICE 错误，但是在向一个未初始化的数组附加单元时不会。
 * isset() 语言结构可以用来检测一个变量是否已被初始化。
 */

/*
 * 预定义变量
 * PHP 提供了大量的预定义变量。由于许多变量依赖于运行的服务器的版本和设置，及其它因素，所以并没有详细的说明文档。
 * 一些预定义变量在 PHP 以命令行形式运行时并不生效。有关这些变量的详细列表，请参阅预定义变量一章。
 * http://php.net/manual/zh/reserved.variables.php
 *
 * PHP 4.2.0 以及后续版本中，PHP 指令 register_globals 的默认值为 off。这是 PHP 的一个主要变化。
 * 让 register_globals 的值为 off 将影响到预定义变量集在全局范围内的有效性。
 * 例如，为了得到 DOCUMENT_ROOT 的值，将必须使用 $_SERVER['DOCUMENT_ROOT'] 代替 $DOCUMENT_ROOT，
 * 又如，使用 $_GET['id'] 来代替 $id 从 URL http://www.example.com/test.php?id=3 中获取 id 值，
 * 亦或使用 $_ENV['HOME'] 来代替 $HOME 获取环境变量 HOME 的值。
 * 更多相关信息，请阅读 register_globals 的配置项条目，安全一章中的使用 Register Globals，以及 PHP » 4.1.0 和 » 4.2.0 的发布公告。
 * 如果有可用的 PHP 预定义变量那最好用，如超全局数组。
 *
 * 从 PHP 4.1.0 开始，PHP 提供了一套附加的预定数组，这些数组变量包含了来自 web 服务器（如果可用），运行环境，和用户输入的数据。
 * 这些数组非常特别，它们在全局范围内自动生效，例如，在任何范围内自动生效。
 * 因此通常被称为自动全局变量（autoglobals）或者超全局变量（superglobals）。
 * （PHP 中没有用户自定义超全局变量的机制。）超全局变量罗列于下文中；
 * 但是为了得到它们的内容和关于 PHP 预定义变量的进一步的讨论以及它们的本质，请参阅预定义变量。
 * 而且，你也将注意到旧的预定义数组（$HTTP_*_VARS）仍旧存在。
 * 自 PHP 5.0.0 起, 用 register_long_arrays 设置选项可禁用 长类型的 PHP 预定义变量数组。
 *
 * 超级全局变量不能被用作函数或类方法中的可变变量
 *
 * 尽管超全局变量和 HTTP_*_VARS 同时存在，但是它们并不是同一个变量，所以改变其中一个的值并不会对另一个产生影响
 *
 * 如果某些 variables_order 中的变量没有设定，它们的对应的 PHP 预定义数组也是空的
 */

/*
 * 变量范围
 * 变量的范围即它定义的上下文背景（也就是它的生效范围）。大部分的 PHP 变量只有一个单独的范围。
 * 这个单独的范围跨度同样包含了 include 和 require 引入的文件。例如：
 */
$a = 1;
//include 'b.inc';
/*
 * 这里变量 $a 将会在包含文件 b.inc 中生效。但是，在用户自定义函数中，一个局部函数范围将被引入。
 * 任何用于函数内部的变量按缺省情况将被限制在局部函数范围内。例如：
 */
$a = 1; /* global scope */

function Test1()
{
    //echo $a; /* reference to local scope variable */
}

Test1();
/*
 * 这个脚本不会有任何输出，因为 echo 语句引用了一个局部版本的变量 $a，而且在这个范围内，它并没有被赋值。
 * 你可能注意到 PHP 的全局变量和 C 语言有一点点不同，在 C 语言中，全局变量在函数中自动生效，除非被局部变量覆盖。
 * 这可能引起一些问题，有些人可能不小心就改变了一个全局变量。PHP 中全局变量在函数中使用时必须声明为 global。
 */

/*
 * global 关键字
 * 使用 global
 */
$a = 1;
$b = 2;

function Sum()
{
    global $a, $b;

    $b = $a + $b;
}

Sum();
echo $b;
/*
 * 以上脚本的输出将是“3”。在函数中声明了全局变量 $a 和 $b 之后，对任一变量的所有引用都会指向其全局版本。
 * 对于一个函数能够声明的全局变量的最大个数，PHP 没有限制。
 * 在全局范围内访问变量的第二个办法，是用特殊的 PHP 自定义 $GLOBALS 数组。前面的例子可以写成：
 * 使用 $GLOBALS 替代 global
 */
$a = 1;
$b = 2;

function Sum1()
{
    $GLOBALS['b'] = $GLOBALS['a'] + $GLOBALS['b'];
}

Sum1();
echo $b;
/*
 * $GLOBALS 是一个关联数组，每一个变量为一个元素，键名对应变量名，值对应变量的内容。
 * $GLOBALS 之所以在全局范围内存在，是因为 $GLOBALS 是一个超全局变量。以下范例显示了超全局变量的用处：
 * 演示超全局变量和作用域的例子
 */
function test_global()
{
    // 大多数的预定义变量并不 "super"，它们需要用 'global' 关键字来使它们在函数的本地区域中有效。
    global $HTTP_POST_VARS;

    echo $HTTP_POST_VARS['name'];

    // Superglobals 在任何范围内都有效，它们并不需要 'global' 声明。Superglobals 是在 PHP 4.1.0 引入的。
    echo $_POST['name'];
}

/*
 * 使用静态变量
 * 变量范围的另一个重要特性是静态变量（static variable）。静态变量仅在局部函数域中存在，但当程序执行离开此作用域时，其值并不丢失。
 * 看看下面的例子：
 */
function Test2()
{
    $a = 0;
    echo $a;
    $a++;
}

/*
 * 本函数没什么用处，因为每次调用时都会将 $a 的值设为 0 并输出 0。将变量加一的 $a++ 没有作用，因为一旦退出本函数则变量 $a 就不存在了。
 * 要写一个不会丢失本次计数值的计数函数，要将变量 $a 定义为静态的：
 */
function test3()
{
    static $a = 0;
    echo $a;
    $a++;
}

/*
 * 现在，变量 $a 仅在第一次调用 test() 函数时被初始化，之后每次调用 test() 函数都会输出 $a 的值并加一。
 * 静态变量也提供了一种处理递归函数的方法。递归函数是一种调用自己的函数。
 * 写递归函数时要小心，因为可能会无穷递归下去。必须确保有充分的方法来中止递归。
 * 以下这个简单的函数递归计数到 10，使用静态变量 $count 来判断何时停止：
 */
function test4()
{
    static $count = 0;

    $count++;
    echo $count;
    if ($count < 10) {
        test4();
    }
    $count--;
}

test4();
/*
 * 静态变量可以按照上面的例子声明。如果在声明中用表达式的结果对其赋值会导致解析错误
 * 声明静态变量
 */
function foo()
{
    static $int = 0;          // correct
    // static $int = 1+2;        // wrong  (as it is an expression)
    // static $int = sqrt(121);  // wrong  (as it is an expression too)

    $int++;
    echo $int;
}

/*
 * 静态声明是在编译时解析的。
 * 在函数之外使用 global 关键字不算错。可以用于在一个函数之内包含文件时。
 */
/*
 * 全局和静态变量的引用
 * 在 Zend 引擎 1 代，它驱动了 PHP4，对于变量的 static 和 global 定义是以引用的方式实现的。
 * 例如，在一个函数域内部用 global 语句导入的一个真正的全局变量实际上是建立了一个到全局变量的引用。
 * 这有可能导致预料之外的行为，如以下例子所演示的：
 */
function test_global_ref()
{
    global $obj;
    $obj = &new stdclass;
}

function test_global_noref()
{
    global $obj;
    $obj = new stdclass;
}

test_global_ref();
var_dump($obj);
test_global_noref();
var_dump($obj);
/*
 * 类似的行为也适用于 static 语句。引用并不是静态地存储的：
 */
function &get_instance_ref()
{
    static $obj;

    echo 'Static object: ';
    var_dump($obj);
    if (!isset($obj)) {
        // 将一个引用赋值给静态变量
        $obj = &new stdclass;
    }
    $obj->property++;
    return $obj;
}

function &get_instance_noref()
{
    static $obj;

    echo 'Static object: ';
    var_dump($obj);
    if (!isset($obj)) {
        // 将一个对象赋值给静态变量
        $obj = new stdclass;
    }
    $obj->property++;
    return $obj;
}

$obj1 = get_instance_ref();
$still_obj1 = get_instance_ref();
echo "\n";
$obj2 = get_instance_noref();
$still_obj2 = get_instance_noref();

/*
 * 可变变量
 * 有时候使用可变变量名是很方便的。就是说，一个变量的变量名可以动态的设置和使用。一个普通的变量通过声明来设置，例如：
 */
$a = 'hello';

/*
 * 一个可变变量获取了一个普通变量的值作为这个可变变量的变量名。
 * 在上面的例子中 hello 使用了两个美元符号（$）以后，就可以作为一个可变变量的变量了。例如：
 */
$$a = 'world';
/*
 * 这时，两个变量都被定义了：$a 的内容是“hello”并且 $hello 的内容是“world”。因此，以下语句：
 */
echo "$a ${$a}";
// 与以下语句输出完全相同的结果：
echo "$a $hello";
//它们都会输出：hello world。

/*
 * 要将可变变量用于数组，必须解决一个模棱两可的问题。
 * 这就是当写下 $$a[1] 时，解析器需要知道是想要 $a[1] 作为一个变量呢，还是想要 $$a 作为一个变量并取出该变量中索引为 [1] 的值。
 * 解决此问题的语法是，对第一种情况用 ${$a[1]}，对第二种情况用 ${$a}[1]。
 * 类的属性也可以通过可变属性名来访问。可变属性名将在该调用所处的范围内被解析。
 * 例如，对于 $foo->$bar 表达式，则会在本地范围来解析 $bar 并且其值将被用于 $foo 的属性名。
 * 对于 $bar 是数组单元时也是一样。
 * 也可使用花括号来给属性名清晰定界。
 * 最有用是在属性位于数组中，或者属性名包含有多个部分或者属性名包含有非法字符时（例如来自 json_decode() 或 SimpleXML）。
 */

/*
 * 可变属性示例
 */

class foo
{
    var $bar = 'I am bar.';
    var $arr = array('I am A.', 'I am B.', 'I am C.');
    var $r = 'I am r.';
}

$foo = new foo();
$bar = 'bar';
$baz = array('foo', 'bar', 'baz', 'quux');
echo $foo->$bar . "\n";
echo $foo->$baz[1] . "\n";

$start = 'b';
$end = 'ar';
echo $foo->{$start . $end} . "\n";

$arr = 'arr';
echo $foo->$arr[1] . "\n";
echo $foo->{$arr}[1] . "\n";

/*
 * 注意，在 PHP 的函数和类的方法中，超全局变量不能用作可变变量。$this 变量也是一个特殊变量，不能被动态引用
 */

/*
 * 来自 PHP 之外的变量
 *
 * HTML 表单（GET 和 POST）
 * 当一个表单提交给 PHP 脚本时，表单中的信息会自动在脚本中可用。有很多方法访问此信息，例如：
 * 一个简单的 HTML 表单
 */
?>
    <form action="foo.php" method="POST">
        Name: <input type="text" name="username"><br/>
        Email: <input type="text" name="email"><br/>
        <input type="submit" name="submit" value="Submit me!"/>
    </form>
<?php
/*
 * 根据特定的设置和个人的喜好，有很多种方法访问 HTML 表单中的数据。例如：
 * 从一个简单的 POST HTML 表单访问数据
 */
// 自 PHP 4.1.0 起可用
echo $_POST['username'];
echo $_REQUEST['username'];

import_request_variables('p', 'p_');
echo $p_username;

// 自 PHP 5.0.0 起，这些长格式的预定义变量
// 可用 register_long_arrays 指令关闭。

echo $HTTP_POST_VARS['username'];

// 如果 PHP 指令 register_globals = on 时可用。不过自
// PHP 4.2.0 起默认值为 register_globals = off。
// 不提倡使用/依赖此种方法。

echo $username;
/*
 * 使用 GET 表单也类似，只不过要用适当的 GET 预定义变量。GET 也适用于 QUERY_STRING（URL 中在“?”之后的信息）。
 * 因此，举例说，http://www.example.com/test.php?id=3 包含有可用 $_GET['id'] 来访问的 GET 数据。
 * 参见 $_REQUEST 和 import_request_variables()。
 */
/*
 * 超全局数组例如 $_POST 和 $_GET，自 PHP 4.1.0 起可用。
 * 变量名中的点和空格被转换成下划线。例如 <input name="a.b" /> 变成了 $_REQUEST["a_b"]。
 * 如上所示，在 PHP 4.2.0 之前 register_globals 的默认值是 on。PHP 社区鼓励大家不要依赖此指令，建议在编码时假定其为 off。
 *
 * magic_quotes_gpc 配置指令影响到 Get，Post 和 Cookie 的值。如果打开，值 (It's "PHP!") 会自动转换成 (It\'s \"PHP!\")。
 * 十多年前对数据库的插入需要如此转义，如今已经过时了，应该关闭。参见 addslashes()，stripslashes() 和 magic_quotes_sybase。
 *
 * PHP 也懂得表单变量上下文中的数组（参见相关常见问题）。
 * 例如可以将相关的变量编成组，或者用此特性从多选输入框中取得值。例如，将一个表单 POST 给自己并在提交时显示数据：
 * 更复杂的表单变量
 */
if (isset($_POST['action']) && $_POST['action'] == 'submitted') {
    echo '<pre>';

    print_r($_POST);
    echo '<a href="' . $_SERVER['PHP_SELF'] . '">Please try again</a>';

    echo '</pre>';
} else {
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        Name: <input type="text" name="personal[name]"><br/>
        Email: <input type="text" name="personal[email]"><br/>
        Beer: <br>
        <select multiple name="beer[]">
            <option value="warthog">Warthog</option>
            <option value="guinness">Guinness</option>
            <option value="stuttgarter">Stuttgarter Schwabenbr</option>
        </select><br/>
        <input type="hidden" name="action" value="submitted"/>
        <input type="submit" name="submit" value="submit me!"/>
    </form>
    <?php
}
?>
<?php
/*
 * IMAGE SUBMIT 变量名
 * 当提交表单时，可以用一幅图像代替标准的提交按钮，用类似这样的标记：
 */
?>
    <input type="image" src="image.gif" name="sub"/>
<?php
/*
 * 当用户点击到图像中的某处时，相应的表单会被传送到服务器，并加上两个变量 sub_x 和 sub_y。它们包含了用户点击图像的坐标。
 * 有经验的用户可能会注意到被浏览器发送的实际变量名包含的是一个点而不是下划线（即 sub.x 和 sub.y），但 PHP 自动将点转换成了下划线。
 *
 * HTTP Cookies
 * PHP 透明地支持 » RFC 6265定义中的 HTTP cookies。
 * Cookies 是一种在远端浏览器端存储数据并能追踪或识别再次访问的用户的机制。
 * 可以用 setcookie() 函数设定 cookies。
 * Cookies 是 HTTP 信息头中的一部分，因此 SetCookie 函数必须在向浏览器发送任何输出之前调用。
 * 对于 header() 函数也有同样的限制。
 * Cookie 数据会在相应的 cookie 数据数组中可用，例如 $_COOKIE，$HTTP_COOKIE_VARS 和 $_REQUEST。
 * 更多细节和例子见 setcookie() 手册页面。
 * 如果要将多个值赋给一个 cookie 变量，必须将其赋成数组。例如：
 */

setcookie("MyCookie[foo]", 'Testing 1', time() + 3600);
setcookie("MyCookie[bar]", 'Testing 2', time() + 3600);
/*
 * 这将会建立两个单独的 cookie，尽管 MyCookie 在脚本中是一个单一的数组。
 * 如果想在仅仅一个 cookie 中设定多个值，考虑先在值上使用 serialize() 或 explode()。
 * 注意在浏览器中一个 cookie 会替换掉上一个同名的 cookie，除非路径或者域不同。
 * 因此对于购物车程序可以保留一个计数器并一起传递，例如：
 * 一个 setcookie() 的示例
 */
if (isset($_COOKIE['count'])) {
    $count = $_COOKIE['count'] + 1;
} else {
    $count = 1;
}
setcookie('count', $count, time() + 3600);
setcookie("Cart[$count]", $item, time() + 3600);

/*
 * 变量名中的点
 * 通常，PHP 不会改变传递给脚本中的变量名。然而应该注意到点（句号）不是 PHP 变量名中的合法字符。至于原因，看看：
 */
//$varname.ext;  /* 非法变量名 */
/*
 * 这时，解析器看到是一个名为 $varname 的变量，后面跟着一个字符串连接运算符，
 * 后面跟着一个裸字符串（即没有加引号的字符串，且不匹配任何已知的健名或保留字）'ext'。
 * 很明显这不是想要的结果。 出于此原因，要注意 PHP 将会自动将变量名中的点替换成下划线。
 */
/*
 * 确定变量类型
 * 因为 PHP 会判断变量类型并在需要时进行转换（通常情况下），因此在某一时刻给定的变量是何种类型并不明显。
 * PHP 包括几个函数可以判断变量的类型，
 * 例如：gettype()，is_array()，is_float()，is_int()，is_object() 和 is_string()。参见类型一章。
 */
