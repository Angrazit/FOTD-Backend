<?php

namespace Database\Seeders;

use App\Models\style;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $style = new style();
        $style->color = 'white' ;
        $style->gender = 'male';
        $style->link_gambar = 'https://i.pinimg.com/236x/fd/d7/b6/fdd7b60f8cbbb688a86cf0d5df3f7b7c.jpg';
        $style->save();
    }
}
