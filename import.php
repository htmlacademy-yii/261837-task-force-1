<?php
use Htmlacademy\Import\Converter;

require_once "vendor/autoload.php";

$data = [
    [
        'src' => 'data/categories.csv',
        'dst' => 'sql/categories.sql',
        'table' => 'categories',
        'header' => ['name' => 'text', 'icon' => 'text'],
        'add_fields' => [],
    ],

    [
        'src' => 'data/cities.csv',
        'dst' => 'sql/cities.sql',
        'table' => 'cities',
        'header' => ['city_name' => 'text', 'lat' => 'number', 'lng' => 'number'],
        'add_fields' => [],
    ],

    [
        'src' => 'data/users.csv',
        'dst' => 'sql/users.sql',
        'table' => 'users',
        'header' => ['email' => 'text', 'name' => 'text', 'password' => 'text', 'created_at' => 'text'],
        'add_fields' => [],
    ],

    [
        'src' => 'data/profiles.csv',
        'dst' => 'sql/user_profiles.sql',
        'table' => 'user_profiles',
        'header' => ['address' => 'text', 'birthday' => 'text', 'information' => 'text', 'contact_phone' => 'text', 'contact_skype' => 'text'],
        'add_fields' =>
            [
                ['field_name' => 'user_id', 'field_type' => 'number', 'random' => [1, 20]],
                ['field_name' => 'city_id', 'field_type' => 'number', 'random' => [1, 1108]],
            ]
    ],

    [
        'src' => 'data/tasks.csv',
        'dst' => 'sql/tasks.sql',
        'table' => 'tasks',
        'header' =>
            [
                'created_at' => 'text', 'category_id' => 'number', 'description' => 'text',
                'date_close' => 'text', 'name' => 'text', 'address' => 'text', 'budget' => 'number',
                'lat' => 'number', 'lng' => 'number'
            ],
        'add_fields' =>
            [
                ['field_name' => 'status', 'field_type' => 'text', 'random' => ['new', 'processing', 'canceled', 'completed', 'failed']],
                ['field_name' => 'owner_user_id', 'field_type' => 'number', 'random' => [1, 20]],
                ['field_name' => 'performer_user_id', 'field_type' => 'number', 'random' => [1, 20]],
                ['field_name' => 'city_id', 'field_type' => 'number', 'random' => [1, 1108]],
            ]
    ],

    [
        'src' => 'data/replies.csv',
        'dst' => 'sql/responses.sql',
        'table' => 'responses',
        'header' => ['created_at' => 'text', 'task_id' => 'number', 'comment' => 'text'],
        'add_fields' =>
            [
                ['field_name' => 'user_id', 'field_type' => 'number', 'random' => [1, 20]],
                ['field_name' => 'price', 'field_type' => 'number', 'random' => [1, 10000]],
            ]
    ],

    [
        'src' => 'data/opinions.csv',
        'dst' => 'sql/reviews.sql',
        'table' => 'reviews',
        'header' => ['created_at' => 'text', 'score' => 'number', 'message' => 'text'],
        'add_fields' =>
            [
                ['field_name' => 'task_id', 'field_type' => 'number', 'random' => [1, 10]],
                ['field_name' => 'owner_id', 'field_type' => 'number', 'random' => [1, 20]],
                ['field_name' => 'performer_id', 'field_type' => 'number', 'random' => [1, 20]],
                ['field_name' => 'task_completed', 'field_type' => 'number', 'random' => [0, 1]],
            ]
    ],

];
try {
    foreach ($data as $instance) {
        $converter = new Converter($instance['src'], $instance['dst'], $instance['table'], $instance['header'], $instance['add_fields']);
        $converter->convert();
    }
    $dh_host = 'localhost';
    $db_user = 'root';
    $db_password = '';
    $db_name = 'taskforce';
    $db_schema = 'sql/schema_v1.sql';

    $mysqli = new mysqli($dh_host, $db_user, $db_password, $db_name);
    if (mysqli_connect_errno()) {
        print("Не удалось подключиться к базе данных: " . mysqli_connect_error());
        exit();
    }

    $files = array_column($data, 'dst');
    array_unshift($files, $db_schema);

    foreach ($files as $file) {
        $sql = file_get_contents($file);
        print("Импорт $file: ");
        $message = $mysqli->multi_query($sql) ? "Успешно" : "Ошибка: " . $mysqli->error;
        print("$message<br>");

        while ($mysqli->more_results() && $mysqli->next_result()) {
            $mysqli->use_result();
        }

        if ($file !== $db_schema) {
            unlink($file);
        }
    }
} catch (Throwable $exc) {
    print("Не удалось выполнить импорт. Ошибка: " . $exc->getMessage());
}
