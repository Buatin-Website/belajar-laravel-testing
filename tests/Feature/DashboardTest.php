<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\getJson;

it('can\'t access dashboard (unauthorized)', function () {
    getJson(route('api.dashboard'))
        ->assertUnauthorized();
});

it('can access dashboard', function (User $user, User $admin, User $customer) {
    actingAs($user)
        ->getJson(route('api.dashboard'))
        ->assertJson([
            'message' => 'Welcome to the dashboard!',
        ]);

    actingAs($admin)
        ->getJson(route('api.dashboard'))
        ->assertJson([
            'message' => 'Welcome to the dashboard!',
        ]);

    actingAs($customer)
        ->getJson(route('api.dashboard'))
        ->assertJson([
            'message' => 'Welcome to the dashboard!',
        ]);
})->with('user', 'user_admin', 'user_customer');