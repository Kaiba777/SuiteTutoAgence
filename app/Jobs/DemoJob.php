<?php

namespace App\Jobs;

use App\Models\Property;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;

class DemoJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // Permet de supprimer la tâche si le model est supprimé
    public $deleteWhereMissingModels = true;

    /**
     * Create a new job instance.
     */
    public function __construct(private Property $property)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $property = $this->property->refresh();
        // Récuperé le titre du bien en question
        echo $this->property->title;
    }
}
