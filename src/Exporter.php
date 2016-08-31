<?php
namespace Pilulka\Edi;

class Exporter
{
    /**
     * @var string
     */
    private $directory;

    private $extension = "EDI";

    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    public function setExtension($ext)
    {
        $this->extension = $ext;
    }

    public function exportOrders(Orders\Message $orders)
    {
        $prefix = "O" . date("Y-m-d-");
        $maxSequence = 1;
        foreach (glob("$this->directory/$prefix" . "*.$this->extension") as $fileName) {
            $fileName = str_replace($this->directory . "/", "", $fileName);
            if (preg_match("/$prefix([0-9]+)\.{$this->extension}/", $fileName, $matches)) {
                if ($matches[1] > $maxSequence) {
                    $maxSequence = $matches[1];
                }
            } else {
                trigger_error("file $fileName doesn't correspond ORDERS export filename format, delete it");
            }
        }

        touch("$this->directory/$prefix" . ($maxSequence + 1) . ".$this->extension");
    }
}
