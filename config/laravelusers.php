<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel-users setting
    |--------------------------------------------------------------------------
    */

    // The parent blade file
    'laravelUsersBladeExtended'     => 'layouts.index', // 'layouts.app'

    // Enable `auth` middleware
    'authEnabled'                   => true,

    // Enable Optional Roles Middleware on the users assignments
    'rolesEnabled'                  => true,

    /*
     | Enable Roles Middlware on the usability of this package.
     | This requires the middleware from the roles package to be registered in `App\Http\Kernel.php`
     | An Example: of roles middleware entry in protected `$routeMiddleware` array would be:
     | 'role' => \jeremykenedy\LaravelRoles\Middleware\VerifyRole::class,
     */

    'rolesMiddlwareEnabled'         => true,

    // Optional Roles Middleware
    'rolesMiddlware'                => 'role:admin',

    // Optional Role Model
    'roleModel'                     => 'jeremykenedy\LaravelRoles\Models\Role',

    // Enable Soft Deletes - Not yet setup - on the roadmap.
    'softDeletedEnabled'            => true,

    // Laravel Default User Model
    'defaultUserModel'              => 'App\Models\User',

    // Use the provided blade templates or extend to your own templates.
    'showUsersBlade'                => 'laravelusers::usersmanagement.show-users',
    'createUserBlade'               => 'laravelusers::usersmanagement.create-user',
    'showIndividualUserBlade'       => 'laravelusers::usersmanagement.show-user',
    'editIndividualUserBlade'       => 'laravelusers::usersmanagement.edit-user',

    // Use Package Bootstrap Flash Alerts
    'enablePackageBootstapAlerts'   => true,

    // Users List Pagination
    'enablePagination'              => true,
    'paginateListSize'              => 25,

    // Enable Search Users- Uses jQuery Ajax
    'enableSearchUsers'             => true,

    // Users List JS DataTables - not recommended use with pagination
    'enabledDatatablesJs'           => false,
    'datatablesJsStartCount'        => 25,
    'datatablesCssCDN'              => '',
    'datatablesJsCDN'               => '',
    'datatablesJsPresetCDN'         => '',

    // Bootstrap Tooltips
    'tooltipsEnabled'               => true,
    'enableBootstrapPopperJsCdn'    => true,
    'bootstrapPopperJsCdn'          => '',

    // Icons
    'fontAwesomeEnabled'            => true,
    'fontAwesomeCdn'                => '',

    // Extended blade options for packages app.blade.php
    'enableBootstrapCssCdn'         => true,
    'bootstrapCssCdn'               => '',

    'enableAppCss'                  => true,
    'appCssPublicFile'              => 'css/app.css',

    'enableBootstrapJsCdn'          => true,
    'bootstrapJsCdn'                => '',

    'enableAppJs'                   => true,
    'appJsPublicFile'               => '',

    'enablejQueryCdn'               => true,
    'jQueryCdn'                     => '',

];
