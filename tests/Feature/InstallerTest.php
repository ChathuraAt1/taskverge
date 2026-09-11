<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;
use Tests\TestCase;

class InstallerTest extends TestCase
{
    use RefreshDatabase;

    public function test_installer_route_returns_404_when_disabled(): void
    {
        Config::set('installer.enabled', false);

        $getRes = $this->get('/install');
        $getRes->assertStatus(404);

        $postRes = $this->post('/install', ['action' => 'migrate']);
        $postRes->assertStatus(404);
    }

    public function test_installer_route_renders_when_enabled(): void
    {
        Config::set('installer.enabled', true);

        $response = $this->get('/install');

        $response->assertStatus(200);
        $response->assertSee('System Installer');
        $response->assertSee('Database Connectivity');
        $response->assertSee('Migration Force');
        $response->assertSee('Fresh Migration Force');
        $response->assertSee('Seed Database (Force)');
    }

    public function test_installer_executes_migration_force(): void
    {
        Config::set('installer.enabled', true);

        $response = $this->post('/install', [
            'action' => 'migrate',
        ]);

        $response->assertRedirect(route('install.index'));
        $response->assertSessionHas('install_result');

        $result = session('install_result');
        $this->assertEquals('migrate', $result['action']);
        $this->assertTrue($result['success']);
        $this->assertNotEmpty($result['output']);
    }

    public function test_installer_rejects_invalid_action(): void
    {
        Config::set('installer.enabled', true);

        $response = $this->post('/install', [
            'action' => 'drop_everything_malicious',
        ]);

        $response->assertSessionHasErrors(['action']);
    }
}
