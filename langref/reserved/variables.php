<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-15
 * Time: 15:08
 */

/*
 * 预定义变量
 * http://php.net/manual/zh/reserved.variables.php
 *
 * 对于全部脚本而言，PHP 提供了大量的预定义变量。这些变量将所有的外部变量表示成内建环境变量，并且将错误信息表示成返回头。
 * 参见 FAQ “register_globals 对我有什么影响？”
 */

/*
 * 超全局变量
 * 超全局变量 — 超全局变量是在全部作用域中始终可用的内置变量
 * http://php.net/manual/zh/language.variables.superglobals.php
 * 说明
 * PHP 中的许多预定义变量都是“超全局的”，这意味着它们在一个脚本的全部作用域中都可用。
 * 在函数或方法中无需执行 global $variable; 就可以访问它们。
 *
 * $GLOBALS    http://php.net/manual/zh/reserved.variables.globals.php
 * $_SERVER    http://php.net/manual/zh/reserved.variables.server.php
 * $_GET       http://php.net/manual/zh/reserved.variables.get.php
 * $_POST      http://php.net/manual/zh/reserved.variables.post.php
 * $_FILES     http://php.net/manual/zh/reserved.variables.files.php
 * $_COOKIE    http://php.net/manual/zh/reserved.variables.cookies.php
 * $_SESSION   http://php.net/manual/zh/reserved.variables.session.php
 * $_REQUEST   http://php.net/manual/zh/reserved.variables.request.php
 * $_ENV       http://php.net/manual/zh/reserved.variables.environment.php
 * $php_errormsg http://php.net/manual/zh/reserved.variables.phperrormsg.php
 * $http_response_header http://php.net/manual/zh/reserved.variables.httpresponseheader.php
 * $argc       http://php.net/manual/zh/reserved.variables.argc.php
 * $argv       http://php.net/manual/zh/reserved.variables.argv.php
 */
