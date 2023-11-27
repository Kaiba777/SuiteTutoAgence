<?php

namespace App\Listeners;

use Illuminate\Mail\Mailer;
use App\Mail\PropertyContactMail;
use Illuminate\Events\Dispatcher;
use App\Events\ContactRequestEvent;
use App\Listeners\ContactEventSubscriber;

class ContactEventSubscriber
{
    public function __construct(private Mailer $mailer)
    {

    }
    public function sendEmailForContact(ContactRequestEvent $event)
    {
        $this->mailer->send(new PropertyContactMail($event->property, $event->data));
    }
    public function subscribe(Dispatcher $dispatcher): array
    {
       return [
        ContactRequestEvent::class => 'sendEmailForContact'
       ];
    }
}