<?php namespace Tests\Repositories;

use App\Models\Register_user;
use App\Repositories\Register_userRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class Register_userRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Register_userRepository
     */
    protected $registerUserRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->registerUserRepo = \App::make(Register_userRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_register_user()
    {
        $registerUser = Register_user::factory()->make()->toArray();

        $createdRegister_user = $this->registerUserRepo->create($registerUser);

        $createdRegister_user = $createdRegister_user->toArray();
        $this->assertArrayHasKey('id', $createdRegister_user);
        $this->assertNotNull($createdRegister_user['id'], 'Created Register_user must have id specified');
        $this->assertNotNull(Register_user::find($createdRegister_user['id']), 'Register_user with given id must be in DB');
        $this->assertModelData($registerUser, $createdRegister_user);
    }

    /**
     * @test read
     */
    public function test_read_register_user()
    {
        $registerUser = Register_user::factory()->create();

        $dbRegister_user = $this->registerUserRepo->find($registerUser->id);

        $dbRegister_user = $dbRegister_user->toArray();
        $this->assertModelData($registerUser->toArray(), $dbRegister_user);
    }

    /**
     * @test update
     */
    public function test_update_register_user()
    {
        $registerUser = Register_user::factory()->create();
        $fakeRegister_user = Register_user::factory()->make()->toArray();

        $updatedRegister_user = $this->registerUserRepo->update($fakeRegister_user, $registerUser->id);

        $this->assertModelData($fakeRegister_user, $updatedRegister_user->toArray());
        $dbRegister_user = $this->registerUserRepo->find($registerUser->id);
        $this->assertModelData($fakeRegister_user, $dbRegister_user->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_register_user()
    {
        $registerUser = Register_user::factory()->create();

        $resp = $this->registerUserRepo->delete($registerUser->id);

        $this->assertTrue($resp);
        $this->assertNull(Register_user::find($registerUser->id), 'Register_user should not exist in DB');
    }
}
