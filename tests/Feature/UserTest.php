<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('can\'t access user data (unauthorized)', function () {
    getJson(route('api.users.index'))
        ->assertUnauthorized();
});

it('can\'t access user data (user not admin)', function (User $user, User $customer) {
    actingAs($user)
        ->getJson(route('api.users.index'))
        ->assertForbidden();

    actingAs($customer)
        ->getJson(route('api.users.index'))
        ->assertForbidden();
})->with('user', 'user_customer');

it('can access user data', function (User $admin) {
    actingAs($admin)
        ->getJson(route('api.users.index'))
        ->assertOk();
})->with('user_admin');