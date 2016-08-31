<?php
namespace Pilulka\Edi\Orders;

class LineTextsTest extends \PHPUnit_Framework_TestCase
{
    public function testXmlOutput()
    {
        $text1 = new LineText("text1");
        $text1->setText2("text2");

        $text2 = new LineText("text1");
        $text2->setText2("text2");

        $texts = new LineTexts();
        $texts->addText($text1);
        $texts->addText($text2);

        $this->assertXmlStringEqualsXmlString(<<<XML
<?xml version="1.0" encoding="UTF-8"?>
<line_texts>
    <text>
        <text_number>1</text_number>
        <text1>text1</text1>
        <text2>text2</text2>
    </text>
    <text>
        <text_number>2</text_number>
        <text1>text1</text1>
        <text2>text2</text2>
    </text>
</line_texts> 
XML
            ,
            $texts->getXml(new \SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?>"
                . "<line_texts></line_texts>"))->asXML());
    }
}
