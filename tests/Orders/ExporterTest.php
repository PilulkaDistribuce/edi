<?php
namespace Pilulka\Edi\Orders;


class ExporterTest extends \PHPUnit_Framework_TestCase
{
    public function testExport()
    {
        $directory = __DIR__ . "/../fixtures/exportDir";
        // clear working directory
        foreach (glob("$directory/*") as $file) {
            unlink($file);
        }

        // generates some files as previously exported order files
        $filePrefix = "/O" . date("Y-m-d-");
        touch("$directory/$filePrefix" . "1.xml");
        touch("$directory/$filePrefix" . "2.xml");

        $exporter = new \Pilulka\Edi\Exporter($directory);
        $exporter->setExtension("xml");
        $exporter->exportOrders(new Message());

        $this->assertFileExists("$directory/$filePrefix" . "3.xml");

        // clear working directory
        /*foreach (glob("$directory/*") as $file) {
            unlink($file);
        }
        */
    }
}
