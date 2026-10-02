<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\Palavra;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PalavraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Palavra::factory(20)->create();
    }
}
