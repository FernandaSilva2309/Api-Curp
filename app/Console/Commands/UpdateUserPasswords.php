<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UpdateUserPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:update-passwords {newPassword}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update passwords for all users to a fixed value';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $newPassword = $this->argument('newPassword');

        // Asegúrate de validar la contraseña aquí si es necesario
        if (strlen($newPassword) < 8) {
            $this->error('The new password must be at least 8 characters long.');
            return 1;
        }

        $users = User::all();

        if ($users->isEmpty()) {
            $this->error('No users found.');
            return 1;
        }

        $users->each(function ($user) use ($newPassword) {
            $user->password = Hash::make($newPassword);
            if ($user->save()) {
                $this->info("Password for user {$user->id} updated successfully.");
            } else {
                $this->error("Failed to update password for user {$user->id}.");
            }
        });

        $this->info('All user passwords have been updated.');

        return 0;
    }
}
