<?php

namespace App\Notifications\Storage;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class UpdateProductNotification extends Notification
{
    use Queueable;

    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }


    public function via($notifiable)
    {
        return ['mail','database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->from('noreply@thegrounly.com')
            ->subject('Un produit a mis à jour')
            ->greeting("Bonjour")
            ->markdown('mail.product.create', ['url' => route('product.show',['product' => $this->product]),'product' => $this->product]);
    }


    public function toArray($notifiable)
    {
        $img = (isset($this->product->imgs[0])) ? $this->product->imgs[0]->img : null;

        if ($img)  {$return['img'] = $img;}

        $return['name'] = $this->product->name;

        $return['request'] = 'storage/product.request_update';

        $return['action'] = 'storage/product.action';

        $return['route'] = route('product.show',['product' => $this->product]);

        return $return;
    }
}
