<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeOptionTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('attribute_options')->delete();

        DB::table('attribute_options')->insert([
            [
                'id'           => '1',
                'admin_name'   => 'Red',
                'sort_order'   => '1',
                'attribute_id' => '23',
            ], [
                'id'           => '2',
                'admin_name'   => 'Green',
                'sort_order'   => '2',
                'attribute_id' => '23',
            ], [
                'id'           => '3',
                'admin_name'   => 'Yellow',
                'sort_order'   => '3',
                'attribute_id' => '23',
            ], [
                'id'           => '4',
                'admin_name'   => 'Black',
                'sort_order'   => '4',
                'attribute_id' => '23',
            ], [
                'id'           => '5',
                'admin_name'   => 'White',
                'sort_order'   => '5',
                'attribute_id' => '23',
            ], [
                'id'           => '6',
                'admin_name'   => 'S',
                'sort_order'   => '1',
                'attribute_id' => '24',
            ], [
                'id'           => '7',
                'admin_name'   => 'M',
                'sort_order'   => '2',
                'attribute_id' => '24',
            ], [
                'id'           => '8',
                'admin_name'   => 'L',
                'sort_order'   => '3',
                'attribute_id' => '24',
            ], [
                'id'           => '9',
                'admin_name'   => 'XL',
                'sort_order'   => '4',
                'attribute_id' => '24',
            ],
            [
                'id'           => '10',
                'admin_name'   => 'Canvas',
                'sort_order'   => null,
                'attribute_id' => '27',
            ],
            [
                'id'           => '11',
                'admin_name'   => 'Board',
                'sort_order'   => null,
                'attribute_id' => '27',
            ],
            [
                'id'           => '12',
                'admin_name'   => 'Strech',
                'sort_order'   => null,
                'attribute_id' => '27',
            ],
            [
                'id'           => '13',
                'admin_name'   => 'Wood',
                'sort_order'   => null,
                'attribute_id' => '27',
            ],
            [
                'id'           => '14',
                'admin_name'   => 'Feather',
                'sort_order'   => null,
                'attribute_id' => '27',
            ],
            [
                'id'           => '15',
                'admin_name'   => 'Paper',
                'sort_order'   => null,
                'attribute_id' => '27',
            ],
            [
                'id'           => '16',
                'admin_name'   => 'MDF',
                'sort_order'   => null,
                'attribute_id' => '27',
            ],
            [
                'id'           => '17',
                'admin_name'   => 'Tassar',
                'sort_order'   => null,
                'attribute_id' => '27',
            ],
            [
                'id'           => '18',
                'admin_name'   => 'Ink',
                'sort_order'   => null,
                'attribute_id' => '28',
            ],
            [
                'id'           => '19',
                'admin_name'   => 'Pencil',
                'sort_order'   => null,
                'attribute_id' => '28',
            ],
            [
                'id'           => '20',
                'admin_name'   => 'Color pencil',
                'sort_order'   => null,
                'attribute_id' => '28',
            ],
            [
                'id'           => '21',
                'admin_name'   => 'Oil',
                'sort_order'   => null,
                'attribute_id' => '28',
            ],
            [
                'id'           => '22',
                'admin_name'   => 'Acrylic',
                'sort_order'   => null,
                'attribute_id' => '28',
            ],
            [
                'id'           => '23',
                'admin_name'   => 'Watercolor',
                'sort_order'   => null,
                'attribute_id' => '28',
            ],
            [
                'id'           => '24',
                'admin_name'   => 'Charcoal',
                'sort_order'   => null,
                'attribute_id' => '28',
            ],
            [
                'id'           => '25',
                'admin_name'   => 'Glass',
                'sort_order'   => null,
                'attribute_id' => '28',
            ],
            [
                'id'           => '26',
                'admin_name'   => 'Painting',
                'sort_order'   => null,
                'attribute_id' => '28',
            ],
            [
                'id'           => '27',
                'admin_name'   => 'Ball point',
                'sort_order'   => null,
                'attribute_id' => '28',
            ], [
                'id'           => '28',
                'admin_name'   => 'Pen art',
                'sort_order'   => null,
                'attribute_id' => '28',
            ],
            [
                'id'           => '29',
                'admin_name'   => 'Digital',
                'sort_order'   => null,
                'attribute_id' => '28',
            ]
        ]);
    }
}
