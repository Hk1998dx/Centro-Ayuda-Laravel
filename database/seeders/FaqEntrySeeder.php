<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FaqEntry;

class FaqEntrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    FaqEntry::factory()->count(10)->create();
}
}
