<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use App\Models\ServiceRegisterRequest;



class ServiceRegisterRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create('tr_TR');

        foreach (range(1, 50) as $i) {
            ServiceRegisterRequest::create([
                'company_name' => $faker->company,
                'service_type' => $faker->randomElement(['authorized', 'private', 'independent']),
                'description'  => $faker->paragraph(),
                'address'      => $faker->address,
                'phone'        => $faker->phoneNumber,
                'email'        => $faker->unique()->safeEmail,
                'password'     => Hash::make('password'),
            ]);
        }
    }
}
