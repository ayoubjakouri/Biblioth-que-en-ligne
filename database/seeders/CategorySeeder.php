<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            "Informatique",
            "Design",
            "Marketing",
            "Mobile Application",
            "Documentaires",
            "Poésie",
            "Mangas"
        ];

        foreach($categories as $categorie) {
            DB::table('categories')->insert([
                "name" => $categorie
            ]);
        }


    }
}
