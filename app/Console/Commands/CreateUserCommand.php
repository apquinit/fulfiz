<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\User;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     *
     * @return int Number of transaction that are expired
     */
    public function handle()
    {
        $username = $this->ask('Enter username', 'default_user');
        $password = $this->secret('Enter password', 'password123!');

        if ($this->confirm('Proceed to user creation with provided details?', false)) {
            factory(User::class)->create([
                'username' => $username,
                'password' => app('hash')->make($password),
            ]);
            $this->info('User created successfully.');
            exit(0);
        }
        $this->info('User creation aborted.');
        exit(0);
    }
}
