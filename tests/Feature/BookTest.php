<?php

namespace Tests\Feature;

use App\Models\Book;
use Database\Seeders\BookSeeder;
use Tests\TestCase;

class BookTest extends TestCase
{
    protected int $books_count = 10;

    protected function setUp(): void
    {
        parent::setUp();
        if (!count(Book::all()))
            $this->seed(BookSeeder::class);
    }

    public function test_get()
    {
        $response = $this->get('/api/book');
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'ok'
        ]);
    }

    public function test_post_success()
    {
        $data = [
            'title' => fake()->jobTitle(),
            'publisher' => fake()->name(),
            'author' => (fake()->firstName('female') . ' ' . fake()->lastName('female')),
            'genre' => fake()->randomElement(['Action', 'Classic', 'Comic', 'Detective']),
            'publication' => fake()->date(),
            'words' => fake()->randomNumber(3),
            'price' => fake()->randomFloat(1, 20, 200)
        ];
        $response = $this->post("/api/book", $data);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'ok'
        ]);
    }

    public function test_post_error()
    {

        $data = [
            'title' => fake()->jobTitle(),
            'publisher' => fake()->name(),
        ];
        $response = $this->post("/api/book", $data);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'error'
        ]);
    }

    public function test_path_success()
    {
        $book = Book::first();
        $data = [
            'title' => fake()->jobTitle(),
            'publisher' => fake()->name(),
            'id' => $book?->id
        ];
        $response = $this->patch("/api/book", $data);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'ok'
        ]);
    }

    public function test_path_error()
    {
        $data = [
            'title' => fake()->jobTitle()
        ];
        $response = $this->patch("/api/book", $data);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'error'
        ]);
    }

    public function test_delete_success()
    {
        $book = Book::first();
        $data = [
            'id' => $book?->id
        ];
        $response = $this->delete("/api/book", $data);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'ok'
        ]);
    }

    public function test_delete_error()
    {
        $data = [
            'title' => fake()->jobTitle()
        ];
        $response = $this->delete("/api/book", $data);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'error'
        ]);
    }

    public function test_delete_not_found()
    {
        $data = [
            'id' => 99999
        ];
        $response = $this->delete("/api/book", $data);
        $response->assertStatus(200);
        $response->assertJson([
            'status' => 'error'
        ]);
    }

}
