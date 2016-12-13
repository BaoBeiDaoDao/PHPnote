<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-13
 * Time: 16:25
 */

/*
 * Resource 资源类型
 *
 * 资源 resource 是一种特殊变量，保存了到外部资源的一个引用。资源是通过专门的函数来建立和使用的。所有这些函数及其相应资源类型见附录。
 * http://php.net/manual/zh/resource.php
 *
 * get_resource_type
 * get_resource_type — 返回资源（resource）类型
 * string get_resource_type ( resource $handle )
 * 此函数返回一个字符串，用于表示传递给它的 resource 的类型。如果参数不是合法的 resource，将产生错误。
 */
//$c = mysql_connect();
$pdo = new PDO('mysql:host=localhost;dbname=PHPnote;port=3306','root','1234');
//echo get_resource_type($c) . "\n";
// 打印：mysql link
var_dump($pdo);

$fp = fopen("foo", "w");
echo get_resource_type($fp) . "\n";
// 打印：file

//$doc = new_xmldoc("1.0");
//echo get_resource_type($doc->doc) . "\n";
// 打印：domxml document

/*
 * 转换为资源
 * 由于资源类型变量保存有为打开文件、数据库连接、图形画布区域等的特殊句柄，因此将其它类型的值转换为资源没有意义。
 *
 * 释放资源
 * 由于 PHP 4 Zend 引擎引进了引用计数系统，可以自动检测到一个资源不再被引用了（和 Java 一样）。
 * 这种情况下此资源使用的所有外部资源都会被垃圾回收系统释放。因此，很少需要手工释放内存。
 * 持久数据库连接比较特殊，它们不会被垃圾回收系统销毁
 */


/*
 * NULL
 * 特殊的 NULL 值表示一个变量没有值。NULL 类型唯一可能的值就是 NULL。
 * 在下列情况下一个变量被认为是 NULL：
 * 被赋值为 NULL。
 * 尚未被赋值。
 * 被 unset()。
 *
 * 语法
 * NULL 类型只有一个值，就是不区分大小写的常量 NULL。
 */
$var = NULL;
/* is_null — 检测变量是否为 NULL
 * 如果 var 是 null 则返回 TRUE，否则返回 FALSE。
 * 查看 NULL 类型获知变量什么时候被认为是 NULL，而什么时候不是。
 */

/*
 * unset
 * unset — 释放给定的变量
 * void unset ( mixed $var [, mixed $... ] )
 * unset() 销毁指定的变量。
 * unset() 在函数中的行为会依赖于想要销毁的变量的类型而有所不同。
 * 如果在函数中 unset() 一个全局变量，则只是局部变量被销毁，而在调用环境中的变量将保持调用 unset() 之前一样的值。
 */
function destroy_foo()
{
    global $foo;
    unset($foo);
}

$foo = 'bar';
destroy_foo();
echo $foo;
/*
 * 如果您想在函数中 unset() 一个全局变量，可使用 $GLOBALS 数组来实现：
 */
function foo()
{
    unset($GLOBALS['bar']);
}

$bar = "something";
foo();

/*
 * 如果在函数中 unset() 一个通过引用传递的变量，则只是局部变量被销毁，而在调用环境中的变量将保持调用 unset() 之前一样的值。
 */
function foo1(&$bar){
    unset($bar);
    $bar = "blah";
}

$bar = 'something';
echo "$bar\n";

foo1($bar);
echo "$bar\n";

/*
 * 如果在函数中 unset() 一个静态变量，那么在函数内部此静态变量将被销毁。但是，当再次调用此函数时，此静态变量将被复原为上次被销毁之前的值。
 */
function foo2()
{
    static $bar;
    $bar++;
    echo "Before unset: $bar, ";
    unset($bar);
    $bar = 23;
    echo "after unset: $bar\n";
}

foo2();
foo2();
foo2();

/*
 * unset() 示例
 */
// 销毁单个变量
unset ($foo);

// 销毁单个数组元素
//unset ($bar['quux']);

// 销毁一个以上的变量
unset($foo1, $foo2, $foo3);
/*
 * 使用 (unset) 类型强制转换
 * (unset) 类型强制转换常常和函数 unset() 引起困惑。 为了完整性，(unset) 是作为一个 NULL 类型的强制转换。它不会改变变量的类型。
 */
$name = 'Felipe';
var_dump((unset) $name);
var_dump($name);

/*
 * 因为是一个语言构造器而不是一个函数，不能被 可变函数 调用。
 * 在 PHP 5 之前无法在对象里销毁 $this。
 * 在 unset() 一个无法访问的对象属性时，如果定义了 __unset() 则对调用这个重载方法。
 */
/*
 * isset() - 检测变量是否设置
 * empty() - 检查一个变量是否为空
 * __unset()
 * array_splice() - 把数组中的一部分去掉并用其它值取代
 */


/*
 * Callback 回调类型
 * 自 PHP 5.4 起可用 callable 类型指定回调类型 callback
 * 一些函数如 call_user_func() 或 usort() 可以接受用户自定义的回调函数作为参数。
 * 回调函数不止可以是简单函数，还可以是对象的方法，包括静态类方法。
 */
/*
 * 传递
 * 一个 PHP 的函数以 string 类型传递其名称。可以使用任何内置或用户自定义函数，但除了语言结构例如：
 * array()，echo，empty()，eval()，exit()，isset()，list()，print 或 unset()。
 * 一个已实例化的对象的方法被作为数组传递，下标 0 包含该对象，下标 1 包含方法名。
 * 静态类方法也可不经实例化该类的对象而传递，只要在下标 0 中包含类名而不是对象。
 * 自 PHP 5.2.3 起，也可以传递 'ClassName::methodName'。
 * 除了普通的用户自定义函数外，create_function() 可以用来创建一个匿名回调函数。自 PHP 5.3.0 起也可传递 closure 给回调参数。
 */
/*
 * 回调函数示例
 */
// An example callback function
function my_callback_function() {
    echo 'hello world!';
}

// An example callback method
class MyClass {
    static function myCallbackMethod() {
        echo 'Hello World!';
    }
}

// Type 1: Simple callback
call_user_func('my_callback_function');

// Type 2: Static class method call
call_user_func(array('MyClass', 'myCallbackMethod'));

// Type 3: Object method call
$obj = new MyClass();
call_user_func(array($obj, 'myCallbackMethod'));

// Type 4: Static class method call (As of PHP 5.2.3)
call_user_func('MyClass::myCallbackMethod');

// Type 5: Relative static class method call (As of PHP 5.3.0)
class A {
    public static function who() {
        echo "A\n";
    }
}

class B extends A {
    public static function who() {
        echo "B\n";
    }
}

call_user_func(array('B', 'parent::who')); // A

/*
 * 使用 Closure 的示例
 */
// Our closure
$double = function($a) {
    return $a * 2;
};

// This is our range of numbers
$numbers = range(1, 5);

// Use the closure as a callback here to 
// double the size of each element in our 
// range
$new_numbers = array_map($double, $numbers);

print implode(' ', $new_numbers);
// 输出 2 4 6 8 10

/*
 * 在函数中注册有多个回调内容时(如使用 call_user_func() 与 call_user_func_array())，如在前一个回调中有未捕获的异常，其后的将不再被调用。
 */