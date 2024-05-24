<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user with the role admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::create([
            'phoneNumber' => '081234567890',
            'role' => 'admin',
            'password' => bcrypt('katasandi123'),
        ]);

        $this->info('Admin user created successfully');
    }
}
