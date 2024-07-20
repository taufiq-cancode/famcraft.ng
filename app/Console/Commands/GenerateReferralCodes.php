<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class GenerateReferralCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:referral-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate referral codes for existing users without a referral code';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::whereNull('referral_code')->get();

        foreach ($users as $user) {
            $user->referral_code = Str::random(10);
            $user->save();
            $this->info('Generated referral code for user: ' . $user->email);
        }

        $this->info('Referral codes generated for all users.');
    }
}
