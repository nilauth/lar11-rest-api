<?php

use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;


Route::get( '/', function () {
    return view( 'welcome' );
} );

Route::get( '/setup', function () {
    $credentials = [
        'email'    => 'admin@admin.com',
        'password' => 'password',
    ];

// Attempt to authenticate the admin user
//    if ( ! auth()->attempt( $credentials ) ) {
    if ( ! Auth::attempt( $credentials ) ) // Create the admin user if not already existing
    {
        $user = new User();

        $user->name     = 'Admin';
        $user->email    = $credentials['email'];
        $user->password = Hash::make( $credentials['password'] );
        $user->save();
    }
// Log in the newly created admin user
    if ( Auth::attempt( $credentials ) ) {
//            $user = auth()->user();

        $user = auth()->user();
        if ( $user instanceof \App\Models\User ) {
            // Hinting here for $user will be specific to the User object
            $adminToken  = $user->createToken( 'admin-token',
                [ 'create', 'update', 'delete' ] );
            $updateToken = $user->createToken( 'update-token',
                [ 'create', 'update' ] );
            $basicToken  = $user->createToken( 'basic-token' );
        } else {
            throw new AuthenticationException();
        }

        return [
            'admin'  => $adminToken->plainTextToken,
            'update' => $updateToken->plainTextToken,
            'basic'  => $basicToken->plainTextToken,
        ];
    }
} );
