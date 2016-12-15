<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-15
 * Time: 11:51
 */

/*
 * error
 * http://php.net/manual/zh/language.errors.php
 */

/*
 * basic
 * http://php.net/manual/zh/language.errors.basics.php
 */

/*
 * PHP 7 错误处理
 * http://php.net/manual/zh/language.errors.php7.php
 * PHP 7 改变了大多数错误的报告方式。
 * 不同于传统（PHP 5）的错误报告机制，现在大多数错误被作为 Error 异常抛出。
 * 这种 Error 异常可以像 Exception 异常一样被第一个匹配的 try / catch 块所捕获。
 * 如果没有匹配的 catch 块，则调用异常处理函数（事先通过 set_exception_handler() 注册）进行处理。
 * 如果尚未注册异常处理函数，则按照传统方式处理：被报告为一个致命错误（Fatal Error）。
 * Error 类并非继承自 Exception 类，所以不能用 catch (Exception $e) { ... } 来捕获 Error。
 * 你可以用 catch (Error $e) { ... }，或者通过注册异常处理函数（ set_exception_handler()）来捕获 Error。
 */