<?php

return [
    'tasks'               => 'task/index',
    'tasks/([0-9]+)'      => 'tasks/index/$1',
    'login'               => 'site/login',
    'logout'              => 'site/logout',
    'task/create'         => 'task/create',
    'task/delete/([0-9])' => 'task/delete/$1',
    'task/update/([0-9])' => 'task/update/$1',
];