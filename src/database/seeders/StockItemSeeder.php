<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StockItem;
use App\Models\Supplier;

class StockItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliers = Supplier::all();

        $shoeNames = [
            'Nike Air Force 1',
            'Adidas Superstar',
            'Vans Old Skool',
            'Converse Chuck Taylor All Star',
            'Puma Suede Classic',
            'New Balance 990',
            'Reebok Classic Leather',
            'Fila Disruptor',
            'Saucony Jazz Original',
            'Asics Gel-Lyte III',
            'Nike Air Max 90',
            'Adidas NMD',
            'Vans Sk8-Hi',
            'Converse One Star',
            'Puma Cali',
            'New Balance 574',
            'Reebok Club C',
            'Fila Ray Tracer',
            'Saucony Shadow 5000',
            'Asics Gel-Kayano 5',
            'Nike Air Jordan 1',
            'Adidas Yeezy Boost 350',
            'Vans Era',
            'Converse Jack Purcell',
            'Puma RS-X',
            'New Balance 1500',
            'Reebok Workout',
            'Fila Mindblower',
            'Saucony Grid SD',
            'Asics Gel-Quantum 360',
            'Nike Blazer Mid',
            'Adidas Ultraboost',
            'Vans Slip-On',
            'Converse Pro Leather',
            'Puma Thunder Spectra',
            'New Balance 997',
            'Reebok Classic Nylon',
            'Fila Original Fitness',
            'Saucony Freedom ISO',
            'Asics Gel-Lyte V',
            'Nike Air Max 95',
            'Adidas Stan Smith',
            'Vans Authentic',
            'Converse Fastbreak',
            'Puma Future Rider',
            'New Balance 1300',
            'Reebok Aztrek',
            'Fila Venom',
            'Saucony Grid 9000',
            'Asics Gel-Nimbus 22',
            'Nike Air Max 97',
            'Adidas Continental 80',
            'Vans Style 36',
            'Converse ERX 260',
            'Puma Ralph Sampson',
            'New Balance 990v5',
            'Reebok Classic Harman',
            'Fila Mindblower 2.0',
            'Saucony Kinvara 11',
            'Asics Gel-Kinsei OG',
            'Nike Air Max 270',
            'Adidas Falcon',
            'Vans Chukka Low',
            'Converse Weapon',
            'Puma Mirage Sport',
            'New Balance 327',
            'Reebok Classic Leather Legacy',
            'Fila Trailblazer',
            'Saucony Jazz Court RFG',
            'Asics Gel-Excite 8',
            'Nike Air Max Plus',
            'Adidas ZX 8000',
            'Vans Slip-On Pro',
            'Converse Run Star Hike',
            'Puma Cell Dome',
            'New Balance 992',
            'Reebok Nano 9',
            'Fila Mindblower x Liam Hodges',
            'Saucony Shadow 6000',
            'Asics Gel-Respector',
            'Nike Dunk Low',
            'Adidas Originals Kamanda',
            'Vans Era Pro',
            'Converse CONS',
            'Puma Mirage Mox'
        ];
        $i = 1;
        foreach ($shoeNames as $name) {
            $supplier = $suppliers->random();
            $item = new StockItem([
                'name' => $name,
                'supplier_id' => $supplier->id,
                'gender' => 'Unisex',
                'brand' => 'Brand ' . rand(1, 10),
                'colour' => 'Colour ' . rand(1, 5),
                'shoe_size' => rand(5, 12),
                'material' => 'Material ' . rand(1, 3),
                'category' => 'Category ' . rand(1, 5),
                'price' => rand(50, 200),
                'stock_level' => rand(10, 100),
                'barcode' => $i++
            ]);
            $item->save();
        }
    }
}
