<?php

namespace Taskforce\Import;

abstract class BasicImport {

    /**
     * BasicImport constructor.
     * @param $filename - Путь к файлу csv
     */

    public function __construct(string $filename) {
        $this->filename = $filename;
    }

    abstract public function writeDb(string $dirname):void;
    abstract public function getColumnNames():string;
    abstract public function toSQLRow(array $row):string;

};

?>
