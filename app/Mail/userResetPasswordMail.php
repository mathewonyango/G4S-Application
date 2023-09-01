<?php


namespace App\Mail;


use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class userResetPasswordMail extends Mailable
{
    use Queueable,SerializesModels;

    /**
     * @var User
     */
    public $user;
    public $code;

    /**
     * Create a new message instance.
     *
     * @param User $user
     * @param $code
     */

    public function __construct(User $user, $code)
    {
        $this->user = $user;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $code = $this->code;
        $name = $this->user->last_name;
        $role = ucwords($this->user->role);

        return $this->subject(config('app.name'). '- Reset Password Link ')
            ->view('mail.users-resetpassword', compact('code', 'name'));
    }
}
