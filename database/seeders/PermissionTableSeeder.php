<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'customer type create',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'customer type edit',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'customer type delete',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'location create',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'location edit',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'location delete',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'gallery view',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'gallery create',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'gallery edit',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'gallery delete',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'video view',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'video create',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'video edit',
                'guard_name' => 'admin'
            ],
            [
                'name' => 'video delete',
                'guard_name' => 'admin'
            ],
        ]);
    }
}
