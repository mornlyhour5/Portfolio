<?php
declare(strict_types=1);

// Escape text before printing it into HTML
function e(string $text): string
{
    return htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

// Adds the file's modified time to a local asset path, so browsers load the new file after an edit
function asset(string $path): string
{
    $file = dirname(__DIR__) . '/' . $path;
    $version = is_file($file) ? filemtime($file) : time();

    return $path . '?v=' . $version;
}
