<?php
return [
    // Mặc định sẽ là offline, assets sẽ được load từ local, nếu set offline là false và resource có định
    // nghĩa cdn thì assets sẽ được load từ cdn
    'offline' => env('ASSETS_OFFLINE', true),

    // Bật hiển thị version, lúc này link tới resource sẽ được nối thêm "?v=1.0" chẳng hạn.
    'enable_version' => true,

    // Version hiển thị khi enable_vesion là true
    'vesion' => '0.1',

    // Các thư viện js mặc định được sử dụng, là key được định nghĩa trong phần resource bên dưới.
    'scripts' => [ 
        //
    ],

    // Các thư viện css mặc định
    'styles' => [
        //
    ],

    // Định nghĩa tất cả đường dẫn tới assets.
    'resources' => [
    	// Định nghĩa các thư viện css
    	'styles' => [ 
        ],

        // Định nghĩa các thư viện js
        'scripts' => [
            //
        ],
    ],
];