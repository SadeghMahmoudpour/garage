<?php

require_once 'vendor/autoload.php';

use Temperworks\Codechallenge\infrastructure\console\ApplicationCommand;

$command = New ApplicationCommand();
try {
    $command->execute();
} catch (\Exception $exception) {
    echo "An exception happened: ";
    echo $exception->getMessage();
    echo "\n";
}
