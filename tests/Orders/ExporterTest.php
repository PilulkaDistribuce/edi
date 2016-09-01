<?php
namespace Pilulka\Edi\Orders;

class ExporterTest extends \PHPUnit_Framework_TestCase
{
    private $workingDirectory;

    public function setUp()
    {
        $this->workingDirectory = __DIR__ . "/../fixtures/exportDir";
        parent::setUp();
    }

    private function clearWorkingDirectory()
    {
        foreach (glob("$this->workingDirectory/*") as $file) {
            unlink($file);
        }
    }

    public function testExport()
    {
        $this->clearWorkingDirectory();
        // generates some files as previously exported order files
        $filePrefix = \Pilulka\Edi\Exporter::getOrdersDefaultPrefix();
        $fileExtension = \Pilulka\Edi\Exporter::DEFAULT_EXTENSION;
        touch("$this->workingDirectory/$filePrefix" . "1.$fileExtension");
        touch("$this->workingDirectory/$filePrefix" . "2.$fileExtension");

        $messageStub = $this->getMockBuilder('\Pilulka\Edi\Orders\Message')
            ->disableOriginalConstructor()
            ->getMock();
        $messageStub->method("getXml")->willReturn(
            new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><orion_message></orion_message>"));

        $exporter = new \Pilulka\Edi\Exporter($this->workingDirectory);
        $exporter->exportOrders($messageStub);

        $this->assertFileExists("$this->workingDirectory/$filePrefix" . "3.$fileExtension");

        $this->clearWorkingDirectory();
    }
}
