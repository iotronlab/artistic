<?php

namespace Database\Seeders;

use App\Models\Attribute\AttributeOption;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AttributeOptionTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('attribute_options')->delete();

        // DB::table('attribute_options')->insert([
        //     [
        //         'id'           => '1',
        //         'admin_name'   => 'Red',
        //         'sort_order'   => '1',
        //         'attribute_id' => '19',
        //     ], [
        //         'id'           => '2',
        //         'admin_name'   => 'Green',
        //         'sort_order'   => '2',
        //         'attribute_id' => '19',
        //     ], [
        //         'id'           => '3',
        //         'admin_name'   => 'Yellow',
        //         'sort_order'   => '3',
        //         'attribute_id' => '19',
        //     ], [
        //         'id'           => '4',
        //         'admin_name'   => 'Black',
        //         'sort_order'   => '4',
        //         'attribute_id' => '19',
        //     ], [
        //         'id'           => '5',
        //         'admin_name'   => 'White',
        //         'sort_order'   => '5',
        //         'attribute_id' => '19',
        //     ], [
        //         'id'           => '6',
        //         'admin_name'   => 'S',
        //         'sort_order'   => '1',
        //         'attribute_id' => '20',
        //     ], [
        //         'id'           => '7',
        //         'admin_name'   => 'M',
        //         'sort_order'   => '2',
        //         'attribute_id' => '20',
        //     ], [
        //         'id'           => '8',
        //         'admin_name'   => 'L',
        //         'sort_order'   => '3',
        //         'attribute_id' => '20',
        //     ], [
        //         'id'           => '9',
        //         'admin_name'   => 'XL',
        //         'sort_order'   => '4',
        //         'attribute_id' => '20',
        //     ],
        //     [
        //         'id'           => '10',
        //         'admin_name'   => 'Canvas',
        //         'sort_order'   => null,
        //         'attribute_id' => '21',
        //     ],
        //     [
        //         'id'           => '11',
        //         'admin_name'   => 'Board',
        //         'sort_order'   => null,
        //         'attribute_id' => '21',
        //     ],
        //     [
        //         'id'           => '12',
        //         'admin_name'   => 'Strech',
        //         'sort_order'   => null,
        //         'attribute_id' => '21',
        //     ],
        //     [
        //         'id'           => '13',
        //         'admin_name'   => 'Wood',
        //         'sort_order'   => null,
        //         'attribute_id' => '21',
        //     ],
        //     [
        //         'id'           => '14',
        //         'admin_name'   => 'Feather',
        //         'sort_order'   => null,
        //         'attribute_id' => '21',
        //     ],
        //     [
        //         'id'           => '15',
        //         'admin_name'   => 'Paper',
        //         'sort_order'   => null,
        //         'attribute_id' => '21',
        //     ],
        //     [
        //         'id'           => '16',
        //         'admin_name'   => 'MDF',
        //         'sort_order'   => null,
        //         'attribute_id' => '21',
        //     ],
        //     [
        //         'id'           => '17',
        //         'admin_name'   => 'Tassar',
        //         'sort_order'   => null,
        //         'attribute_id' => '21',
        //     ],
        //     [
        //         'id'           => '18',
        //         'admin_name'   => 'Ink',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ],
        //     [
        //         'id'           => '19',
        //         'admin_name'   => 'Pencil',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ],
        //     [
        //         'id'           => '20',
        //         'admin_name'   => 'Color pencil',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ],
        //     [
        //         'id'           => '21',
        //         'admin_name'   => 'Oil',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ],
        //     [
        //         'id'           => '22',
        //         'admin_name'   => 'Acrylic',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ],
        //     [
        //         'id'           => '23',
        //         'admin_name'   => 'Watercolor',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ],
        //     [
        //         'id'           => '24',
        //         'admin_name'   => 'Charcoal',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ],
        //     [
        //         'id'           => '25',
        //         'admin_name'   => 'Glass',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ],
        //     [
        //         'id'           => '26',
        //         'admin_name'   => 'Painting',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ],
        //     [
        //         'id'           => '27',
        //         'admin_name'   => 'Ball point',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ], [
        //         'id'           => '28',
        //         'admin_name'   => 'Pen art',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ],
        //     [
        //         'id'           => '29',
        //         'admin_name'   => 'Digital',
        //         'sort_order'   => null,
        //         'attribute_id' => '22',
        //     ],
        //     [
        //         'id'           => '30',
        //         'admin_name'   => 'Landscape',
        //         'sort_order'   => null,
        //         'attribute_id' => '23',
        //     ],
        //     [
        //         'id'           => '31',
        //         'admin_name'   => 'Portrait',
        //         'sort_order'   => null,
        //         'attribute_id' => '23',
        //     ],
        //     [
        //         'id'           => '32',
        //         'admin_name'   => 'Square',
        //         'sort_order'   => null,
        //         'attribute_id' => '23',
        //     ]
        // ]);
        // AttributeOption
        $json = Storage::disk('local')->get('data/attribute-option.json');
        $data = json_decode($json);
        foreach ($data as $option) {
            AttributeOption::create(array(
                'admin_name' => $option->admin_name,
                'sort_order' => $option->sort_order,
                'swatch_value' => $option->swatch_value,
                'attribute_id' => $option->attribute_id,

            ));
        }
    }
}
