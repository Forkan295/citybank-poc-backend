<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use DarkGhostHunter\Larapass\Contracts\WebAuthnAuthenticatable;
use DarkGhostHunter\Larapass\WebAuthnAuthentication;


class User extends Authenticatable implements WebAuthnAuthenticatable
{
    use HasApiTokens, HasFactory, Notifiable, WebAuthnAuthentication;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();;
//            if (empty($model->{$model->getKeyName()})) {
//                $model->{$model->getKeyName()} = Str::uuid()->toString();
//            }
        });
    }

    /**
     * @return HasMany
     */
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class, 'user_id');
    }

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class, 'user_id');
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function getAccount($id)
    {
        return $this->accounts()->find($id);
    }

    public function getAccountByType($type)
    {
        return $this->accounts()->where('type', $type)->first();
    }

    /**
     * @return Collection
     */
    public function getTransactions(): Collection
    {
        return $this->transactions()->get();
    }

    /**
     * @param $accountId
     * @return Collection
     */
    public function getTransactionsByAccount($accountId): Collection
    {
        return $this->transactions()->where('account_id', $accountId)->get();
    }

    /**
     * @return int|mixed
     */
    public function getTotalTransactionAmountAttribute()
    {
        return $this->transactions()->sum('amount');
    }
}
