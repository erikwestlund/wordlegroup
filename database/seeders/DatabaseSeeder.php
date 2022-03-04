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
        $startBoard = random_int(1, app(WordleBoard::class)->activeBoardNumber - 20);

        // Create 20 groups, each with 20 members, and 20 scores per member
        collect(range(1, 20))->each(fn($i) => $this->createGroup($startBoard, $i));

        // Now, for each user, randomly assign them to two other groups
        User::all()
            ->each(function ($user) use ($startBoard) {
                $currentGroupMembership = GroupMembership::where('user_id', $user->id)->first();
                $startOfWordleDay = app(WordleBoard::class)->getDateFromBoardNumber($startBoard);
                $groupMembershipTime = $startOfWordleDay->subHour();

                Group::where('id', '!=', $user->memberships()->first()->id)
                     ->inRandomOrder()
                     ->take(2)
                     ->get()
                     ->each(function ($group) use ($user, $groupMembershipTime) {
                         GroupMembership::firstOrCreate([
                             'user_id'    => $user->id,
                             'group_id'   => $group->id,
                             'created_at' => $groupMembershipTime,
                         ]);
                     });
            });

//        $this->call([
//            GroupMembershipSeeder::class,
//        ]);
    }

    public function createGroup($startBoard = null, $iteration = 1)
    {
        if (!$startBoard) {
            $earliestStartBoard = app(WordleBoard::class)->activeBoardNumber - 20;
            $startBoard = $startBoard ?? random_int(1, $earliestStartBoard);
        }

        $startOfWordleDay = app(WordleBoard::class)->getDateFromBoardNumber($startBoard);
        $groupMembershipTime = $startOfWordleDay->subHour();

        // Create an admin. First time through, make the email generic for testing ease.
        if ($iteration === 1) {
            $admin = User::factory()->state(['email' => 'user@site.com'])->create();
        } else {
            $admin = User::factory()->create();
        }

        // Create a gruop.
        $group = Group::factory()
                      ->for($admin, 'admin')
                      ->state(['created_at' => $groupMembershipTime])
                      ->create();

        $adminMembership = GroupMembership::factory()
                                          ->for($admin, 'user')
                                          ->for($group, 'group')
                                          ->state(['created_at' => $groupMembershipTime])
                                          ->create();


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
                                  ->state(['group_id' => $group->id, 'created_at' => $groupMembershipTime])
                                  ->create();

        // Add scores for each member.
        $members->each(function ($membership) use ($startBoard) {
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
