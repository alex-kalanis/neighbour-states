<?php

namespace Tests\Unit;

use App\Lib\Lookup\Db;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

abstract class AbstractLocateDb extends TestCase
{
    use RefreshDatabase;

    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->refreshDatabase();
    }

    protected function getLib(): Db
    {
        return new Db();
    }
}
