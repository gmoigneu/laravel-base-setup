<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Seeder;

class UpsunSeeder extends Seeder
{
    public function run()
    {
         $organization = Organization::factory()->create([
            'name' => 'Upsun',
            'slug' => 'upsun',
            'description' => 'This is a test organization',
            'logo' => 'https://upsun.com/logo.png',
            'website' => 'https://upsun.com',
            'email' => 'guillaume@upsun.com',
            'phone' => '1234567890',
            'address' => '1234567890',
        ]);

        $superuser = User::factory()->create([
            'name' => 'Upsun Superuser',
            'email' => 'superuser@upsun.com',
            'organization_id' => $organization->id,
        ]);

        $editor = User::factory()->create([
            'name' => 'Upsun Editor',
            'email' => 'editor@upsun.com',
            'organization_id' => $organization->id,
        ]);

        $user = User::factory()->create([
            'name' => 'Upsun User',
            'email' => 'user@upsun.com',
            'organization_id' => $organization->id,
        ]);

        $superuser->assignRole(['superuser', 'admin']);
        $editor->assignRole(['editor']);
        $user->assignRole(['user']);
    }
}
