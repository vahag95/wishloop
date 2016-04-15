<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder {

  	public function run()
  	{
    	DB::table('users')->delete();
    	$user = User::create([
          'id'         => 1,
          'name' => 'Test',          
	        'email' 	 => 'test@test.test',
	        'password' 	 => Hash::make('test')
	    ]);      

      $user = User::create([
            'id'         => 2,
            'name' => 'Test2',            
            'email'      => 'asd@asd.asd',
            'password'   => Hash::make('asdasdasd')
        ]);      
    }
}
