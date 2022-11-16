<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'name' => 'Veículos', 'slug' => 'veiculos'],
            ['id' => 2, 'name' => 'Tecnologia', 'slug' => 'tecnologia'],
            ['id' => 3, 'name' => 'Casa e Móveis', 'slug' => 'casa-e-moveis'],
            ['id' => 4, 'name' => 'Indústria', 'slug' => 'industria'],
            ['id' => 5, 'name' => 'Saúde', 'slug' => 'saude'],
            ['id' => 6, 'name' => 'Beleza e Cuidado Pessoal', 'slug' => 'beleza-e-cuidado-pessoal'],
            ['id' => 7, 'name' => 'Brinquedos', 'slug' => 'brinquedos'],
            ['id' => 8, 'name' => 'Produtos Sustentaveis', 'slug' => 'produtos-sustentaveis'],
            ['id' => 9, 'name' => 'Alimentos e Bebidas', 'slug' => 'alimentos-e-bebidas'],
            ['id' => 10, 'name' => 'Acessórios', 'slug' => 'acessorios'],
            ['id' => 11, 'name' => 'Música, Filmes e Seriados', 'slug' => 'musica-filmes-e-feriados'],
            ['id' => 12, 'name' => 'Viagens', 'slug' => 'viagens'],
        ];

        foreach ($items as $item) {
            Category::create($item);
        }
    }
}
