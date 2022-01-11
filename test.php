<?php

require_once 'classes/Task.php';

$task1 = new Task(1, );

assert($task1->getStatus('currentStatus') == Task::STATUS_CANCELED, 'canceled');

?>
