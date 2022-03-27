<?php

use App\Models\User;
use function Pest\Laravel\postJson;

it('can\'t login (validation error)', function () {
    postJson(route('api.auth.login'))
        ->assertUnprocessable();
});

it('can\'t login (invalid credentials)', function (User $user) {
    postJson(route('api.auth.login'), [
        'email' => $user->email,
        'password' => \Pest\Faker\faker()->password(8),
    ])->assertUnauthorized();
})->with('user');

it('can login', function (User $user) {
    postJson(route('api.auth.login'), [
        'email' => $user->email,
        'password' => 'password',
    ])->assertOk();
})->with('user');