<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProductImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_images')->insert([
            [
                'id' => 1,
                'product_id' => 1,
                'path' => 'product-photos/VpqD5xtSEjsGVm1sY7DrcFAIzSitA7LFh6rKIv5H.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'product_id' => 2,
                'path' => 'product-photos/dfIGYRQoOTPqKCxyA5moKTaAFjsizdKgvyL2qq1i.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'product_id' => 3,
                'path' => 'product-photos/425cp38lOnd7oc6hix30u6zg9pNC25hcv5PsHz6X.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'product_id' => 4,
                'path' => 'product-photos/dU1O5fU2vttRsKs5anOFhETOwxoH2MXkRzrsu3A2.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'product_id' => 5,
                'path' => 'product-photos/q7SUuHDyHn6WaKvme5aaKNALMoM0WHSIjFrPl4Pb.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'product_id' => 6,
                'path' => 'product-photos/9KeI9Fih55ZMDriFYm2kVwHuUt1Pp9xxhWJVpcQE.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'product_id' => 7,
                'path' => 'product-photos/FtAyWv0xjyAUP0lFszxeGfoUd5CPwqdsgRLSh57L.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 8,
                'product_id' => 8,
                'path' => 'product-photos/juyi9ML8LesOdEmGRBFcWVDC15ZKlTN8wEdkRE1Q.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [   'id' => 9,
                'product_id' => 9,
                'path' => 'product-photos/WDNHdAC94jFvNbIj8SknPVKdM9JYqweZqEFQGPVY.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 10,
                'product_id' => 10,
                'path' => 'product-photos/9C3BWO1GiAgFTFbfwxYfEUnOa9u2aP9OjFAp8V9w.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 11,
                'product_id' => 11,
                'path' => 'product-photos/BmZJVeeA9W0BHkZrN9VgusmgoywYI8kuk7HWisKx.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 12,
                'product_id' => 12,
                'path' => 'product-photos/jcrRkTRTTMaUdieC4GLHJQDgNqLmlFt0KpRjUZyN.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 13,
                'product_id' => 12,
                'path' => 'product-photos/Ff3raukpU0THYbhmXgXCaV9EbeNLysEi8WvghY0a.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
