<?php
namespace App\File;

use SplFileObject;
use App\Iterator;

class CsvFile extends Iterator {
    public function __construct($file) {
        parent::__construct(new SplFileObject($file));
        $this->setFlags(SplFileObject::READ_CSV);

        if ($current instanceof SplFileInfo) {
            $current->isWriteable();
            $current->isReadable();
        }
    }
}
