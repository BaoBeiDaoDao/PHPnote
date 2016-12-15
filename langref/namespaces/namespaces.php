<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-15
 * Time: 10:11
 */

/*
 * 命名空间
 * 命名空间概述
 * 什么是命名空间？
 * 从广义上来说，命名空间是一种封装事物的方法。
 * 在很多地方都可以见到这种抽象概念。
 * 例如，在操作系统中目录用来将相关文件分组，对于目录中的文件来说，它就扮演了命名空间的角色。
 * 具体举个例子，文件 foo.txt 可以同时在目录/home/greg 和 /home/other 中存在，但在同一个目录中不能存在两个 foo.txt 文件。
 * 另外，在目录 /home/greg 外访问 foo.txt 文件时，我们必须将目录名以及目录分隔符放在文件名之前得到 /home/greg/foo.txt。
 * 这个原理应用到程序设计领域就是命名空间的概念。
 * 在PHP中，命名空间用来解决在编写类库或应用程序时创建可重用的代码如类或函数时碰到的两类问题：
 * 用户编写的代码与PHP内部的类/函数/常量或第三方类/函数/常量之间的名字冲突。
 * 为很长的标识符名称(通常是为了缓解第一类问题而定义的)创建一个别名（或简短）的名称，提高源代码的可读性。
 * PHP 命名空间提供了一种将相关的类、函数和常量组合到一起的途径。
 * 名为PHP或php的命名空间，以及以这些名字开头的命名空间（例如PHP\Classes）被保留用作语言内核使用，而不应该在用户空间的代码中使用。
 */

/*
 * 定义命名空间
 * 虽然任意合法的PHP代码都可以包含在命名空间中，但只有以下类型的代码受命名空间的影响，
 * 它们是：类（包括抽象类和traits）、接口、函数和常量。
 * 命名空间通过关键字namespace 来声明。
 * 如果一个文件中包含命名空间，它必须在其它所有代码之前声明命名空间，除了一个以外：declare关键字。
 *
 * 在声明命名空间之前唯一合法的代码是用于定义源文件编码方式的 declare 语句。
 * 另外，所有非 PHP 代码包括空白符都不能出现在命名空间的声明之前：
 *
 * 另外，与PHP其它的语言特征不同，同一个命名空间可以定义在多个文件中，即允许将同一个命名空间的内容分割存放在不同的文件中
 */

/*
 * 定义子命名空间
 * 与目录和文件的关系很象，PHP 命名空间也允许指定层次化的命名空间的名称。因此，命名空间的名字可以使用分层次的方式定义：
 * //namespace MyProject\Sub\Level;
 * const CONNECT_OK = 1;
 * class Connection { ... }
 * function connect() { ... }
 *
 * 上面的例子创建了常量MyProject\Sub\Level\CONNECT_OK，类 MyProject\Sub\Level\Connection
 * 和函数 MyProject\Sub\Level\connect。
 */

/*
 * 在同一个文件中定义多个命名空间
 * 也可以在同一个文件中定义多个命名空间。在同一个文件中定义多个命名空间有两种语法形式。
 * 定义多个命名空间，简单组合语法
 * namespace MyProject;
 * ...
 * namespace AnotherProject;
 * ...
 * 不建议使用这种语法在单个文件中定义多个命名空间。建议使用下面的大括号形式的语法。
 * namespace MyProject {
 * ...
 * }
 * namespace AnotherProject {
 * ...
 * }
 * 在实际的编程实践中，非常不提倡在同一个文件中定义多个命名空间。
 * 这种方式的主要用于将多个 PHP 脚本合并在同一个文件中。
 * 将全局的非命名空间中的代码与命名空间中的代码组合在一起，只能使用大括号形式的语法。
 * 全局代码必须用一个不带名称的 namespace 语句加上大括号括起来
 *
 * 除了开始的declare语句外，命名空间的括号外不得有任何PHP代码。
 */

/*
 * 使用命名空间：基础
 * 在讨论如何使用命名空间之前，必须了解 PHP 是如何知道要使用哪一个命名空间中的元素的。
 * 可以将 PHP 命名空间与文件系统作一个简单的类比。在文件系统中访问一个文件有三种方式：
 * 相对文件名形式如foo.txt。它会被解析为 currentdirectory/foo.txt，其中 currentdirectory 表示当前目录。
 * 因此如果当前目录是 /home/foo，则该文件名被解析为/home/foo/foo.txt。
 * 相对路径名形式如subdirectory/foo.txt。它会被解析为 currentdirectory/subdirectory/foo.txt。
 * 绝对路径名形式如/main/foo.txt。它会被解析为/main/foo.txt。
 *
 * PHP 命名空间中的元素使用同样的原理。例如，类名可以通过三种方式引用：
 * 非限定名称，或不包含前缀的类名称，例如 $a=new foo(); 或 foo::staticmethod();。
 * 如果当前命名空间是 currentnamespace，foo 将被解析为 currentnamespace\foo。
 * 如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，则 foo 会被解析为foo。
 * 警告：如果命名空间中的函数或常量未定义，则该非限定的函数名称或常量名称会被解析为全局函数名称或常量名称。
 * 详情参见 使用命名空间：后备全局函数名称/常量名称。
 * 限定名称,或包含前缀的名称，例如 $a = new subnamespace\foo(); 或 subnamespace\foo::staticmethod();。
 * 如果当前的命名空间是 currentnamespace，则 foo 会被解析为 currentnamespace\subnamespace\foo。
 * 如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，foo 会被解析为subnamespace\foo。
 * 完全限定名称，或包含了全局前缀操作符的名称，例如， $a = new \currentnamespace\foo();
 * 或 \currentnamespace\foo::staticmethod();。
 * 在这种情况下，foo 总是被解析为代码中的文字名(literal name)currentnamespace\foo。
 *
 * 注意访问任意全局类、函数或常量，都可以使用完全限定名称，例如 \strlen() 或 \Exception 或 \INI_ALL。
 */

/*
 * 命名空间和动态语言特征
 * PHP 命名空间的实现受到其语言自身的动态特征的影响。
 * 必须使用完全限定名称（包括命名空间前缀的类名称）。
 * 注意因为在动态的类名称、函数名称或常量名称中，限定名称和完全限定名称没有区别，因此其前导的反斜杠是不必要的。
 */

/*
 * namespace关键字和__NAMESPACE__常量
 * PHP支持两种抽象的访问当前命名空间内部元素的方法，__NAMESPACE__ 魔术常量和namespace关键字。
 * 常量__NAMESPACE__的值是包含当前命名空间名称的字符串。在全局的，不包括在任何命名空间中的代码，它包含一个空的字符串。
 * 关键字 namespace 可用来显式访问当前命名空间或子命名空间中的元素。它等价于类中的 self 操作符。
 */

/*
 * 使用命名空间：别名/导入
 * 允许通过别名引用或导入外部的完全限定名称，是命名空间的一个重要特征。
 * 这有点类似于在类 unix 文件系统中可以创建对其它的文件或目录的符号连接。
 * 所有支持命名空间的PHP版本支持三种别名或导入方式：为类名称使用别名、为接口使用别名或为命名空间名称使用别名。
 * PHP 5.6开始允许导入函数或常量或者为它们设置别名。
 * 在PHP中，别名是通过操作符 use 来实现的.
 *
 * 注意对命名空间中的名称（包含命名空间分隔符的完全限定名称如 Foo\Bar以及相对的不包含命名空间分隔符的全局名称如 FooBar）来说，
 * 前导的反斜杠是不必要的也不推荐的，因为导入的名称必须是完全限定的，不会根据当前的命名空间作相对解析。
 * 为了简化操作，PHP还支持在一行中使用多个use语句
 *
 * 导入操作是在编译执行的，但动态的类名称、函数名称或常量名称则不是。
 *
 * 另外，导入操作只影响非限定名称和限定名称。完全限定名称由于是确定的，故不受导入的影响。
 */

/*
 * 全局空间
 * 如果没有定义任何命名空间，所有的类与函数的定义都是在全局空间，与 PHP 引入命名空间概念前一样。
 * 在名称前加上前缀 \ 表示该名称是全局空间中的名称，即使该名称位于其它的命名空间中时也是如此。
 */

/*
 * 使用命名空间：后备全局函数/常量
 * 在一个命名空间中，当 PHP 遇到一个非限定的类、函数或常量名称时，它使用不同的优先策略来解析该名称。
 * 类名称总是解析到当前命名空间中的名称。因此在访问系统内部或不包含在命名空间中的类名称时，必须使用完全限定名称，
 * 对于函数和常量来说，如果当前命名空间中不存在该函数或常量，PHP 会退而使用全局空间中的函数或常量
 */

/*
 * 名称解析规则
 * 在说明名称解析规则之前，我们先看一些重要的定义：
 * 命名空间名称定义
 * 非限定名称Unqualified name
 * 名称中不包含命名空间分隔符的标识符，例如 Foo
 * 限定名称Qualified name
 * 名称中含有命名空间分隔符的标识符，例如 Foo\Bar
 * 完全限定名称Fully qualified name
 * 名称中包含命名空间分隔符，并以命名空间分隔符开始的标识符，例如 \Foo\Bar。 namespace\Foo 也是一个完全限定名称。
 * 名称解析遵循下列规则：
 * 对完全限定名称的函数，类和常量的调用在编译时解析。例如 new \A\B 解析为类 A\B。
 * 有的非限定名称和限定名称（非完全限定名称）根据当前的导入规则在编译时进行转换。
 * 例如，如果命名空间 A\B\C 被导入为 C，那么对 C\D\e() 的调用就会被转换为 A\B\C\D\e()。
 * 在命名空间内部，所有的没有根据导入规则转换的限定名称均会在其前面加上当前的命名空间名称。
 * 例如，在命名空间 A\B 内部调用 C\D\e()，则 C\D\e() 会被转换为 A\B\C\D\e() 。
 * 非限定类名根据当前的导入规则在编译时转换（用全名代替短的导入名称）。
 * 例如，如果命名空间 A\B\C 导入为C，则 new C() 被转换为 new A\B\C() 。
 * 在命名空间内部（例如A\B），对非限定名称的函数调用是在运行时解析的。
 * 例如对函数 foo() 的调用是这样解析的：
 * 在当前命名空间中查找名为 A\B\foo() 的函数
 * 尝试查找并调用 全局(global) 空间中的函数 foo()。
 * 在命名空间（例如A\B）内部对非限定名称或限定名称类（非完全限定名称）的调用是在运行时解析的。
 * 下面是调用 new C() 及 new D\E() 的解析过程： new C()的解析:
 * 在当前命名空间中查找A\B\C类。
 * 尝试自动装载类A\B\C。
 * new D\E()的解析:
 * 在类名称前面加上当前命名空间名称变成：A\B\D\E，然后查找该类。
 * 尝试自动装载类 A\B\D\E。
 * 为了引用全局命名空间中的全局类，必须使用完全限定名称 new \C()。
 */

/*
 * FAQ: things you need to know about namespaces
 * http://php.net/manual/zh/language.namespaces.faq.php
 */