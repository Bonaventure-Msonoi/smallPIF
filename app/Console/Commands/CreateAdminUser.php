<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create {--email=} {--name=}';

    protected $description = 'Create an admin user (first-time setup)';

    public function handle(): int
    {
        $email = $this->option('email') ?: $this->ask('Admin email');
        $name = $this->option('name') ?: $this->ask('Admin name');
        $password = $this->secret('Admin password (min 8 chars)');
        $passwordConfirm = $this->secret('Confirm password');

        if (!$password || strlen($password) < 8) {
            $this->error('Password must be at least 8 characters.');
            return self::FAILURE;
        }
        if ($password !== $passwordConfirm) {
            $this->error('Passwords do not match.');
            return self::FAILURE;
        }

        $existing = User::query()->where('email', $email)->first();
        if ($existing) {
            $existing->forceFill([
                'name' => $name,
                'password' => Hash::make($password),
                'is_admin' => true,
            ])->save();

            $this->info('Existing user updated to admin.');
            return self::SUCCESS;
        }

        User::query()->create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);

        $this->info('Admin user created.');
        return self::SUCCESS;
    }
}

