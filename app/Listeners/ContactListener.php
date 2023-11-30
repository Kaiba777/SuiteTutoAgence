<?php

namespace App\Listeners;

use Illuminate\Mail\Mailer;
use App\Mail\PropertyContactMail;
use App\Events\ContactRequestEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct(private Mailer $mailer)
    {
    }

    /**
     * Handle the event.
     */
    public function handle(ContactRequestEvent $event): void
    {
        // Permet de mettre un ralentissement
        // sleep(3);
        // Permet d'exécuter les actions des événements
        $this->mailer->send(new PropertyContactMail($event->property, $event->data));
    }
}
