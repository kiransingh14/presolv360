<?php

namespace App\Console\Commands;

use App\Events\DispatchNotifications;
use App\Models\Notifications;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;

#[Signature('app:automate-send-notification')]
#[Description('Command description')]
class AutomateSendNotification extends Command
{
    public $signature = 'app:automate-send-notification';

    public $description = 'dispatch pending notification event if not processed';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $pendingNotification = Notifications::where('status', 'pending')->get();

        foreach ($pendingNotification as $notification) {
            DispatchNotifications::dispatch($notification->id);
        }

        $this->info("Processed {$pendingNotification->count()} pending notification(s).");

        return Command::SUCCESS;
    }
}
