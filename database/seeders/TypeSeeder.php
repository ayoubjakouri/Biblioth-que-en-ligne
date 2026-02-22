<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            "Texte",
            "Audible",
            "E-Books"
        ];

        foreach ($types as $type) {
            DB::table('types')->insert([
                "name" => $type
            ]);
        }
    }
}
