<?php

namespace Database\Seeders;

use App\Concerns\WordleBoard;
use App\Concerns\WordleDate;
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
        $seedCount = 5;
        $startBoard = random_int(1, app(WordleBoard::class)->activeBoardNumber - 20);

        // Create groups with members
        collect(range(1, $seedCount))->each(fn($i) => $this->createGroup($seedCount, $startBoard, $i));

        // Now, for each user, randomly assign them to two other groups
        // And then add the scores for each user.
        User::all()
            ->each(function ($user) use ($startBoard, $seedCount) {
                $currentGroupMembership = GroupMembership::where('user_id', $user->id)->first();
                $startOfWordleDay = app(WordleBoard::class)->getDateFromBoardNumber($startBoard);
                $groupMembershipTime = $startOfWordleDay->subHour();

                Group::where('id', '!=', $user->memberships()->first()->group_id)
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

                Score::factory()
                     ->count($seedCount)
                     ->state(new Sequence(
                         function ($sequence) use ($user, $startBoard, $seedCount) {
                             $date = app(WordleBoard::class)->getDateFromBoardNumber($sequence->index + $startBoard);
                             $scoreDateTime = $scoreTime = app(WordleDate::class)->get($date)
                                                                                 ->addHours(random_int(0, 23))
                                                                                 ->addMinutes(random_int(0, 59))
                                                                                 ->addSeconds(random_int(0, 59));
                             return [
                                 'user_id'           => $user->id,
                                 'recording_user_id' => $user->id,
                                 'board_number'      => $sequence->index + $startBoard,
                                 'date'              => $date,
                                 'created_at'        => $scoreDateTime,
                                 'updated_at'        => $scoreDateTime,
                             ];
                         },
                     ))->create();
            });

        // Now, create an admin score f


//        $this->call([
//            GroupMembershipSeeder::class,
//        ]);
    }

    public function createGroup($seedCount = 5, $startBoard = null, $iteration = 1)
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

        // Create a group.
        $group = Group::factory()
                      ->for($admin, 'admin')
                      ->state(['created_at' => $groupMembershipTime])
                      ->create();

        $adminMembership = GroupMembership::factory()
                                          ->for($admin, 'user')
                                          ->for($group, 'group')
                                          ->state(['created_at' => $groupMembershipTime])
                                          ->create();

        // Create some members.
        $members = GroupMembership::factory()
                                  ->count(4)
                                  ->state(['group_id' => $group->id, 'created_at' => $groupMembershipTime])
                                  ->create();
    }
}
