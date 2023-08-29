<?php

namespace App\Console\Commands;

use App\Actions\Fortify\PasswordValidationRules;
use App\Enums\RoleEnum;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Validator;


class CreateUser extends Command
{
    use PasswordValidationRules;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user {name?} {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create user';

    /**
     * Execute the console command.
     */
    public function handle(): bool
    {
        $admins = User::whereHas('role', function (Builder $query) {
            $query->where('code', RoleEnum::ADMIN->value);
        })->count();

        $digit = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        $stringDigit = $digit->format($admins);

        if ($admins > 0) {
            $plural = Str::plural('admin', $admins);
            $this->info("There is already $stringDigit $plural in database");
            return false;
        }

        $name = $this->argument('name');
        $email = $this->argument('email');

        if (!$name) {
            $name = $this->ask('What\'s Your name?');
        }

        if (!$email) {
            $email = $this->ask('What\'s Your email?');
        }

        $password = $this->secret('What is the password?');
        $passwordConfirmation = $this->secret('Confirm the password');

        $validation = Validator::make([
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $passwordConfirmation,
        ], [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
        ]);

        if ($validation->fails()) {
            $this->info('Admin User not created. See error messages below:');

            foreach ($validation->errors()->all() as $error) {
                $this->error($error);
            }

            return false;
        }

        $role = Role::where('code', RoleEnum::ADMIN->value)->get()->first();

        //create adminUser in database
        $adminUser = new User([
            'name' => $name,
            'email' => $email,
            //save hashed password in DB so no one can see the plain text
            'password' => Hash::make($password),
        ]);

        $adminUser->role()->associate($role);
        $adminUser->save();

        if ($adminUser->exists) {
            $this->info("Admin user $adminUser->name has been created");

            return true;
        }

        $this->error('Something went wrong!');
        return false;
    }
}
