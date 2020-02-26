<?php

use EDU\Models\User;
use EDU\Models\UserProfile;
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
        factory(User::class)->create([
            'email' => 'admin@example.com',
            'enrolment' => 100000
        ])->each(function(User $user){
            $profile = factory(UserProfile::class)->make();
            $user->profile()->create($profile->toArray());
            User::assingRole($user, User::ROLE_ADMIN);
            $user->save();
        });

        factory(User::class,50)->create()->each(function(User $user){
            if(!$user->userable){
                $profile = factory(UserProfile::class)->make();
                $user->profile()->create($profile->toArray());
                User::assingRole($user, User::ROLE_TEACHER);
                User::assignEnrolment(new User(), User::ROLE_TEACHER);
                $user->save();
            }
        });

        factory(User::class,100)->create()->each(function(User $user){
            if(!$user->userable){
                $profile = factory(UserProfile::class)->make();
                $user->profile()->create($profile->toArray());
                User::assingRole($user, User::ROLE_STUDENT);
                User::assignEnrolment(new User(), User::ROLE_STUDENT);
                $user->save();
            }
        });
    }
}
