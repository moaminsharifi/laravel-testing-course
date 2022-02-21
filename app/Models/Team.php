<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [ 'name' , 'size'];

    public  function  add($user){
        if(is_iterable($user)){
            $usersCount = count($user);
            $this->gourdAgainstTooManyMembers($usersCount);
            $this->members()->saveMany($user);
        }else {
            $this->gourdAgainstTooManyMembers();
            $this->members()->save($user);
        }


    }

    public  function remove($user){
        if (is_iterable($user)){

            $result = $this->members()
                ->whereIn('id', $user->pluck('id'))->where(
                    ['team_id'=>$this->id]
                )
                ->update(['team_id'=>null]);
            if ($result == 0){
                throw new \Exception;
            }

        }else {
            $this->deteachUser($user);
        }
    }
    protected function deteachUser($user){
        if ($user->team_id === $this->id){
            $user->team_id = null;
            $user->save();
        }else{
            throw new \Exception;
        }
    }
    public function refreshMembers(){
        return $this->members()->update(['team_id'=>null]);
    }
    public function members(){
       return  $this->hasMany(User::class);
    }
    public function count(){
        return $this->members()->count();
    }
    protected function gourdAgainstTooManyMembers($howMuchMemberAdd = 1){
        if($this->count() +$howMuchMemberAdd >= $this->size + 1){
            throw new \Exception;
        }
    }
}

