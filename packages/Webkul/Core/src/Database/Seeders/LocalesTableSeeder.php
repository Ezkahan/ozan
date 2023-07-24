<?php

namespace Webkul\Core\Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class LocalesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('channels')->delete();

        DB::table('locales')->delete();

        DB::table('locales')->insert([
            [
                'id'   => 1,
                'code' => 'tm',
                'name' => 'Türkmen',
            ], [
                'id'   => 2,
                'code' => 'en',
                'name' => 'English',
            ], [
                'id'   => 3,
                'code' => 'ru',
                'name' => 'Russian',
            ]]);
    }
}
