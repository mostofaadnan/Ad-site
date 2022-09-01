<?php

namespace App\Notifications;

use App\Models\AdPost;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostNotification extends Notification
{
    use Queueable;
    public $adPost;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(AdPost $adPost)
    {
        $this->adPost = $adPost;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        /* return ['database', 'mail','nexmo']; */
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable)
    {
        if ($this->adPost->city_id == 0) {
            $location = 'All City' . $this->adPost->StateName->name . ',' . $this->adPost->CountryName->name;
        } else {
            $location = $this->adPost->CityName->name . ',' . $this->adPost->StateName->name . ',' . $this->adPost->CountryName->name;
        }
        return [
            'type' => 'New Post',
            'message' => $this->adPost->UserName->name . ' You make an Post.',
            'id' => $this->adPost->id,
            'date' => $this->adPost->date,
            'Location' => $location,
            'Category' => $this->adPost->CategoryName->title,
            'Subcategory' => $this->adPost->SubCategoryname->title,
        ];
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
}
