<?php

require_once 'classes/Task.php';

$task1 = new Task(1, );
$task2 = new Task(2, 3);

assert($task1->getStatus('canceled') == Task::STATUS_CANCELED, 'canceled');

?>
