<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin vartotojas
        User::create([
            'name'     => 'Administratorius',
            'email'    => 'admin@test.lt',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);

        // Paprastas vartotojas
        User::create([
            'name'     => 'Vartotojas',
            'email'    => 'user@test.lt',
            'password' => Hash::make('password'),
            'role'     => 'user',
        ]);

        // Kategorijos
        $categories = [
            ['name' => 'Techninė įranga (Hardware)', 'color' => '#e74c3c'],
            ['name' => 'Programinė įranga (Software)', 'color' => '#3498db'],
            ['name' => 'Tinklas (Network)',            'color' => '#2ecc71'],
            ['name' => 'Prieiga (Access)',             'color' => '#f39c12'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Parametrai DB
        Setting::set('app_name', 'Ticket Sistema');
        Setting::set('items_per_page', '10');
        Setting::set('admin_email', 'admin@test.lt');
        Setting::set('notify_on_status_change', 'true');
        Setting::set('notify_on_comment', 'true');
    }
}