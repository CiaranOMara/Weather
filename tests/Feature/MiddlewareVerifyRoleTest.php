<?php

namespace Tests\Feature;

use App\Exceptions\RoleDeniedException;
use App\Http\Middleware\VerifyRole;
use App\User;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MiddlewareVerifyRoleTest extends TestCase
{
    public function testUserHasPermission()
    {
        $guard = \Mockery::mock(Guard::class);
        $user = \Mockery::mock(User::class);
        $request = new Request();
        $guard->shouldReceive('check')->once()->withNoArgs()->andReturn(true);
        $guard->shouldReceive('user')->once()->withNoArgs()->andReturn($user);
        $user->shouldReceive('hasRole')->once()->with('role1')->andReturn(true);
        $verifyRole = new VerifyRole($guard);
        $result = $verifyRole->handle($request, function (Request $request) {
            return 'next was called';
        }, 'role1');
        $this->assertEquals('next was called', $result);
    }

    public function testUserHasPermission_throwsException()
    {
        $guard = \Mockery::mock(Guard::class);
        $user = \Mockery::mock(User::class);
        $request = new Request();
        $guard->shouldReceive('check')->once()->withNoArgs()->andReturn(true);
        $guard->shouldReceive('user')->once()->withNoArgs()->andReturn($user);
        $user->shouldReceive('hasRole')->once()->with('role1')->andReturn(false);
        $this->expectException(RoleDeniedException::class);
        $verifyRole = new VerifyRole($guard);
        $verifyRole->handle($request, function (Request $request) {
        }, 'role1');
    }
}
