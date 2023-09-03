<?php

use function Pest\Laravel\post;

test('Titulo', function () {

    //create a user
    $user = \App\Models\User::factory()->create();

    //login the user
    $this->actingAs($user);

    //create a question with 260 characters
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 255) . '?',
    ]);

    $request->assertRedirect(route('dashboard'));
    \Pest\Laravel\assertDatabaseCount('questions', 1);

    \Pest\Laravel\assertDatabaseHas('questions', [
        'question' => str_repeat('*', 255) . '?',
    ]);

});
