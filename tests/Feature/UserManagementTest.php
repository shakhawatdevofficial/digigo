<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('guest cannot access user management', function () {
    $response = $this->get(route('admin.users.index'));
    $response->assertRedirect(route('login'));
});

test('regular user cannot access user management', function () {
    $user = User::factory()->create(['role' => 'user', 'status' => true]);

    $response = $this->actingAs($user)->get(route('admin.users.index'));
    $response->assertRedirect();
    $response->assertSessionHas('error');
});

test('admin can view user list and stats', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    User::factory()->count(3)->create(['role' => 'user', 'status' => true]);
    User::factory()->count(2)->create(['role' => 'user', 'status' => false]);

    $response = $this->actingAs($admin)->get(route('admin.users.index'));

    $response->assertStatus(200);
    $response->assertSee('User Management', false);
    $response->assertSee($admin->name, false);
});

test('admin can search and filter users', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $user1 = User::factory()->create(['name' => 'Tanvir Ahmed', 'email' => 'tanvir@gmail.com', 'role' => 'user']);
    $user2 = User::factory()->create(['name' => 'Rahim Chowdhury', 'email' => 'rahim@gmail.com', 'role' => 'user']);

    $response = $this->actingAs($admin)->get(route('admin.users.index', ['search' => 'Tanvir']));
    $response->assertStatus(200);
    $response->assertSee('Tanvir Ahmed', false);
    $response->assertDontSee('Rahim Chowdhury', false);
});

test('admin can create a new user account with photo', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $photo = UploadedFile::fake()->image('avatar.jpg', 150, 150);

    $response = $this->actingAs($admin)->post(route('admin.users.store'), [
        'name' => 'Naimur Rahman',
        'email' => 'naimur@example.com',
        'phone' => '01812345678',
        'role' => 'user',
        'password' => 'secret123',
        'status' => '1',
        'photo' => $photo,
    ]);

    $response->assertRedirect(route('admin.users.index'));
    $response->assertSessionHas('success');

    $createdUser = User::where('email', 'naimur@example.com')->first();
    expect($createdUser)->not->toBeNull();
    expect($createdUser->name)->toBe('Naimur Rahman');
    expect($createdUser->phone)->toBe('01812345678');
    expect($createdUser->role)->toBe('user');
    expect($createdUser->status)->toBeTrue();
    expect(Hash::check('secret123', $createdUser->password))->toBeTrue();
    expect($createdUser->photo)->not->toBeNull();

    // Clean up uploaded test photo
    $photoPath = public_path($createdUser->photo);
    if (File::exists($photoPath)) {
        File::delete($photoPath);
    }
});

test('admin can view edit user page', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $targetUser = User::factory()->create(['name' => 'Karim Mia', 'role' => 'user']);

    $response = $this->actingAs($admin)->get(route('admin.users.edit', $targetUser->id));

    $response->assertStatus(200);
    $response->assertSee('Edit User Account: Karim Mia', false);
    $response->assertSee($targetUser->email, false);
});

test('admin can update user details and change password', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $targetUser = User::factory()->create([
        'name' => 'Old Name',
        'email' => 'old@example.com',
        'role' => 'user',
        'status' => true,
    ]);

    $response = $this->actingAs($admin)->put(route('admin.users.update', $targetUser->id), [
        'name' => 'Updated Name',
        'email' => 'updated@example.com',
        'phone' => '01999999999',
        'role' => 'admin',
        'password' => 'newpassword123',
    ]);

    $response->assertRedirect(route('admin.users.index'));
    $response->assertSessionHas('success');

    $targetUser->refresh();
    expect($targetUser->name)->toBe('Updated Name');
    expect($targetUser->email)->toBe('updated@example.com');
    expect($targetUser->phone)->toBe('01999999999');
    expect($targetUser->role)->toBe('admin');
    expect($targetUser->status)->toBeFalse(); // Unchecked in request means inactive
    expect(Hash::check('newpassword123', $targetUser->password))->toBeTrue();
});

test('admin can toggle user status', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);
    $targetUser = User::factory()->create(['status' => true]);

    $response = $this->actingAs($admin)->post(route('admin.users.toggle-status', $targetUser->id));

    $response->assertRedirect(route('admin.users.index'));
    $response->assertSessionHas('success');

    $targetUser->refresh();
    expect($targetUser->status)->toBeFalse();
});

test('admin cannot delete or deactivate own account', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    // Attempt delete self
    $deleteResponse = $this->actingAs($admin)->delete(route('admin.users.destroy', $admin->id));
    $deleteResponse->assertRedirect(route('admin.users.index'));
    $deleteResponse->assertSessionHas('error');
    expect(User::find($admin->id))->not->toBeNull();

    // Attempt toggle status self
    $toggleResponse = $this->actingAs($admin)->post(route('admin.users.toggle-status', $admin->id));
    $toggleResponse->assertRedirect(route('admin.users.index'));
    $toggleResponse->assertSessionHas('error');
    $admin->refresh();
    expect($admin->status)->toBeTrue();
});

test('admin can delete another user and photo is deleted', function () {
    $admin = User::factory()->create(['role' => 'admin', 'status' => true]);

    // Create fake photo in uploads/users
    $testDir = public_path('uploads/users');
    if (! File::exists($testDir)) {
        File::makeDirectory($testDir, 0755, true);
    }
    $fakePhotoRel = 'uploads/users/delete_test.jpg';
    File::put(public_path($fakePhotoRel), 'fake photo content');

    $targetUser = User::factory()->create([
        'photo' => $fakePhotoRel,
    ]);

    $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $targetUser->id));

    $response->assertRedirect(route('admin.users.index'));
    $response->assertSessionHas('success');

    expect(User::find($targetUser->id))->toBeNull();
    expect(File::exists(public_path($fakePhotoRel)))->toBeFalse();
});
