<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImmigrationSeeder extends Seeder
{
    public function run(): void
    {
        // Detect schema variants
        $hasAllowedPerms  = Schema::hasColumn('permissions', 'allowed_permissions');
        $hasModuleSettings = Schema::hasTable('module_settings');
        $hasModuleCompany = $hasModuleSettings && Schema::hasColumn('module_settings', 'company_id');
        $hasPermRoleTable = Schema::hasTable('permission_role');
        $hasSpatieTable   = Schema::hasTable('role_has_permissions');

        // 1) Module row (plural key)
        DB::table('modules')->updateOrInsert(
            ['module_name' => 'immigrations'],
            ['description' => 'Immigration Management', 'created_at' => now(), 'updated_at' => now()]
        );

        $moduleId = (int) DB::table('modules')->where('module_name', 'immigrations')->value('id');

        // 2) Permissions (plural keys)
        $perms = [
            ['name' => 'view_immigrations',   'display_name' => 'View Immigration'],
            ['name' => 'add_immigrations',    'display_name' => 'Add Immigration'],
            ['name' => 'edit_immigrations',   'display_name' => 'Edit Immigration'],
            ['name' => 'delete_immigrations', 'display_name' => 'Delete Immigration'],
        ];

        foreach ($perms as $perm) {
            $data = [
                'display_name' => $perm['display_name'],
                'module_id'    => $moduleId,
                'updated_at'   => now(),
            ];
            if (!DB::table('permissions')->where('name', $perm['name'])->exists()) {
                $data['created_at'] = now();
            }
            if ($hasAllowedPerms) {
                // common Worksuite pattern
                $data['allowed_permissions'] = $perm['name'] === 'add_immigrations'
                    ? json_encode(['all' => 4, 'none' => 5])
                    : json_encode(['all' => 4, 'added' => 1, 'none' => 5]);
            }

            DB::table('permissions')->updateOrInsert(['name' => $perm['name']], $data);
        }

        // Clean any old singular duplicates (safe)
        if (Schema::hasTable('permissions')) {
            DB::table('permissions')->whereIn('name', [
                'view_immigration','add_immigration','edit_immigration','delete_immigration'
            ])->delete();
        }

        // Get permission IDs
        $permIds = DB::table('permissions')
            ->whereIn('name', array_column($perms, 'name'))
            ->pluck('id')
            ->all();

        // 3) Activate module for admin/employee in module_settings
        if ($hasModuleSettings) {
            if ($hasModuleCompany) {
                $companyId = (int) (DB::table('companies')->value('id') ?? 1);
                foreach (['admin','employee'] as $type) {
                    DB::table('module_settings')->updateOrInsert(
                        ['module_name' => 'immigrations', 'company_id' => $companyId, 'type' => $type],
                        ['status' => 'active', 'created_at' => now(), 'updated_at' => now()]
                    );
                }
            } else {
                foreach (['admin','employee'] as $type) {
                    DB::table('module_settings')->updateOrInsert(
                        ['module_name' => 'immigrations', 'type' => $type],
                        ['status' => 'active', 'created_at' => now(), 'updated_at' => now()]
                    );
                }
            }
        }

        // 4) Assign permissions to Admin (and Employee if exists)
        // Find role IDs by name (fallback to common ids if names differ)
        $roles = DB::table('roles')->select('id', 'name')->get();
        $adminRoleId = optional($roles->firstWhere('name', 'admin'))->id ?? 1;
        $employeeRoleId = optional($roles->firstWhere('name', 'employee'))->id ?? null;

        if ($hasPermRoleTable) {
            // permission_role with (permission_id, role_id)
            foreach ($permIds as $pid) {
                DB::table('permission_role')->updateOrInsert(
                    ['permission_id' => $pid, 'role_id' => $adminRoleId],
                    []
                );
                if ($employeeRoleId) {
                    DB::table('permission_role')->updateOrInsert(
                        ['permission_id' => $pid, 'role_id' => $employeeRoleId],
                        []
                    );
                }
            }
        } elseif ($hasSpatieTable) {
            // Spatie pivot: role_has_permissions (permission_id, role_id)
            foreach ($permIds as $pid) {
                DB::table('role_has_permissions')->updateOrInsert(
                    ['permission_id' => $pid, 'role_id' => $adminRoleId],
                    []
                );
                if ($employeeRoleId) {
                    DB::table('role_has_permissions')->updateOrInsert(
                        ['permission_id' => $pid, 'role_id' => $employeeRoleId],
                        []
                    );
                }
            }
        }

        // 5) Optional: add a friendly translation key if langs are DB-driven elsewhere
        // (nothing to do here in seeder; your resources/lang/en/modules.php line is already added)
    }
}
