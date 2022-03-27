<?php

use function Pest\Laravel\get;

it('can test the application returns a successful response', function () {
    get('/')
        ->assertStatus(200);
});