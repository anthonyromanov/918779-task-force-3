<?php

use Taskforce\Exceptions\FileFormatException;
use Taskforce\Exceptions\SourceFileException;
use Taskforce\Import\CategoryImport;
use Taskforce\Import\CityImport;
use Taskforce\Import\UserImport;
use Taskforce\Import\TaskImport;
use Taskforce\Import\AttachmentImport;
use Taskforce\Import\ResponseImport;
use Taskforce\Import\ReviewImport;

require_once "vendor/autoload.php";

try {
    $dataImporter = new CategoryImport('./data/category.csv');
    $dataImporter->import();
    $dataImporter->writeDb('./data');
} 

catch (SourceFileException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
} 

catch (FileFormatException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
};

try {
    $dataImporter = new CityImport('./data/city.csv');
    $dataImporter->import();
    $dataImporter->writeDb('./data');
} 

catch (SourceFileException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
} 

catch (FileFormatException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
};

try {
    $dataImporter = new UserImport('./data/user.csv');
    $dataImporter->import();
    $dataImporter->writeDb('./data');
} 

catch (SourceFileException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
} 

catch (FileFormatException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
};

try {
    $dataImporter = new TaskImport('./data/task.csv');
    $dataImporter->import();
    $dataImporter->writeDb('./data');
} 

catch (SourceFileException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
} 

catch (FileFormatException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
};

try {
    $dataImporter = new AttachmentImport('./data/attachment.csv');
    $dataImporter->import();
    $dataImporter->writeDb('./data');
} 

catch (SourceFileException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
} 

catch (FileFormatException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
};

try {
    $dataImporter = new ResponseImport('./data/response.csv');
    $dataImporter->import();
    $dataImporter->writeDb('./data');
} 

catch (SourceFileException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
} 

catch (FileFormatException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
};

try {
    $dataImporter = new ReviewImport('./data/review.csv');
    $dataImporter->import();
    $dataImporter->writeDb('./data');
} 

catch (SourceFileException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
} 

catch (FileFormatException $e) {
    echo("Не удалось обработать csv файл: " .$e->getMessage());
};

?>