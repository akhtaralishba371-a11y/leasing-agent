<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Property;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@leasing.test'],
            ['name' => 'Admin', 'password' => Hash::make('password')],
        );

        $amenityNames = [
            'Air Conditioning',
            'Balcony',
            'Fireplace',
            'Furnished Floors',
            'Garage',
            'Hardwood Floors',
            'In-Unit Laundry',
            'Pool',
        ];

        $amenities = collect($amenityNames)->map(fn (string $name) => Amenity::firstOrCreate(
            ['slug' => str($name)->slug()],
            ['name' => $name],
        ));

        if (Property::count() === 0) {
            $samples = [
                [
                    'name' => 'The Dobie at 21st & Guadalupe',
                    'address' => '2021 Guadalupe St',
                    'city' => 'Austin',
                    'neighborhood' => 'West Campus',
                    'property_type' => 'apartment',
                    'state' => 'TX',
                    'zip' => '78705',
                    'featured' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=900&q=80',
                    'description' => 'Fully furnished studios and 1–4 bedroom units with resort-style amenities.',
                ],
                [
                    'name' => 'West Campus Modern — Tower Exclusive',
                    'address' => '2400 Nueces St',
                    'city' => 'Austin',
                    'neighborhood' => 'West Campus',
                    'property_type' => 'exclusive',
                    'state' => 'TX',
                    'zip' => '78705',
                    'featured' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=900&q=80',
                    'description' => 'Boutique mid-rise with private balconies and rooftop lounge.',
                ],
                [
                    'name' => 'Hyde Park Student Homes',
                    'address' => '4200 Duval St',
                    'city' => 'Austin',
                    'neighborhood' => 'Hyde Park',
                    'property_type' => 'house',
                    'state' => 'TX',
                    'zip' => '78751',
                    'featured' => true,
                    'image_url' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=900&q=80',
                    'description' => 'Quiet tree-lined streets meet modern interiors.',
                ],
                [
                    'name' => 'Riverside Fireplace Loft',
                    'address' => '1800 Riverside Dr',
                    'city' => 'Austin',
                    'neighborhood' => 'Riverside',
                    'property_type' => 'loft',
                    'state' => 'TX',
                    'zip' => '78741',
                    'image_url' => 'https://tower-leasing.com/wp-content/uploads/2025/02/GetMedia-3.ashx-2.jpeg',
                    'description' => 'Spacious loft with fireplace and dedicated parking.',
                ],
            ];

            foreach ($samples as $i => $data) {
                $property = Property::create($data);
                $property->amenities()->attach($amenities->random(rand(2, 4))->pluck('id'));

                Unit::create([
                    'property_id' => $property->id,
                    'unit_number' => 'A'.($i + 1),
                    'bedrooms' => [0, 1, 2, 3][$i % 4],
                    'bathrooms' => [1, 1.5, 2, 2.5][$i % 4],
                    'rent' => [690, 850, 980, 1050][$i % 4],
                    'status' => 'available',
                    'available_on' => now()->addMonths(2),
                ]);
            }
        }
    }
}
