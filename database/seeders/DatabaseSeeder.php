<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $adminRole = \App\Models\Role::create(['name' => 'admin']);
        $editorRole = \App\Models\Role::create(['name' => 'editor']);
        $viewerRole = \App\Models\Role::create(['name' => 'viewer']);
        $admin = User::factory()->create([
            'name' => 'Hamza Admin',
            'email' => 'admin@odin.com',
            'password' => bcrypt('password'), 
            'is_active' => true,
        ]);
        $admin->roles()->attach($adminRole);

        $editor = User::factory()->create([
            'name' => 'Sara Editor',
            'email' => 'editor@odin.com',
            'password' => bcrypt('password'),
            'is_active' => true,
        ]);
        $editor->roles()->attach($editorRole);

        // 4. إنشاء بعض الأصناف (Categories) باش يبان ليك الـ Dashboard عامر
        \App\Models\Category::create(['name' => 'Laravel']);
        \App\Models\Category::create(['name' => 'PHP']);
        \App\Models\Category::create(['name' => 'Vue.js']);
    }
}
