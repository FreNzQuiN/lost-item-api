<?php

namespace Tests\Feature;

use App\Models\LostItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LostItemApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_lost_items(): void
    {
        LostItem::create([
            'item_name' => 'Dompet Hitam',
            'description' => 'Berisi kartu identitas',
            'location_lost' => 'Gedung F',
            'date_lost' => '2026-03-09',
            'reporter_name' => 'Raka',
            'contact' => '081234567890',
            'status' => 'lost',
        ]);

        $response = $this->getJson('/api/lost-items');

        $response->assertOk()
            ->assertJsonCount(1)
            ->assertJsonFragment([
                'item_name' => 'Dompet Hitam',
                'location_lost' => 'Gedung F',
            ]);
    }

    public function test_can_create_lost_item(): void
    {
        $payload = [
            'item_name' => 'Kunci Motor',
            'description' => 'Gantungan warna merah',
            'location_lost' => 'Parkiran FILKOM',
            'date_lost' => '2026-03-08',
            'reporter_name' => 'Nadia',
            'contact' => '089876543210',
        ];

        $response = $this->postJson('/api/lost-items', $payload);

        $response->assertCreated()
            ->assertJsonPath('message', 'Lost item reported successfully')
            ->assertJsonPath('data.item_name', 'Kunci Motor')
            ->assertJsonPath('data.status', 'lost');

        $this->assertDatabaseHas('lost_items', [
            'item_name' => 'Kunci Motor',
            'reporter_name' => 'Nadia',
            'status' => 'lost',
        ]);
    }

    public function test_store_requires_mandatory_fields(): void
    {
        $response = $this->postJson('/api/lost-items', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'item_name',
                'location_lost',
                'date_lost',
                'reporter_name',
                'contact',
            ]);
    }

    public function test_can_show_lost_item_by_id(): void
    {
        $item = LostItem::create([
            'item_name' => 'Jaket Biru',
            'description' => 'Ukuran L',
            'location_lost' => 'Perpustakaan',
            'date_lost' => '2026-03-07',
            'reporter_name' => 'Alya',
            'contact' => '081111111111',
            'status' => 'lost',
        ]);

        $response = $this->getJson('/api/lost-items/' . $item->id);

        $response->assertOk()
            ->assertJsonFragment([
                'id' => $item->id,
                'item_name' => 'Jaket Biru',
            ]);
    }

    public function test_show_returns_404_when_lost_item_not_found(): void
    {
        $response = $this->getJson('/api/lost-items/99999');

        $response->assertNotFound();
    }

    public function test_can_update_lost_item(): void
    {
        $item = LostItem::create([
            'item_name' => 'Flashdisk',
            'description' => '32GB',
            'location_lost' => 'Lab Komputer',
            'date_lost' => '2026-03-06',
            'reporter_name' => 'Reno',
            'contact' => '082222222222',
            'status' => 'lost',
        ]);

        $response = $this->putJson('/api/lost-items/' . $item->id, [
            'status' => 'found',
            'location_lost' => 'Ditemukan di ruang admin',
        ]);

        $response->assertOk()
            ->assertJsonPath('message', 'Lost item updated successfully')
            ->assertJsonPath('data.status', 'found');

        $this->assertDatabaseHas('lost_items', [
            'id' => $item->id,
            'status' => 'found',
            'location_lost' => 'Ditemukan di ruang admin',
        ]);
    }

    public function test_update_returns_404_when_lost_item_not_found(): void
    {
        $response = $this->putJson('/api/lost-items/99999', [
            'status' => 'found',
        ]);

        $response->assertNotFound();
    }

    public function test_can_delete_lost_item(): void
    {
        $item = LostItem::create([
            'item_name' => 'Powerbank',
            'description' => null,
            'location_lost' => 'Kantin',
            'date_lost' => '2026-03-05',
            'reporter_name' => 'Fikri',
            'contact' => '083333333333',
            'status' => 'lost',
        ]);

        $response = $this->deleteJson('/api/lost-items/' . $item->id);

        $response->assertOk()
            ->assertJsonPath('message', 'Lost item deleted successfully');

        $this->assertDatabaseMissing('lost_items', [
            'id' => $item->id,
        ]);
    }

    public function test_delete_returns_404_when_lost_item_not_found(): void
    {
        $response = $this->deleteJson('/api/lost-items/99999');

        $response->assertNotFound();
    }
}
