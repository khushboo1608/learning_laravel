<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Register_user;

class Register_userApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_register_user()
    {
        $registerUser = Register_user::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/register_users', $registerUser
        );

        $this->assertApiResponse($registerUser);
    }

    /**
     * @test
     */
    public function test_read_register_user()
    {
        $registerUser = Register_user::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/register_users/'.$registerUser->id
        );

        $this->assertApiResponse($registerUser->toArray());
    }

    /**
     * @test
     */
    public function test_update_register_user()
    {
        $registerUser = Register_user::factory()->create();
        $editedRegister_user = Register_user::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/register_users/'.$registerUser->id,
            $editedRegister_user
        );

        $this->assertApiResponse($editedRegister_user);
    }

    /**
     * @test
     */
    public function test_delete_register_user()
    {
        $registerUser = Register_user::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/register_users/'.$registerUser->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/register_users/'.$registerUser->id
        );

        $this->response->assertStatus(404);
    }
}
