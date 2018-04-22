<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;

class UsersController extends Controller
{
    public function __contructor()
    {
        # code...
    }


  /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
  public function index()
  {
      $users = new User();
      return $users->readUser();
  }


  /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
  public function store(Request $request)
  {
    // $validate_rule = User::$rules;
    
    $all = $request->all();
    $account = $request->account;
    $remember_token = $request->remember_token;
    // dd($remember_token);
    
		// $validator = Validator::make($all, $validate_rule);
		// if ($validator->fails()) {
		//   return response(json_encode($validator->getMessageBag()->toArray()), 400);
		// }
    unset($all['account']);
    
    if ($remember_token) {
    	unset($remember_token);
    	$all['remember_token'] = str_random(10);
    	// dd($all);
    }

		if (filter_var($account, FILTER_VALIDATE_EMAIL)) {
			
			$all['email'] = $account;
    }
    else if (is_numeric($account)) {
    	// dd($account);
    	$all['phone_number'] = $account;
    }

    $all['password'] = bcrypt($all['password']);
    
    $user = new User($all);

    $result = $user->save();
		// dd($result);
		if ($result) {

			$data = [
			  'data' => [ 'user_id' => $user->id],
			  'error' => null
			];
			return response($data, 201);
		}
		else{

			$data = [
			  'data' => [],
			  'error' => 'There seems to be a problem adding a user.'
			];

			return response($data, 500);
		}
	}

  /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function show($id)
  {
      $users = new User();
      return $users->readUser($id);
  }

  /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function update(Request $request, $id)
  {
    $users = new User();
    $all = $request->all();

    if ($result = User::find($id)) {
      $result->update($all);
      // $result = $patientProfile->updatePatientProfile($id, $all);
      return response($result, 200);
    }

    return response('There seems to be a problem with the data', 500);
  }


  /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
  public function destroy($id)
  {
      $users = new User();
      $result = $users->deleteUser($id);
      // dd($result);
      return response('true', 204);
  }
}
