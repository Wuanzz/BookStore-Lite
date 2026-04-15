<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Cửa Hàng',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'), // Mật khẩu là 123456, đã được băm để Laravel có thể lưu trữ an toàn
        ]);
    }
}
