<?php

namespace App\Enum;

enum UserRoleEnum: string
{
    case ADMIN = 'ADMIN';
    case WORKER = 'WORKER';
    case USER = 'USER';


}
