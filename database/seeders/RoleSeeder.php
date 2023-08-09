<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $entries = [
            [
                'id' => 1,
                'code' => 'ADMIN',
                'name' => 'Administrator',
            ],
            [
                'id' => 2,
                'code' => 'WORKER',
                'name' => 'Employee',
            ],
            [
                'id' => 3,
                'code' => 'USER',
                'name' => 'User',
            ],
        ];

        foreach ($entries as $entry) {
            Role::updateOrCreate(
                ['id' => $entry['id']],
                [
                    'code' => $entry['code'],
                    'name' => $entry['name']
                ]
            );
        }
    }
}
