<?php

namespace Database\Seeders;

use App\Enums\Role;
use App\Models\Billing;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Pharmacist;
use App\Models\Prescription;
use App\Models\Prescription_Item;
use App\Models\Shipment;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Order::factory(20)->create();

        User::factory()->create([
            'name' => 'Test',
            'email' => 'test@example.com',
            'role'=>Role::Admin
        ]);
        Billing::factory(5)->create();
        Inventory::factory(5)->create();
        OrderItem::factory(5)->create();
        Payment::factory(5)->create();
        Prescription::factory(5)->create();
        Pharmacist::factory(5)->create();
        Shipment::factory(5)->create();
//        Supplier::factory(5)->create();
//        Prescription_Item::factory(5)->create();
    }
}
