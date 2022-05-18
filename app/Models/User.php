<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google_id',
        'country'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function userCountry()
    {
        return $this->hasOne(Country::class, 'name', 'country');
    }

    public function getUserCountryHtml()
    {
        $html = '';
        if ($this->country != '' && $this->userCountry) {
            $country = $this->userCountry;
            $html =  '<option value="' . $country->name . '" data-icon="fi-' . strtolower($country->sortname) . '" >' . $country->name . '</option>';
        }

        return  $html;
    }

    public function  calculateDistane(
        $latitudeFrom,
        $longitudeFrom,
        $latitudeTo,
        $longitudeTo,
        $earthRadius = 6371000
    ) {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
            cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return round(($angle * $earthRadius) / 1000) . " Km";
    }

    public function defaultLoction()
    {
        $list = [
            'New Delhi' => [
                'lat' => 28.7041,
                'long' => 77.1025
            ],
            'Penang' => [
                'lat' => 5.285153,
                'long' => 100.456238
            ],
            'Kuala Lumpur' => [
                'lat' => 3.140853,
                'long' => 101.693207
            ],
        ];

        return $list;
    }
}
