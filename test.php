<?php

use Taskforce\Task;
use Taskforce\Exceptions\NoAvailableActionsException;
use Taskforce\Exceptions\FileFormatException;
use Taskforce\Exceptions\SourceFileException;
use Taskforce\DataImporter;

require_once "vendor/autoload.php";

$task = new Task (1, 2);

try {

    assert($task->getAllowedAction(Task::STATUS_NEW,Task::CancelAction) == Task::ACTION_CANCEL);

} catch (NoAvailableActionsException $e) {

    echo $e->getMessage();
    
}

try {

    $dataImporter = new DataImporter('./data/category.csv');
    $dataImporter->import();
    $dataImporter->writeDbFile('./data');

} 

catch (SourceFileException $e) {

    echo("Не удалось обработать csv файл: " .$e->getMessage());

} 

catch (FileFormatException $e) {

    echo("Не удалось обработать csv файл: " .$e->getMessage());

};

try {

    $dataImporter = new DataImporter('./data/city.csv');
    $dataImporter->import();
    $dataImporter->writeDbFile('./data');

} 

catch (SourceFileException $e) {

    echo("Не удалось обработать csv файл: " .$e->getMessage());

} 

catch (FileFormatException $e) {

    echo("Не удалось обработать csv файл: " .$e->getMessage());

}






?>
