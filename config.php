<?php
declare(strict_types=1);

// Site content and settings. Change these values to update the portfolio.
// Text in two languages is written as ['en' => 'English', 'km' => 'ភាសាខ្មែរ'].
// Plain text (names, technology tags) is shown the same in both languages.

$profile = [
    'nickname' => 'Star',
    'name'     => 'Lyhour Morn',
    'email'    => 'mornlyhour508@gmail.com',
    'linkedin' => 'https://www.linkedin.com/in/morn-lyhour-461b44371/',
    'github'   => 'https://github.com/mornlyhour5',
    'telegram' => 'https://t.me/mornlyhour',
    'facebook' => 'https://www.facebook.com/share/1D2jDDBuxt/?mibextid=wwXIfr',
];

// Navigation: section id => label
$sections = [
    'experience' => ['en' => 'Experience', 'km' => 'បទពិសោធន៍'],
    'skills'     => ['en' => 'Skills', 'km' => 'ជំនាញ'],
    'projects'   => ['en' => 'Projects', 'km' => 'ស្នាដៃ'],
    'contact'    => ['en' => 'Contact', 'km' => 'ទំនាក់ទំនង'],
];

$steps = [
    [
        'stage' => ['en' => 'Start', 'km' => 'ចាប់ផ្តើម'],
        'title' => ['en' => 'High school', 'km' => 'វិទ្យាល័យ'],
        'text'  => ['en' => 'Where the path began.', 'km' => 'ជាកន្លែងដែលដំណើរបានចាប់ផ្តើម។'],
    ],
    [
        'stage' => '2026',
        'title' => ['en' => 'B.S. in Software Engineering', 'km' => 'បរិញ្ញាបត្រ B.S. ផ្នែកវិស្វកម្មកម្មវិធី'],
        'text'  => ['en' => 'Beltei International University.', 'km' => 'សាកលវិទ្យាល័យអន្តរជាតិ Beltei។'],
    ],
    [
        'stage' => '2026',
        'title' => ['en' => 'Backend Developer Intern', 'km' => 'អ្នកហ្វឹកហាត់អភិវឌ្ឍន៍ Backend'],
        'text'  => ['en' => 'Four months on Laravel, PostgreSQL, RESTful APIs and Vue.js integration.', 'km' => 'ការងារ 4 ខែលើ Laravel, PostgreSQL, RESTful APIs និងការភ្ជាប់ជាមួយ Vue.js។'],
    ],
    [
        'stage' => ['en' => '2026 to present', 'km' => '2026 ដល់បច្ចុប្បន្ន'],
        'title' => ['en' => 'Application Developer', 'km' => 'អ្នកអភិវឌ្ឍន៍កម្មវិធី'],
        'text'  => ['en' => 'First Cambodia. Building .NET systems, T-SQL procedures and Power BI reports.', 'km' => 'First Cambodia។ កំពុងបង្កើតប្រព័ន្ធ .NET នីតិវិធី T-SQL និងរបាយការណ៍ Power BI។'],
    ],
];

$skills = [
    ['name' => ['en' => 'Backend', 'km' => 'ផ្នែក Backend'], 'wide' => true, 'tags' => ['.NET and C#', 'Laravel and PHP', 'Python', 'RESTful APIs', 'Service-Repository pattern']],
    ['name' => ['en' => 'Data and reporting', 'km' => 'ទិន្នន័យ និងរបាយការណ៍'], 'wide' => false, 'tags' => ['Power BI', 'Report Builder', 'T-SQL procedures']],
    ['name' => ['en' => 'Databases', 'km' => 'មូលដ្ឋានទិន្នន័យ'], 'wide' => false, 'tags' => ['PostgreSQL', 'SQL', 'Database architecture']],
    ['name' => ['en' => 'Frontend', 'km' => 'ផ្នែក Frontend'], 'wide' => false, 'tags' => ['React.js', 'Vue.js', 'JavaScript (ES6+)']],
    ['name' => ['en' => 'Desktop and tools', 'km' => 'កម្មវិធីលើកុំព្យូទ័រ និងឧបករណ៍'], 'wide' => false, 'tags' => ['CustomTkinter', 'PyInstaller', 'C++ and OOP', 'Docker', 'Git']],
];

$projects = [
    [
        'kind'  => ['en' => 'Desktop utility', 'km' => 'កម្មវិធីលើកុំព្យូទ័រ'],
        'title' => 'TheHours YT Downloader',
        'text'  => ['en' => 'A custom desktop video and audio downloader built with Python, CustomTkinter and yt-dlp, packaged with PyInstaller.', 'km' => 'កម្មវិធីទាញយកវីដេអូ និងសំឡេងលើកុំព្យូទ័រ ដែលសរសេរដោយ Python, CustomTkinter និង yt-dlp ហើយវេចខ្ចប់ដោយ PyInstaller។'],
        'tags'  => ['Python', 'CustomTkinter', 'yt-dlp'],
        'github' => null, // no public repo: the GitHub button is hidden
    ],
    [
        'kind'  => ['en' => 'Console and desktop', 'km' => 'Console និងកុំព្យូទ័រ'],
        'title' => 'Bank Management System',
        'text'  => ['en' => 'A banking system built in C++ to handle accounts, transactions, security checks and financial records.', 'km' => 'ប្រព័ន្ធធនាគារដែលសរសេរដោយ C++ សម្រាប់គ្រប់គ្រងគណនី ប្រតិបត្តិការ ការពិនិត្យសុវត្ថិភាព និងកំណត់ត្រាហិរញ្ញវត្ថុ។'],
        'tags'  => ['C++', 'OOP', 'File handling'],
        'github' => null, // no public repo: the GitHub button is hidden
    ],
    [
        'kind'  => ['en' => 'Full-stack web', 'km' => 'គេហទំព័រ Full-stack'],
        'title' => 'POS and Fashion Store System',
        'text'  => ['en' => 'A full-stack e-commerce and point-of-sale web app built with Laravel, SQL databases and a responsive React.js frontend.', 'km' => 'កម្មវិធីគេហទំព័រលក់ទំនិញ (e-commerce) និងចំណុចលក់ (POS) ពេញលក្ខណៈ ដែលសរសេរដោយ Laravel, ទិន្នន័យ SQL និង React.js ដែលអាចប្រែតាមទំហំអេក្រង់។'],
        'tags'  => ['Laravel', 'React.js', 'PostgreSQL'],
        // Replace with this project's repo link once it is shared (currently the profile page)
        'github' => $profile['github'],
    ],
];

// Footer social links: label => url
$socials = [
    'GitHub'   => $profile['github'],
    'Telegram' => $profile['telegram'],
    'Facebook' => $profile['facebook'],
];
