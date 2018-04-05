<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\User;
use App\Http\Controllers\UsersController as UserControl;
use Illuminate\Support\Facades\DB;
use JWTAuth;


class AuthTest extends TestCase
{
    protected $user;

  public function setUp()
  {
    parent::setUp();

    $users = new User();
    $this->user = $users;
    // User::truncate();
  }

  /** @test */
  public function login()
  {
    $createdStatus = 201;
    $createdResponse = 'Successfully added user';

    $newUser = generateNewUser(null, 'make');
    
    $data = [
      'username' => '0958982073',
      'password' => 'secret'
    ];

    $post = $this->post('/api/auth/login', $data);
    dd($post->getContent());
    // dd($newUser);
    $post = $this->post('/api/user', $newUser, $header);

    // dd($post->getContent());
    $post->assertStatus($createdStatus);
    
    $stringResponse = is_string($post->getContent());
    $this->assertTrue($stringResponse);

    $jsonReponseContent = $post->getContent();
    $result = json_decode($jsonReponseContent);
    // dd($result);
    // $this->assertEquals($createdResponse, $result);
    $this->assertObjectHasAttribute('user_id', $result->data);
    $this->assertNull($result->error);
  }
}
