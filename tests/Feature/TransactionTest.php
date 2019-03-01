<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Transaction;

class ExampleTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function user_can_create_transaction()
    {
        $this->withoutExceptionHandling();

        $attributes = [
            'type' => 'income',
            'amount' => $this->faker->randomNumber(),
            'description' => $this->faker->sentence,
            'date' => $this->faker->date
        ];

        $this->post('transactions', $attributes)->assertRedirect('transactions');

        $this->assertDatabaseHas('transactions', $attributes);
    }

    /** @test */
    public function amount_is_required_for_transaction()
    {
        $attributes = factory(Transaction::class)->raw(['amount' => null]);

        $this->post('transactions', $attributes)->assertSessionHasErrors('amount');
    }

    /** @test */
    public function amount_must_be_greater_than_zero()
    {
        $attributes = factory(Transaction::class)->raw(['amount' => -1]);

        $this->post('transactions', $attributes)->assertSessionHasErrors('amount');
    }

    /** @test */
    public function type_is_required_for_transactions()
    {
        $attributes = factory(Transaction::class)->raw(['type' => null]);

        $this->post('transactions', $attributes)->assertSessionHasErrors('type');
    }

    /** @test */
    public function descriptions_is_required_for_transactions()
    {
        $attributes = factory(Transaction::class)->raw(['description' => null]);

        $this->post('transactions', $attributes)->assertSessionHasErrors('description');
    }

    /** @test */
    public function date_is_required_for_transaction()
    {
        $attributes = factory(Transaction::class)->raw(['date' => null]);

        $this->post('transactions', $attributes)->assertSessionHasErrors('date');
    }

    /** @test */
    public function date_must_be_in_iso_8601_format()
    {
        $attributes = factory(Transaction::class)->raw(['date' => '2019/02/24']);

        $this->post('transactions', $attributes)->assertSessionHasErrors('date');
    }

    /** @test */
    public function user_can_view_list_of_transactions()
    {
        $this->withoutExceptionHandling();
        $transactionA = factory(Transaction::class)->create();
        $transactionB = factory(Transaction::class)->create();

        $this->get('transactions')
            ->assertSee($transactionA->description)
            ->assertSee($transactionB->description);
    }
}
