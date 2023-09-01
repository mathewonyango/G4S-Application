<?php


namespace App\Mail;


use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class userSignUpMail extends Mailable
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
        $name = $this->user->lastname;
        // dd($this->user);
        $user_email = $this->user->username;
        $role = ucwords($this->user->role);

        return $this->subject(config('app.name'). '- Account activation link '."($role) Role")
            ->view('mail.user-signup', compact('code', 'name', 'user_email'));
    }
}
