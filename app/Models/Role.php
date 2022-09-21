<?php

namespace App\Models;


class Role extends \Spatie\Permission\Models\Role
{
    public static function defaultRoles()
    {
        return [
            'admin',
            'user',
        ];
    }
}

