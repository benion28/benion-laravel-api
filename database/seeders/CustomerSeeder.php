<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory()->count(100)->hasInvoices(10)->create();

        Customer::factory()->count(50)->hasInvoices(20)->create();

        Customer::factory()->count(30)->hasInvoices(5)->create();

        Customer::factory()->count(10)->create();
    }
}