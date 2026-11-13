<?php
declare(strict_types=1);

// Site content and settings. Change these values to update the portfolio.

$profile = [
    'nickname' => 'Star',
    'name'     => 'Morn Lyhour',
    'email'    => 'mornlyhour508@gmail.com',
    'linkedin' => 'https://www.linkedin.com/in/morn-lyhour-461b44371/',
    'github'   => 'https://github.com/mornlyhour5',
    'telegram' => 'https://t.me/mornlyhour',
    'facebook' => 'https://www.facebook.com/share/1D2jDDBuxt/?mibextid=wwXIfr',
];

// Navigation: section id => label
$sections = [
    'experience' => 'Experience',
    'skills'     => 'Skills',
    'projects'   => 'Projects',
    'contact'    => 'Contact',
];

$steps = [
    ['stage' => 'Start', 'title' => 'High school', 'text' => 'Where the path began.'],
    ['stage' => '2026', 'title' => 'B.S. in Software Engineering', 'text' => 'Beltei International University.'],
    ['stage' => '2026', 'title' => 'Backend Developer Intern', 'text' => 'Four months on Laravel, PostgreSQL, RESTful APIs and Vue.js integration.'],
    ['stage' => '2026 to present', 'title' => 'Application Developer', 'text' => 'First Cambodia. Building .NET systems, T-SQL procedures and Power BI reports.'],
];

$skills = [
    ['name' => 'Backend', 'wide' => true, 'tags' => ['.NET and C#', 'Laravel and PHP', 'Python', 'RESTful APIs', 'Service-Repository pattern']],
    ['name' => 'Data and reporting', 'wide' => false, 'tags' => ['Power BI', 'Report Builder', 'T-SQL procedures']],
    ['name' => 'Databases', 'wide' => false, 'tags' => ['PostgreSQL', 'SQL', 'Database architecture']],
    ['name' => 'Frontend', 'wide' => false, 'tags' => ['React.js', 'Vue.js', 'JavaScript (ES6+)']],
    ['name' => 'Desktop and tools', 'wide' => false, 'tags' => ['CustomTkinter', 'PyInstaller', 'C++ and OOP', 'Docker', 'Git']],
];

$projects = [
    [
        'kind'  => 'Desktop utility',
        'title' => 'TheHours YT Downloader',
        'text'  => 'A custom desktop video and audio downloader built with Python, CustomTkinter and yt-dlp, packaged with PyInstaller.',
        'tags'  => ['Python', 'CustomTkinter', 'yt-dlp'],
    ],
    [
        'kind'  => 'Console and desktop',
        'title' => 'Bank Management System',
        'text'  => 'A banking system built in C++ to handle accounts, transactions, security checks and financial records.',
        'tags'  => ['C++', 'OOP', 'File handling'],
    ],
    [
        'kind'  => 'Full-stack web',
        'title' => 'POS and Fashion Store System',
        'text'  => 'A full-stack e-commerce and point-of-sale web app built with Laravel, SQL databases and a responsive React.js frontend.',
        'tags'  => ['Laravel', 'React.js', 'PostgreSQL'],
    ],
];

// Footer social links: label => url
$socials = [
    'GitHub'   => $profile['github'],
    'Telegram' => $profile['telegram'],
    'Facebook' => $profile['facebook'],
];
