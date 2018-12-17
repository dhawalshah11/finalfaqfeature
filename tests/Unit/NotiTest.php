<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Notifications\answernoti;
use App\Notifications\Updatenoti;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class NotiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNewAnswer()
    {
        Notification::fake();
        $user = $user = factory(\App\User::class)->make();
        $user->save();
        $user->notify(new answernoti());
        Notification::assertSentTo(
            [$user], answernoti::class
        );
    }

    public function testUpdateAnswer()
    {
        Notification::fake();
        $user = $user = factory(\App\User::class)->make();
        $user->save();
        $user->notify(new Updatenoti());
        Notification::assertSentTo(
            [$user], Updatenoti::class
        );
    }

    public function testNewAnswerNotify()
    {
        Mail::fake();
        $user = $user = factory(\App\User::class)->make();
        $user->save();
        $user->notify(new answernoti());
        if (Mail::failures()) {
            self::assertTrue(false);
        } else {
            self::assertTrue(true);
        }
    }

    public function testUpdateAnswerNotify()
    {
        Mail::fake();
        $user = $user = factory(\App\User::class)->make();
        $user->save();
        $user->notify(new Updatenoti());
        if (Mail::failures()) {
            self::assertTrue(false);
        } else {
            self::assertTrue(true);
        }
    }
}