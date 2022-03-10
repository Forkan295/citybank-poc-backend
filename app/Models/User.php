<?php

namespace App\Models;

use App\Models\Account;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
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

    public function accounts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Account::class, 'user_id');
    }

    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class, 'user_id');
    }

    public function getAccounts(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->accounts()->get();
    }

    public function getAccount($id)
    {
        return $this->accounts()->find($id);
    }

    public function getAccountByName($name)
    {
        return $this->accounts()->where('name', $name)->first();
    }

    public function getAccountByType($type)
    {
        return $this->accounts()->where('type', $type)->first();
    }

    public function getTransactions(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->transactions()->get();
    }

    public function getTransactionsByAccount($accountId): \Illuminate\Database\Eloquent\Collection
    {
        return $this->transactions()->where('account_id', $accountId)->get();
    }

    public function totalTransactionAmount()
    {
        return $this->transactions()->sum('amount');
    }
}
