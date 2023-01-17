<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => "users-show",
                'module' => "users",
                'guard_name' => "api",
                "created_at" => Carbon::now()

            ],
            [
                'name' => "users-delete",
                'module' => "users",
                'guard_name' => "api",
                "created_at" => Carbon::now()

            ],
            [
                'name' => "users-update",
                'module' => "users",
                'guard_name' => "api",
                "created_at" => Carbon::now()

            ],
            [
                'name' => "users-index",
                'module' => "users",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "users-store",
                'module' => "users",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "roles-index",
                'module' => "roles",
                'guard_name' => "api",
                "created_at" => Carbon::now()

            ], [
                'name' => "roles-show",
                'module' => "roles",
                'guard_name' => "api",
                "created_at" => Carbon::now()

            ],
            [
                'name' => "roles-update",
                'module' => "roles",
                'guard_name' => "api",
                "created_at" => Carbon::now()

            ],
            [
                'name' => "roles-store",
                'module' => "roles",
                'guard_name' => "api",
                "created_at" => Carbon::now()

            ],
            [
                'name' => "roles-delete",
                'module' => "roles",
                'guard_name' => "api",
                "created_at" => Carbon::now()

            ],
            [
                'name' => "settings-index",
                'module' => "settings",
                'guard_name' => "api",
                "created_at" => Carbon::now()

            ], [
                'name' => "settings-show",
                'module' => "settings",
                'guard_name' => "api",
                "created_at" => Carbon::now()

            ],
            [
                'name' => "settings-update",
                'module' => "settings",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "settings-store",
                'module' => "settings",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "settings-delete",
                'module' => "settings",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "log-index",
                'module' => "log",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "status-index",
                'module' => "status",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "status-show",
                'module' => "status",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "status-store",
                'module' => "status",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "status-update",
                'module' => "status",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ], [
                'name' => "status-delete",
                'module' => "status",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "actions-index",
                'module' => "actions",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ], [
                'name' => "actions-show",
                'module' => "actions",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "actions-store",
                'module' => "actions",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "actions-update",
                'module' => "actions",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ], [
                'name' => "actions-delete",
                'module' => "actions",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "unit-types-index",
                'module' => "unit_types",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ], [
                'name' => "unit-types-show",
                'module' => "unit_types",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "unit-types-store",
                'module' => "unit_types",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "unit-types-update",
                'module' => "unit_types",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ], [
                'name' => "unit-types-delete",
                'module' => "unit_types",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ], [
                'name' => "channels-index",
                'module' => "channels",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ], [
                'name' => "channels-show",
                'module' => "channels",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "channels-store",
                'module' => "channels",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "channels-update",
                'module' => "channels",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ], [
                'name' => "channels-delete",
                'module' => "channels",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "cities-index",
                'module' => "cities",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "cities-show",
                'module' => "cities",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "cities-store",
                'module' => "cities",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "cities-update",
                'module' => "cities",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "cities-delete",
                'module' => "cities",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "countries-index",
                'module' => "countries",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "countries-show",
                'module' => "countries",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "countries-store",
                'module' => "countries",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "countries-update",
                'module' => "countries",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "countries-delete",
                'module' => "countries",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "governorates-index",
                'module' => "governorates",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "governorates-show",
                'module' => "governorates",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "governorates-store",
                'module' => "governorates",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "governorates-update",
                'module' => "governorates",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "governorates-delete",
                'module' => "governorates",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "districts-index",
                'module' => "districts",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "districts-show",
                'module' => "districts",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "districts-store",
                'module' => "districts",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "districts-update",
                'module' => "districts",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "districts-delete",
                'module' => "districts",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "project-types-index",
                'module' => "Project Types",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "project-types-show",
                'module' => "Project Types",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "project-types-store",
                'module' => "Project Types",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "project-types-update",
                'module' => "Project Types",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "project-types-delete",
                'module' => "Project Types",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "project-features-index",
                'module' => "Project Features",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "project-features-show",
                'module' => "Project Features",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "project-features-store",
                'module' => "Project Features",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "project-features-update",
                'module' => "Project Features",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "project-features-delete",
                'module' => "Project Features",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "projects-index",
                'module' => "Projects",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "projects-show",
                'module' => "Projects",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "projects-store",
                'module' => "Projects",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "projects-update",
                'module' => "Projects",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "projects-delete",
                'module' => "Projects",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],

            [
                'name' => "company-index",
                'module' => "company",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "company-show",
                'module' => "company",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "company-store",
                'module' => "company",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "company-update",
                'module' => "company",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "company-delete",
                'module' => "company",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],

            [
                'name' => "ambassadors-index",
                'module' => "ambassadors",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "ambassadors-show",
                'module' => "ambassadors",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "ambassadors-store",
                'module' => "ambassadors",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "ambassadors-update",
                'module' => "ambassadors",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "ambassadors-delete",
                'module' => "ambassadors",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "brokers-index",
                'module' => "brokers",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "brokers-show",
                'module' => "brokers",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "brokers-store",
                'module' => "brokers",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "brokers-update",
                'module' => "brokers",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "brokers-delete",
                'module' => "brokers",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
            [
                'name' => "images-delete",
                'module' => "images",
                'guard_name' => "api",
                "created_at" => Carbon::now()
            ],
        ];
        Permission::insertOrIgnore($data);
    }
}