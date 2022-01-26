<?php

namespace Taskforce;

use Taskforce\Exceptions\FileFormatException;
use Taskforce\exceptions\SourceFileException;
use SplFileObject;
use RuntimeException;

class DataImporter
{
    private  $filename;
    private  $columns = [];
    private  $fileObject;
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

        if ($this->fileObject->getExtension() != 'csv') {

            throw new FileFormatException('Неправильный формат файла');

        }

        $this->columns[] = $this->getHeaderData();

        foreach ($this->getNextLine() as $line) {

            $this->result[] = $line;

        }

    }

    public function writeDbFile(string $dirName):void {

        $baseName = $this->fileObject->getBasename(".csv");

        $columnsByRow = implode(", ", $this->columns[0]);

        $contentFile = "INSERT INTO $baseName ($columnsByRow) \n VALUES \n";

        $values = "";

        foreach($this->result as $value) {

            $valueByRow = implode(",", $value);

            $valueByRow = preg_replace('~[^,]+(?=(,|$))~', "'$0'", $valueByRow);

            $values .= "($valueByRow), \n";

        }

        $values = preg_replace('/(,)(?=\s*$)/s', ";", $values);

        $contentFile .= $values;

        $filenameSql = "$dirName/$baseName.sql";

        if (!file_put_contents($filenameSql, $contentFile)) {

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
