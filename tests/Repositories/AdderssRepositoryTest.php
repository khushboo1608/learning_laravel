<?php namespace Tests\Repositories;

use App\Models\Adderss;
use App\Repositories\AdderssRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class AdderssRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var AdderssRepository
     */
    protected $adderssRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->adderssRepo = \App::make(AdderssRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_adderss()
    {
        $adderss = Adderss::factory()->make()->toArray();

        $createdAdderss = $this->adderssRepo->create($adderss);

        $createdAdderss = $createdAdderss->toArray();
        $this->assertArrayHasKey('id', $createdAdderss);
        $this->assertNotNull($createdAdderss['id'], 'Created Adderss must have id specified');
        $this->assertNotNull(Adderss::find($createdAdderss['id']), 'Adderss with given id must be in DB');
        $this->assertModelData($adderss, $createdAdderss);
    }

    /**
     * @test read
     */
    public function test_read_adderss()
    {
        $adderss = Adderss::factory()->create();

        $dbAdderss = $this->adderssRepo->find($adderss->id);

        $dbAdderss = $dbAdderss->toArray();
        $this->assertModelData($adderss->toArray(), $dbAdderss);
    }

    /**
     * @test update
     */
    public function test_update_adderss()
    {
        $adderss = Adderss::factory()->create();
        $fakeAdderss = Adderss::factory()->make()->toArray();

        $updatedAdderss = $this->adderssRepo->update($fakeAdderss, $adderss->id);

        $this->assertModelData($fakeAdderss, $updatedAdderss->toArray());
        $dbAdderss = $this->adderssRepo->find($adderss->id);
        $this->assertModelData($fakeAdderss, $dbAdderss->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_adderss()
    {
        $adderss = Adderss::factory()->create();

        $resp = $this->adderssRepo->delete($adderss->id);

        $this->assertTrue($resp);
        $this->assertNull(Adderss::find($adderss->id), 'Adderss should not exist in DB');
    }
}
