<?php

namespace App\Observers;

use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        //
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user)
    {
        if ($user->isDirty('role') && $user->role === 'Agent') {
            if ($user->referred_by) {
                $referrer = User::find($user->referred_by);

                if ($referrer) {
                    $bonusAmount = env('REFERRAL_BONUS_AMOUNT', 1000.00);

                    $referrer->wallet->balance += $bonusAmount;
                    $referrer->wallet->save();
                }
            }
        }
    }

    protected function performOtherAction(User $referrer)
    {
        \Log::info('Referrer is not an agent, performing another action for user ID: ' . $referrer->id);
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        //
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        //
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        //
    }
}
