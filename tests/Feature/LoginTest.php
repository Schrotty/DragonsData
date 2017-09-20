<?php
/**
 * Created by PhpStorm.
 * User: ruben
 * Date: 20.09.2017
 * Time: 21:54
 */

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAccess()
    {
        $this->accessAsGuest();
        $this->accessAsAuthUser();
    }

    public function accessAsAuthUser()
    {
        Auth::login(User::all()->first());

        $response = $this->get('/');
        $response->assertStatus(200);

        Auth::logout();
    }

    public function accessAsGuest()
    {
        $response = $this->get('/');
        $response->assertStatus(302);
    }
}
