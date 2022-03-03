<?php

namespace Database\Seeders;

use App\Concerns\WordleBoard;
use App\Models\Group;
use App\Models\GroupMembership;
use App\Models\Score;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
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
        collect(range(0, 19))->each(fn($i) => $this->createGroup($i));


//        $this->call([
//            GroupMembershipSeeder::class,
//        ]);
    }

    public function createGroup($i = 0)
    {
        // Create an admin. First time through, make the email generic for testing ease.
        if ($i === 0) {
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

        $earliestStartBoard = app(WordleBoard::class)->activeBoardNumber - 20;
        $startBoard = random_int(1, $earliestStartBoard);

        $score = Score::factory()
                      ->count(20)
                      ->state(new Sequence(
                          function ($sequence) use ($admin, $startBoard) {

                              return [
                                  'user_id'           => $admin,
                                  'recording_user_id' => $admin,
                                  'board_number'      => $sequence->index + $startBoard,
                                  'date'              => app(WordleBoard::class)->getDateFromBoardNumber($sequence->index + $startBoard),
                              ];
                          },
                      ))->create();

        // Create some members.
        $members = GroupMembership::factory()
                                  ->count(4)
                                  ->state(['group_id' => $group->id])
                                  ->create();

        // Add scores for each member.
        $members->each(function ($membership) {
            $earliestStartBoard = app(WordleBoard::class)->activeBoardNumber - 20;
            $startBoard = random_int(1, $earliestStartBoard);

            Score::factory()
                 ->count(20)
                 ->state(new Sequence(
                     function ($sequence) use ($membership, $startBoard) {

                         return [
                             'user_id'           => $membership->user_id,
                             'recording_user_id' => $membership->user_id,
                             'board_number'      => $sequence->index + $startBoard,
                             'date'              => app(WordleBoard::class)->getDateFromBoardNumber($sequence->index + $startBoard),
                         ];
                     },
                 ))->create();
        });
    }
}
