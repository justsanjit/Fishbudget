<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Transaction;
use App\User;

class TransactionTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function authenticated_user_can_create_transaction()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->actingAs($user);

        $attributes = [
            'type' => 'income',
            'amount' => $this->faker->randomNumber(),
            'description' => $this->faker->sentence,
            'date' => $this->faker->date,
        ];

        $response = $this->post('transactions', $attributes);

        $response->assertRedirect('transactions');
        $this->assertDatabaseHas('transactions', $attributes);
    }

    /** @test */
    public function guest_can_not_create_a_transaction()
    {
        $transaction = factory(Transaction::class)->raw();

        $response = $this->post('transactions', $transaction);

        $response->assertRedirect('login');
    }

    /** @test */
    public function amount_is_required_for_transaction()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Transaction::class)->raw(['amount' => null]);

        $this->post('transactions', $attributes)->assertSessionHasErrors('amount');
    }

    /** @test */
    public function amount_must_be_greater_than_zero()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Transaction::class)->raw(['amount' => -1]);

        $this->post('transactions', $attributes)->assertSessionHasErrors('amount');
    }

    /** @test */
    public function type_is_required_for_transactions()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Transaction::class)->raw(['type' => null]);

        $this->post('transactions', $attributes)->assertSessionHasErrors('type');
    }

    /** @test */
    public function descriptions_is_required_for_transactions()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Transaction::class)->raw(['description' => null]);

        $this->post('transactions', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function date_is_required_for_transaction()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Transaction::class)->raw(['date' => null]);

        $this->post('transactions', $attributes)->assertSessionHasErrors('date');
    }

    /** @test */
    public function date_must_be_in_iso_8601_format()
    {
        $this->actingAs(factory(User::class)->create());

        $attributes = factory(Transaction::class)->raw(['date' => '2019/02/24']);

        $this->post('transactions', $attributes)->assertSessionHasErrors('date');
    }

    /** @test */
    public function user_can_view_list_of_his_transactions()
    {
        $jane = factory(User::class)->create();
        $this->actingAs($jane);

        $janesTransaction = factory(Transaction::class)->create(['user_id' => $jane->id]);
        $notJanesTransaction = factory(Transaction::class)->create();

        $response = $this->get('transactions');

        $response->assertSee($janesTransaction->description)
            ->assertDontSee($notJanesTransaction->description);
    }

    /** @test */
    public function guest_can_not_view_list_of_transaction()
    {
        $transaction = factory(Transaction::class)->create();

        $response = $this->get('transactions');

        $response->assertRedirect('login');
    }

    /** @test */
    public function authenticated_user_can_view_transaction()
    {
        $this->withExceptionHandling();

        $user = factory(User::class)->create();
        $transaction = factory(Transaction::class)->create(['user_id' => $user->id]);

        $this->actingAs($user);

        $response = $this->get('transactions/' . $transaction->id);

        $response->assertSee($transaction->description)
            ->assertSee($transaction->type)
            ->assertSee($transaction->amount);
    }

    /** @test */
    public function authenticated_user_can_not_view_other_user_transaction()
    {
        $jane = factory(User::class)->create();
        $notJanesTransaction = factory(Transaction::class)->create();

        $this->actingAs($jane);

        $response = $this->get('transactions/' . $notJanesTransaction->id);

        $response->assertStatus(403);
    }

    /** @test */
    public function guest_can_not_view_single_transaction()
    {
        $transaction = factory(Transaction::class)->create();

        $response = $this->get('transactions/' . $transaction->id);

        $response->assertRedirect('login');
    }
}
