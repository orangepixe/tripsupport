<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Route;

class DefaultDataUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $currentRouteName = Route::currentRouteName();
        if ($currentRouteName != 'LaravelUpdater::database') {

            // Default All Permission
            $allPermission = [
                [
                    'name' => 'manage user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show user',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete role',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage contact',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create contact',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit contact',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete contact',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete note',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage logged history',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete logged history',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage pricing packages',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create pricing packages',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit pricing packages',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete pricing packages',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'buy pricing packages',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage pricing transation',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage coupon',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create coupon',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit coupon',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete coupon',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage coupon history',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete coupon history',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage account settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage password settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage general settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage company settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage email settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage payment settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage seo settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage google recaptcha settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage notification',
                    'gaurd_name' => 'web',
                ],
                [
                    'name' => 'edit notification',
                    'gaurd_name' => 'web',
                ],
                [
                    'name' => 'manage FAQ',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create FAQ',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit FAQ',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete FAQ',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage Page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create Page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit Page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete Page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'show Page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage home page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit home page',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage footer',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit footer',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage 2FA settings',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage auth page',
                    'guard_name' => 'web',
                ],


                [
                    'name' => 'manage ticket',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create ticket',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit ticket',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete ticket',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'reply ticket',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage today ticket',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage client',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create client',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit client',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete client',
                    'guard_name' => 'web',
                ],

                [
                    'name' => 'manage owner faq',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create owner faq',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit owner faq',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete owner faq',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage knowledge article',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create knowledge article',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit knowledge article',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete knowledge article',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage blog',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create blog',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit blog',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete blog',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'manage category',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'create category',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'edit category',
                    'guard_name' => 'web',
                ],
                [
                    'name' => 'delete category',
                    'guard_name' => 'web',
                ],

            ];
            Permission::insert($allPermission);

            // Default Super Admin Role
            $superAdminRoleData =  [
                'name' => 'super admin',
                'parent_id' => 0,
            ];
            $systemSuperAdminRole = Role::create($superAdminRoleData);
            $systemSuperAdminPermission = [
                ['name' => 'manage user'],
                ['name' => 'create user'],
                ['name' => 'edit user'],
                ['name' => 'delete user'],
                ['name' => 'show user'],
                ['name' => 'manage contact'],
                ['name' => 'create contact'],
                ['name' => 'edit contact'],
                ['name' => 'delete contact'],
                ['name' => 'manage note'],
                ['name' => 'create note'],
                ['name' => 'edit note'],
                ['name' => 'delete note'],
                ['name' => 'manage pricing packages'],
                ['name' => 'create pricing packages'],
                ['name' => 'edit pricing packages'],
                ['name' => 'delete pricing packages'],
                ['name' => 'manage pricing transation'],
                ['name' => 'manage coupon'],
                ['name' => 'create coupon'],
                ['name' => 'edit coupon'],
                ['name' => 'delete coupon'],
                ['name' => 'manage coupon history'],
                ['name' => 'delete coupon history'],
                ['name' => 'manage account settings'],
                ['name' => 'manage password settings'],
                ['name' => 'manage general settings'],
                ['name' => 'manage email settings'],
                ['name' => 'manage payment settings'],
                ['name' => 'manage seo settings'],
                ['name' => 'manage google recaptcha settings'],
                ['name' => 'manage FAQ'],
                ['name' => 'create FAQ'],
                ['name' => 'edit FAQ'],
                ['name' => 'delete FAQ'],
                ['name' => 'manage Page'],
                ['name' => 'create Page'],
                ['name' => 'edit Page'],
                ['name' => 'delete Page'],
                ['name' => 'show Page'],
                ['name' => 'manage home page'],
                ['name' => 'edit home page'],
                ['name' => 'manage footer'],
                ['name' => 'edit footer'],
                ['name' => 'manage 2FA settings'],
                ['name' => 'manage auth page'],


            ];
            $systemSuperAdminRole->givePermissionTo($systemSuperAdminPermission);
            // Default Super Admin
            $superAdminData =     [
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'super admin',
                'lang' => 'english',
                'email_verified_at' => now(),
                'profile' => 'avatar.png',
            ];
            $systemSuperAdmin = User::create($superAdminData);
            $systemSuperAdmin->assignRole($systemSuperAdminRole);
            HomePageSection();
            CustomPage();
            authPage($systemSuperAdmin->id);
            DefaultBankTransferPayment();

            // Default Owner Role
            $ownerRoleData = [
                'name' => 'owner',
                'parent_id' => $systemSuperAdmin->id,
            ];
            $systemOwnerRole = Role::create($ownerRoleData);

            // Default Owner All Permissions
            $systemOwnerPermission = [
                ['name' => 'manage user'],
                ['name' => 'create user'],
                ['name' => 'edit user'],
                ['name' => 'delete user'],
                ['name' => 'manage role'],
                ['name' => 'create role'],
                ['name' => 'edit role'],
                ['name' => 'delete role'],
                ['name' => 'manage contact'],
                ['name' => 'create contact'],
                ['name' => 'edit contact'],
                ['name' => 'delete contact'],
                ['name' => 'manage note'],
                ['name' => 'create note'],
                ['name' => 'edit note'],
                ['name' => 'delete note'],
                ['name' => 'manage logged history'],
                ['name' => 'delete logged history'],
                ['name' => 'manage pricing packages'],
                ['name' => 'buy pricing packages'],
                ['name' => 'manage pricing transation'],
                ['name' => 'manage account settings'],
                ['name' => 'manage password settings'],
                ['name' => 'manage general settings'],
                ['name' => 'manage company settings'],
                ['name' => 'manage email settings'],
                ['name' => 'manage notification'],
                ['name' => 'edit notification'],
                ['name' => 'manage 2FA settings'],

                ['name' => 'manage ticket'],
                ['name' => 'create ticket'],
                ['name' => 'edit ticket'],
                ['name' => 'delete ticket'],
                ['name' => 'reply ticket'],
                ['name' => 'manage today ticket'],
                ['name' => 'manage client'],
                ['name' => 'create client'],
                ['name' => 'edit client'],
                ['name' => 'delete client'],
                ['name' => 'manage owner faq'],
                ['name' => 'create owner faq'],
                ['name' => 'edit owner faq'],
                ['name' => 'delete owner faq'],
                ['name' => 'manage knowledge article'],
                ['name' => 'create knowledge article'],
                ['name' => 'edit knowledge article'],
                ['name' => 'delete knowledge article'],
                ['name' => 'manage blog'],
                ['name' => 'create blog'],
                ['name' => 'edit blog'],
                ['name' => 'delete blog'],
                ['name' => 'manage category'],
                ['name' => 'create category'],
                ['name' => 'edit category'],
                ['name' => 'delete category'],
            ];
            $systemOwnerRole->givePermissionTo($systemOwnerPermission);

            // Default Owner Create
            $ownerData =    [
                'name' => 'Owner',
                'email' => 'owner@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'owner',
                'lang' => 'english',
                'email_verified_at' => now(),
                'profile' => 'avatar.png',
                'code' => uniqid(),
                'subscription' => 1,
                'parent_id' => $systemSuperAdmin->id,
            ];
            $systemOwner = User::create($ownerData);
            // Default Template Assign
            defaultTemplate($systemOwner->id);
            // Default Owner Role Assign
            $systemOwner->assignRole($systemOwnerRole);


            // Default Owner Role
            $managerRoleData =  [
                'name' => 'manager',
                'parent_id' => $systemOwner->id,
            ];
            $systemManagerRole = Role::create($managerRoleData);
            // Default Manager All Permissions
            $systemManagerPermission = [
                ['name' => 'manage user'],
                ['name' => 'create user'],
                ['name' => 'edit user'],
                ['name' => 'delete user'],
                ['name' => 'manage contact'],
                ['name' => 'create contact'],
                ['name' => 'edit contact'],
                ['name' => 'delete contact'],
                ['name' => 'manage note'],
                ['name' => 'create note'],
                ['name' => 'edit note'],
                ['name' => 'delete note'],
                ['name' => 'manage 2FA settings'],

                ['name' => 'manage ticket'],
                ['name' => 'create ticket'],
                ['name' => 'edit ticket'],
                ['name' => 'delete ticket'],
                ['name' => 'reply ticket'],
                ['name' => 'manage client'],
                ['name' => 'create client'],
                ['name' => 'edit client'],
                ['name' => 'delete client'],
                ['name' => 'manage owner faq'],
                ['name' => 'create owner faq'],
                ['name' => 'edit owner faq'],
                ['name' => 'delete owner faq'],
                ['name' => 'manage knowledge article'],
                ['name' => 'create knowledge article'],
                ['name' => 'edit knowledge article'],
                ['name' => 'delete knowledge article'],
                ['name' => 'manage blog'],
                ['name' => 'create blog'],
                ['name' => 'edit blog'],
                ['name' => 'delete blog'],
                ['name' => 'manage category'],
                ['name' => 'create category'],
                ['name' => 'edit category'],
                ['name' => 'delete category'],

            ];
            $systemManagerRole->givePermissionTo($systemManagerPermission);

            // Default Manager Create
            $managerData =   [
                'name' => 'Manager',
                'email' => 'manager@gmail.com',
                'password' => Hash::make('123456'),
                'type' => 'manager',
                'lang' => 'english',
                'email_verified_at' => now(),
                'profile' => 'avatar.png',
                'subscription' => 0,
                'parent_id' => $systemOwner->id,
            ];
            $systemManager = User::create($managerData);
            // Default Manager Role Assign
            $systemManager->assignRole($systemManagerRole);

            // Default Owner Role
            defaultClientCreate($systemOwner->id);

            // Subscription default data
            $subscriptionData = [
                'title' => 'Basic',
                'package_amount' => 0,
                'interval' => 'Unlimited',
                'user_limit' => 10,
                'client_limit' => 10,
                'enabled_logged_history' => 1,
            ];
            \App\Models\Subscription::create($subscriptionData);
        }
    }
}
