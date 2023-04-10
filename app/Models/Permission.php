<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{

    public static function defaultPermissions()
    {
        return [
            'view users',
            'add users',
            'edit users',
            'delete users',

            'view roles',
            'add roles',
            'edit roles',
            'delete roles',

            'view properties',
            'add properties',
            'edit properties',
            'delete properties',

            'view tenants',
            'add tenants',
            'edit tenants',
            'delete tenants',

            'view owners',
            'add owners',
            'edit owners',
            'delete owners',

            'view onboarding',
            'add onboarding',
            'edit onboarding',
            'delete onboarding',

            'view furnitures',
            'add furnitures',
            'edit furnitures',
            'delete furnitures',

            'view tasks',
            'add tasks',
            'edit tasks',
            'delete tasks',
        ];
    }
}
