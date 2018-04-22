<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Model\User;
use App\Http\Controllers\UsersController as UserControl;
use Illuminate\Support\Facades\DB;
use JWTAuth;
use Faker\Factory as Faker;

class UserTest extends TestCase
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
  public function register_new_user()
  {
    $faker = Faker::create();

    $createdStatus = 201;
    $createdResponse = 'Successfully added user';

    $newUser = generateNewUser(null, 'make');
    // dd($newUser);

    $randomAccountEntry = [
      $newUser['email'],
      $newUser['phone_number'],
    ];

    $numberDigit = $faker->numberBetween(0,1);
    
    $data = [
      'firstname' => $newUser['firstname'],
      'lastname' => $newUser['lastname'],
      'account' => $randomAccountEntry[$numberDigit],
      'password' => 'secret',
      'remember_token' => $newUser['remember_token']
    ];
    
    $post = $this->post('/api/user/register', $data);
    dd($post->getContent());

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


  /** @test */
  public function add_a_user()
  {
    $createdStatus = 201;
    $createdResponse = 'Successfully added user';

    // $user = DB::select('select * from users where id = 1');
    // dd($user[0]->email);
    $data = [
      'username' => '0958982073',
      'password' => 'secret'
    ];

    $post = $this->post('/api/auth/login', $data);
    dd($post->getContent());
    // generateNewUser(5, 'make');
    $firstUser = User::first();
    $token = JWTAuth::fromUser($firstUser);
    $header = [ 'Authorization' => 'Bearer '. $token ];
    $newUser = generateNewUser(null, 'make');
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


    // dd($jsonReponseContent);
    // $this->assertObjectHasAttribute('username', $jsonReponseContent);
    // $this->assertObjectHasAttribute('id', $jsonReponseContent);
  }
}
