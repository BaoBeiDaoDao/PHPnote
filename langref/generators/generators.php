<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-15
 * Time: 11:57
 */

/*
 * 生成器总览
 * 生成器提供了一种更容易的方法来实现简单的对象迭代，相比较定义类实现 Iterator 接口的方式，性能开销和复杂性大大降低。
 * 生成器允许你在 foreach 代码块中写代码来迭代一组数据而不需要在内存中创建一个数组, 那会使你的内存达到上限，或者会占据可观的处理时间。
 * 相反，你可以写一个生成器函数，就像一个普通的自定义函数一样,
 * 和普通函数只返回一次不同的是, 生成器可以根据需要 yield 多次，以便生成需要迭代的值。
 * 一个简单的例子就是使用生成器来重新实现 range() 函数。
 * 标准的 range() 函数需要在内存中生成一个数组包含每一个在它范围内的值，然后返回该数组,
 * 结果就是会产生多个很大的数组。
 * 比如，调用 range(0, 1000000) 将导致内存占用超过 100 MB。
 * 做为一种替代方法, 我们可以实现一个 xrange() 生成器,
 * 只需要足够的内存来创建 Iterator 对象并在内部跟踪生成器的当前状态，这样只需要不到1K字节的内存。
 */
function xrange($start, $limit, $step = 1)
{
    if ($start < $limit) {
        if ($step <= 0) {
            throw new LogicException('Step must be +ve');
        }

        for ($i = $start; $i <= $limit; $i += $step) {
            yield $i;
        }
    } else {
        if ($step >= 0) {
            throw new LogicException('Step must be -ve');
        }

        for ($i = $start; $i >= $limit; $i += $step) {
            yield $i;
        }
    }
}

/* 
 * 注意下面range()和xrange()输出的结果是一样的。
 */

echo 'Single digit odd numbers from range():  ';
foreach (range(1, 9, 2) as $number) {
    echo "$number ";
}
echo "\n";

echo 'Single digit odd numbers from xrange(): ';
foreach (xrange(1, 9, 2) as $number) {
    echo "$number ";
}

/*
 * Generator objects
 * When a generator function is called for the first time, an object of the internal Generator class is returned.
 * This object implements the Iterator interface in much the same way as a forward-only iterator object would,
 * and provides methods that can be called to manipulate the state of the generator,
 * including sending values to and returning values from it.
 */

/*
 * 生成器语法
 * 一个生成器函数看起来像一个普通的函数，不同的是普通函数返回一个值，而一个生成器可以yield生成许多它所需要的值。
 * 当一个生成器被调用的时候，它返回一个可以被遍历的对象.当你遍历这个对象的时候(例如通过一个foreach循环)，
 * PHP 将会在每次需要值的时候调用生成器函数，并在产生一个值之后保存生成器的状态，这样它就可以在需要产生下一个值的时候恢复调用状态。
 * 一旦不再需要产生更多的值，生成器函数可以简单退出，而调用生成器的代码还可以继续执行，就像一个数组已经被遍历完了。
 *
 * 一个生成器不可以返回值： 这样做会产生一个编译错误。然而return空是一个有效的语法并且它将会终止生成器继续执行。
 */

/*
 * yield关键字
 * 生成器函数的核心是yield关键字。
 * 它最简单的调用形式看起来像一个return申明，不同之处在于普通return会返回值并终止函数的执行，
 * 而yield会返回一个值给循环调用此生成器的代码并且只是暂停执行生成器函数。
 */
function gen_one_to_three()
{
    for ($i = 1; $i <= 3; $i++) {
        //注意变量$i的值在不同的yield之间是保持传递的。
        yield $i;
    }
}

$generator = gen_one_to_three();
foreach ($generator as $value) {
    echo "$value\n";
}
/*
 * 在内部会为生成的值配对连续的整型索引，就像一个非关联的数组。
 * 如果在一个表达式上下文(例如在一个赋值表达式的右侧)中使用yield，你必须使用圆括号把yield申明包围起来。 例如这样是有效的：
 * $data = (yield $value);
 * 而这样就不合法，并且在PHP5中会产生一个编译错误：
 * $data = yield $value;
 * The parenthetical restrictions do not apply in PHP 7.
 * 这个语法可以和生成器对象的Generator::send()方法配合使用。
 */

/*
 * 指定键名来生成值
 * PHP的数组支持关联键值对数组，生成器也一样支持。所以除了生成简单的值，你也可以在生成值的时候指定键名。
 * 如下所示，生成一个键值对与定义一个关联数组十分相似。
 */
/* 
 * 下面每一行是用分号分割的字段组合，第一个字段将被用作键名。
 */

$input = <<<'EOF'
1;PHP;Likes dollar signs
2;Python;Likes whitespace
3;Ruby;Likes blocks
EOF;

function input_parser($input)
{
    foreach (explode("\n", $input) as $line) {
        $fields = explode(';', $line);
        $id = array_shift($fields);

        yield $id => $fields;
    }
}

foreach (input_parser($input) as $id => $fields) {
    echo "$id:\n";
    echo "    $fields[0]\n";
    echo "    $fields[1]\n";
}
/*
 * Caution和之前生成简单值类型一样，在一个表达式上下文中生成键值对也需要使用圆括号进行包围：
 * $data = (yield $key => $value); 
 */

/*
 * 生成null值
 * Yield可以在没有参数传入的情况下被调用来生成一个 NULL值并配对一个自动的键名。
 */

/*
 * 使用引用来生成值
 * 生成函数可以像使用值一样来使用引用生成。
 * 这个和returning references from functions（从函数返回一个引用）一样：
 * 通过在函数名前面加一个引用符号。
 *
 * Generator delegation via yield from
 * In PHP 7, generator delegation allows you to yield values from another generator,
 * Traversable object, or array by using the yield from keyword.
 * The outer generator will then yield all values from the inner generator, object,
 * or array until that is no longer valid, after which execution will continue in the outer generator.
 * If a generator is used with yield from, the yield from expression
 * will also return any value returned by the inner generator.
 */

/*
 * Comparing generators with Iterator objects
 * The primary advantage of generators is their simplicity.
 * Much less boilerplate code has to be written compared to implementing an Iterator class,
 * and the code is generally much more readable.
 *
 * This flexibility does come at a cost, however: generators are forward-only iterators,
 * and cannot be rewound once iteration has started.
 * This also means that the same generator can't be iterated over multiple times:
 * the generator will need to either be rebuilt by calling the generator function again,
 * or cloned via the clone keyword.
 */