<?php

namespace Webkul\Core\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('channels')->delete();

        DB::table('currencies')->delete();

        DB::table('currencies')->insert([
            [
                'id'     => 1,
                'code'   => 'TMT',
                'name'   => 'Manat',
                'symbol' => '',
            ],
//            [
//                'id'     => 2,
//                'code'   => 'EUR',
//                'name'   => 'Euro',
//                'symbol' => '€',
//            ]
        ]);
    }
}
