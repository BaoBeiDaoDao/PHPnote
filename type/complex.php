<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016-12-13
 * Time: 15:31
 */

/*
 * PHP 中的数组实际上是一个有序映射。映射是一种把 values 关联到 keys 的类型。
 * 此类型在很多方面做了优化，因此可以把它当成真正的数组，或列表（向量），散列表（是映射的一种实现），字典，集合，栈，队列以及更多可能性。
 * 由于数组元素的值也可以是另一个数组，树形结构和多维数组也是允许的。
 */
/*
 * 定义数组 array()
 * 可以用 array() 语言结构来新建一个数组。它接受任意数量用逗号分隔的 键（key） => 值（value）对。
 * array(  key =>  value , ... )
 * 键（key）可是是一个整数 integer 或字符串 string
 * 值（value）可以是任意类型的值
 */

$array = array(
    "foo" => "bar",
    "bar" => "foo",
);

// 自 PHP 5.4 起
$array = [
    "foo" => "bar",
    "bar" => "foo",
];

/*
 * key 可以是 integer 或者 string。value 可以是任意类型。
 * 此外 key 会有如下的强制转换：
 * 包含有合法整型值的字符串会被转换为整型。例如键名 "8" 实际会被储存为 8。但是 "08" 则不会强制转换，因为其不是一个合法的十进制数值。
 * 浮点数也会被转换为整型，意味着其小数部分会被舍去。例如键名 8.7 实际会被储存为 8。
 * 布尔值也会被转换成整型。即键名 true 实际会被储存为 1 而键名 false 会被储存为 0。
 * Null 会被转换为空字符串，即键名 null 实际会被储存为 ""。
 * 数组和对象不能被用为键名。坚持这么做会导致警告：Illegal offset type。
 * 如果在数组定义中多个单元都使用了同一个键名，则只使用了最后一个，之前的都被覆盖了。
 */
$array = array(
    1 => "a",
    "1" => "b",
    1.5 => "c",
    true => "d",
);
var_dump($array);

/*
 * 上例中所有的键名都被强制转换为 1，则每一个新单元都会覆盖前一个的值，最后剩下的只有一个 "d"。
 * PHP 数组可以同时含有 integer 和 string 类型的键名，因为 PHP 实际并不区分索引数组和关联数组。
 * 如果对给出的值没有指定键名，则取当前最大的整数索引值，而新的键名将是该值加一。如果指定的键名已经有了值，则该值会被覆盖
 */
/*
 * 没有键名的索引数组
 */
$array = array("foo", "bar", "hallo", "world");
var_dump($array);

/*
 * 仅对部分单元指定键名
 */
$array = array(
    "a",
    "b",
    6 => "c",
    "d",
);
var_dump($array); //最后一个值 "d" 被自动赋予了键名 7。这是由于之前最大的整数键名是 6。

/*
 * 用方括号语法访问数组单元
 * 数组单元可以通过 array[key] 语法来访问。
 */
$array = array(
    "foo" => "bar",
    42 => 24,
    "multi" => array(
        "dimensional" => array(
            "array" => "foo"
        )
    )
);
var_dump($array["foo"]);
var_dump($array[42]);
var_dump($array["multi"]["dimensional"]["array"]);
/*
 * 方括号和花括号可以互换使用来访问数组单元（例如 $array[42] 和 $array{42} 在上例中效果相同）。
 */
/*
 * 数组间接引用
 */
function getArray()
{
    return array(1, 2, 3);
}

// on PHP 5.4
$secondElement = getArray()[1];
// previously
$tmp = getArray();
$secondElement = $tmp[1];
// or
list(, $secondElement) = getArray();

/*
 * 用方括号的语法新建／修改
 * 可以通过明示地设定其中的值来修改一个已有数组。
 * 这是通过在方括号内指定键名来给数组赋值实现的。也可以省略键名，在这种情况下给变量名加上一对空的方括号（[]）。
 * $arr[key] = value;
 * $arr[] = value;
 * // key 可以是 integer 或 string
 * // value 可以是任意类型的值
 * 如果 $arr 还不存在，将会新建一个，这也是另一种新建数组的方法。不过并不鼓励这样做，
 * 因为如果 $arr 已经包含有值（例如来自请求变量的 string）则此值会保留
 * 而 [] 实际上代表着字符串访问运算符。初始化变量的最好方式是直接给其赋值。。
 * 要修改某个值，通过其键名给该单元赋一个新值。要删除某键值对，对其调用 unset() 函数。
 */
$arr = array(5 => 1, 12 => 2);
$arr[] = 56;    // This is the same as $arr[13] = 56;
// at this point of the script
$arr["x"] = 42; // This adds a new element to
// the array with key "x"
unset($arr[5]); // This removes the element from the array
unset($arr);    // This deletes the whole array

/*
 * 如上所述，如果给出方括号但没有指定键名，则取当前最大整数索引值，新的键名将是该值加上 1（但是最小为 0）。
 * 如果当前还没有整数索引，则键名将为 0。 注意这里所使用的最大整数键名不一定当前就在数组中。
 * 它只要在上次数组重新生成索引后曾经存在过就行了。以下面的例子来说明：
 */
// 创建一个简单的数组
$array = array(1, 2, 3, 4, 5);
print_r($array);
// 现在删除其中的所有元素，但保持数组本身不变:
foreach ($array as $i => $value) {
    unset($array[$i]);
}
print_r($array);
// 添加一个单元（注意新的键名是 5，而不是你可能以为的 0）
$array[] = 6;
print_r($array);
// 重新索引：
$array = array_values($array);
$array[] = 7;
print_r($array);

/*
 * 数组函数
 *
array_change_key_case — 返回字符串键名全为小写或大写的数组
array_chunk — 将一个数组分割成多个
array_column — 返回数组中指定的一列
array_combine — 创建一个数组，用一个数组的值作为其键名，另一个数组的值作为其值
array_count_values — 统计数组中所有的值出现的次数
array_diff_assoc — 带索引检查计算数组的差集
array_diff_key — 使用键名比较计算数组的差集
array_diff_uassoc — 用用户提供的回调函数做索引检查来计算数组的差集
array_diff_ukey — 用回调函数对键名比较计算数组的差集
array_diff — 计算数组的差集
array_fill_keys — 使用指定的键和值填充数组
array_fill — 用给定的值填充数组
array_filter — 用回调函数过滤数组中的单元
array_flip — 交换数组中的键和值
array_intersect_assoc — 带索引检查计算数组的交集
array_intersect_key — 使用键名比较计算数组的交集
array_intersect_uassoc — 带索引检查计算数组的交集，用回调函数比较索引
array_intersect_ukey — 用回调函数比较键名来计算数组的交集
array_intersect — 计算数组的交集
array_key_exists — 检查给定的键名或索引是否存在于数组中
array_keys — 返回数组中部分的或所有的键名
array_map — 为数组的每个元素应用回调函数
array_merge_recursive — 递归地合并一个或多个数组
array_merge — 合并一个或多个数组
array_multisort — 对多个数组或多维数组进行排序
array_pad — 用值将数组填补到指定长度
array_pop — 将数组最后一个单元弹出（出栈）
array_product — 计算数组中所有值的乘积
array_push — 将一个或多个单元压入数组的末尾（入栈）
array_rand — 从数组中随机取出一个或多个单元
array_reduce — 用回调函数迭代地将数组简化为单一的值
array_replace_recursive — 使用传递的数组递归替换第一个数组的元素
array_replace — 使用传递的数组替换第一个数组的元素
array_reverse — 返回一个单元顺序相反的数组
array_search — 在数组中搜索给定的值，如果成功则返回相应的键名
array_shift — 将数组开头的单元移出数组
array_slice — 从数组中取出一段
array_splice — 把数组中的一部分去掉并用其它值取代
array_sum — 计算数组中所有值的和
array_udiff_assoc — 带索引检查计算数组的差集，用回调函数比较数据
array_udiff_uassoc — 带索引检查计算数组的差集，用回调函数比较数据和索引
array_udiff — 用回调函数比较数据来计算数组的差集
array_uintersect_assoc — 带索引检查计算数组的交集，用回调函数比较数据
array_uintersect_uassoc — 带索引检查计算数组的交集，用回调函数比较数据和索引
array_uintersect — 计算数组的交集，用回调函数比较数据
array_unique — 移除数组中重复的值
array_unshift — 在数组开头插入一个或多个单元
array_values — 返回数组中所有的值
array_walk_recursive — 对数组中的每个成员递归地应用用户函数
array_walk — 使用用户自定义函数对数组中的每个元素做回调处理
array — 新建一个数组
arsort — 对数组进行逆向排序并保持索引关系
asort — 对数组进行排序并保持索引关系
compact — 建立一个数组，包括变量名和它们的值
count — 计算数组中的单元数目或对象中的属性个数
current — 返回数组中的当前单元
each — 返回数组中当前的键／值对并将数组指针向前移动一步
end — 将数组的内部指针指向最后一个单元
extract — 从数组中将变量导入到当前的符号表
in_array — 检查数组中是否存在某个值
key_exists — 别名 array_key_exists
key — 从关联数组中取得键名
krsort — 对数组按照键名逆向排序
ksort — 对数组按照键名排序
list — 把数组中的值赋给一些变量
natcasesort — 用“自然排序”算法对数组进行不区分大小写字母的排序
natsort — 用“自然排序”算法对数组排序
next — 将数组中的内部指针向前移动一位
pos — current 的别名
prev — 将数组的内部指针倒回一位
range — 建立一个包含指定范围单元的数组
reset — 将数组的内部指针指向第一个单元
rsort — 对数组逆向排序
shuffle — 将数组打乱
sizeof — count 的别名
sort — 对数组排序
uasort — 使用用户自定义的比较函数对数组中的值进行排序并保持索引关联
uksort — 使用用户自定义的比较函数对数组中的键名进行排序
usort — 使用用户自定义的比较函数对数组中的值进行排序
 */

/*
 * unset() 函数允许删除数组中的某个键。但要注意数组将不会重建索引。如果需要删除后重建索引，可以用 array_values() 函数。
 *
 */
$a = array(1 => 'one', 2 => 'two', 3 => 'three');
unset($a[2]);
/* will produce an array that would have been defined as
   $a = array(1 => 'one', 3 => 'three');
   and NOT
   $a = array(1 => 'one', 2 =>'three');
*/
$b = array_values($a);
// Now $b is array(0 => 'one', 1 =>'three')

/*
 * foreach 控制结构是专门用于数组的。它提供了一个简单的方法来遍历数组。
 */
/*
 * 应该始终在用字符串表示的数组索引上加上引号。例如用 $foo['bar'] 而不是 $foo[bar]。
 * 这并不意味着总是给键名加上引号。用不着给键名为常量或变量的加上引号，否则会使 PHP 不能解析它们。
 */

/*
 * 转换为数组
 * 对于任意 integer，float，string，boolean 和 resource 类型，如果将一个值转换为数组，将得到一个仅有一个元素的数组，
 * 其下标为 0，该元素即为此标量的值。换句话说，(array)$scalarValue 与 array($scalarValue) 完全一样。
 * 如果一个 object 类型转换为 array，则结果为一个数组，其单元为该对象的属性。键名将为成员变量名，不过有几点例外：整数属性不可访问；
 * 私有变量前会加上类名作前缀；保护变量前会加上一个 '*' 做前缀。这些前缀的前后都各有一个 NULL 字符。这会导致一些不可预知的行为：
 */

class A
{
    private $A; // This will become '\0A\0A'
}

class B extends A
{
    private $A; // This will become '\0B\0A'
    public $AA; // This will become 'AA'
}

var_dump((array)new B());
/*
 * 上例会有两个键名为 'AA'，不过其中一个实际上是 '\0A\0A'。 将 NULL 转换为 array 会得到一个空的数组。
 */

/*
 * 可以用 array_diff() 和数组运算符来比较数组。
 */

/*
 * Object 对象
 * 对象初始化
 * 要创建一个新的对象 object，使用 new 语句实例化一个类：
 */

class foo
{
    function do_foo()
    {

        echo "Doing foo.";
    }
}

$bar = new foo;
$bar->do_foo();

/*
 * 转换为对象
 * 如果将一个对象转换成对象，它将不会有任何变化。如果其它任何类型的值被转换成对象，将会创建一个内置类 stdClass 的实例。
 * 如果该值为 NULL，则新的实例为空。数组转换成对象将使键名成为属性名并具有相对应的值。
 * 对于任何其它的值，名为 scalar 的成员变量将包含该值。
 */
$obj = (object)'ciao';
echo $obj->scalar;  // outputs 'ciao'
