<?php

use Taskforce\Task;

require_once "vendor/autoload.php";

$task = new Task (1, 2);

try {

    assert($task->getAllowedAction(Task::STATUS_NEW,Task::CancelAction) == Task::ACTION_CANCEL);

} catch (CustomException $e) {

    echo $e->getMessage();
    
}

try {

    var_dump($task);

} catch (CustomException $e) {

    echo $e->getMessage();

}

?>
