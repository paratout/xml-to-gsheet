<?php


namespace App\Tests\Formatter;

use App\Formatter\Google_Formatter;
use App\Reader\XML_Reader;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class GoogleFormatterTest extends KernelTestCase
{

    protected $reader;

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
        $this->reader = new XML_Reader("tests/Assets/products.xml");
    }

    /** @test */
    public function a_reader_content_can_be_formatted()
    {
        $dataLoad = new Google_Formatter($this->reader);
        $this->assertEquals(count($dataLoad->getDataLoad()), 7);
    }
}
