<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-13
 * Time: 13:13
 */

/* php.ini 配置 enable-short-tags 之后可以使用 短标记: <?
 * 纯 php 文件可以省略尾标签 : ?\>
 * 文件末尾的 PHP 代码段结束标记可以不要，有些情况下当使用 include 或者 require 时省略掉会更好些，
 * 这样不期望的空白符就不会出现在文件末尾，之后仍然可以输出响应标头。在使用输出缓冲时也很便利，就不会看到由包含文件生成的不期望的空白符。
 *
 * PHP 支持 C，C++ 和 Unix Shell 风格（Perl 风格）的注释，// 或者 # 或者 /*
 */
?>
<?php
$expression = true;
// php 可以和 html 分离
?>
    <p>输出 html </p>
    <p>This is going to be ignored by PHP and displayed by the browser.</p>
<?php echo 'While this is going to be parsed.'; ?>
    <p>This will also be ignored by PHP and displayed by the browser.</p>

<?php
// 使用 if else
?>
<?php if ($expression == true): ?>
    This  will  show  if  the  expression  is  true.
<?php else: ?>
    Otherwise  this  will  show.
<?php endif; ?>

<?php
// 指令分隔符
echo 'hello world!'; // 使用分号作为指令分隔符
