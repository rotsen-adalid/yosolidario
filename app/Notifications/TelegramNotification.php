<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Telegram\TelegramChannel;
use NotificationChannels\Telegram\TelegramLocation;
use NotificationChannels\Telegram\TelegramMessage;

class TelegramNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [TelegramChannel::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toTelegram($notifiable)
    {
        if($notifiable->action == 'USER_REGISTER') {
            return $this->userRegister($notifiable);
        } else if($notifiable->action == 'USER_GEOLOCATION') {
            return $this->userGeolocation($notifiable);
        }
        else if($notifiable->action == 'CAMPAIGN_IN_REVIEW') {
            return $this->campaignInReview($notifiable);
        }
    }
    
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }

    // test agency
    public function userRegister($notifiable)
    {
        return TelegramMessage::create()
            ->to($notifiable->telegramid)
            ->content("*".$notifiable->notice."*\n".$notifiable->description);
    } 

    // test agency
    public function userName($notifiable)
    {
        return TelegramMessage::create()
            ->to($notifiable->telegramid)
            ->content("*".$notifiable->notice."*\n".$notifiable->description);
    }

    // campaign in review
    public function userGeolocation($notifiable)
    {
        return TelegramLocation::create()
            ->to($notifiable->telegramid)
            ->latitude($notifiable->latitude)
            ->longitude($notifiable->longitude);
            //->latitude('-16.546706')
            //->longitude('-68.222242');
    } 

    // campaign in review
    public function campaignInReview($notifiable)
    {
        return TelegramMessage::create()
            ->to($notifiable->telegramid)
            ->content("*".$notifiable->notice."*\n".$notifiable->description)
            ->button('Campaña', $notifiable->linkOne)
            ->button('Usuario', $notifiable->linkTwo);
    } 
}
