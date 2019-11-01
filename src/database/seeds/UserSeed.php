<?php

use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'name' => 'Admin', 'email' => 'admin@neighbourly.co.nz', 'password' => '$2y$10$gGC4MxHwlzUXa4E9w/HfdeLUwZ/h0rlYN1qX8eL3GnsdH/qsyD2Ma', 'remember_token' => '',],

        ];

        foreach ($items as $item) {
            \App\User::create($item);
        }
    }
}
