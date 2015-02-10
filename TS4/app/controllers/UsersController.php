<?php

class UsersController extends \BaseController {

	/**
	 * Display a listing of users
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();

		return View::make('users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new user
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('users.create');
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$validator = Validator::make($data = Input::all(), User::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		User::create($data);

		return Redirect::route('users.index');
	}

	/**
	 * Display the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::findOrFail($id);

		return View::make('users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$user = User::find($id);

		return View::make('users.edit', compact('user'));
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$user = User::findOrFail($id);

		$validator = Validator::make($data = Input::all(), User::$rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput();
		}

		$user->update($data);

		return Redirect::route('users.index');
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		User::destroy($id);

		return Redirect::route('users.index');
	}





	public function getSignIn(){

		return View::make('signin');
	}
  




  	public function postSignIn(){

  			$validator = Validator::make(Input::all() , array(
  						
  						'email' => 'required | email',
  						'password' => 'required'

  				)
  			);


  			if($validator->fails()){

  				return Redirect::route('account-sign-in')
  						->withErrors($validator)
  						->withInput();


  			} else {
  						$auth = Auth::attempt(array(  
  														
  								'email' 	=> $email,
  								'password'  => $password,
  								'active'    => 1
  						));


  						if($auth){
  							//Redirect to the Intended page
  							return Redirect:: intended('/');
  						} else{
  							     return Redirect::route('account-sign-in')
  												->with('global' , 'Email or Password Wrong or You are not SignIn!');
  						}
  			}

  			return Redirect::route('account-sign-in')
  			->with('global' , 'There Was a problem Signing you in!');
	}



	public function goToHome(){

		return View::make('signin');
	}


	public function accountStatus(){

		return View::make('getSignIn');
	}


}