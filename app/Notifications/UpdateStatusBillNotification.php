<?php

namespace App\Notifications;

use App\Models\Bill;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UpdateStatusBillNotification extends Notification implements ShouldQueue
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
        return ["mail", "database"];
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
            ->subject("Đơn hàng #" . $this->bill->code)
            ->greeting("Xin chào, " . ($this->is_shop ? $notifiable->name : $notifiable->fullname) . "!")
            ->line($this->getMessages()[1])
            ->action("Xem đơn hàng", env("FE_APP_URL") . ($this->is_shop ? "shop/don-hang/quan-ly" : "don-hang-cua-toi"))
            ->line("Cảm ơn bạn! Chúc bạn mua sắm vui vẻ tại M-Clothing");
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $messages = $this->getMessages();
        return [
            "title" => $messages[0],
            "message" => $messages[1],
        ];
    }

    private function getMessages(): array
    {
        $data = ["Đơn hàng #" . $this->bill->code];
        switch ($this->bill->status) {
            case 1:
                $data[] = $this->is_shop ? "Bạn đã xác nhận đơn hàng. Hãy chuẩn bị sớm để giao cho khách hàng nhé !"
                : "Đơn hàng đã được người bán xác nhận. Đơn hàng sẽ được người bán chuẩn bị và sớm giao tới bạn.";
                break;
            case 2:
                $data[] = $this->is_shop ? "Đơn hàng đang được giao cho khách hàng." : "Đơn hàng của bạn đang trên đường giao.";
                break;
            case 3:
                $data[] = $this->is_shop ? "Đơn hàng đã giao thành công." : "Giao hàng thành công.";
                break;
            case 4:
                $data[] = $this->is_shop ? "Đơn hàng được hoàn từ khách hàng." : "Hoàn hàng thành công.";
                break;
            case 5:
                $data[] = "Đơn hàng đã bị hủy";
                break;
            default:
                $data[] = "-";
        }
        return $data;
    }
}
