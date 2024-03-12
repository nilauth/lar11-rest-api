<?php

use Illuminate\Support\Facades\Route;

Route::get( '/', function () {
    return view( 'welcome' );
} );


Route::redirect( '/here', '/there' );

Route::get( '/there', function () {
    return 'redirected from /here';
} );
