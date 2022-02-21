<?php

namespace Tests\Feature;

use App\Models\Team;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TeamTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_team_has_a_name()
    {
        $team = new Team(['name'=>'Acme']);
        $this->assertEquals('Acme', $team->name);
    }
    public function test_a_team_can_add_members(){
        $team = Team::factory()->create();
        $user = User::factory()->create();
        $userTwo = User::factory()->create();

        $team->add($user);
        $team->add($userTwo);

        $this->assertEquals(2, $team->count());

    }
    public function test_a_team_have_max_size(){
        $team = Team::factory()->create(['size'=>5]);

        $userOne = User::factory()->create();
        $userTwo = User::factory()->create();
        $userThree = User::factory()->create();
        $userFour = User::factory()->create();
        $userFive = User::factory()->create();


        $team->add($userOne);
        $team->add($userTwo);
        $team->add($userThree);
        $team->add($userFour);
        $team->add($userFive);

        $this->assertEquals(5, $team->count());

        $userWhoCanNotBeMember = User::factory()->create();

        $this->expectException('Exception');
        $team->add($userWhoCanNotBeMember);

    }
    public function test_a_team_can_add_multiple_members_at_once(){
        $team = Team::factory()->create(['size'=>5]);

        $users = User::factory()->count(2)->create();

        $team->add($users);

        $this->assertEquals(2 , $team->count());
    }
    public function test_a_team_can_remove_a_member(){

        $team = Team::factory()->create(['size'=>5]);
        $userOne = User::factory()->create();
        $userTwo = User::factory()->create();

        $team->add($userOne);
        $team->add($userTwo);

        $this->assertEquals(2 , $team->count());

        $team->remove($userOne);
        $this->assertEquals(1 , $team->count());

    }
    public function test_a_team_can_remove_members_at_once(){
        $team = Team::factory()->create(['size'=>100]);
        $this->assertEquals(0 , $team->count());

        $usersGroupOne = User::factory()->count(10)->create();
        $usersGroupTwo = User::factory()->count(10)->create();

        $team->add($usersGroupOne);
        $team->add($usersGroupTwo);
        $this->assertEquals(20 , $team->count());

        $team->remove($usersGroupOne);
        $this->assertEquals(10 , $team->count());

    }
    public function test_different_team_can_not_delete_other_team_members(){
        $teamOne = Team::factory()->create(['size'=>5]);
        $teamTwo= Team::factory()->create(['size'=>5]);
        $userForTeamOne = User::factory()->create();
        $userForTeamTwo = User::factory()->create();

        $teamOne->add($userForTeamOne);
        $teamTwo->add($userForTeamTwo);

        $this->expectException('Exception');
        $teamOne->remove($userForTeamTwo);
    }
    public function test_a_team_can_remove_all_members_at_once(){
        $team = Team::factory()->create(['size'=>100]);

        $users = User::factory()->count(100)->create();

        $team->add($users);

        $this->assertEquals(100 , $team->count());
        $team->refreshMembers();

        $this->assertEquals(0 , $team->count());
    }
}
