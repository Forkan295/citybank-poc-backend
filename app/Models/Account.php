<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'account_id');
    }

    /**
     * @return mixed
     */
    public function getAccountTypeNameAttribute()
    {
        return $this->accountType->name;
    }

    /**
     * @param $balance
     * @return $this
     */
    public function setBalance($balance): Account
    {
        $this->balance = $balance;
        $this->save();
        return $this;
    }

    /**
     * @return int|mixed
     */
    public function getTotalTransactionAmountAttribute()
    {
        return $this->transactions()->sum('amount');
    }

    public function scopeIsPrimaryAccount($query)
    {
        $query->where('is_primary_account', 1);
    }
}
