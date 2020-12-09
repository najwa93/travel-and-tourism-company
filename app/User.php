<?php

namespace App;

use App\Models\Admin\Country\Country;
use App\Models\User\FlightReservation\FlightReservation;
use App\Models\User\HotelReservation\HotelReservation;
use App\Models\User\Messages\Message;
use App\Models\User\OfferReservation\OfferReservation;
use App\Models\User\Role;
use App\Models\User\Subscribe\Subscribe;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name','user_name','last_name','phone_number','country_id','gender'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   /* public function isAdmin()
    {
        if($this->role_id === 5)
        {
            return true;
        }
        else
        {
            return false;
        }
    }*/

   public function hasRole($role){
       $user_role = Role::where('name',$role)->first();
       //dd($user_role);
       if ($this->role()->where('name', $role)->first()){
           return true;
       }else{
           return false;
       }
   }

   /*public function assignRole($role){
       return $this->role()->save($role);
   }*/

    public function role(){
        return $this->belongsTo(Role::class,'role_id');
    }

    public function country(){
        return $this->belongsTo(Country::class,'country_id');
    }

    //hotel Reservation
    public function hotel_reservation(){
        return $this->hasMany(HotelReservation::class);
    }

    //flight Reservation
    public function flight_reservation(){
        return $this->hasMany(FlightReservation::class);
    }

    //offer Reservation
    public function offer_reservation(){
        return $this->hasOne(OfferReservation::class);
    }

    public function message(){
        return $this->hasMany(Message::class);
    }

    public function subscribe(){
        return $this->hasOne(Subscribe::class);
    }

}
