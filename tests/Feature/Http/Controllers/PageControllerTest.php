<?php
namespace Tests\Feature\Http\Controllers;

use App\Http\Controllers\CartController;
use AvoRed\Framework\Models\Database\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageControllerTest extends \Tests\TestCase
{
    use RefreshDatabase;


    /** @test */
    public function testCheckoutViewRoute()
    {
        $page = factory(Page::class)->create();
        $response = $this->get(route('page.show', $page->slug));
        $response->assertStatus(200);
        $response->assertSee($page->content);
    }
}
