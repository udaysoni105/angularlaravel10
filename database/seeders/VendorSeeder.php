<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define the vendor data
        $vendors = [
            [
                'name' => 'Vendor 3',
                'email' => 'vendor3@example.com',
                'phone' => '923456789',
            ],
            [
                'name' => 'Vendor 4',
                'email' => 'vendor4@example.com',
                'phone' => '187654321',
            ],
        ];

        // Loop through the vendors and create records in the database
        foreach ($vendors as $vendorData) {
            Vendor::create($vendorData);
        }
    }
}
