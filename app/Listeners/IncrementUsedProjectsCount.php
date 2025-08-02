<?php

namespace App\Listeners;

use App\Events\ProjectCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class IncrementUsedProjectsCount
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProjectCreated $event): void
    {
        $project = $event->project;
        $company = $project->company;

        if (!$company) return;

        $subscription = $company->activeSubscription;

        if ($subscription) {
            $subscription->increment('used_projects');

            // تحقق إذا وصل للحد الأقصى
            if ($subscription->used_projects >= $subscription->subscriptionPlan->project_limit) {
                $subscription->update(['status' => 'expired']);
            }
        }

    }
}
