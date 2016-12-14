<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-13
 * Time: 17:44
 */

/*
 * 伪类型与变量
 */

/*
 * mixed
 * mixed 说明一个参数可以接受多种不同的（但不一定是所有的）类型。
 * 例如 gettype() 可以接受所有的 PHP 类型，str_replace() 可以接受字符串和数组。
 *
 * number
 * number 说明一个参数可以是 integer 或者 float。
 *
 * callback
 * 本文档中在 PHP 5.4 引入 callable 类型之前使用 了 callback 伪类型。二者含义完全相同。
 *
 * void
 * void 作为返回类型意味着函数的返回值是无用的。void 作为参数列表意味着函数不接受任何参数。
 *
 * 在函数原型中，$... 表示等等的意思。当一个函数可以接受任意个参数时使用此变量名。
 */

/*
 * PHP 类型比较表
 * http://php.net/manual/zh/types.comparisons.php
 *
 * 类型转换的判别
 * PHP 在变量定义中不需要（或不支持）明确的类型定义；变量类型是根据使用该变量的上下文所决定的。
 * 也就是说，如果把一个 string 值赋给变量 $var，$var 就成了一个 string。
 * 如果又把一个integer 赋给 $var，那它就成了一个integer。
 * PHP 的自动类型转换的一个例子是加法运算符“+”。如果任何一个操作数是float，则所有的操作数都被当成float，结果也是float。
 * 否则操作数会被解释为integer，结果也是integer。
 * 注意这并没有改变这些操作数本身的类型；改变的仅是这些操作数如何被求值以及表达式本身的类型。
 * 如果要改变一个变量的类型，参见 settype()。
 */
$foo = "0";  // $foo 是字符串 (ASCII 48)
$foo += 2;   // $foo 现在是一个整数 (2)
$foo = $foo + 1.3;  // $foo 现在是一个浮点数 (3.3)
$foo = 5 + "10 Little Piggies"; // $foo 是整数 (15)
$foo = 5 + "10 Small Pigs";     // $foo 是整数 (15)

/*
 * 自动转换为 数组 的行为目前没有定义。
 * 此外，由于 PHP 支持使用和数组下标同样的语法访问字符串下标，以下例子在所有 PHP 版本中都有效：
 */
$a = 'car';    // $a is a string
$a[0] = 'b';   // $a is still a string
echo $a;       // bar

/*
 * 类型强制转换
 * PHP 中的类型强制转换和 C 中的非常像：在要转换的变量之前加上用括号括起来的目标类型。
 */
$foo = 10;   // $foo is an integer
$bar = (boolean)$foo;   // $bar is a boolean

/*
 * 允许的强制转换有：
(int), (integer) - 转换为整形 integer
(bool), (boolean) - 转换为布尔类型 boolean
(float), (double), (real) - 转换为浮点型 float
(string) - 转换为字符串 string
(array) - 转换为数组 array
(object) - 转换为对象 object
(unset) - 转换为 NULL (PHP 5)
 * (binary) 转换和 b 前缀转换支持为 PHP 5.2.1 新增。
 * 注意在括号内允许有空格和制表符，所以下面两个例子功能相同：
 */
$foo = (int) $bar;
$foo = ( int ) $bar;

//将字符串文字和变量转换为二进制字符串：
$string = "你好";
$binary = (binary)$string;
$binary = b"binary string";

//可以将变量放置在双引号中的方式来代替将变量转换成字符串：
$foo = 10;            // $foo 是一个整数
$str = "$foo";        // $str 是一个字符串
$fst = (string) $foo; // $fst 也是一个字符串

// 输出 "they are the same"
if ($fst === $str) {
    echo "they are the same";
}
