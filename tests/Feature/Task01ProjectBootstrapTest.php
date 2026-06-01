<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class Task01ProjectBootstrapTest extends TestCase
{
    use RefreshDatabase;

    public function test_laravel_version_is_12(): void
    {
        $this->assertStringStartsWith('12.', app()->version());
    }

    public function test_app_key_is_set(): void
    {
        $this->assertNotEmpty(config('app.key'));
        $this->assertStringStartsWith('base64:', config('app.key'));
    }

    public function test_app_name_is_manthabill(): void
    {
        $this->assertSame('ManthaBill', config('app.name'));
    }

    public function test_database_connection_works(): void
    {
        $this->assertNotNull(DB::connection()->getPdo());
    }

    public function test_default_migrations_ran(): void
    {
        $this->assertTrue(Schema::hasTable('migrations'));
        $this->assertTrue(Schema::hasTable('cache'));
        $this->assertTrue(Schema::hasTable('jobs'));
    }

    public function test_application_returns_http_200(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_env_example_configures_mysql(): void
    {
        $envExample = file_get_contents(base_path('.env.example'));

        $this->assertStringContainsString('DB_CONNECTION=mysql', $envExample);
        $this->assertStringContainsString('DB_DATABASE=manthabill', $envExample);
        $this->assertStringContainsString('SESSION_DRIVER=database', $envExample);
    }

    public function test_env_is_in_gitignore(): void
    {
        $gitignore = file_get_contents(base_path('.gitignore'));

        $this->assertStringContainsString('.env', $gitignore);
    }
}
