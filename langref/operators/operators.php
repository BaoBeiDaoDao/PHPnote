<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-14
 * Time: 11:20
 */
/*
 * 运算符
 */

/*
 * 运算符是可以通过给出的一或多个值（用编程行话来说，表达式）来产生另一个值（因而整个结构成为一个表达式）的东西。
 * 运算符可按照其能接受几个值来分组。一元运算符只能接受一个值，例如 !（逻辑取反运算符）或 ++（递增运算符）。
 * 二元运算符可接受两个值，例如熟悉的算术运算符 +（加）和 -（减），大多数 PHP 运算符都是这种。
 * 最后是唯一的三元运算符 ? :，可接受三个值；通常就简单称之为“三元运算符”（尽管称之为条件运算符可能更合适）。
 */
/*
 * 运算符优先级
 * http://php.net/manual/zh/language.operators.precedence.php
 */
/*
 * 算术运算符
 * 基本数学一样
 * 除法运算符总是返回浮点数。只有在下列情况例外：两个操作数都是整数（或字符串转换成的整数）并且正好能整除，这时它返回一个整数。
 * 取模运算符的操作数在运算之前都会转换成整数（除去小数部分）。
 * 取模运算符 % 的结果和被除数的符号（正负号）相同。即 $a % $b 的结果和 $a 的符号相同。例如
 */
echo (5 % 3) . "\n";           // prints 2
echo (5 % -3) . "\n";          // prints 2
echo (-5 % 3) . "\n";          // prints -2
echo (-5 % -3) . "\n";         // prints -2

/*
 * 赋值运算符
 * 基本的赋值运算符是“=”。一开始可能会以为它是“等于”，其实不是的。它实际上意味着把右边表达式的值赋给左边的运算数。
 * 赋值运算表达式的值也就是所赋的值。也就是说，“$a = 3”的值是 3。
 */
$a = ($b = 4) + 5; // $a 现在成了 9，而 $b 成了 4。
/*
 * 在基本赋值运算符之外，还有适合于所有二元算术，数组集合和字符串运算符的“组合运算符”，
 * 这样可以在一个表达式中使用它的值并把表达式的结果赋给它
 */
$a = 3;
$a += 5; // sets $a to 8, as if we had said: $a = $a + 5;
$b = "Hello ";
$b .= "There!"; // sets $b to "Hello There!", just like $b = $b . "There!";
/*
 * 注意赋值运算将原变量的值拷贝到新变量中（传值赋值），所以改变其中一个并不影响另一个。这也适合于在密集循环中拷贝一些值例如大数组。
 * 在 PHP 中普通的传值赋值行为有个例外就是碰到对象 object 时，在 PHP 5 中是以引用赋值的，除非明确使用了 clone 关键字来拷贝
 *
 * 引用赋值
 * PHP 支持引用赋值，使用“$var = &$othervar;”语法。引用赋值意味着两个变量指向了同一个数据，没有拷贝任何东西。 
 */
$a = 3;
$b = &$a; // $b 是 $a 的引用

print "$a\n"; // 输出 3
print "$b\n"; // 输出 3

$a = 4; // 修改 $a

print "$a\n"; // 输出 4
print "$b\n"; // 也输出 4，因为 $b 是 $a 的引用，因此也被改变
/*
 * 自 PHP 5 起，new 运算符自动返回一个引用，
 * 因此再对 new 的结果进行引用赋值在 PHP 5.3 以及以后版本中会发出一条 E_DEPRECATED 错误信息，
 * 在之前版本会发出一条 E_STRICT 错误信息。
 */

class C
{
}

/* The following line generates the following error message:
 * Deprecated: Assigning the return value of new by reference is deprecated in...
 */
$o = &new C;

/*
 * 位运算符
 * http://php.net/manual/zh/language.operators.bitwise.php
 * 比较运算符
 * http://php.net/manual/zh/language.operators.comparison.php
 * 错误控制运算符
 * http://php.net/manual/zh/language.operators.errorcontrol.php
 * PHP 支持一个错误控制运算符：@。当将其放置在一个 PHP 表达式之前，该表达式可能产生的任何错误信息都被忽略掉。
 *
 * 执行运算符
 * PHP 支持一个执行运算符：反引号（``）。注意这不是单引号！
 * PHP 将尝试将反引号中的内容作为 shell 命令来执行，并将其输出信息返回（即，可以赋给一个变量而不是简单地丢弃到标准输出）。
 * 使用反引号运算符“`”的效果与函数 shell_exec() 相同。
 */
$output = `ls -al`;
echo "<pre>$output</pre>";
//反引号运算符在激活了安全模式或者关闭了 shell_exec() 时是无效的。
//与其它某些语言不同，反引号不能在双引号字符串中使用。
/*
 * 递增／递减运算符
 * PHP 支持 C 风格的前／后递增与递减运算符。
 * 递增／递减运算符不影响布尔值。递减 NULL 值也没有效果，但是递增 NULL 的结果是 1。
 *
 * ++$a  前加  $a 的值加一，然后返回 $a。
 * $a++  后加  返回 $a，然后将 $a 的值加一。
 * --$a  前减  $a 的值减一， 然后返回 $a。
 * $a--  后减  返回 $a，然后将 $a 的值减一。
 */
echo "<h3>Postincrement</h3>";
$a = 5;
echo "Should be 5: " . $a++ . "<br />\n";
echo "Should be 6: " . $a . "<br />\n";

echo "<h3>Preincrement</h3>";
$a = 5;
echo "Should be 6: " . ++$a . "<br />\n";
echo "Should be 6: " . $a . "<br />\n";

echo "<h3>Postdecrement</h3>";
$a = 5;
echo "Should be 5: " . $a-- . "<br />\n";
echo "Should be 4: " . $a . "<br />\n";

echo "<h3>Predecrement</h3>";
$a = 5;
echo "Should be 4: " . --$a . "<br />\n";
echo "Should be 4: " . $a . "<br />\n";
/*
 * 在处理字符变量的算数运算时，PHP 沿袭了 Perl 的习惯，而非 C 的。
 * 例如，在 Perl 中 $a = 'Z'; $a++; 将把 $a 变成'AA'，而在 C 中，a = 'Z'; a++;
 * 将把 a 变成 '['（'Z' 的 ASCII 值是 90，'[' 的 ASCII 值是 91）。
 * 注意字符变量只能递增，不能递减，并且只支持纯字母（a-z 和 A-Z）。递增／递减其他字符变量则无效，原字符串没有变化。
 */
//涉及字符变量的算数运算
echo '== Alphabets ==' . PHP_EOL;
$s = 'W';
for ($n = 0; $n < 6; $n++) {
    echo ++$s . PHP_EOL;
}
// Digit characters behave differently
echo '== Digits ==' . PHP_EOL;
$d = 'A8';
for ($n = 0; $n < 6; $n++) {
    echo ++$d . PHP_EOL;
}
$d = 'A08';
for ($n = 0; $n < 6; $n++) {
    echo ++$d . PHP_EOL;
}
//递增或递减布尔值没有效果。
/*
 * 逻辑运算符
 *
 * $a and $b  And（逻辑与）  TRUE，如果 $a 和 $b 都为 TRUE。
 * $a or $b   Or（逻辑或）   TRUE，如果 $a 或 $b 任一为 TRUE。
 * $a xor $b  Xor（逻辑异或）TRUE，如果 $a 或 $b 任一为 TRUE，但不同时是。
 * ! $a       Not（逻辑非）  TRUE，如果 $a 不为 TRUE。
 * $a && $b   And（逻辑与）  TRUE，如果 $a 和 $b 都为 TRUE。
 * $a || $b   Or（逻辑或）   TRUE，如果 $a 或 $b 任一为 TRUE。
 *
 * 逻辑运算符示例
 */
// --------------------
// foo() 根本没机会被调用，被运算符“短路”了

$a = (false && foo());
$b = (true || foo());
$c = (false and foo());
$d = (true or foo());

// --------------------
// "||" 比 "or" 的优先级高

// 表达式 (false || true) 的结果被赋给 $e
// 等同于：($e = (false || true))
$e = false || true;

// 常量 false 被赋给 $f，true 被忽略
// 等同于：(($f = false) or true)
$f = false or true;

var_dump($e, $f);

// --------------------
// "&&" 比 "and" 的优先级高

// 表达式 (true && false) 的结果被赋给 $g
// 等同于：($g = (true && false))
$g = true && false;

// 常量 true 被赋给 $h，false 被忽略
// 等同于：(($h = true) and false)
$h = true and false;

var_dump($g, $h);

/*
 * 数组运算符
 *
 * $a + $b    联合    $a 和 $b 的联合。
 * $a == $b   相等    如果 $a 和 $b 具有相同的键／值对则为 TRUE。
 * $a === $b  全等    如果 $a 和 $b 具有相同的键／值对并且顺序和类型都相同则为 TRUE。
 * $a != $b   不等    如果 $a 不等于 $b 则为 TRUE。
 * $a <> $b   不等    如果 $a 不等于 $b 则为 TRUE。
 * $a !== $b  不全等  如果 $a 不全等于 $b 则为 TRUE。
 *
 * + 运算符把右边的数组元素附加到左边的数组后面，两个数组中都有的键名，则只用左边数组中的，右边的被忽略。
 */

$a = array("a" => "apple", "b" => "banana");
$b = array("a" => "pear", "b" => "strawberry", "c" => "cherry");

$c = $a + $b; // Union of $a and $b
echo "Union of \$a and \$b: \n";
var_dump($c);

$c = $b + $a; // Union of $b and $a
echo "Union of \$b and \$a: \n";
var_dump($c);

$a += $b; // Union of $a += $b is $a and $b
echo "Union of \$a += \$b: \n";
var_dump($a);
//数组中的单元如果具有相同的键名和值则比较时相等。
$a = array("apple", "banana");
$b = array(1 => "banana", "0" => "apple");

var_dump($a == $b); // bool(true)
var_dump($a === $b); // bool(false)
/*
 * 字符串运算符
 * 有两个字符串（string）运算符。第一个是连接运算符（“.”），它返回其左右参数连接后的字符串。
 * 第二个是连接赋值运算符（“.=”），它将右边参数附加到左边的参数之后
 */
$a = "Hello ";
$b = $a . "World!"; // now $b contains "Hello World!"

$a = "Hello ";
$a .= "World!";     // now $a contains "Hello World!"

/*
 * 类型运算符
 * instanceof 用于确定一个 PHP 变量是否属于某一类 class 的实例
 * 对类使用 instanceof
 */

class MyClass
{
}

class NotMyClass
{
}

$a = new MyClass;

var_dump($a instanceof MyClass);
var_dump($a instanceof NotMyClass);

//instanceof　也可用来确定一个变量是不是继承自某一父类的子类的实例：
class ParentClass
{
}

class MyClass1 extends ParentClass
{
}

$a = new MyClass1;

var_dump($a instanceof MyClass1);
var_dump($a instanceof ParentClass);
//检查一个对象是否不是某个类的实例，可以使用逻辑运算符 not。
class MyClass2
{
}

$a = new MyClass2;
var_dump(!($a instanceof stdClass));
//最后，instanceof也可用于确定一个变量是不是实现了某个接口的对象的实例:
interface MyInterface
{
}

class MyClass3 implements MyInterface
{
}

$a = new MyClass3;

var_dump($a instanceof MyClass3);
var_dump($a instanceof MyInterface);
//虽然 instanceof 通常直接与类名一起使用，但也可以使用对象或字符串变量：
interface MyInterface1
{
}

class MyClass4 implements MyInterface1
{
}

$a = new MyClass4;
$b = new MyClass4;
$c = 'MyClass4';
$d = 'NotMyClass4';

var_dump($a instanceof $b); // $b is an object of class MyClass
var_dump($a instanceof $c); // $c is a string 'MyClass'
var_dump($a instanceof $d); // $d is a string 'NotMyClass'
//如果被检测的变量不是对象，instanceof 并不发出任何错误信息而是返回 FALSE。不允许用来检测常量。
$a = 1;
$b = NULL;
$c = imagecreate(5, 5);
var_dump($a instanceof stdClass); // $a is an integer
var_dump($b instanceof stdClass); // $b is NULL
var_dump($c instanceof stdClass); // $c is a resource
//var_dump(FALSE instanceof stdClass);
/*
 * 然而 instanceof 的使用还有一些陷阱必须了解。在 PHP 5.1.0 之前，
 * 如果要检查的类名称不存在，instanceof 会调用 __autoload()。
 * 另外，如果该类没有被装载则会产生一个致命错误。可以通过使用动态类引用或用一个包含类名的字符串变量来避开这种问题：
 */
//避免 PHP 5.0 中 instanceof 引起的类名查找和致命错误问题
$d = 'NotMyClass';
var_dump($a instanceof $d); // no fatal error here
/*
 * instanceof 运算符是 PHP 5 引进的。在此之前用 is_a()，但是后来 is_a() 被废弃而用 instanceof 替代了。
 * 注意自 PHP 5.3.0 起，又恢复使用 is_a() 了。
 * 参见 get_class() 和 is_a()。
 */