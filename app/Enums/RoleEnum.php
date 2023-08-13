<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'ADMIN';
    case WORKER = 'WORKER';
    case USER = 'USER';


}
