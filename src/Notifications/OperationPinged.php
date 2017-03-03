<?php

namespace Seat\Kassie\Calendar\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\SlackMessage;

use Seat\Kassie\Calendar\Helpers\Helper;

class OperationPinged extends Notification
{
	use Queueable;

	public function via($notifiable)
	{
		return ['slack'];
	}

	public function toSlack($notifiable)
	{
		$content = trans('calendar::seat.notification_ping_operation') . '<' . url('/calendar/operation') . '@example.com|*' . $notifiable->title . '*> - ' . trans('calendar::seat.starts_in') . ' ' . $notifiable->starts_in;

		return (new SlackMessage)
			->success()
			->from('SeAT Calendar', ':calendar:')
			->content($content);
	}
}
