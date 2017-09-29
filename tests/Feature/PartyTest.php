<?php

namespace Tests\Feature;

use App\Party;
use App\User;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class PartyTest extends TestCase
{
    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make();
    }

    public function testChronistAccess()
    {
        $party = Party::find('59b40259d02aae3df2708233');
        $chronist = User::find($party->getValue('chronist'));

        $this->actingAs($chronist, 'web');

        $response = $this->get('/entry/create/' . $party->getValue('_id'));
        $response->assertStatus(200);
    }

    public function testViewAccessAsNonAuthUser()
    {
        $party = factory(Party::class)->create();

        $this->user->group = 3;
        $this->actingAs($this->user, 'web');

        $response = $this->get('/party/' . $party->getValue('_id'));
        $response->assertStatus(403);
    }

    public function testViewAccessAsAuthUser()
    {
        $party = factory(Party::class)->make([
            'member' => [ $this->user->getValue('_id') ]
        ]);

        $this->user->group = 3;

        $this->assertTrue($this->user->can('view', $party));
    }
}
