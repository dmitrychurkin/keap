<?php

declare(strict_types=1);

namespace DmitryChurkin\Keap\Tests\Feature;

use DmitryChurkin\Keap\KeapServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase;
use Workbench\App\Models\InfusionsoftAccount;

class InfusionsoftAccountTest extends TestCase
{
    use RefreshDatabase;

    protected function getPackageProviders($app): array
    {
        return [
            KeapServiceProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    protected function setUp(): void
    {
        parent::setUp();

        // If your workbench migrations exist, load them:
        // $migrationsPath = realpath(__DIR__ . '/../../../workbench/database/migrations');
        // if ($migrationsPath && is_dir($migrationsPath)) {
        //     $this->loadMigrationsFrom($migrationsPath);
        // }

        // Fallback: create the table if migrations aren't present
        if (! Schema::hasTable('infusionsoft_accounts')) {
            Schema::create('infusionsoft_accounts', function (Blueprint $table) {
                $table->id();
                $table->string('label');
                $table->text('connection');
                $table->timestamps();
            });
        }
    }

    public function test_factory_creates_infusionsoft_account(): void
    {
        $account = InfusionsoftAccount::factory()->create();

        $this->assertDatabaseHas('infusionsoft_accounts', [
            'id' => $account->id,
            'label' => $account->label,
            'connection' => $account->connection,
        ]);
    }
}
