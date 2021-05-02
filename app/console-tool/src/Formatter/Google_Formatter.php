<?php

namespace App\Formatter;

use App\Contract\FileFormatterInterface;
use App\Contract\FileReaderInterface;
use App\Helper\Logger;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Throwable;

class Google_Formatter implements FileFormatterInterface
{
    protected $fileReader;

    public function __construct(FileReaderInterface $fileReader)
    {
        $this->fileReader = $fileReader;
    }

    public function getDataLoad(): array
    {
        $ss_buffer[0] = []; //First row of the Spreadsheet
        $row_buffer = [];

        $data = $this->fileReader->getContent();

        foreach ($data as $key => $catalog) {
            foreach ($catalog as $itemKey => $item) {
                foreach ($item as $key => $value) {

                    #First row entries
                    if (is_string($key)) {
                        if (!in_array($key, $ss_buffer[0])) {
                            $ss_buffer[0][] = $key;
                        }
                    }

                    #Data entries
                    $row_buffer[] = is_string($value) ? $value : '';
                }
                $ss_buffer[] = $row_buffer;
                $row_buffer = null;
            }
        }
        return $ss_buffer;
    }
}
