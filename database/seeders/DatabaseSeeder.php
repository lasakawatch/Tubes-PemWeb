<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     * This seeder is SAFE to run multiple times (idempotent)
     */
    public function run(): void
    {
        // Only seed if users table is empty (first time deployment)
        if (User::count() === 0) {
            $this->command->info('🚀 First deployment detected. Seeding database...');
            
            $this->call([
                UserSeeder::class,
                ProductSeeder::class,
                OrderSeeder::class,
                ArticleSeeder::class,
                FaqSeeder::class,
                ContactMessageSeeder::class,
            ]);
            
            $this->command->info('✅ Database seeding completed!');
        } else {
            $this->command->info('⏭️ Database already seeded. Skipping...');
        }
    }
}
