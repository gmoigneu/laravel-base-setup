<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Organization;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $editOrganization = Permission::create(['name' => 'edit organization']);
        $viewOrganization = Permission::create(['name' => 'view organization']);

        $editPrompt = Permission::create(['name' => 'edit prompts']);
        $viewPrompt = Permission::create(['name' => 'view prompts']);

        $role = Role::create(['name' => 'superuser']);
        $role->givePermissionTo($editOrganization);
        $role->givePermissionTo($viewOrganization);
        $role->givePermissionTo($editPrompt);
        $role->givePermissionTo($viewPrompt);

        $role = Role::create(['name' => 'editor']);
        $role->givePermissionTo($editPrompt);
        $role->givePermissionTo($viewPrompt);
        $role->givePermissionTo($viewOrganization);

        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo($viewOrganization);
        $role->givePermissionTo($viewPrompt);

        $role = Role::create(['name' => 'admin']);

        for ($i = 0; $i < 10; $i++) {
            $organization = Organization::factory()->create();
            $superuser = User::factory()->create([
                'organization_id' => $organization->id,
            ]);
            $superuser->assignRole('superuser');

            $editor = User::factory()->create([
                'organization_id' => $organization->id,
            ]);
            $editor->assignRole('editor');

            $user = User::factory()->create([
                'organization_id' => $organization->id,
            ]);
            $user->assignRole('user');
        }

        $this->call([
            UpsunSeeder::class,
        ]);
    }
}
