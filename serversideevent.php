<?php
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$filename = "messages.txt";
$id = 0;
while (1) {
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    fclose($handle);
    unlink($filename);

    $message = trim($contents);
    if ($message) {
        $id++;
        echo "id: {$id}\n";
        echo "event: message\n";
        echo "data: {\"text\": \"{$message}\", \"done\":false}";
        echo "\n\n";
    }

    ob_flush();
    flush();
    sleep(1);
}
