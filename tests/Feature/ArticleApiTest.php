<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_articles_can_be_listed_and_retrieved_by_id_without_authentication()
    {
        $article = $this->createArticle();

        $this->getJson('/api/articles')
            ->assertOk()
            ->assertJsonPath('status', 'success')
            ->assertJsonPath('data.0.id', $article->id);

        $this->getJson('/api/articles/'.$article->id)
            ->assertOk()
            ->assertJsonPath('data.id', $article->id);
    }

    public function test_article_mutations_require_authentication_and_support_crud()
    {
        $this->postJson('/api/articles', [
            'title' => 'Unauthenticated article',
            'content' => 'Content',
            'category' => 'Technology',
        ])->assertUnauthorized();
        $this->putJson('/api/articles/1', ['title' => 'Unauthenticated update'])
            ->assertUnauthorized();
        $this->deleteJson('/api/articles/1')
            ->assertUnauthorized();

        $user = User::factory()->create();
        $this->actingAs($user, 'sanctum');

        $this->postJson('/api/articles', [
            'title' => 'API article',
            'content' => 'Created through the API',
            'category' => 'Technology',
        ])
            ->assertCreated()
            ->assertJsonPath('data.title', 'API article');

        $article = Article::where('title', 'API article')->firstOrFail();

        $this->putJson('/api/articles/'.$article->id, [
            'title' => 'Updated API article',
        ])
            ->assertOk()
            ->assertJsonPath('data.title', 'Updated API article');

        $this->deleteJson('/api/articles/'.$article->id)
            ->assertOk()
            ->assertJsonPath('status', 'success');

        $this->assertDatabaseMissing('articles', ['id' => $article->id]);
    }

    public function test_login_issues_a_token_and_logout_revokes_it()
    {
        $user = User::factory()->create([
            'email' => 'api-user@example.com',
            'password' => bcrypt('secret-password'),
        ]);

        $login = $this->postJson('/api/login', [
            'email' => 'api-user@example.com',
            'password' => 'secret-password',
        ])
            ->assertOk()
            ->assertJsonPath('status', 'success');

        $token = $login->json('token');
        $this->assertNotEmpty($token);

        $this->withToken($token)
            ->getJson('/api/user')
            ->assertOk()
            ->assertJsonPath('id', $user->id);

        $this->withToken($token)
            ->postJson('/api/logout')
            ->assertOk()
            ->assertJsonPath('status', 'success');

        $this->assertDatabaseCount('personal_access_tokens', 0);
        $this->app['auth']->forgetGuards();

        $this->withToken($token)
            ->getJson('/api/user')
            ->assertUnauthorized();
    }

    public function test_api_token_cannot_be_issued_from_a_web_session()
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->postJson('/session-token')
            ->assertNotFound();

        $this->assertDatabaseCount('personal_access_tokens', 0);
    }

    private function createArticle(): Article
    {
        return Article::create([
            'title' => 'Test article',
            'content' => 'A test article body.',
            'category' => 'Technology',
            'author' => 'Test author',
        ]);
    }
}
