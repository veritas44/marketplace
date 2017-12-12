<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class FileRejected extends Notification
{
	use Queueable;

	protected $user;
	protected $file;


	/**
	 * FileApproved constructor.
	 *
	 * @param $user
	 * @param $file
	 */
	public function __construct($user, $file)
	{
		$this->user = $user;
		$this->file = $file;
	}

	/**
	 * Get the notification's delivery channels.
	 *
	 * @param  mixed  $notifiable
	 * @return array
	 */
	public function via($notifiable)
	{
		return ['mail'];
	}

	/**
	 * Get the mail representation of the notification.
	 *
	 * @param  mixed  $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail($notifiable)
	{

		$image = '/images/icons/rejected.svg';
		$imageAlt = 'Your file has been rejected';

		return (new MailMessage)
			->markdown('vendor.notifications.email', ['image' => $image, 'imageAlt' => $imageAlt])
			->line('File name: ' . $this->file->title)
			->line('Your file has been rejected');
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
