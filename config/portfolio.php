<?php

return [

    'seo' => [
        'title'       => 'Director Frost // Portfolio Terminal',
        'description' => 'Portfolio of Director Frost: Laravel, CodeIgniter 4 and ESP32 IoT developer.',
        'image'       => 'img/og-image.png',   // 1200x630 preview image, optional
    ],

    'resume' => [
        'file'          => 'files/posu.pdf',              // path inside public/
        'download_name' => 'Director-Frost-Resume.pdf',     // name the visitor's browser saves it as
    ],

    'contact_to' => env('PORTFOLIO_CONTACT_TO', env('MAIL_FROM_ADDRESS')),

    'tabs' => [
        ['id' => 'overview', 'code' => '01', 'label' => '[OVERVIEW]'],
        ['id' => 'profile',  'code' => '02', 'label' => '[PROFILE]'],
        ['id' => 'skills',   'code' => '03', 'label' => '[SKILLS]'],
        ['id' => 'projects', 'code' => '04', 'label' => '[PROJECTS]'],
        ['id' => 'contact',  'code' => '05', 'label' => '[CONTACT]'],
    ],

    'skill_categories' => [
        ['id' => 'ALL',      'label' => 'ALL_MODULES'],
        ['id' => 'BACKEND',  'label' => 'BACKEND_WEB'],
        ['id' => 'HARDWARE', 'label' => 'IOT_EMBEDDED'],
    ],

    'experience' => [
        [
            'type'    => 'LANGUAGE',
            'icon'    => 'fa-solid fa-language',
            'period'  => '2025 — PRESENT',
            'title'   => 'Japanese Language (JLPT N5)',
            'org'     => 'Self-study',
            'desc'    => 'Working toward JLPT N5 certification.',
            'tags'    => ['JLPT', 'Japanese'],
            'current' => true,
        ],
        [
            'type'    => 'WORK',
            'icon'    => 'fa-solid fa-briefcase',
            'period'  => '2023 — PRESENT',
            'title'   => 'Web & IoT Architect',
            'org'     => 'Freelance / Your Company',
            'desc'    => 'Building Laravel and CodeIgniter 4 backends and ESP32-CAM surveillance integrations.',
            'tags'    => ['Laravel', 'CodeIgniter 4', 'ESP32'],
            'current' => true,
        ],
        [
            'type'    => 'CERTIFICATION',
            'icon'    => 'fa-solid fa-certificate',
            'period'  => '2023',
            'title'   => 'Your Certification Name',
            'org'     => 'Issuing Organization',
            'desc'    => 'What the certification covers.',
            'tags'    => [],
            'current' => false,
        ],
        [
            'type'    => 'EDUCATION',
            'icon'    => 'fa-solid fa-graduation-cap',
            'period'  => '2020 — 2024',
            'title'   => 'Informatics Engineering',
            'org'     => 'Your University',
            'desc'    => 'Focus on software engineering and embedded systems.',
            'tags'    => ['Informatics'],
            'current' => false,
        ],
    ],

    'skills' => [
        ['name' => 'Laravel Framework',  'category' => 'BACKEND',  'level' => 95, 'desc' => 'REST APIs, ORM Eloquent, Authentication, Middleware.'],
        ['name' => 'CodeIgniter 4',      'category' => 'BACKEND',  'level' => 90, 'desc' => 'Lightweight PHP backend engines, high-speed routing.'],
        ['name' => 'ESP32 / ESP32-CAM',  'category' => 'HARDWARE', 'level' => 88, 'desc' => 'C++ Arduino core, HTTP video streams, GPIO sensor data.'],
        ['name' => 'MySQL & SQLite',     'category' => 'BACKEND',  'level' => 92, 'desc' => 'Relational database schema optimization, indexing.'],
    ],

    'statuses' => [
        'DEPLOYED'    => 'bg-[#10b981]/10 text-[#10b981] border-[#10b981]/30',
        'IN PROGRESS' => 'bg-[#1d6cd8]/10 dark:bg-[#00f0ff]/10 text-[#1d6cd8] dark:text-[#00f0ff] border-[#1d6cd8]/30 dark:border-[#00f0ff]/30',
        'PROTOTYPE'   => 'bg-[#f59e0b]/10 text-[#d97706] border-[#f59e0b]/30',
        'PLANNED'     => 'bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-300 border-slate-300 dark:border-slate-700',
        'ARCHIVED'    => 'bg-[#ef4444]/10 text-[#ef4444] border-[#ef4444]/30',
        'default'     => 'bg-[#f59e0b]/10 text-[#d97706] border-[#f59e0b]/30',
    ],

    'projects' => [
        [
            'code'       => 'OP-01',
            'title'      => 'IoT Home Security Integration',
            'status'     => 'DEPLOYED',
            'shortDesc'  => 'ESP32-CAM microcontroller surveillance network linked with CodeIgniter 4 dynamic web dashboard.',
            'tags'       => ['ESP32-CAM', 'CodeIgniter 4', 'C++', 'MySQL'],
            'fullDesc'   => 'Comprehensive IoT security platform featuring live camera video feeds from ESP32-CAM hardware modules directly routed into a light web terminal.',
            'highlights' => [
                'Real-time video frame streaming over HTTP protocol.',
                'CodeIgniter 4 backend auth and event logging table.',
                'Low-latency hardware-to-cloud payload dispatch.',
            ],

            'image'      => 'img/projects/op-01.jpg',
            'links'      => [
                'github' => 'https://github.com/yourusername/iot-home-security',
                'demo'   => null,
            ],

        ],
        [
            'code'       => 'OP-02',
            'title'      => 'PRTS Tactical Portfolio Core',
            'status'     => 'IN PROGRESS',
            'shortDesc'  => 'High-performance single page application built with HAAVK / Endfield corporate terminal aesthetic.',
            'tags'       => ['Tailwind CSS', 'Alpine.js', 'Web Audio API'],
            'fullDesc'   => 'A light/dark corporate tactical terminal designed for Director Frost. Features custom Web Audio API synthesizer feedback.',
            'highlights' => [
                'Zero-dependency Alpine.js SPA router architecture.',
                'Synthesizer pitch generation on click/tab interaction.',
                'Slate & Dark tactical UI modes with local storage state.',
            ],
        ],
    ],

    'socials' => [
        ['icon' => 'fa-brands fa-github',      'name' => 'GITHUB',    'handle' => '@yourusername',   'desc' => 'Source code and open projects.', 'url' => 'https://github.com/yourusername'],
        ['icon' => 'fa-brands fa-linkedin-in', 'name' => 'LINKEDIN',  'handle' => 'Your Name',       'desc' => 'Professional profile.',          'url' => 'https://linkedin.com/in/yourusername'],
        ['icon' => 'fa-solid fa-envelope',     'name' => 'EMAIL',     'handle' => 'you@example.com', 'desc' => 'Direct line for inquiries.',     'url' => 'mailto:you@example.com'],
        ['icon' => 'fa-brands fa-instagram',   'name' => 'INSTAGRAM', 'handle' => '@yourusername',   'desc' => 'Photos and behind-the-scenes.',  'url' => 'https://instagram.com/yourusername'],
    ],
];
