<?php

return [
    'driver' => env('LARAVEL_PDF_DRIVER', 'dompdf'),

    'dompdf' => [
        'is_remote_enabled' => env('LARAVEL_PDF_DOMPDF_REMOTE_ENABLED', true),
        'chroot' => env('LARAVEL_PDF_DOMPDF_CHROOT'),
    ],
];
