<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        'account_no',
        'type_id',
        'date_opened',
        'balance',
        'is_primary',
        'status',
    ];

    protected $casts = [
        'is_primary' => 'boolean'
    ];

    Const PRIMARY_TYPE_ID = 2;

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
     * @param $query
     */
    public function scopeIsPrimaryAccount($query)
    {
        $query->where('is_primary', 1);
    }

    public function generateUniqueAccountNumber()
    {
        $accountNumber = random_int(100000000, 9999999999);

        if (Account::where('account_no', $accountNumber)->exists()) {
            return $this->generateUniqueAccountNumber();
        }

        return $accountNumber;
    }
}
