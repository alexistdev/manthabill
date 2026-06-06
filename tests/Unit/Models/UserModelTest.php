<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    private function makeUser(int $status = User::STATUS_ACTIVE, array $overrides = []): User
    {
        return User::create(array_merge([
            'client'      => 1,
            'password'    => bcrypt('pass'),
            'email'       => 'u@test.com',
            'date_create' => now()->toDateString(),
            'status'      => $status,
        ], $overrides));
    }

    public function test_is_active_returns_true_for_status_one(): void
    {
        $user = $this->makeUser(User::STATUS_ACTIVE);
        $this->assertTrue($user->isActive());
        $this->assertFalse($user->isUnverified());
        $this->assertFalse($user->isSuspended());
    }

    public function test_is_unverified_returns_true_for_status_two(): void
    {
        $user = $this->makeUser(User::STATUS_UNVERIFIED);
        $this->assertTrue($user->isUnverified());
        $this->assertFalse($user->isActive());
    }

    public function test_is_suspended_returns_true_for_status_three(): void
    {
        $user = $this->makeUser(User::STATUS_SUSPENDED);
        $this->assertTrue($user->isSuspended());
        $this->assertFalse($user->isActive());
    }

    public function test_display_name_uses_client_number_when_no_name(): void
    {
        $user = $this->makeUser(User::STATUS_ACTIVE, ['client' => 42]);
        UserDetail::create(['id_user' => $user->id_user, 'gambar' => 'default.jpg']);

        $this->assertSame('Client #42', $user->display_name);
    }

    public function test_display_name_returns_full_name_when_set(): void
    {
        $user = $this->makeUser();
        UserDetail::create([
            'id_user'       => $user->id_user,
            'gambar'        => 'default.jpg',
            'nama_depan'    => 'Budi',
            'nama_belakang' => 'Santoso',
        ]);

        $this->assertSame('Budi Santoso', $user->fresh()->display_name);
    }

    public function test_detail_relation_returns_user_detail(): void
    {
        $user   = $this->makeUser();
        $detail = UserDetail::create(['id_user' => $user->id_user, 'gambar' => 'default.jpg']);

        $this->assertTrue($user->detail->is($detail));
    }
}
