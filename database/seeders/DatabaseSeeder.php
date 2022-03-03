<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\GroupMembership;
use App\Models\Score;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        collect(range(0,19))->each(fn($i) => $this->createGroup($i));


//        $this->call([
//            GroupMembershipSeeder::class,
//        ]);
    }

    public function createGroup($i = 0)
    {
        // Create an admin. First time through, make the email generic for testing ease.
        if($i === 0) {
            $admin = User::factory()->state(['email' => 'user@site.com'])->create();
        } else {
            $admin = User::factory()->create();
        }

        // Create a gruop.
        $group = Group::factory()
                      ->for($admin, 'admin')
                      ->create();

        $adminMembership = GroupMembership::factory()
                                          ->for($admin, 'user')
                                          ->for($group, 'group')
                                          ->create();

        $score = Score::factory()->count(5)
                      ->state([
                          'user_id'           => $admin,
                          'recording_user_id' => $admin,
                      ])->create();

        // Create some members.
        $members = GroupMembership::factory()
                                  ->count(4)
                                  ->state(['group_id' => $group->id])
                                  ->create();

        // Add scores for each member.
        $members->each(function ($membership) {
            Score::factory()->count(5)->state([
                'user_id'           => $membership->user_id,
                'recording_user_id' => $membership->user_id,
            ])->create();
        });
    }
}
