<?php


namespace App\Tests\Reader;

use App\Reader\XML_Reader;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class XMLReaderTest extends KernelTestCase
{

    protected function setUp(): void
    {
        $kernel = self::bootKernel();
    }

    /** @test */
    public function an_xml_file_can_be_decoded_into_array(){
        $xmlr = new XML_Reader("tests/Assets/products.xml");
        $this->assertArrayHasKey('product', $xmlr->getContent());
    }
}
