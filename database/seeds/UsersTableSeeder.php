<?php

use App\User;
use Illuminate\Database\Seeder;
use jeremykenedy\LaravelRoles\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('es');
        $adminRole = Role::whereName('Admin')->first();
        $userRole = Role::whereName('User')->first();
        
        // Seed test admin
        $seededAdminEmail = 'admin@admin.com';
        $user = User::where('email', '=', $seededAdminEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'email'                          => $seededAdminEmail,
                'password'                       => Hash::make('password'),
                'phone'                          => $faker->e164PhoneNumber,
                'activated'                      => true
            ]);

            $user->attachRole($adminRole);
            $user->save();
        }
        
        // Seed test user
        $seededUserEmail = 'user@user.com';
        $user = User::where('email', '=', $seededUserEmail)->first();
        if ($user === null) {
            $user = User::create([
                'name'                           => $faker->userName,
                'first_name'                     => $faker->firstName,
                'last_name'                      => $faker->lastName,
                'email'                          => $seededUserEmail,
                'password'                       => Hash::make('password'),
                'phone'                          => $faker->e164PhoneNumber,
                'activated'                      => true
            ]);

            $user->attachRole($userRole);
            $user->save();
        }
    }
}
