<?php

$html['title'] = 'PHP Associative Arrays';
$html['description'] = 'Learn how to use associative arrays in PHP';

echo ("<pre/>");
print_r($html);
echo ("<pre/>");


echo $html['description'];


// echo '<br/>';
// $colors = ['red', 'green', 'blue'];

// foreach ($colors as $key => $value) {
//     echo $key + 1 . ')' . ' ' . $value .  '<br/>';
// }

// echo '<br/>';
// $capitals = [
//     'Japan' => 'Tokyo',
//     'France' => 'Paris',
//     'Germany' => 'Berlin',
//     'United Kingdom' => 'London',
//     'United States' => 'Washington D.C.'
// ];

// foreach ($capitals as $country => $capital) {
//     echo "The capital city of $country is <b>$capital</b>" . '<br/>';
// }

echo '<br/>';
$tasks = [
    ['Learn PHP programming', 2],
    ['Practice PHP', 2],
    ['Work', 8],
    ['Do exercise', 1],
];

$tasks = [['Build something matter in PHP', 2], ...$tasks];
unset($tasks[count($tasks) - 2]);

array_splice($tasks, 2, count($tasks));
print_r($tasks);

foreach ($tasks as $task) {
    foreach ($task as $task_detai) {
        echo $l . '<br>';
    }
}
echo '<br/>';

$colors = [
    'red' => '#ff000',
    'green' => '#00ff00',
    'blue' => '#0000ff',
];

$colors = ['black' => '#000000'] + $colors;
print_r($colors);

// Remove from front array_shift
// Add to front array_unshift
// Remove from back array_pop
// Add to back array_push
echo '<br/>';

$user = [
    'username' => 'admin',
    'email' => 'admin@phptutorial.net',
    'is_active' => '1'
];

$properties = array_keys($user); //Only keys
$properties = array_keys($user, 'admin'); // Search Value of a key
$strict = array_keys($user, 'admin'); // Strict Search Value of a key

print_r($strict);

echo '<br/>';

function array_keys_by(array $array, callable $callback): array
{
    $keys = [];
    foreach ($array as $key => $value) {
        if ($callback($key)) {
            $keys[] = $key;
        }
    }

    return $keys;
}

$permissions = [
    'edit_post' => 1,
    'delete_post' => 2,
    'publish_post' => 3,
    'approve' => 4,
];

$keys = array_keys_by($permissions, function ($permission) {
    return strpos($permission, 'ove');
});

print_r($keys);

// isset checks if a value-key is available and is not null
$path =  pathinfo('c:\temp\readme.txt');
print_r($path);

$fruits = ['apple', 'Banana', 'orange'];
sort($fruits, SORT_FLAG_CASE | SORT_STRING);

// print($fruits);

// class Person
// {
//     public $name;

//     public $age;

//     public function __construct(string $name, int $age)
//     {
//         $this->name = $name;
//         $this->age = $age;
//     }
// }

// class PersonComparer
// {
//     public static function compare(Person $x, Person $y)
//     {
//         return $x->age <=> $y->age;
//     }
// }

// $group = [
//     new Person('Bob', 20),
//     new Person('Alex', 25),
//     new Person('Peter', 30),
// ];

// usort($group, ['PersonComparer', 'compare']);

// print_r($group);

function add(int $a, int $b): int
{
    return $a + $b;
}

$result = call_user_func_array('add', [10, 20]);
$result2 = add(10, 20);

echo $result . "<br/>";
echo $result2 . "<br/>";

$lengths = [10, 20, 30];
$areas = array_map(fn($length) => ($length * $length), $lengths);

class Square
{
    public static function area($length)
    {
        return $length * $length;
    }
}

$lengths = [10, 20, 30];

$areas = array_map('Square::area', $lengths);
