<?php

namespace Webkul\Inventory\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class InventoryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('inventory_sources')->delete();

        DB::table('inventory_sources')->insert([
            'id'             => 1,
            'code'           => 'sklad',
            'name'           => 'Sklad',
            'contact_name'   => 'Ashgabat Warehouse',
            'contact_email'  => 'warehouse@ozan.com',
            'contact_number' => 1234567899,
            'status'         => 1,
            'country'        => 'TM',
            'state'          => 'AG',
            'street'         => '12th Street',
            'city'           => 'OGUZHAN',
            'postcode'       => '48127',
        ]);
    }
}