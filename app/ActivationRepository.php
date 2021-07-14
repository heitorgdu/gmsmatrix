<?php
namespace App;


use Carbon\Carbon;
use Illuminate\Database\Connection;
use Illuminate\Support\Facades\DB;

class ActivationRepository
{

    protected $db;

    protected $table = 'user_activations';


    /**
     * @return string
     */
    protected function getToken()
    {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }

    /**
     * @param $user
     * @return string
     */
    public function createActivation($user)
    {

        $activation = $this->getActivation($user);

        if (!$activation) {
            return $this->createToken($user);
        }
        return $this->regenerateToken($user);

    }

    /**
     * @param $user
     * @return string
     */
    private function regenerateToken($user)
    {

        $token = $this->getToken();
        DB::table($table)->where('user_id', $user->id)->update([
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    /**
     * @param $user
     * @return string
     */
    private function createToken($user)
    {
        $token = $this->getToken();
        DB::table($this->table)->insert([
            'user_id' => $user->id,
            'token' => $token,
            'created_at' => new Carbon()
        ]);
        return $token;
    }

    /**
     * @param $user
     * @return mixed
     */
    public function getActivation($user)
    {
        return DB::table($this->table)->where('user_id', $user->id)->first();
    }


    /**
     * @param $token
     * @return mixed
     */
    public function getActivationByToken($token)
    {
        return DB::table($this->table)->where('token', $token)->first();
    }

    /**
     * @param $token
     */
    public function deleteActivation($token)
    {
        DB::table($this->table)->where('token', $token)->delete();
    }

}