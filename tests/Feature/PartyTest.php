<?php

namespace Tests\Feature;

use App\Party;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PartyTest extends TestCase
{
    public function testChronistAccess()
    {
        $party = Party::find('59b40259d02aae3df2708233');
        $chronist = User::find($party->getValue('chronist'));
        $this->actingAs($chronist, 'web');

        $response = $this->get('/entry/create/' . $party->getValue('_id'));
        $response->assertStatus(200);
    }
}
