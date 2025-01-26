<?php

function executeDatabaseCommand($action) {
    // Параметры подключения к базе данных
    $username = 'local_user';
    $password = 'local_user_pass_2024';
    $database = 'redwood_db';
    $file = 'C:\OSPanel\domains\redwood\mysql-dump\db_dump.sql';
    // $file = 'D:\ospanel\domains\redwood\mysql-dump\db_dump.sql';

    // Путь к директории с mysql
    $mysqldumpPath = 'C:\OSPanel\modules\database\MySQL-8.0-Win10\bin';
    // $mysqldumpPath = 'D:\ospanel\modules\database\MySQL-8.0-Win10\bin';

    // Команды для экспорта и импорта базы данных
    if ($action === 'export') {
        $command = "cd $mysqldumpPath && mysqldump --user=$username --password=$password --host=localhost --port=3306 --default-character-set=utf8mb4 --single-transaction --quick --lock-tables=false --skip-add-locks --skip-comments --skip-extended-insert --complete-insert --set-charset $database > $file";
    } elseif ($action === 'import') {
        $command = "cd $mysqldumpPath && mysql --user=$username --password=$password --host=localhost --port=3306 $database < $file";
    } else {
        echo "Некорректное действие.";
        return;
    }

    // Выполнение команды
    exec($command, $output, $retval);

    // Проверка успешности выполнения команды
    if ($retval == 0) {
        echo $action === 'export' ? "Дамп базы данных успешно экспортирован и сохранен в $file." : "База данных импортирована из файла $file.";
    } else {
        echo $action === 'export' ? "Ошибка при экспорте базы данных." : "Ошибка при импорте базы данных.";
    }
}



// executeDatabaseCommand('export');
// executeDatabaseCommand('import');