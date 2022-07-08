<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'Təqdimat taxtaları'
            ],
            [
                'Sinilər'
            ],
            [
                'Çərəz qabları'
            ],
            [
                'Salfet qabları'
            ],
            [
                'Fincan altlıqları'
            ],
            [
                'Şamdanlar'
            ]
        ];

        foreach ($categories as $category)
        {
            Category::create([
                'name_az'=>$category[0],
                'name_en'=>$category[0],
                'name_ru'=>$category[0],
                'slug_az'=>str_slug($category[0]),
                'slug_en'=>str_slug($category[0]),
                'slug_ru'=>str_slug($category[0]),
                'src'=>'product-17-hover.webp'
            ]);
        }
    }
}
