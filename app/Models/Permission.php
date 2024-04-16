<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{

    public static function defaultPermissions()
    {
        return [
            'view user',
            'add user',
            'edit user',
            'delete user',

            'view role',
            'add role',
            'edit role',
            'delete role',

            'view property',
            'add property',
            'edit property',
            'delete property',

            'view tenant',
            'add tenant',
            'edit tenant',
            'delete tenant',

            'view owner',
            'add owner',
            'edit owner',
            'delete owner',

            'view onboarding',
            'add onboarding',
            'edit onboarding',
            'delete onboarding',
            'verify onboarding',

            'view furniture',
            'add furniture',
            'edit furniture',
            'delete furniture',

            'view task',
            'add task',
            'edit task',
            'delete task',

            'view audit',
            'add audit',
            'edit audit',
            'delete audit',
            'verify audit',
        ];
    }
}
