<?php

namespace App\Notifications;

use App\Models\Bill;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CreateBillNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $bill;
    private $is_shop;

    public function __construct(Bill $bill, $is_shop = false)
    {
        $this->bill = $bill;
        $this->is_shop = $is_shop;
    }

    /**
     * Get the notification"s delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ["database", "mail"];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = env("FE_URL") . ($this->is_shop ? "shop/don-hang/quan-ly" : "don-hang-cua-toi");
        $mail_message = new MailMessage();
        $mail_message
            ->subject("Đơn hàng #" . $this->bill->code)
            ->greeting("Xin chào, " . ($this->is_shop ? $notifiable->name : $notifiable->fullname) . "!")
            ->line($this->is_shop ? "Bạn có đơn hàng mới #" . $this->bill->code : "Bạn vừa tạo đơn hàng #" . $this->bill->code)
            ->line("Ghi chú: " . $this->bill->note)
            ->action("Xem đơn hàng", $url)
            ->line("Cảm ơn bạn! Chúc bạn mua sắm vui vẻ tại M-Clothing");
        return $mail_message;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $this->is_shop = $notifiable->user_id != null;
        return [
            "title" => $this->is_shop ? "Đơn hàng mới" : "Tạo đơn hàng",
            "message" => $this->is_shop ?
            "Bạn có đơn hàng mới, mã đơn hàng #" . $this->bill->code . "."
            : "Bạn đã tạo thành công đơn hàng #" . $this->bill->code . ".",
            "code" => $this->bill->code,
            "type" => $this->is_shop ? "shop" : "user",
        ];
    }
}
