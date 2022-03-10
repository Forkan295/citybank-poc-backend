<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'account_type_id',
        'name',
        'balance',
    ];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * @return BelongsTo
     */
    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class, 'type_id');
    }

    public function getUser()
    {
        return $this->user()->first();
    }

    public function getAccountTypeName()
    {
        return $this->accountType->name;
    }

    public function transactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Transaction::class, 'account_id');
    }

    public function getTransactions(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->transactions()->get();
    }

    public function getBalance()
    {
        return $this->balance;
    }

    public function setBalance($balance)
    {
        $this->balance = $balance;
        $this->save();
        return $this;
    }

    public function totalTransactionAmount()
    {
        return $this->transactions()->sum('amount');
    }

}
