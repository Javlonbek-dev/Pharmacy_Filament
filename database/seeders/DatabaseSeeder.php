<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        Order::factory(20)->create();
//        Billing::factory(5)->create();
//        Inventory::factory(5)->create();
//        OrderItem::factory(5)->create();
//        Payment::factory(5)->create();
//        Prescription::factory(5)->create();
//        Pharmacist::factory(5)->create();
//        Shipment::factory(5)->create();
//        Supplier::factory(5)->create();
//        Prescription_Item::factory(5)->create();

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
        ]);
    }
}
