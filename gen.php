<?php

use Nette\DI\Compiler;
use Nette\PhpGenerator\ClassType;

$class = ClassType::fromCode('<?php ' . (new Compiler())->loadConfig(__DIR__ . "/config.neon")->compile());
$class->setName("Container");
$file = new PhpFile();
$file->setStrictTypes();
$file->addNamespace($ns)->add($class);
return ((new PsrPrinter())->printFile($file));