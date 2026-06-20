<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\ContactMessage;
use App\Models\Profile;
use App\Models\Project;
use App\Models\ProjectCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class PortfolioFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_can_be_opened(): void
    {
        Profile::create([
            'name' => 'Wisnu Nugroho',
            'title' => 'Designer',
            'tagline' => 'Creative portfolio',
            'short_bio' => 'Short bio',
            'long_bio' => 'Long bio',
            'email' => 'wisnu@example.com',
        ]);

        $this->get(route('home'))->assertOk()->assertSee('Wisnu');
    }

    public function test_projects_page_only_shows_published_projects(): void
    {
        $category = ProjectCategory::create(['name' => 'UI UX', 'slug' => 'ui-ux']);

        Project::create([
            'category_id' => $category->id,
            'title' => 'Published Project',
            'slug' => 'published-project',
            'description' => 'Published description',
            'tools' => 'Figma',
            'year' => '2026',
            'is_published' => true,
        ]);

        Project::create([
            'category_id' => $category->id,
            'title' => 'Draft Project',
            'slug' => 'draft-project',
            'description' => 'Draft description',
            'tools' => 'Figma',
            'year' => '2026',
            'is_published' => false,
        ]);

        $this->get(route('projects.index'))
            ->assertOk()
            ->assertSee('Published Project')
            ->assertDontSee('Draft Project');
    }

    public function test_contact_form_stores_message(): void
    {
        $this->post(route('contact.send'), [
            'name' => 'Client',
            'email' => 'client@example.com',
            'subject' => 'Project baru',
            'category' => 'Freelance',
            'message' => 'Saya ingin berdiskusi tentang project desain baru.',
        ])->assertSessionHas('success');

        $this->assertDatabaseHas(ContactMessage::class, [
            'email' => 'client@example.com',
            'category' => 'Freelance',
        ]);
    }

    public function test_public_comment_is_stored_pending_approval(): void
    {
        $this->post(route('comments.store'), [
            'name' => 'Visitor',
            'email' => 'visitor@example.com',
            'body' => 'Portfolio-nya keren.',
        ])->assertRedirect(route('home').'#comments')
            ->assertSessionHas('comment_success');

        $this->assertDatabaseHas(Comment::class, [
            'email' => 'visitor@example.com',
            'is_approved' => false,
        ]);
    }

    public function test_get_comments_redirects_to_home_comments_section(): void
    {
        $this->get('/comments')->assertRedirect(route('home').'#comments');
    }

    public function test_admin_dashboard_requires_authentication(): void
    {
        $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
    }

    public function test_admin_dashboard_rejects_non_admin_user(): void
    {
        $user = User::factory()->create(['is_admin' => false]);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_admin_dashboard_allows_admin_user(): void
    {
        $user = User::factory()->create(['is_admin' => true]);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertOk();
    }

    public function test_unused_admin_show_routes_are_not_registered(): void
    {
        $this->assertFalse(Route::has('admin.projects.show'));
        $this->assertFalse(Route::has('admin.skills.show'));
        $this->assertFalse(Route::has('admin.experiences.show'));
    }

    public function test_admin_can_archive_contact_message(): void
    {
        $user = User::factory()->create(['is_admin' => true]);
        $message = ContactMessage::create([
            'name' => 'Client',
            'email' => 'client@example.com',
            'subject' => 'Project baru',
            'category' => 'Freelance',
            'message' => 'Saya ingin berdiskusi tentang project desain baru.',
        ]);

        $this->actingAs($user)
            ->put(route('admin.messages.archive', $message))
            ->assertSessionHas('success');

        $this->assertTrue($message->fresh()->is_archived);
    }
}
