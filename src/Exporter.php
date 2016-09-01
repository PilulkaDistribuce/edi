<?php
namespace Pilulka\Edi;

class Exporter
{
    const DEFAULT_EXTENSION = "EDI";

    /**
     * destination directory for export
     * @var string
     */
    private $directory;

    /**
     * @var string
     */
    private $extension = self::DEFAULT_EXTENSION;

    /**
     * @var string
     */
    private $ordersPrefix;

    /**
     * @param string $directory
     */
    public function __construct($directory)
    {
        if (!is_writable($directory)) {
            throw new \InvalidArgumentException("directory '$directory' isn't writable");
        }
        $this->directory = $directory;
        $this->ordersPrefix = self::getOrdersDefaultPrefix();
    }

    final public static function getOrdersDefaultPrefix()
    {
        return "O" . date("Y-m-d-");
    }

    /**
     * @param string $prefix e.g. 0201601 etc.
     */
    public function setOrdersFilePrefix($prefix)
    {
       $this->ordersPrefix = $prefix;
    }

    public function setExtension($ext)
    {
        $this->extension = $ext;
    }

    public function exportOrders(Orders\Message $message)
    {
        $maxSequence = 1;
        foreach (glob("$this->directory/$this->ordersPrefix" . "*.$this->extension") as $filePathName) {
            $fileName = str_replace($this->directory . "/", "", $filePathName);
            $sequence = str_replace([".$this->extension", $this->ordersPrefix], "", $fileName);
            if ($sequence < 1) {
                trigger_error("File $filePathName doesn't correspond ORDERS export filename format"
                    . ", no integer sequence detected. Fix or delete this file.");
                continue;
            }
            $maxSequence = $sequence;
        }

        touch("$this->directory/$this->ordersPrefix" . ($maxSequence + 1) . ".$this->extension");
    }
}
