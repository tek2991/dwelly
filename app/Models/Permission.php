<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{

    public static function defaultPermissions()
    {
        return [
            'view_users',
            'add_users',
            'edit_users',
            'delete_users',

            'view_roles',
            'add_roles',
            'edit_roles',
            'delete_roles',

            'view_properties',
            'add_properties',
            'edit_properties',
            'delete_properties',
        ];
    }
}
