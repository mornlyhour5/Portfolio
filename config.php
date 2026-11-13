<?php
declare(strict_types=1);

// Site content and settings. Change these values to update the portfolio.
// Text in two languages is written as ['en' => 'English', 'km' => 'ភាសាខ្មែរ'].
// Plain text (names, technology tags) is shown the same in both languages.

$profile = [
    'nickname' => 'Hour',
    'name'     => 'Lyhour Morn',
    'email'    => 'mornlyhour508@gmail.com',
    'linkedin' => 'www.linkedin.com/in/lyhour-morn',
    'github'   => 'https://github.com/mornlyhour5',
    'telegram' => 'https://t.me/lyhourmorn',
    'facebook' => 'https://www.facebook.com/share/1XAyCuFmbN/?mibextid=wwXIfr',
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
        'stage' => ['en' => '2010 - 2016', 'km' => '២០១០ - ២០១៦'],
        'title' => ['en' => 'Primary Education', 'km' => 'ការអប់រំកម្រិតបឋមសិក្សា'],
        'text'  => ['en' => 'Completed six years of primary schooling at Svay Antor Primary School.', 
                    'km' => 'បានបញ្ចប់ការសិក្សាកម្រិតបឋមសិក្សារយៈពេលប្រាំមួយឆ្នាំនៅសាលាបឋមសិក្សាស្វាយអន្ទរ។'],
    ],
    [
        'stage' => ['en' => '2026', 'km' => '២០១៦ - ២០២២'],
        'title' => ['en' => 'High School Graduation', 'km' => 'បញ្ចប់ការសិក្សានៅវិទ្យាល័យ'],
        'text'  => ['en' => 'Successfully completed secondary and upper secondary education at Hun Sen Svay Antor High School.', 
                    'km' => 'បានបញ្ចប់ការសិក្សាកម្រិតមធ្យមសិក្សាបឋមភូមិ និងទុតិយភូមិដោយជោគជ័យនៅវិទ្យាល័យ ហ៊ុន សែន ស្វាយអន្ទរ។'],
    ],
    [
        'stage' => ['en' => '2023', 'km' => '២០២៣'],
        'title' => ['en' => 'Started University', 'km' => 'ចាប់ផ្តើមការសិក្សានៅសាកលវិទ្យាល័យ'],
        'text'  => [
            'en' => 'Began pursuing a Bachelor’s Degree in Software Engineering at BELTEI International University.',
            'km' => 'បានចាប់ផ្តើមសិក្សាថ្នាក់បរិញ្ញាបត្រជំនាញវិស្វកម្មសូហ្វវែរ (Software Engineering) នៅសាកលវិទ្យាល័យ ប៊ែលធី អន្តរជាតិ។'
        ],
    ],
    [
        'stage' => ['en' => '2023 - 2026', 'km' => '២០២៣ - ២០២៦'],
        'title' => ['en' => 'Software Engineering Journey', 'km' => 'ដំណើរនៃការសិក្សាជំនាញវិស្វកម្មសូហ្វវែរ'],
        'text'  => [
            'en' => 'Built a strong foundation in programming, database design, software development, and practical projects.',
            'km' => 'បានកសាងមូលដ្ឋានគ្រឹះដ៏រឹងមាំលើការសរសេរកម្មវិធី ការរចនាប្រព័ន្ធទិន្នន័យ (Database) ការអភិវឌ្ឍសូហ្វវែរ និងគម្រោងអនុវត្តជាក់ស្តែង។'
        ],
    ],
    [
        'stage' => ['en' => '2026', 'km' => '២០២៦'],
        'title' => ['en' => 'Backend Developer Intern', 'km' => 'កម្មសិក្សាការីផ្នែក Backend Developer'],
        'text'  => [
            'en' => 'Completed a four-month internship developing Laravel RESTful APIs, managing PostgreSQL databases.',
            'km' => 'បានបញ្ចប់កម្មសិក្សារយៈពេលបួនខែលើការអភិវឌ្ឍ Laravel RESTful APIs ការគ្រប់គ្រងប្រព័ន្ធទិន្នន័យ PostgreSQL ។'
        ],
    ],
    [
        'stage' => ['en' => '16-Jul-2026', 'km' => '១៦-កក្កដា-២០២៦'],
        'title' => ['en' => 'Bachelor’s Degree Graduate', 'km' => 'បញ្ចប់ការសិក្សាថ្នាក់បរិញ្ញាបត្រ'],
        'text'  => [
            'en' => 'Graduated with a Bachelor’s Degree in Software Engineering from BELTEI International University.',
            'km' => 'បានបញ្ចប់ការសិក្សាថ្នាក់បរិញ្ញាបត្រជំនាញវិស្វកម្មសូហ្វវែរ ពីសាកលវិទ្យាល័យ ប៊ែលធី អន្តរជាតិ។'
        ],
    ],
    [
        'stage' => ['en' => '2026 - Present', 'km' => '២០២៦ - បច្ចុប្បន្ន'],
        'title' => ['en' => 'Application Developer', 'km' => 'អ្នកអភិវឌ្ឍកម្មវិធី (Application Developer)'],
        'text'  => [
            'en' => 'Working at First Cambodia on Core Banking reporting, developing T-SQL Stored Procedures, creating custom reports, and supporting customer reporting requirements.',
            'km' => 'កំពុងបម្រើការងារនៅក្រុមហ៊ុន First Cambodia ផ្នែករបាយការណ៍ប្រព័ន្ធធនាគារស្នូល (Core Banking) ដោយអភិវឌ្ឍ T-SQL Stored Procedures បង្កើតរបាយការណ៍តាមតម្រូវការ និងគាំទ្រតម្រូវការរបាយការណ៍របស់អតិថិជន។'
        ],
    ],
];

$skills = [
    [
        'name' => ['en' => 'Backend', 'km' => 'ផ្នែក Backend'],
        'wide' => true,
        'tags' => [
            'Laravel and PHP', 
            'RESTful APIs', 
            'Service-Repository pattern',
            'MVC'
        ]
    ],
    [
        'name' => ['en' => 'Data and reporting', 'km' => 'ទិន្នន័យ និងរបាយការណ៍'],
        'wide' => false,
        'tags' => [
            'Report Builder', 
            'T-SQL procedures'
        ]
    ],
    [
        'name' => ['en' => 'Frontend', 'km' => 'ផ្នែក Frontend'],
        'wide' => false,
        'tags' => [
            'React.js', 
            'Vue.js', 
            'JavaScript (ES6+)'
        ]
    ],
    [
        'name' => ['en' => 'Databases', 'km' => 'មូលដ្ឋានទិន្នន័យ'],
        'wide' => false,
        'tags' => [
            'PostgreSQL',
            'MySQL',
            'Microsoft SQL Server',
            'Oracle Database'
        ]
    ],
    [
        'name' => ['en' => 'Development Tools', 'km' => 'ឧបករណ៍អភិវឌ្ឍន៍'],
        'wide' => false,
        'tags' => [
            'GitHub',
            'Visual Studio',
            'VS Code',
            'Postman',
            'Microsoft Report Builder',
            'SSMS',
            'SSRS',
            'Hoppscotch'
        ]
    ]
];

$projects = [
    [
        'kind'   => ['en' => 'Desktop utility', 'km' => 'កម្មវិធីលើកុំព្យូទ័រ'],
        'title' => 'TheHours YT Downloader',
        'text'  => [
            'en' => 'A custom desktop video and audio downloader built with Python, CustomTkinter, and yt-dlp, supporting high-resolution downloads up to 4K.',
            'km' => 'កម្មវិធីទាញយកវីដេអូ និងសំឡេងលើកុំព្យូទ័រ ដែលសរសេរដោយ Python, CustomTkinter និង yt-dlp ព្រមទាំងគាំទ្រការទាញយកកម្រិតខ្ពស់រហូតដល់ 4K។'
        ],
        'tags'  => ['Python', 'CustomTkinter', 'yt-dlp'],
        'github' => null,
    ],
    [
        'kind'   => ['en' => 'Academic Thesis', 'km' => 'និក្ខេបបទសិក្សា'],
        'title' => 'Bachelor\'s Thesis',
        'text'  => [
            'en' => 'Successfully defended a thesis titled "POS For Seller Computer In Phnom Penh at CC Computer" for the Bachelor of Software Engineering degree at BELTEI International University.',
            'km' => 'បានការពារនិក្ខេបបទដោយជោគជ័យក្រោមចំណងជើង "POS For Seller Computer In Phnom Penh at CC Computer" សម្រាប់ថ្នាក់បរិញ្ញាបត្រជំនាញវិស្វកម្មសូហ្វវែរ នៅសាកលវិទ្យាល័យ ប៊ែលធី អន្តរជាតិ។'
        ],
        'tags'  => [],
        'github' => null,
    ],
    [
        'kind'   => ['en' => 'Desktop application', 'km' => 'កម្មវិធីកុំព្យូទ័រ'],
        'title' => 'Store Management System',
        'text'  => [
            'en' => 'A product storage and inventory desktop application built with C# applying Object-Oriented Programming (OOP) principles and integrated with an Oracle Database.',
            'km' => 'កម្មវិធីគ្រប់គ្រងស្តុកទំនិញលើកុំព្យូទ័រ សរសេរដោយ C# ដោយអនុវត្តតាមគោលការណ៍សរសេរកម្មវិធីផ្តោតលើវត្ថុ (OOP) និងភ្ជាប់ជាមួយមូលដ្ឋានទិន្នន័យ Oracle។'
        ],
        'tags'  => ['C#', 'OOP', 'Oracle DB', 'Desktop'],
        'github' => null,
    ],
    [
        'kind'   => ['en' => 'Full-stack web', 'km' => 'គេហទំព័រ Full-stack'],
        'title' => 'POS & Computer Accessories Store',
        'text'  => [
            'en' => 'Built in Year 2 Semester 2, this full-stack point-of-sale and e-commerce web app features a Laravel backend, SQL database, and a responsive React.js frontend.',
            'km' => 'បង្កើតឡើងក្នុងឆ្នាំទី២ ឆមាសទី២ កម្មវិធីគេហទំព័រលក់ទំនិញ និងចំណុចលក់ (POS) នេះមានប្រព័ន្ធ Backend ប្រើប្រាស់ Laravel មូលដ្ឋានទិន្នន័យ SQL និង Frontend ប្រើប្រាស់ React.js។'
        ],
        'tags'  => ['Laravel', 'React.js', 'MySQL'],
        'github' => $profile['github'] ?? null,
    ],
    [
        'kind'   => ['en' => 'Web Application', 'km' => 'កម្មវិធីគេហទំព័រ'],
        'title' => 'Loan Management System',
        'text'  => [
            'en' => 'Built in Year 2 Semester 1, this loan tracking web application features borrower record management and loan disbursement using a React.js frontend, PHP backend, and MySQL database.',
            'km' => 'បង្កើតឡើងក្នុងឆ្នាំទី២ ឆមាសទី១ កម្មវិធីតាមដានប្រាក់កម្ចីនេះមានមុខងារគ្រប់គ្រងកំណត់ត្រាអ្នកខ្ចី និងការបញ្ចេញប្រាក់កម្ចី ដោយប្រើប្រាស់ React.js ជា Frontend, PHP ជា Backend និង MySQL ជាមូលដ្ឋានទិន្នន័យ។'
        ],
        'tags'  => ['React.js', 'PHP', 'MySQL', 'Web'],
        'github' => null,
    ],
    [
        'kind'   => ['en' => 'Frontend Web', 'km' => 'គេហទំព័រ Frontend'],
        'title' => 'Computer Store Website',
        'text'  => [
            'en' => 'Created in Year 1 Semester 2, this static e-commerce website for computer accessories was built using HTML, CSS, and JavaScript, and deployed on free hosting.',
            'km' => 'បង្កើតឡើងក្នុងឆ្នាំទី១ ឆមាសទី២ គេហទំព័រលក់សម្ភារៈកុំព្យូទ័រនេះ សរសេរដោយប្រើប្រាស់ HTML, CSS និង JavaScript និងដាក់ឱ្យដំណើរការលើប្រព័ន្ធហូសស្ទីងឥតគិតថ្លៃ។'
        ],
        'tags'  => ['HTML', 'CSS', 'JavaScript'],
        'github' => null,
    ],
    [
        'kind'   => ['en' => 'Console & Desktop', 'km' => 'កុងសូល និងកុំព្យូទ័រ'],
        'title' => 'Bank Management System',
        'text'  => [
            'en' => 'First-year C++ project, since refactored and updated with new features, leveraging OOP and persistent file handling for secure account and transaction management.',
            'km' => 'ជាគម្រោងភាសា C++ ឆ្នាំទី១ ដែលត្រូវបានកែលម្អ និងបន្ថែមមុខងារថ្មីៗ ដោយប្រើប្រាស់ OOP និងការគ្រប់គ្រងឯកសារជាប់លាប់សម្រាប់ការគ្រប់គ្រងគណនី និងប្រតិបត្តិការប្រកបដោយសុវត្ថិភាព។'
        ],
        'tags'  => ['C++', 'OOP', 'File handling'],
        'github' => null,
    ],
];
// Footer social links: label => url
$socials = [
    'GitHub'   => $profile['github'],
    'Telegram' => $profile['telegram'],
    'Facebook' => $profile['facebook'],
];


// Contact email configuration
$contactRecipient = $profile['email'];

// Must be an email address authorized by your mail provider.
$contactFromEmail = 'no-reply@yourdomain.com';