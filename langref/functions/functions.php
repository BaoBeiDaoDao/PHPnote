<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-14
 * Time: 15:04
 */

/*
 * 用户自定义函数
 * 一个函数可由以下的语法来定义： 
 */
//function foo($arg_1, $arg_2, /* ...,*/ $arg_n)
//{
//    echo "Example  function.\n";
//    return $retval;
//}
/*
 * 任何有效的 PHP 代码都有可能出现在函数内部，甚至包括其它函数和类定义。
 * 函数名和 PHP 中的其它标识符命名规则相同。有效的函数名以字母或下划线打头，后面跟字母，数字或下划线。
 * 可以用正则表达式表示为：[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*。
 *
 * 函数无需在调用之前被定义，除非是下面两个例子中函数是有条件被定义时。
 * 当一个函数是有条件被定义时，必须在调用函数之前定义。
 */
$makefoo = true;

/* 不能在此处调用foo()函数，
   因为它还不存在，但可以调用bar()函数。*/

bar();

if ($makefoo) {
    function foo()
    {
        echo "I don't exist until program execution reaches me.\n";
    }
}

/* 现在可以安全调用函数 foo()了，
   因为 $makefoo 值为真 */

if ($makefoo) foo();

function bar()
{
    echo "I exist immediately upon program start.\n";
}

//函数中的函数
function foo()
{
    function bar()
    {
        echo "I don't exist until foo() is called.\n";
    }
}

/* 现在还不能调用bar()函数，因为它还不存在 */

foo();

/* 现在可以调用bar()函数了，因为foo()函数
   的执行使得bar()函数变为已定义的函数 */

bar();

/*
 * PHP 中的所有函数和类都具有全局作用域，可以定义在一个函数之内而在之外调用，反之亦然。
 * PHP 不支持函数重载，也不可能取消定义或者重定义已声明的函数。
 *
 * 函数名是大小写无关的，不过在调用函数的时候，使用其在定义时相同的形式是个好习惯。
 * PHP 的函数支持可变数量的参数和默认参数。参见 func_num_args()，func_get_arg() 和 func_get_args()。
 * 在 PHP 中可以调用递归函数。
 * 递归函数
 */
function recursion($a)
{
    if ($a < 20) {
        echo "$a\n";
        recursion($a + 1);
    }
}

//但是要避免递归函数／方法调用超过 100-200 层，因为可能会使堆栈崩溃从而使当前脚本终止。 无限递归可视为编程错误。

/*
 * 函数的参数
 * 通过参数列表可以传递信息到函数，即以逗号作为分隔符的表达式列表。参数是从左向右求值的。
 * PHP 支持按值传递参数（默认），通过引用传递参数以及默认参数。也支持可变长度参数列表。
 * 向函数传递数组
 */
function takes_array($input)
{
    echo "$input[0] + $input[1] = ", $input[0] + $input[1];
}

/*
 * 通过引用传递参数
 * 默认情况下，函数参数通过值传递（因而即使在函数内部改变参数的值，它并不会改变函数外部的值）。
 * 如果希望允许函数修改它的参数值，必须通过引用传递参数。
 * 如果想要函数的一个参数总是通过引用传递，可以在函数定义中该参数的前面加上符号 &： 
 */
function add_some_extra(&$string)
{
    $string .= 'and something extra.';
}

$str = 'This is a string, ';
add_some_extra($str);
echo $str;    // outputs 'This is a string, and something extra.'

/*
 * 默认参数的值
 * 函数可以定义 C++ 风格的标量参数默认值，如下所示： 
 */
function makecoffee($type = "cappuccino")
{
    return "Making a cup of $type.\n";
}

echo makecoffee();
echo makecoffee(null);
echo makecoffee("espresso");

//PHP 还允许使用数组 array 和特殊类型 NULL 作为默认参数，例如：
//使用非标量类型作为默认参数
function makecoffee1($types = array("cappuccino"), $coffeeMaker = NULL)
{
    $device = is_null($coffeeMaker) ? "hands" : $coffeeMaker;
    return "Making a cup of " . join(", ", $types) . " with $device.\n";
}

echo makecoffee1();
echo makecoffee1(array("cappuccino", "lavazza"), "teapot");
/*
 * 默认值必须是常量表达式，不能是诸如变量，类成员，或者函数调用等。
 * 注意当使用默认参数时，任何默认参数必须放在任何非默认参数的右侧；否则，函数将不会按照预期的情况工作。考虑下面的代码片断：
 * 函数默认参数的不正确用法
 */
function makeyogurt($type = "acidophilus", $flavour)
{
    return "Making a bowl of $type $flavour.\n";
}

echo makeyogurt("raspberry");   // won't work as expected
/*
 * 函数默认参数正确的用法
 */
function makeyogurt1($flavour, $type = "acidophilus")
{
    return "Making a bowl of $type $flavour.\n";
}

echo makeyogurt1("raspberry");   // works as expected
//自 PHP 5 起，传引用的参数也可以有默认值。

/*
 * 返回值
 * 值通过使用可选的返回语句返回。可以返回包括数组和对象的任意类型。
 * 返回语句会立即中止函数的运行，并且将控制权交回调用该函数的代码行。
 * 更多信息见 return。
 * 如果省略了 return，则返回值为 NULL。 
 */
function square($num)
{
    return $num * $num;
}

echo square(4);   // outputs '16'.
//函数不能返回多个值，但可以通过返回一个数组来得到类似的效果。
//返回一个数组以得到多个返回值
function small_numbers()
{
    return array(0, 1, 2);
}

list ($zero, $one, $two) = small_numbers();
//从函数返回一个引用，必须在函数声明和指派返回值给一个变量时都使用引用运算符 &：
//从函数返回一个引用
/*
function &returns_reference()
{
    return $someref;
}

$newref =& returns_reference();
*/

/*
 * 可变函数
 *
 * PHP 支持可变函数的概念。这意味着如果一个变量名后有圆括号，PHP 将寻找与变量的值同名的函数，并且尝试执行它。
 * 可变函数可以用来实现包括回调函数，函数表在内的一些用途。
 * 可变函数不能用于例如 echo，print，unset()，isset()，empty()，include，require 以及类似的语言结构。
 * 需要使用自己的包装函数来将这些结构用作可变函数。
 * 可变函数示例
 */
function foo1()
{
    echo "In foo1()<br />\n";
}

function bar1($arg = '')
{
    echo "In bar1(); argument was '$arg'.<br />\n";
}

// 使用 echo 的包装函数
function echoit($string)
{
    echo $string;
}

$func = 'foo';
$func();        // This calls foo()

$func = 'bar';
$func('test');  // This calls bar()

$func = 'echoit';
$func('test');  // This calls echoit()

//也可以用可变函数的语法来调用一个对象的方法。
class Foo
{
    function Variable()
    {
        $name = 'Bar';
        $this->$name(); // This calls the Bar() method
    }

    function Bar()
    {
        echo "This is Bar";
    }
}

$foo = new Foo();
$funcname = "Variable";
$foo->$funcname();   // This calls $foo->Variable()
//当调用静态方法时，函数调用要比静态属性优先：
class Foo1
{
    static $variable = 'static property';

    static function Variable()
    {
        echo 'Method Variable called';
    }
}

echo Foo1::$variable; // This prints 'static property'. It does need a $variable in this scope.
$variable = "Variable";
Foo1::$variable();  // This calls $foo->Variable() reading $variable in this scope.

//参见 is_callable()，call_user_func()，可变变量和 function_exists()。

/*
 * 内部（内置）函数
 *
 * PHP 有很多标准的函数和结构。
 * 还有一些函数需要和特定地 PHP 扩展模块一起编译，否则在使用它们的时候就会得到一个致命的“未定义函数”错误。
 * 例如，要使用 image 函数中的 imagecreatetruecolor()，需要在编译 PHP 的时候加上 GD 的支持。
 * 或者，要使用 mysql_connect() 函数，就需要在编译 PHP 的时候加上 MySQL 支持。
 * 有很多核心函数已包含在每个版本的 PHP 中如字符串和变量函数。
 * 调用 phpinfo() 或者 get_loaded_extensions() 可以得知 PHP 加载了那些扩展库。
 * 同时还应该注意，很多扩展库默认就是有效的。
 * PHP 手册按照不同的扩展库组织了它们的文档。
 * 请参阅配置，安装以及各自的扩展库章节以获取有关如何设置 PHP 的信息。
 * 手册中如何阅读函数原型讲解了如何阅读和理解一个函数的原型。
 * 确认一个函数将返回什么，或者函数是否直接作用于传递的参数是很重要的。
 * 例如，str_replace() 函数将返回修改过的字符串，而 usort() 却直接作用于传递的参数变量本身。
 * 手册中，每一个函数的页面中都有关于函数参数、行为改变、成功与否的返回值以及使用条件等信息。
 * 了解这些重要的（常常是细微的）差别是编写正确的 PHP 代码的关键。
 *
 * 如果传递给函数的参数类型与实际的类型不一致，
 * 例如将一个 array 传递给一个 string 类型的变量，那么函数的返回值是不确定的。
 * 在这种情况下，通常函数会返回 NULL。但这仅仅是一个惯例，并不一定如此。
 * 参见 function_exists()，函数参考，get_extension_funcs() 和 dl()。
 *
 * 匿名函数
 * 匿名函数（Anonymous functions），也叫闭包函数（closures），允许 临时创建一个没有指定名称的函数。
 * 最经常用作回调函数（callback）参数的值。当然，也有其它应用的情况。
 * 
 */
echo preg_replace_callback('~-([a-z])~', function ($match) {
    return strtoupper($match[1]);
}, 'hello-world');
// 输出 helloWorld
/*
 * 闭包函数也可以作为变量的值来使用。
 * PHP 会自动把此种表达式转换成内置类 Closure 的对象实例。
 * 把一个 closure 对象赋值给一个变量的方式与普通变量赋值的语法是一样的，最后也要加上分号：
 * 匿名函数变量赋值示例
 */
$greet = function ($name) {
    printf("Hello %s\r\n", $name);
};

$greet('World');
$greet('PHP');

//闭包可以从父作用域中继承变量。 任何此类变量都应该用 use 语言结构传递进去。
$message = 'hello';

// 没有 "use"
$example = function () {
    // var_dump($message);
};
echo $example();

// 继承 $message
$example = function () use ($message) {
    var_dump($message);
};
echo $example();

// Inherited variable's value is from when the function
// is defined, not when called
$message = 'world';
echo $example();

// Reset message
$message = 'hello';

// Inherit by-reference
$example = function () use (&$message) {
    var_dump($message);
};
echo $example();

// The changed value in the parent scope
// is reflected inside the function call
$message = 'world';
echo $example();

// Closures can also accept regular arguments
$example = function ($arg) use ($message) {
    var_dump($arg . ' ' . $message);
};
$example("hello");

/*
 * 这些变量都必须在函数或类的头部声明。 从父作用域中继承变量与使用全局变量是不同的。
 * 全局变量存在于一个全局的范围，无论当前在执行的是哪个函数。而 闭包的父作用域是定义该闭包的函数（不一定是调用它的函数）。
 * 示例如下：
 */

//Closures 和作用域
// 一个基本的购物车，包括一些已经添加的商品和每种商品的数量。
// 其中有一个方法用来计算购物车中所有商品的总价格，该方法使
// 用了一个 closure 作为回调函数。

class Cart
{
    const PRICE_BUTTER = 1.00;
    const PRICE_MILK = 3.00;
    const PRICE_EGGS = 6.95;

    protected $products = array();

    public function add($product, $quantity)
    {
        $this->products[$product] = $quantity;
    }

    public function getQuantity($product)
    {
        return isset($this->products[$product]) ? $this->products[$product] :
            FALSE;
    }

    public function getTotal($tax)
    {
        $total = 0.00;

        $callback =
            function ($quantity, $product) use ($tax, &$total) {
                $pricePerItem = constant(__CLASS__ . "::PRICE_" .
                    strtoupper($product));
                $total += ($pricePerItem * $quantity) * ($tax + 1.0);
            };

        array_walk($this->products, $callback);
        return round($total, 2);;
    }
}

$my_cart = new Cart;

// 往购物车里添加条目
$my_cart->add('butter', 1);
$my_cart->add('milk', 3);
$my_cart->add('eggs', 6);

// 打出出总价格，其中有 5% 的销售税.
print $my_cart->getTotal(0.05) . "\n";
// 最后结果是 54.29

//匿名函数目前是通过 Closure 类来实现的。
//可以在闭包中使用 func_num_args()，func_get_arg() 和 func_get_args()。
