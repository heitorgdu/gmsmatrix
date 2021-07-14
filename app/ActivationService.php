<?php

namespace App;

use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Exception;

class ActivationService
{

    protected $mailer;
    protected $activationRepo;
    protected $resendAfter = 24;

    /**
     * ActivationService constructor.
     */
    public function __construct()
    {
      
        $this->activationRepo = new ActivationRepository();
    }


    /**
     * @param $user
     * @return string|void
     */
    public function sendActivationMail($user)
    {

        if ($user->activated || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);
		
		$data['link'] = $link;
        $data['name'] = $user['name'];
        try{
            Mail::send('confirm', $data, function (Message $m) use ($user) {
                $m->to($user->email)->subject('Welcome to the GMS Matrix Portal '.$user['name']);
            });
            return "Your account is almost ready .<br /> Security requires confirmation so an email message has been sent to verify your address. Please check your spam folder if the message isn't in your inbox.";
        }catch(Exception $e){
            return 'Your account is almost ready. <br/> Mail could not be sent. Contact Admin!';
        }
    }

    /**
     * @param $token
     * @return null
     */
    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->activated = true;

        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;

    }

    /**
     * @param $user
     * @return bool
     */
    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}