<?php


namespace App\Command;

use App\Connector\Google_Connector;
use App\Formatter\Google_Formatter;
use App\Helper\Logger;
use App\Model\Spreadsheet;
use App\Reader\XML_Reader;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Logger\ConsoleLogger;
use Symfony\Component\Console\Output\OutputInterface;

use Throwable;

class MainCommand extends Command
{

    protected static $defaultName = "xml-to-gsheet";

    protected function configure()
    {
        $this->setDescription("XML to Google Sheet")
            ->addArgument("fileLocation", InputArgument::REQUIRED, "Document location")
            ->addOption('title', "t", InputOption::VALUE_REQUIRED, 'Title of the Spreadsheet document.', "Products XML import - " . date_create()->format("Y-m-d H:i:s"));
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            #Getting the file location from the command argument
            $fileLocation = $input->getArgument('fileLocation');

            #Loading the file with a reader
            $fileReader = new XML_Reader($fileLocation);

            #Getting the data formatted as expected by Google API
            $fileFormatter = new Google_Formatter($fileReader);
            $dataLoad = $fileFormatter->getDataLoad();

            #Authenticate to Google Sheet and getting the Google service
            $service = Google_Connector::getInstance()->service;

            #Upload the content to Google Sheet
            $googleWriter = new Spreadsheet($service); //Getting the I/O service
            $documentTitle = $input->getOption('title'); //Setting the document title from command option -t, --title or use default
            $documentId = $googleWriter->create($documentTitle); //Creating a new document and return the Google spreadsheet ID
            $googleWriter->appendValues($documentId, "A:Z", 'RAW', $dataLoad); //Write the data to the sheet
 
        } catch (Throwable $e) {
            #$logger = new Logger();
            #$logger->warning($e->getMessage());
        }

        return 0;
    }
}
