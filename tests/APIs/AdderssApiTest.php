<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Adderss;

class AdderssApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_adderss()
    {
        $adderss = Adderss::factory()->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/addersses', $adderss
        );

        $this->assertApiResponse($adderss);
    }

    /**
     * @test
     */
    public function test_read_adderss()
    {
        $adderss = Adderss::factory()->create();

        $this->response = $this->json(
            'GET',
            '/api/addersses/'.$adderss->id
        );

        $this->assertApiResponse($adderss->toArray());
    }

    /**
     * @test
     */
    public function test_update_adderss()
    {
        $adderss = Adderss::factory()->create();
        $editedAdderss = Adderss::factory()->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/addersses/'.$adderss->id,
            $editedAdderss
        );

        $this->assertApiResponse($editedAdderss);
    }

    /**
     * @test
     */
    public function test_delete_adderss()
    {
        $adderss = Adderss::factory()->create();

        $this->response = $this->json(
            'DELETE',
             '/api/addersses/'.$adderss->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/addersses/'.$adderss->id
        );

        $this->response->assertStatus(404);
    }
}
