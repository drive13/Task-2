<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('users')->insert([
            'name' => 'LaravelDev',
            'email' => 'laraveldel@gmail.com',
            'password' => '$2y$10$eQOkz6Qhb9psNj36SHN93Oc8oC.75vECVM9BfEJLoP85hrGmYYobm',
        ]);

        DB::table('products')->insert([
            'product' => 'Router',
            'code_product' => 'Rtr001',
            'price' => '870000',
            'stock' => 10,
        ]);
        DB::table('products')->insert([
            'product' => 'Keyboard K1',
            'code_product' => 'Kbd001',
            'price' => '450000',
            'stock' => 9,
        ]);
        DB::table('products')->insert([
            'product' => 'Mouse L1',
            'code_product' => 'Ms001',
            'price' => '240000',
            'stock' => 6,
        ]);
        DB::table('customers')->insert([
            'name' => 'Wahyu',
            'phone' => '081282810588',
            'address' => 'Cibinong, Bogor',
        ]);
        DB::table('customers')->insert([
            'name' => 'Windy',
            'phone' => '081285820544',
            'address' => 'Cisauk, Tangerang',
        ]);
        DB::table('sales_orders')->insert([
            'invoice' => 'INV/11-11-22/0001',
            'date' => '2022-11-11',
            'product_id' => 1,
            'customer_id' => 1,
        ]);
        DB::table('sales_orders')->insert([
            'invoice' => 'INV/11-11-22/0002',
            'date' => '2022-11-11',
            'product_id' => 1,
            'customer_id' => 2,
        ]);
    }
}
