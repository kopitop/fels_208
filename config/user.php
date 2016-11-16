<?php 

return [
    'avatar' => [
         'upload_path' => 'images/uploads/avatars/',
    ],
    'limit' => [
        'list_in_admin' => 10,
    ],
    'password_default' => 123456,
    'role-default' => [
        'member' => 1,
        'admin' => 2,
        'super-admin' => 3,
    ],
    'role-select' => [
        'member' => 1,
        'admin' => 2,
    ],
    'relationship-type' => [
        'follow' => 1,
        'unfollow' => 2,
    ],
];
