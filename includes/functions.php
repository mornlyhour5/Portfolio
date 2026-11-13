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

// Two-language text: the English and Khmer copies both go into the page, and the language switch shows one of them
function bi(string $en, string $km): string
{
    return '<span lang="en">' . e($en) . '</span><span lang="km">' . e($km) . '</span>';
}

// Prints a config value: either ['en' => ..., 'km' => ...] for two languages, or plain text shown as it is
function tr(string|array $value): string
{
    if (is_array($value)) {
        return bi($value['en'], $value['km'] ?? $value['en']);
    }

    return e($value);
}
