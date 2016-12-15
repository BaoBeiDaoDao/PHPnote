<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-15
 * Time: 11:53
 */

/*
 * 异常处理
 * http://php.net/manual/zh/language.exceptions.php
 */

/*
 * 扩展（extend） PHP 内置的异常处理类
 * 用户可以用自定义的异常处理类来扩展 PHP 内置的异常处理类。
 * 以下的代码说明了在内置的异常处理类中，哪些属性和方法在子类中是可访问和可继承的。
 * 译者注：以下这段代码只为说明内置异常处理类的结构，它并不是一段有实际意义的可用代码。
 */

/*
class Exception
{
    protected $message = 'Unknown exception';   // 异常信息
    private $string;                          // __toString cache
    protected $code = 0;                        // 用户自定义异常代码
    protected $file;                            // 发生异常的文件名
    protected $line;                            // 发生异常的代码行号
    private $trace;                           // backtrace
    private $previous;                        // previous exception if nested exception

    public function __construct($message = null, $code = 0, Exception $previous = null);

    final private function __clone();           // Inhibits cloning of exceptions.

    final public function getMessage();        // 返回异常信息

    final public function getCode();           // 返回异常代码

    final public function getFile();           // 返回发生异常的文件名

    final public function getLine();           // 返回发生异常的代码行号

    final public function getTrace();          // backtrace() 数组

    final public function getPrevious();       // 之前的 exception

    final public function getTraceAsString();  // 已格成化成字符串的 getTrace() 信息

    // Overrideable
    public function __toString();               // 可输出的字符串
}
*/
/*
 * 如果使用自定义的类来扩展内置异常处理类，并且要重新定义构造函数的话，
 * 建议同时调用 parent::__construct() 来检查所有的变量是否已被赋值。
 * 当对象要输出字符串的时候，可以重载 __toString() 并自定义输出的样式。
 */

/*
 * Exception 对象不能被复制。尝试对 Exception 对象复制 会导致一个 E_ERROR 级别的错误。
 */