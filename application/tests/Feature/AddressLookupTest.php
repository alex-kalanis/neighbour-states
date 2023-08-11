<?php

namespace Tests\Feature;

class AddressLookupTest extends AbstractControllerTest
{
    /**
     * Test routes - this one exists
     *
     * @return void
     */
    public function test_route_exists_0(): void
    {
        $response = $this->getJson('/routing/FRA/FRA');

        $response->assertStatus(200);

        $data = json_decode($response->getContent(), true);
        $this->assertEquals(['FRA'], $data);
    }

    /**
     * Test routes - this one exists
     *
     * @return void
     */
    public function test_route_exists_1(): void
    {
        $response = $this->getJson('/routing/CZE/ITA');

        $response->assertStatus(200);

        $data = json_decode($response->getContent(), true);
        $this->assertEquals(['CZE', 'AUT', 'ITA'], $data);
    }

    /**
     * Test routes - this one exists
     *
     * @return void
     */
    public function test_route_exists_2(): void
    {
        $response = $this->getJson('/routing/POL/ISR');

        $response->assertStatus(200);

        $data = json_decode($response->getContent(), true);
        $this->assertEquals(['POL', 'DEU', 'FRA', 'ESP', 'MAR', 'DZA', 'LBY', 'EGY', 'ISR'], $data);
        // ... -> Cetua -> ...
    }

    /**
     * Test routes - this one does not exist
     *
     * @return void
     */
    public function test_route_not_exists(): void
    {
        $response = $this->getJson('/routing/ARG/EGY');

        $response->assertStatus(400);

        $data = json_decode($response->getContent(), true);
        $this->assertEquals('path not found', $data['error']);
    }

    /**
     * Test routes - this one does not exist
     *
     * @return void
     */
    public function test_country_not_exists_1(): void
    {
        $response = $this->getJson('/routing/JOR/EGY');

        $response->assertStatus(419);

        $data = json_decode($response->getContent(), true);
        $this->assertEquals('Unknown country of origin', $data['error']);
    }

    /**
     * Test routes - this one does not exist
     *
     * @return void
     */
    public function test_country_not_exists_2(): void
    {
        $response = $this->getJson('/routing/EGY/JOR');

        $response->assertStatus(419);

        $data = json_decode($response->getContent(), true);
        $this->assertEquals('Unknown country of destination', $data['error']);
    }
}
