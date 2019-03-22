<?php

namespace App\Notifications\Company;

use App\Company;
use App\Info_box;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CreateCompanyNotification extends Notification
{
    use Queueable;
    /**
     * @var Company
     */
    private $company;
    /**
     * @var Info_box
     */
    private $info_box;

    /**
     * Create a new notification instance.
     *
     * @param Company $company
     * @param Info_box $info_box
     */
    public function __construct(Company $company, Info_box $info_box)
    {
        $this->company = $company;
        $this->info_box = $info_box;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $img = ($this->info_box->brand) ? $this->info_box->brand : null;
        if ($img)  {$return['img'] = $img;}
        $return['name'] = $this->info_box->name;
        $return['request'] = 'company/company.request';
        $return['action'] = 'company/company.action';
        $return['route'] = route('company.show',['company' => $this->company]);
        return $return;
    }
}
