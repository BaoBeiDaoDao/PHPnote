<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-14
 * Time: 15:46
 */

/*
 * 简介
 * 自 PHP 5 起完全重写了对象模型以得到更佳性能和更多特性。这是自 PHP 4 以来的最大变化。PHP 5 具有完整的对象模型。
 * PHP 5 中的新特性包括访问控制，抽象类和 final 类与方法，附加的魔术方法，接口，对象复制和类型约束。
 * PHP 对待对象的方式与引用和句柄相同，即每个变量都持有对象的引用，而不是整个对象的拷贝。参见对象和引用。
 */

/*
 * 基本概念
 * class
 * 每个类的定义都以关键字 class 开头，后面跟着类名，后面跟着一对花括号，里面包含有类的属性与方法的定义。
 * 类名可以是任何非 PHP 保留字的合法标签。一个合法类名以字母或下划线开头，后面跟着若干字母，数字或下划线。
 * 以正则表达式表示为：[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*。
 * 一个类可以包含有属于自己的常量，变量（称为“属性”）以及函数（称为“方法”）。
 * 简单的类定义
 */

class SimpleClass
{
    // property declaration
    public $var = 'a default value';

    // method declaration
    public function displayVar()
    {
        echo $this->var;
    }
}

/*
 * 当一个方法在类定义内部被调用时，有一个可用的伪变量 $this。
 * $this 是一个到主叫对象的引用（通常是该方法所从属的对象，但如果是从第二个对象静态调用时也可能是另一个对象）。
 * $this 伪变量的示例
 */

class A
{
    function foo()
    {
        if (isset($this)) {
            echo '$this is defined (';
            echo get_class($this);
            echo ")\n";
        } else {
            echo "\$this is not defined.\n";
        }
    }
}

class B
{
    function bar()
    {
        // Note: the next line will issue a warning if E_STRICT is enabled.
        A::foo();
    }
}

$a = new A();
$a->foo();

// Note: the next line will issue a warning if E_STRICT is enabled.
A::foo();
$b = new B();
$b->bar();

// Note: the next line will issue a warning if E_STRICT is enabled.
B::bar();

/*
 * new
 * 要创建一个类的实例，必须使用 new 关键字。
 * 当创建新对象时该对象总是被赋值，除非该对象定义了构造函数并且在出错时抛出了一个异常。
 * 类应在被实例化之前定义（某些情况下则必须这样）。
 * 如果在 new 之后跟着的是一个包含有类名的字符串，则该类的一个实例被创建。
 * 如果该类属于一个名字空间，则必须使用其完整名称。
 */
$instance = new SimpleClass();

// 也可以这样做：
$className = 'Foo';
$instance = new $className(); // Foo()
/*
 * 在类定义内部，可以用 new self 和 new parent 创建新对象。
 * 当把一个对象已经创建的实例赋给一个新变量时，新变量会访问同一个实例，就和用该对象赋值一样。
 * 此行为和给函数传递入实例时一样。可以用克隆给一个已创建的对象建立一个新实例。
 */
//对象赋值
$instance = new SimpleClass();

$assigned = $instance;
$reference =& $instance;

$instance->var = '$assigned will have this value';

$instance = null; // $instance and $reference become null

var_dump($instance);
var_dump($reference);
var_dump($assigned);

//PHP 5.3.0 引进了两个新方法来创建一个对象的实例：
class Test
{
    static public function getNew()
    {
        return new static;
    }
}

class Child extends Test
{
}

$obj1 = new Test();
$obj2 = new $obj1;
var_dump($obj1 !== $obj2);

$obj3 = Test::getNew();
var_dump($obj3 instanceof Test);

$obj4 = Child::getNew();
var_dump($obj4 instanceof Child);

/*
 * extends
 * 一个类可以在声明中用 extends 关键字继承另一个类的方法和属性。PHP不支持多重继承，一个类只能继承一个基类。
 * 被继承的方法和属性可以通过用同样的名字重新声明被覆盖。
 * 但是如果父类定义方法时使用了 final，则该方法不可被覆盖。
 * 可以通过 parent:: 来访问被覆盖的方法或属性。
 * 当覆盖方法时，参数必须保持一致否则 PHP 将发出 E_STRICT 级别的错误信息。
 * 但构造函数例外，构造函数可在被覆盖时使用不同的参数。
 */

class ExtendClass extends SimpleClass
{
    // Redefine the parent method
    function displayVar()
    {
        echo "Extending class\n";
        parent::displayVar();
    }
}

$extended = new ExtendClass();
$extended->displayVar();

/*
 * ::class
 * 自 PHP 5.5 起，关键词 class 也可用于类名的解析。
 * 使用 ClassName::class 你可以获取一个字符串，包含了类 ClassName 的完全限定名称。
 * 这对使用了 命名空间 的类尤其有用。
 */
/*
namespace NS {
    class ClassName
    {
    }

    echo ClassName::class;
}
*/

/*
 * 属性
 * 类的变量成员叫做“属性”，或者叫“字段”、“特征”，在本文档统一称为“属性”。
 * 属性声明是由关键字 public，protected 或者 private 开头，然后跟一个普通的变量声明来组成。
 * 属性中的变量可以初始化，但是初始化的值必须是常数，这里的常数是指 PHP 脚本在编译阶段时就可以得到其值，而不依赖于运行时的信息才能求值。
 * 有关 public，protected 和 private 的更多详细信息，请查看访问控制（可见性）。
 *
 * 为了向后兼容 PHP 4，PHP 5 声明属性依然可以直接使用关键字 var 来替代（或者附加于）public，protected 或 private。
 * 但是已不再需要 var 了。在 PHP 5.0 到 5.1.3，var 会被认为是废弃的，而且抛出 E_STRICT 警告，
 * 但是 5.1.3 之后就不再认为是废弃，也不会抛出警告。
 * 如果直接使用 var 声明属性，而没有用 public，protected 或 private 之一，PHP 5 会将其视为 public。
 *
 * 在类的成员方法里面，可以用 ->（对象运算符）：$this->property（其中 property 是该属性名）这种方式来访问非静态属性。
 * 静态属性则是用 ::（双冒号）：self::$property 来访问。更多静态属性与非静态属性的区别参见 Static 关键字。
 * 当一个方法在类定义内部被调用时，有一个可用的伪变量 $this。
 * $this 是一个到主叫对象的引用（通常是该方法所从属的对象，但如果是从第二个对象静态调用时也可能是另一个对象）。
 *
 * 属性声明
 */

class SimpleClass1
{
    // 错误的属性声明
    public $var1 = 'hello ' . 'world';
    public $var2 = <<<EOD
hello world
EOD;
    public $var3 = 1 + 2;
    //public $var4 = self::myStaticMethod();
    // public $var5 = $myVar;

    // 正确的属性声明
    public $var6 = myConstant;
    public $var7 = array(true, false);

    //在 PHP 5.3.0 及之后，下面的声明也正确
    public $var8 = <<<'EOD'
hello world
EOD;
}

/*
 * 跟 heredocs 不同，nowdocs 可在任何静态数据上下文中使用，包括属性声明。
 */

class foo
{
    // 自 5.3.0 起
    public $bar = <<<'EOT'
bar
EOT;
}

//Nowdoc 支持是在 PHP 5.3.0 新增的。

/*
 * 类常量
 * 可以把在类中始终保持不变的值定义为常量。在定义和使用常量的时候不需要使用 $ 符号。
 * 常量的值必须是一个定值，不能是变量，类属性，数学运算的结果或函数调用。
 * 接口（interface）中也可以定义常量。更多示例见文档中的接口部分。
 * 自 PHP 5.3.0 起，可以用一个变量来动态调用类。但该变量的值不能为关键字（如 self，parent 或 static）。
 * 定义和使用一个类常量
 */

class MyClass
{
    const constant = 'constant value';

    function showConstant()
    {
        echo self::constant . "\n";
    }
}

echo MyClass::constant . "\n";

$classname = "MyClass";
echo $classname::constant . "\n"; // 自 5.3.0 起

$class = new MyClass();
$class->showConstant();

echo $class::constant . "\n"; // 自 PHP 5.3.0 起

//静态数据示例
class foo1
{
    // 自 PHP 5.3.0 起
    const bar = <<<'EOT'
bar
EOT;
}

//和 heredoc 不同，nowdoc 可以用在任何静态数据中。Nowdoc 支持是在 PHP 5.3.0 新增的。

/*
 * 自动加载类
 * 很多开发者写面向对象的应用程序时对每个类的定义建立一个 PHP 源文件。
 * 一个很大的烦恼是不得不在每个脚本开头写一个长长的包含文件列表（每个类一个文件）。
 * 在 PHP 5 中，不再需要这样了。可以定义一个 __autoload() 函数，它会在试图使用尚未被定义的类时自动调用。
 * 通过调用此函数，脚本引擎在 PHP 出错失败前有了最后一个机会加载所需的类。
 *
 * spl_autoload_register() 提供了一种更加灵活的方式来实现类的自动加载。
 * 因此，不再建议使用 __autoload() 函数，在以后的版本中它可能被弃用。
 *
 * 在 5.3.0 版之前，__autoload 函数抛出的异常不能被 catch 语句块捕获并会导致一个致命错误。
 * 从 5.3.0+ 之后，__autoload 函数抛出的异常可以被 catch 语句块捕获，但需要遵循一个条件。
 * 如果抛出的是一个自定义异常，那么必须存在相应的自定义异常类。
 * __autoload 函数可以递归的自动加载自定义异常类。
 *
 * 自动加载不可用于 PHP 的 CLI 交互模式。
 * 如果类名比如被用于 call_user_func()，则它可能包含一些危险的字符，比如 ../。
 * 建议您在这样的函数中不要使用用户的输入，起码需要在 __autoload() 时验证下输入。
 */

/*
 * unserialize()
 * unserialize_callback_func
 * spl_autoload()
 * spl_autoload_register()
 */

/*
 * 构造函数和析构函数
 * 构造函数
 * void __construct ([ mixed $args [, $... ]] )
 * PHP 5 允行开发者在一个类中定义一个方法作为构造函数。
 * 具有构造函数的类会在每次创建新对象时先调用此方法，所以非常适合在使用对象之前做一些初始化工作。
 * 如果子类中定义了构造函数则不会隐式调用其父类的构造函数。
 * 要执行父类的构造函数，需要在子类的构造函数中调用 parent::__construct()。
 * 如果子类没有定义构造函数则会如同一个普通的类方法一样从父类继承（假如没有被定义为 private 的话）。
 * 使用新标准的构造函数
 */

class BaseClass
{
    function __construct()
    {
        print "In BaseClass constructor\n";
    }
}

class SubClass extends BaseClass
{
    function __construct()
    {
        parent::__construct();
        print "In SubClass constructor\n";
    }
}

class OtherSubClass extends BaseClass
{
    // inherits BaseClass's constructor
}

// In BaseClass constructor
$obj = new BaseClass();

// In BaseClass constructor
// In SubClass constructor
$obj = new SubClass();

// In BaseClass constructor
$obj = new OtherSubClass();

/*
 * 为了实现向后兼容性，如果 PHP 5 在类中找不到 __construct() 函数并且也没有从父类继承一个的话，
 * 它就会尝试寻找旧式的构造函数，也就是和类同名的函数。
 * 因此唯一会产生兼容性问题的情况是：类中已有一个名为 __construct() 的方法却被用于其它用途时。
 * 与其它方法不同，当 __construct() 被与父类 __construct() 具有不同参数的方法覆盖时，PHP 不会产生一个 E_STRICT 错误信息。
 * 自 PHP 5.3.3 起，在命名空间中，与类名同名的方法不再作为构造函数。这一改变不影响不在命名空间中的类。
 */
/*
namespace Foo;
class Bar {
        public function Bar() {
                // treated as constructor in PHP 5.3.0-5.3.2
        // treated as regular method as of PHP 5.3.3
    }
}
*/

/*
 * 析构函数
 * void __destruct ( void )
 * PHP 5 引入了析构函数的概念，这类似于其它面向对象的语言，如 C++。析构函数会在到某个对象的所有引用都被删除或者当对象被显式销毁时执行。
 * 析构函数示例
 */

class MyDestructableClass
{
    function __construct()
    {
        print "In constructor\n";
        $this->name = "MyDestructableClass";
    }

    function __destruct()
    {
        print "Destroying " . $this->name . "\n";
    }
}

$obj = new MyDestructableClass();
/*
 * 和构造函数一样，父类的析构函数不会被引擎暗中调用。
 * 要执行父类的析构函数，必须在子类的析构函数体中显式调用 parent::__destruct()。
 * 此外也和构造函数一样，子类如果自己没有定义析构函数则会继承父类的。
 * 析构函数即使在使用 exit() 终止脚本运行时也会被调用。在析构函数中调用 exit() 将会中止其余关闭操作的运行。
 *
 * 析构函数在脚本关闭时调用，此时所有的 HTTP 头信息已经发出。脚本关闭时的工作目录有可能和在 SAPI（如 apache）中时不同。
 *
 * 试图在析构函数（在脚本终止时被调用）中抛出一个异常会导致致命错误。
 */

/*
 * 访问控制（可见性）
 * http://php.net/manual/zh/language.oop5.visibility.php
 *
 * 对属性或方法的访问控制，是通过在前面添加关键字 public（公有），protected（受保护）或 private（私有）来实现的。
 * 被定义为公有的类成员可以在任何地方被访问。
 * 被定义为受保护的类成员则可以被其自身以及其子类和父类访问。
 * 被定义为私有的类成员则只能被其定义所在的类访问。
 *
 * 属性的访问控制
 * 类属性必须定义为公有，受保护，私有之一。如果用 var 定义，则被视为公有。
 *
 * 为了兼容性考虑，在 PHP 4 中使用 var 关键字对变量进行定义的方法在 PHP 5 中仍然有效（只是作为 public 关键字的一个别名）。
 * 在 PHP 5.1.3 之前的版本，该语法会产生一个 E_STRICT 警告。
 *
 * 方法的访问控制
 * 类中的方法可以被定义为公有，私有或受保护。如果没有设置这些关键字，则该方法默认为公有。
 *
 * 其它对象的访问控制
 * 同一个类的对象即使不是同一个实例也可以互相访问对方的私有与受保护成员。这是由于在这些对象的内部具体实现的细节都是已知的。
 */

/*
 * 对象继承
 * 继承已为大家所熟知的一个程序设计特性，PHP 的对象模型也使用了继承。继承将会影响到类与类，对象与对象之间的关系。
 * 比如，当扩展一个类，子类就会继承父类所有公有的和受保护的方法。除非子类覆盖了父类的方法，被继承的方法都会保留其原有功能。
 * 继承对于功能的设计和抽象是非常有用的，而且对于类似的对象增加新功能就无须重新再写这些公用的功能。
 *
 * 除非使用了自动加载，否则一个类必须在使用之前被定义。
 * 如果一个类扩展了另一个，则父类必须在子类之前被声明。此规则适用于类继承其它类与接口。
 */

class fo
{
    public function printItem($string)
    {
        echo 'Foo: ' . $string . PHP_EOL;
    }

    public function printPHP()
    {
        echo 'PHP is great.' . PHP_EOL;
    }
}

class bar extends fo
{
    public function printItem($string)
    {
        echo 'Bar: ' . $string . PHP_EOL;
    }
}

$foo = new fo();
$bar = new bar();
$foo->printItem('baz'); // Output: 'Foo: baz'
$foo->printPHP();       // Output: 'PHP is great' 
$bar->printItem('baz'); // Output: 'Bar: baz'
$bar->printPHP();       // Output: 'PHP is great'

/*
 * 范围解析操作符 （::）
 * 范围解析操作符（也可称作 Paamayim Nekudotayim）或者更简单地说是一对冒号，可以用于访问静态成员，类常量，
 * 还可以用于覆盖类中的属性和方法。
 * 当在类定义之外引用到这些项目时，要使用类名。
 * 自 PHP 5.3.0 起，可以通过变量来引用类，该变量的值不能是关键字（如 self，parent 和 static）。
 * 把 Paamayim Nekudotayim 选作双冒号操作符的名字似乎有些奇怪。
 * 然而，这是 Zend 开发小组在写 Zend Engine 0.5（被用于 PHP 3 中）时所作出的决定。
 * 事实上这个词在希伯莱文就是双冒号的意思。
 *
 * self，parent 和 static 这三个特殊的关键字是用于在类定义的内部对其属性或方法进行访问的。
 *
 * 当一个子类覆盖其父类中的方法时，PHP 不会调用父类中已被覆盖的方法。是否调用父类的方法取决于子类。
 * 这种机制也作用于构造函数和析构函数，重载以及魔术方法。
 */

/*
 * Static（静态）关键字
 * 用 static 关键字来定义静态方法和属性。static 也可用于定义静态变量以及后期静态绑定。
 * 声明类属性或方法为静态，就可以不实例化类而直接访问。静态属性不能通过一个类已实例化的对象来访问（但静态方法可以）。
 * 为了兼容 PHP 4，如果没有指定访问控制，属性和方法默认为公有。
 * 由于静态方法不需要通过对象即可调用，所以伪变量 $this 在静态方法中不可用。
 * 静态属性不可以由对象通过 -> 操作符来访问。
 * 用静态方式调用一个非静态方法会导致一个 E_STRICT 级别的错误。
 * 就像其它所有的 PHP 静态变量一样，静态属性只能被初始化为文字或常量，不能使用表达式。
 * 所以可以把静态属性初始化为整数或数组，但不能初始化为另一个变量或函数返回值，也不能指向一个对象。
 * 自 PHP 5.3.0 起，可以用一个变量来动态调用类。但该变量的值不能为关键字 self，parent 或 static。
 */

/*
 * 抽象类
 * PHP 5 支持抽象类和抽象方法。
 * 定义为抽象的类不能被实例化。
 * 任何一个类，如果它里面至少有一个方法是被声明为抽象的，那么这个类就必须被声明为抽象的。
 * 被定义为抽象的方法只是声明了其调用方式（参数），不能定义其具体的功能实现。
 * 继承一个抽象类的时候，子类必须定义父类中的所有抽象方法；
 * 另外，这些方法的访问控制必须和父类中一样（或者更为宽松）。
 * 例如某个抽象方法被声明为受保护的，那么子类中实现的方法就应该声明为受保护的或者公有的，而不能定义为私有的。
 * 此外方法的调用方式必须匹配，即类型和所需参数数量必须一致。
 * 例如，子类定义了一个可选参数，而父类抽象方法的声明里没有，则两者的声明并无冲突。
 * 这也适用于 PHP 5.4 起的构造函数。在 PHP 5.4 之前的构造函数声明可以不一样的。
 */

/*
 * 对象接口
 * 使用接口（interface），可以指定某个类必须实现哪些方法，但不需要定义这些方法的具体内容。
 * 接口是通过 interface 关键字来定义的，就像定义一个标准的类一样，但其中定义所有的方法都是空的。
 * 接口中定义的所有方法都必须是公有，这是接口的特性。
 *
 * 实现（implements）
 * 要实现一个接口，使用 implements 操作符。
 * 类中必须实现接口中定义的所有方法，否则会报一个致命错误。
 * 类可以实现多个接口，用逗号来分隔多个接口的名称。
 *
 * 实现多个接口时，接口中的方法不能有重名。
 * 接口也可以继承，通过使用 extends 操作符。
 * 类要实现接口，必须使用和接口中所定义的方法完全一致的方式。否则会导致致命错误。
 *
 * 常量
 * 接口中也可以定义常量。接口常量和类常量的使用完全相同，但是不能被子类或子接口所覆盖。
 *
 * 接口加上类型约束，提供了一种很好的方式来确保某个对象包含有某些方法。参见 instanceof 操作符和类型约束。
 */

/*
 * Trait
 * 自 PHP 5.4.0 起，PHP 实现了一种代码复用的方法，称为 trait。
 * Trait 是为类似 PHP 的单继承语言而准备的一种代码复用机制。
 * Trait 为了减少单继承语言的限制，使开发人员能够自由地在不同层次结构内独立的类中复用 method。
 * Trait 和 Class 组合的语义定义了一种减少复杂性的方式，避免传统多继承和 Mixin 类相关典型问题。
 * Trait 和 Class 相似，但仅仅旨在用细粒度和一致的方式来组合功能。
 * 无法通过 trait 自身来实例化。它为传统继承增加了水平特性的组合；也就是说，应用的几个 Class 之间不需要继承。
 *
 * 优先级
 * 从基类继承的成员会被 trait 插入的成员所覆盖。
 * 优先顺序是来自当前类的成员覆盖了 trait 的方法，而 trait 则覆盖了被继承的方法。
 * 从基类继承的成员被插入的 SayWorld Trait 中的 MyHelloWorld 方法所覆盖。
 * 其行为 MyHelloWorld 类中定义的方法一致。优先顺序是当前类中的方法会覆盖 trait 方法，而 trait 方法又覆盖了基类中的方法。
 *
 * 多个 trait
 * 通过逗号分隔，在 use 声明列出多个 trait，可以都插入到一个类中。
 *
 * 冲突的解决
 * 如果两个 trait 都插入了一个同名的方法，如果没有明确解决冲突将会产生一个致命错误。
 * 为了解决多个 trait 在同一个类中的命名冲突，需要使用 insteadof 操作符来明确指定使用冲突方法中的哪一个。
 * 以上方式仅允许排除掉其它方法，as 操作符可以将其中一个冲突的方法以另一个名称来引入。
 *
 * 修改方法的访问控制
 * 使用 as 语法还可以用来调整方法的访问控制。
 *
 * 从 trait 来组成 trait
 * 正如 class 能够使用 trait 一样，其它 trait 也能够使用 trait。
 * 在 trait 定义时通过使用一个或多个 trait，能够组合其它 trait 中的部分或全部成员
 *
 * Trait 的抽象成员
 * 为了对使用的类施加强制要求，trait 支持抽象方法的使用。
 *
 * Trait 的静态成员
 * Traits 可以被静态成员静态方法定义。
 *
 * 属性
 * Trait 同样可以定义属性。
 * 如果 trait 定义了一个属性，那类将不能定义同样名称的属性，否则会产生一个错误。
 * 如果该属性在类中的定义与在 trait 中的定义兼容（同样的可见性和初始值）则错误的级别是 E_STRICT，否则是一个致命错误。
 */

/*
 * 匿名类
 * PHP 7 开始支持匿名类。 匿名类很有用，可以创建一次性的简单对象。
 * 可以传递参数到匿名类的构造器，也可以扩展（extend）其他类、实现接口（implement interface），以及像其他普通的类一样使用 trait：
 *
 * 匿名类被嵌套进普通 Class 后，不能访问这个外部类（Outer class）的 private（私有）、protected（受保护）方法或者属性。
 * 为了访问外部类（Outer class）protected 属性或方法，匿名类可以 extend（扩展）此外部类。
 * 为了使用外部类（Outer class）的 private 属性，必须通过构造器传进来：
 */

/*
 * 重载
 * http://php.net/manual/zh/language.oop5.overloading.php
 */

/*
 * 遍历对象
 * PHP 5 提供了一种定义对象的方法使其可以通过单元列表来遍历，例如用 foreach 语句。默认情况下，所有可见属性都将被用于遍历。
 * foreach 遍历了所有其能够访问的可见属性。
 *
 * 更进一步，可以实现 Iterator 接口。可以让对象自行决定如何遍历以及每次遍历时那些值可用。
 *
 * 可以用 IteratorAggregate 接口以替代实现所有的 Iterator 方法。
 * IteratorAggregate 只需要实现一个方法 IteratorAggregate::getIterator()，其应返回一个实现了 Iterator 的类的实例。
 * PHP 5.5 及以后版本的用户也可参考生成器，其提供了另一方法来定义 Iterators。
 */

/*
 * 魔术方法
 *
 * __construct()， __destruct()， __call()， __callStatic()， __get()， __set()， __isset()， __unset()，
 * __sleep()， __wakeup()， __toString()， __invoke()， __set_state()， __clone() 和 __debugInfo()
 * 等方法在 PHP 中被称为"魔术方法"（Magic methods）。
 * 在命名自己的类方法时不能使用这些方法名，除非是想使用其魔术功能。
 *
 * PHP 将所有以 __（两个下划线）开头的类方法保留为魔术方法。所以在定义类方法时，除了上述魔术方法，建议不要以 __ 为前缀
 *
 * __sleep() 和 __wakeup()
 * public array __sleep ( void )
 * void __wakeup ( void )
 * serialize() 函数会检查类中是否存在一个魔术方法 __sleep()。
 * 如果存在，该方法会先被调用，然后才执行序列化操作。
 * 此功能可以用于清理对象，并返回一个包含对象中所有应被序列化的变量名称的数组。
 * 如果该方法未返回任何内容，则 NULL 被序列化，并产生一个 E_NOTICE 级别的错误。
 *
 * __sleep() 不能返回父类的私有成员的名字。这样做会产生一个 E_NOTICE 级别的错误。可以用 Serializable 接口来替代。
 * __sleep() 方法常用于提交未提交的数据，或类似的清理操作。同时，如果有一些很大的对象，但不需要全部保存，这个功能就很好用。
 * 与之相反，unserialize() 会检查是否存在一个 __wakeup() 方法。如果存在，则会先调用 __wakeup 方法，预先准备对象需要的资源。
 * __wakeup() 经常用在反序列化操作中，例如重新建立数据库连接，或执行其它初始化操作。
 *
 * __toString()
 * public string __toString ( void )
 * __toString() 方法用于一个类被当成字符串时应怎样回应。
 * 例如 echo $obj; 应该显示些什么。此方法必须返回一个字符串，否则将发出一条 E_RECOVERABLE_ERROR 级别的致命错误。
 * 不能在 __toString() 方法中抛出异常。这么做会导致致命错误。
 *
 * 需要指出的是在 PHP 5.2.0 之前，__toString() 方法只有在直接使用于 echo 或 print 时才能生效。
 * PHP 5.2.0 之后，则可以在任何字符串环境生效（例如通过 printf()，使用 %s 修饰符），
 * 但不能用于非字符串环境（如使用 %d 修饰符）。
 * 自 PHP 5.2.0 起，如果将一个未定义 __toString() 方法的对象转换为字符串，会产生 E_RECOVERABLE_ERROR 级别的错误。
 *
 * __invoke()
 * mixed __invoke ([ $... ] )
 * 当尝试以调用函数的方式调用一个对象时，__invoke() 方法会被自动调用。
 * 本特性只在 PHP 5.3.0 及以上版本有效。
 *
 * __set_state()
 * static object __set_state ( array $properties )
 * 自 PHP 5.1.0 起当调用 var_export() 导出类时，此静态 方法会被调用。
 * 本方法的唯一参数是一个数组，其中包含按 array('property' => value, ...) 格式排列的类属性。
 *
 * __debugInfo()
 * array __debugInfo ( void )
 * This method is called by var_dump() when dumping an object to get the properties that should be shown.
 * If the method isn't defined on an object, then all public, protected and private properties will be shown.
 * This feature was added in PHP 5.6.0.
 */

/*
 * Final 关键字
 * PHP 5 新增了一个 final 关键字。如果父类中的方法被声明为 final，则子类无法覆盖该方法。如果一个类被声明为 final，则不能被继承。
 * 属性不能被定义为 final，只有类和方法才能被定义为 final。
 */

/*
 * 对象复制
 * 在多数情况下，我们并不需要完全复制一个对象来获得其中属性。
 * 但有一个情况下确实需要：如果你有一个 GTK 窗口对象，该对象持有窗口相关的资源。
 * 你可能会想复制一个新的窗口，保持所有属性与原来的窗口相同，
 * 但必须是一个新的对象（因为如果不是新的对象，那么一个窗口中的改变就会影响到另一个窗口）。
 * 还有一种情况：如果对象 A 中保存着对象 B 的引用，当你复制对象 A 时，
 * 你想其中使用的对象不再是对象 B 而是 B 的一个副本，那么你必须得到对象 A 的一个副本。
 *
 * 对象复制可以通过 clone 关键字来完成（如果可能，这将调用对象的 __clone() 方法）。对象中的 __clone() 方法不能被直接调用。
 * $copy_of_object = clone $object;
 * 当对象被复制后，PHP 5 会对对象的所有属性执行一个浅复制（shallow copy）。所有的引用属性 仍然会是一个指向原来的变量的引用。
 * void __clone ( void )
 * 当复制完成时，如果定义了 __clone() 方法，
 * 则新创建的对象（复制生成的对象）中的 __clone() 方法会被调用，可用于修改属性的值（如果有必要的话）。
 *
 * 串行化可以进行深复制
 */

/*
 * 对象比较
 * PHP 5 中的对象比较要比 PHP 4 中复杂，所期望的结果更符合一个面向对象语言。
 * 当使用比较运算符（==）比较两个对象变量时，比较的原则是：
 * 如果两个对象的属性和属性值 都相等，而且两个对象是同一个类的实例，那么这两个对象变量相等。
 * 而如果使用全等运算符（===），这两个对象变量一定要指向某个类的同一个实例（即同一个对象）。
 *
 * PHP 扩展中可以自行定义对象比较的原则。
 */

/*
 * 类型约束
 * PHP 5 可以使用类型约束。
 * 函数的参数可以指定必须为对象（在函数原型里面指定类的名字），接口，数组（PHP 5.1 起）或者 callable（PHP 5.4 起）。
 * 不过如果使用 NULL 作为参数的默认值，那么在调用函数的时候依然可以使用 NULL 作为实参。
 * 如果一个类或接口指定了类型约束，则其所有的子类或实现也都如此。
 * 类型约束不能用于标量类型如 int 或 string。Traits 也不允许。
 *
 * 函数调用的参数与定义的参数类型不一致时，会抛出一个可捕获的致命错误。
 *
 * 类型约束不只是用在类的成员函数里，也能使用在函数里：
 *
 * 类型约束允许 NULL 值：
 */

/*
 * 后期静态绑定
 * 自 PHP 5.3.0 起，PHP 增加了一个叫做后期静态绑定的功能，用于在继承范围内引用静态调用的类。
 * 准确说，后期静态绑定工作原理是存储了在上一个“非转发调用”（non-forwarding call）的类名。
 * 当进行静态方法调用时，该类名即为明确指定的那个（通常在 :: 运算符左侧部分）；
 * 当进行非静态方法调用时，即为该对象所属的类。
 * 所谓的“转发调用”（forwarding call）指的是通过以下几种方式进行的静态调用：
 * self::，parent::，static:: 以及 forward_static_call()。
 * 可用 get_called_class() 函数来得到被调用的方法所在的类名，static:: 则指出了其范围。
 * 该功能从语言内部角度考虑被命名为“后期静态绑定”。
 * “后期绑定”的意思是说，static:: 不再被解析为定义当前方法所在的类，而是在实际运行时计算的。
 * 也可以称之为“静态绑定”，因为它可以用于（但不限于）静态方法的调用。
 *
 * self:: 的限制
 * 使用 self:: 或者 __CLASS__ 对当前类的静态引用，取决于定义当前方法所在的类：
 *
 * 后期静态绑定的用法
 *
 * 后期静态绑定本想通过引入一个新的关键字表示运行时最初调用的类来绕过限制。
 * 简单地说，这个关键字能够让你在上述例子中调用 test() 时引用的类是 B 而不是 A。
 * 最终决定不引入新的关键字，而是使用已经预留的 static 关键字。
 *
 * 在非静态环境下，所调用的类即为该对象实例所属的类。
 * 由于 $this-> 会在同一作用范围内尝试调用私有方法，而 static:: 则可能给出不同结果。
 * 另一个区别是 static:: 只能用于静态属性。
 *
 * 后期静态绑定的解析会一直到取得一个完全解析了的静态调用为止。另一方面，如果静态调用使用 parent:: 或者 self:: 将转发调用信息。
 */

/*
 * 对象和引用
 * 在php5 的对象编程经常提到的一个关键点是“默认情况下对象是通过引用传递的”。但其实这不是完全正确的。下面通过一些例子来说明。
 * php的引用是别名，就是两个不同的变量名字指向相同的内容。
 * 在php5，一个对象变量已经不再保存整个对象的值。只是保存一个标识符来访问真正的对象内容。
 * 当对象作为参数传递，作为结果返回，或者赋值给另外一个变量，另外一个变量跟原来的不是引用的关系，
 * 只是他们都保存着同一个标识符的拷贝，这个标识符指向同一个对象的真正内容。
 *
 * 对象序列化
 * 序列化对象 - 在会话中存放对象
 * 所有php里面的值都可以使用函数serialize()来返回一个包含字节流的字符串来表示。unserialize()函数能够重新把字符串变回php原来的值。
 * 序列化一个对象将会保存对象的所有变量，但是不会保存对象的方法，只会保存类的名字。
 * 为了能够unserialize()一个对象，这个对象的类必须已经定义过。
 * 如果序列化类A的一个对象，将会返回一个跟类A相关，而且包含了对象所有变量值的字符串。
 * 如果要想在另外一个文件中解序列化一个对象，这个对象的类必须在解序列化之前定义，
 * 可以通过包含一个定义该类的文件或使用函数spl_autoload_register()来实现。
 *
 * 当一个应用程序使用函数session_register()来保存对象到会话中时，
 * 在每个页面结束的时候这些对象都会自动序列化，而在每个页面开始的时候又自动解序列化。
 * 所以一旦对象被保存在会话中，整个应用程序的页面都能使用这些对象。
 * 但是，session_register()在php5.4.0之后被移除了。
 * 在应用程序中序列化对象以便在之后使用，强烈推荐在整个应用程序都包含对象的类的定义。
 * 不然有可能出现在解序列化对象的时候，没有找到该对象的类的定义，
 * 从而把没有方法的类__PHP_Incomplete_Class_Name作为该对象的类，导致返回一个没有用的对象。
 */

/*
 * OOP 变更日志
 * http://php.net/manual/zh/language.oop5.changelog.php
 */