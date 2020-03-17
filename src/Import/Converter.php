<?php
namespace Htmlacademy\Import;

use Htmlacademy\Exceptions\ImportException;

class Converter {
    private $tableName;
    private $header;
    private $newFields;
    private $csvFile;
    private $sqlFile;
    public function __construct($fileName, $uotputFileName, $tableName, $header, $outputTables) {
        $this->csvFile = new \SplFileObject($fileName, 'r');
        if (!$this->csvFile) {
            throw new ImportException("Не удается открыть файл $fileName");
        }
        if ($this->getCsvHeaderCount() !== count($header)) {
            throw new ImportException("Заголовки данных не совпадают с заголовками csv файла");
        }
        if (file_exists($uotputFileName)) {
            throw new ImportException("Файл $uotputFileName уже существует");
        }
        $this->sqlFile = new \SplFileObject($uotputFileName, 'w');
        if (!$this->sqlFile->isWritable()) {
            throw new ImportException("Файл $uotputFileName недоступен для записи");
        }
        $this->tableName = $tableName;
        $this->header = $header;
        $this->outputTables = $outputTables;
    }

    public function getCsvHeader(): array {
        $this->csvFile->seek(0);
        $header = explode(",", trim($this->csvFile->current()));
        return $header;
    }

    public function getCsvHeaderCount(): int {
        return count($this->getCsvHeader());
    }
    public function convert(): void {
        $fullHeaderNames = array_merge(array_keys($this->header), array_keys($this->getAddHeaders()));
        $fullHeaderTypes = array_merge(array_values($this->header), array_values($this->getAddHeaders()));
        while(!$this->csvFile->eof() && ($row = $this->csvFile->fgetcsv()) && ($row[0] !== null)) {
            $row = array_merge($row, $this->addFields());
            $row = $this->formateRow($row, $fullHeaderTypes);
            $sqlLine = "INSERT INTO " . $this->tableName . " (" . implode(',', $fullHeaderNames)  . ") VALUES (" . implode(',', $row) . ");\n";
            $this->sqlFile->fwrite($sqlLine);
        }
    }
    private function formateRow(array $row, array $types): array {
        for ($i = 0; $i < count($row); $i++) {
            $newRow[] = $types[$i] === "text" ? "'" . addSlashes($row[$i]) . "'" : $row[$i];
        }
        return $newRow;
    }
    private function addFields(): array {
        foreach ($this->outputTables as $field) {
            switch ($field["field_type"]) {
                case "text":
                    $randomKey = array_rand($field['random']);
                    $row[] = $field['random'][$randomKey];
                    break;
                case "number":
                    $row[] = rand($field['random'][0], $field['random'][1]);
                    break;
                default:
                    throw new ImportException("Неизвестный тип поля: " .  $field["field_type"]);
            }
        }
        return $row ?? [];
    }
    private function getAddHeaders(): array {
        $result = [];
        foreach ($this->outputTables as $field) {
            $result[$field["field_name"]] = $field["field_type"];
        }
        return $result;
    }
}
