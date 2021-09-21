<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        

        $categria1=Categoria::create([
            "nombre"=>"Bebidas"
        ]);
        $categria2=Categoria::create([
            "nombre"=>"Desayunos"
        ]);
        $categria3=Categoria::create([
            "nombre"=>"Almuerzos"
        ]);
        $categria4=Categoria::create([
            "nombre"=>"Cenas"
        ]);
        $categria5=Categoria::create([
            "nombre"=>"Postres"
        ]);
        $categria6=Categoria::create([
            "nombre"=>"Extras"
        ]);
        \App\Models\Producto::factory(1000)->create();
    }
}
