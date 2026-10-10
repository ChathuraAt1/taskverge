<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSiteMetadataTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_pages_have_canonical_urls_and_internal_pages_are_noindex(): void
    {
        config(['app.url' => 'https://www.taskverge.example']);

        foreach ([
            '/' => 'https://www.taskverge.example/',
            '/product' => 'https://www.taskverge.example/product',
            '/privacy' => 'https://www.taskverge.example/privacy',
            '/terms' => 'https://www.taskverge.example/terms',
        ] as $path => $canonical) {
            $this->get($path)
                ->assertOk()
                ->assertSee('<link rel="canonical" href="'.$canonical.'">', false)
                ->assertDontSee('<meta name="robots" content="noindex,follow">', false);
        }

        $this->get('/register')
            ->assertOk()
            ->assertSee('<meta name="robots" content="noindex,follow">', false)
            ->assertDontSee('rel="canonical"', false);

        $this->get('/checkout')
            ->assertOk()
            ->assertSee('<meta name="robots" content="noindex,follow">', false)
            ->assertDontSee('rel="canonical"', false);

        $this->actingAs(User::factory()->create())
            ->get('/app')
            ->assertOk()
            ->assertSee('<meta name="robots" content="noindex,follow">', false)
            ->assertDontSee('rel="canonical"', false);
    }

    public function test_sitemap_and_robots_use_the_configured_canonical_origin(): void
    {
        config(['app.url' => 'https://www.taskverge.example/']);

        $this->get('/sitemap.xml')
            ->assertOk()
            ->assertHeader('Content-Type', 'application/xml; charset=UTF-8')
            ->assertSee('<loc>https://www.taskverge.example/</loc>', false)
            ->assertSee('<loc>https://www.taskverge.example/product</loc>', false)
            ->assertSee('<loc>https://www.taskverge.example/privacy</loc>', false)
            ->assertSee('<loc>https://www.taskverge.example/terms</loc>', false)
            ->assertDontSee('/login', false)
            ->assertDontSee('/checkout', false)
            ->assertDontSee('/app', false);

        $this->get('/robots.txt')
            ->assertOk()
            ->assertHeader('Content-Type', 'text/plain; charset=UTF-8')
            ->assertSee('Sitemap: https://www.taskverge.example/sitemap.xml');
    }

    public function test_public_header_renders_responsive_navigation_and_chatbot_yields_to_footer(): void
    {
        $this->get('/')
            ->assertOk()
            ->assertSee('aria-controls="mobile-site-navigation"', false)
            ->assertSee('Capabilities')
            ->assertSee('Contact')
            ->assertSee('id="site-footer"', false)
            ->assertSee('IntersectionObserver', false)
            ->assertSee('x-show="!footerVisible"', false);
    }
}
