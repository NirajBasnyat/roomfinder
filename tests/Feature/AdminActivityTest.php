<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Category;

class AdminActivityTest extends TestCase
{

    use RefreshDatabase;

    public function city()
    {
        $kathmandu = City::Create([
            'name' => 'Kathmandu',
            'latitude' => 27.700769,
            'longitude' => 85.300140,
        ]);

        return $kathmandu;
    }

    public function place()
    {
        $chabhil = Place::Create([
            'name' => 'Chabahil',
            'city_id' => $this->city()->id,
            'latitude' => 27.71678,
            'longitude' => 85.353674,
        ]);
        return $chabhil;
    }

    public function category()
    {
        $category = Category::create([
            'name' => 'Test Category'
        ]);
        return $category;
    }


    /** @test */
    public function admin_can_ban_users()
    {
        $this->withoutExceptionHandling();

        $admin = factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'admin' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $owner = factory(User::class)->create([
            'name' => 'Test Owner',
            'email' => 'test_owner@mail.com',
            'password' => bcrypt('password'),
            'role' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $response = $this->actingAs($admin)->get('admin/banOwner/' . $owner->id, [
            $owner->role = 3,
        ]);

        $response->assertRedirect('/');
    }

    /** @test */
    public function admin_can_unban_users()
    {

        $this->withoutExceptionHandling();

        $admin = factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'admin' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $owner = factory(User::class)->create([
            'name' => 'Test Owner',
            'email' => 'test_owner@mail.com',
            'password' => bcrypt('password'),
            'role' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $this->actingAs($admin)->get('/admin/banOwner/' . $owner->id, [
            $owner->role = 3,
        ]);

        $user = User::findOrFail($owner->id);
        $response = $this->actingAs($admin)->get('/admin/unbanOwner/' . $user->id, [
            $user->role = 1,
        ]);

        $response->assertStatus(302);
    }

    //room category can be created

    /** @test */
    public function admin_can_create_room_category()
    {
        $this->withoutExceptionHandling();

        $admin = factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'admin' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $this->actingAs($admin)->post('room_category', [
            'name' => 'Test Category',
        ]);

        $this->assertCount(1, Category::all());
    }

    /** @test */
    public function admin_cannot_access_other_roles_end_points()
    {
        $this->withoutExceptionHandling();

        $admin = factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'admin' => 1,
            'email_verified_at' => \Carbon\Carbon::now()
        ]);

        $response = $this->actingAs($admin)->get('owner/dashboard');

        $response->assertRedirect('/');

        $response = $this->actingAs($admin)->get('seeker/dashboard');

        $response->assertRedirect('/');

    }
}
