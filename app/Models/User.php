<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function getImageAttribute()
    {
        return $this->profile_photo_path;
    }

    public function user(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|unique:users'
        ]);
        if($validator->fails()){
            return new JsonResponse(
                [
                    'success' => false, 
                    'message' => $validator->errors()
                ], 422
            );
        }
        $email = $request->all()['email'];
        $user = User::create([
            'email' => $email
        ]);
        if($user){
            Mail::to($email)->send(new User($email));
            return new JsonResponse(
                [
                    'success' => true,
                    'message' => "Obrigado por se inscrever em nosso e-mail, verifique sua caixa de entrada"
                ], 200
            );
        }
    }
}
