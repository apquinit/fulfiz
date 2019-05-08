<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = (int)$this->command->ask('How many users do you need?', 10);

        if($count <= 0) {
            $this->command->info('Value cannot be 0 or less than 0.');
            exit(0);
        }

        if($count == 1) {
            $this->command->info("Creating user...");
        } else if ($count > 1) {
            $this->command->info("Creating {$count} users...");
        }

        $users = factory(App\Models\User::class, $count)->create();

        if($count == 1) {
            $this->command->info('User created successfully.');
            exit(0);
        } else if ($count > 1) {
            $this->command->info('Users created successfully.');
            exit(0);
        }
    }
}
