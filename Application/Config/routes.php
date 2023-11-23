<?php

return[
    '' =>[
        'controller' => 'main',
        'action' => 'list',
    ],
    'news/list/page={page:\d+}' =>[
        'controller' => 'news',
        'action' => 'list',
    ],
    'detail/id={id:\d+}' =>[
        'controller' => 'news',
        'action' => 'detail',
    ],
    'news/list/detail/id={id:\d+}' =>[
        'controller' => 'news',
        'action' => 'detail',
    ],
    'news/list' =>[
        'controller' => 'news',
        'action' => 'list',
    ],
    'news/list' =>[
        'controller' => 'news',
        'action' => 'list',
    ]
];
