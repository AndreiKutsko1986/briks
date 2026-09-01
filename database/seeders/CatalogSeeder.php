<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Color;
use App\Models\Item;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    public function run(): void
    {
        $parts = Category::create(['slug' => 'parts', 'name' => 'Parts', 'sort_order' => 1]);
        Category::create(['slug' => 'sets', 'name' => 'Sets', 'sort_order' => 2]);
        Category::create(['slug' => 'minifigures', 'name' => 'Minifigures', 'sort_order' => 3]);
        Category::create(['slug' => 'gear', 'name' => 'Gear', 'sort_order' => 4]);
        Category::create(['slug' => 'books', 'name' => 'Books', 'sort_order' => 5]);

        $brick = Category::create(['slug' => 'brick', 'name' => 'Brick', 'parent_id' => $parts->id, 'sort_order' => 1]);
        $plate = Category::create(['slug' => 'plate', 'name' => 'Plate', 'parent_id' => $parts->id, 'sort_order' => 2]);
        Category::create(['slug' => 'tile', 'name' => 'Tile', 'parent_id' => $parts->id, 'sort_order' => 3]);
        Category::create(['slug' => 'technic', 'name' => 'Technic', 'parent_id' => $parts->id, 'sort_order' => 4]);

        $colors = collect([
            ['name' => 'Black', 'hex_code' => '#05131D', 'sort_order' => 1],
            ['name' => 'White', 'hex_code' => '#FFFFFF', 'sort_order' => 2],
            ['name' => 'Red', 'hex_code' => '#C91A09', 'sort_order' => 3],
            ['name' => 'Blue', 'hex_code' => '#0055BF', 'sort_order' => 4],
            ['name' => 'Yellow', 'hex_code' => '#F2CD37', 'sort_order' => 5],
            ['name' => 'Green', 'hex_code' => '#237841', 'sort_order' => 6],
            ['name' => 'Light Bluish Gray', 'hex_code' => '#9BA19D', 'sort_order' => 7],
            ['name' => 'Dark Bluish Gray', 'hex_code' => '#6C6E68', 'sort_order' => 8],
            ['name' => 'Tan', 'hex_code' => '#E4CD9E', 'sort_order' => 9],
            ['name' => 'Reddish Brown', 'hex_code' => '#582A12', 'sort_order' => 10],
        ])->map(fn ($c) => Color::create($c));

        $sets = Category::where('slug', 'sets')->first();
        $minifigs = Category::where('slug', 'minifigures')->first();

        $items = [
            Item::create(['item_no' => '3001', 'category_id' => $brick->id, 'name' => 'Brick 2 x 4', 'description' => 'Standard 2x4 brick.', 'weight_grams' => 2.32, 'stud_dimensions' => '2 x 4', 'year_from' => 1976, 'year_to' => 2026]),
            Item::create(['item_no' => '3003', 'category_id' => $brick->id, 'name' => 'Brick 2 x 2', 'description' => 'Standard 2x2 brick.', 'weight_grams' => 1.35, 'stud_dimensions' => '2 x 2', 'year_from' => 1976, 'year_to' => 2026]),
            Item::create(['item_no' => '3004', 'category_id' => $brick->id, 'name' => 'Brick 1 x 2', 'weight_grams' => 0.80, 'stud_dimensions' => '1 x 2', 'year_from' => 1976, 'year_to' => 2026]),
            Item::create(['item_no' => '3031', 'category_id' => $plate->id, 'name' => 'Plate 4 x 4', 'weight_grams' => 2.22, 'stud_dimensions' => '4 x 4', 'year_from' => 1970, 'year_to' => 2026]),
            Item::create(['item_no' => '3020', 'category_id' => $plate->id, 'name' => 'Plate 2 x 4', 'weight_grams' => 1.10, 'stud_dimensions' => '2 x 4', 'year_from' => 1970, 'year_to' => 2026]),
            Item::create(['item_no' => '10281', 'category_id' => $sets->id, 'name' => 'Bonsai Tree', 'description' => 'Creator Expert Bonsai Tree.', 'weight_grams' => 1070, 'year_from' => 2021, 'year_to' => 2024]),
            Item::create(['item_no' => '21318', 'category_id' => $sets->id, 'name' => 'Tree House', 'weight_grams' => 2800, 'year_from' => 2019, 'year_to' => 2022]),
            Item::create(['item_no' => 'col348', 'category_id' => $minifigs->id, 'name' => 'Jungle Explorer CMF', 'weight_grams' => 5.03, 'year_from' => 2019, 'year_to' => 2019]),
        ];

        $items[0]->colors()->attach([1, 2, 3, 4, 5]);
        $items[1]->colors()->attach([1, 2, 3]);
        $items[2]->colors()->attach([1, 2]);
        $items[3]->colors()->attach([1, 2, 7]);
        $items[4]->colors()->attach([1, 2, 7]);

        Listing::create(['item_id' => 1, 'color_id' => 1, 'seller_name' => 'BrickWorld Store', 'condition_type' => 'new', 'quantity' => 500, 'price' => 0.08]);
        Listing::create(['item_id' => 1, 'color_id' => 1, 'seller_name' => 'Parts Palace', 'condition_type' => 'used', 'quantity' => 200, 'price' => 0.04, 'country' => 'Germany']);
        Listing::create(['item_id' => 1, 'color_id' => 2, 'seller_name' => 'BrickWorld Store', 'condition_type' => 'new', 'quantity' => 300, 'price' => 0.09]);
        Listing::create(['item_id' => 1, 'color_id' => 3, 'seller_name' => 'Red Brick Co', 'condition_type' => 'new', 'quantity' => 150, 'price' => 0.10, 'country' => 'UK']);
        Listing::create(['item_id' => 4, 'color_id' => 1, 'seller_name' => 'Plate Depot', 'condition_type' => 'new', 'quantity' => 120, 'price' => 0.15]);
        Listing::create(['item_id' => 6, 'seller_name' => 'Set Sellers Inc', 'condition_type' => 'new', 'quantity' => 5, 'price' => 49.99]);
        Listing::create(['item_id' => 7, 'seller_name' => 'AFOL Market', 'condition_type' => 'new', 'quantity' => 2, 'price' => 199.99]);
        Listing::create(['item_id' => 8, 'seller_name' => 'Minifig Mania', 'condition_type' => 'new', 'quantity' => 12, 'price' => 4.50, 'country' => 'Netherlands']);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@bricks.local',
            'password' => 'admin123',
            'is_admin' => true,
        ]);
    }
}
