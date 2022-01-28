<?php

namespace Taskforce;

use Taskforce\Exceptions\FileFormatException;
use Taskforce\Exceptions\SourceFileException;
use SplFileObject;
use RuntimeException;

class DataImporter
{
    private $filename;
    private $columns = [];
    private $fileObject;
    private $result = [];
    private $error = null;

    /**
     * DataImporter constructor.
     * @param $filename - Путь к файлу csv
     */
    public function __construct(string $filename) {
        $this->filename = $filename;
    }

    public function import():void {
        if (!file_exists($this->filename)) {
            throw new SourceFileException("Файл не существует");
        }

        try {
            $this->fileObject = new SplFileObject($this->filename);
        }

        catch (RuntimeException $exception) {
            throw new SourceFileException("Не удалось открыть файл для чтения");
        }

        if ($this->fileObject->getExtension() !== 'csv') {
            throw new FileFormatException('Неправильный формат файла');
        }

        $this->columns[] = $this->getHeaderData();

        foreach ($this->getNextLine() as $line) {
            $this->result[] = $line;
        }
    }

    public function writeDb(string $dirname):void {

        $basename = $this->fileObject->getBasename(".csv");
        $columnHeader = implode(", ", $this->columns[0]);
        $columnHeader = preg_replace( '/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $columnHeader);
        $columnHeader = preg_replace( '/long/', 'lng', $columnHeader);
        $formatHeader = "INSERT INTO %s (%s) VALUES\n";
        $contentfile = sprintf($formatHeader, $basename, $columnHeader);
        $values = "";

        foreach($this->result as $value) {
            $rowValue = implode(", ", $value);
            $values .= "($rowValue), \n";
        }

        $values = preg_replace('/(,)(?=\s*$)/s', ";", $values);
        $contentfile .= $values;
        $formatSql = "%s/%s.sql";
        $sqlfile = sprintf($formatSql, $dirname, $basename);

        if (!file_put_contents($sqlfile, $contentfile)) {
            throw new SourceFileException("Не удалось экспортировать данные в файл");
        }
    }

    public function getData():array {
        return $this->result;
    }

    public function getColumns():array {
        return $this->columns;
    }

    private function getHeaderData():?array {
        $this->fileObject->rewind();
        $data = $this->fileObject->fgetcsv();       
        return $data;
    }

    private function getNextLine():?iterable {
        $result = null;

        while (!$this->fileObject->eof()) {
            yield $this->fileObject->fgetcsv();
        }

        return $result;
    }
}

?>