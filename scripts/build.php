<?php
namespace Build;
class Fs
{
    const EXAMPLE_FN = "example.php";
    private $_dir;
    
    public function __construct($dir) 
    {
        $this->_dir = $dir; 
    }

    public function getExamine()
    {
        return file($this->_dir . "/" . self::EXAMPLE_FN);
    }
    public function eachInclude($fn)
    {
        $it = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($this->_dir));

        foreach ($it as $fileinfo) {
            if ($fileinfo->isFile() 
                && $fileinfo->getFilename() !== self::EXAMPLE_FN 
                && strpos($fileinfo->getFilename(), ".") !== 0) {
                $relPath = substr($fileinfo->getPathname(), strlen($this->_dir));
                $fn($relPath, file($fileinfo->getPathname()));
            }
        }
    }
}


function run() 
{
    $out = "";
    $fs = new Fs("example");
    $fs->eachInclude(function ($fName, $fLines) use (&$out) {
        $out .= "\n\n// File: .{$fName }\n"  
            . implode("", array_slice($fLines, 7));
    });
    $eLines = $fs->getExamine();
    $exHereDoc = implode("", array_slice($eLines, 0, 7));
    $exCode = "\n//File: " . Fs::EXAMPLE_FN . PHP_EOL . implode("", array_slice($eLines, 7));
    file_put_contents("tutorial.php", $exHereDoc . $out . $exCode);
    print "\ntutorial is created successfully\n";
}

run();