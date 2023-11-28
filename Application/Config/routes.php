<?php

return[
    '' =>[
        'controller' => 'main',
        'action' => 'list',
    ],
    'main/add' =>[
        'controller' => 'main',
        'action' => 'add',
    ],
    'main/delete' =>[
        'controller' => 'main',
        'action' => 'delete',
    ],
    'main/edit' =>[
        'controller' => 'main',
        'action' => 'edit',
    ],
    'main/comment' =>[
        'controller' => 'main',
        'action' => 'comment',
    ],
    'main/rating' =>[
        'controller' => 'main',
        'action' => 'rating',
    ],
    // AdminController
    'admin' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'admin/login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'admin/logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],
    'admin/add' => [
        'controller' => 'admin',
        'action' => 'add',
    ],
    'admin/edit/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],
    'admin/delete/{id:\d+}' => [
        'controller' => 'admin',
        'action' => 'delete',
    ],
    'admin/posts/{page:\d+}' => [
        'controller' => 'admin',
        'action' => 'posts',
    ],
    'admin/posts' => [
        'controller' => 'admin',
        'action' => 'posts',
    ],
];
