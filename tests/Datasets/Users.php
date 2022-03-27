<?php

use App\Models\User;

dataset('user', function () {
    yield fn () => User::factory()->create();
});

dataset('user_admin', function () {
    yield fn () => User::factory()->create()->assignRole('Administrator');
});

dataset('user_customer', function () {
    yield fn () => User::factory()->create()->assignRole('Customer');
});