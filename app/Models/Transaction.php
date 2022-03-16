<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'invoice_id',
        'user_id',
        'account_id',
        'type_id',
        'beneficiary_id',
        'previous_amount',
        'transfer_amount',
        'remarks',
        'transaction_date',
        'status',
    ];

    protected $dates = [
        'transaction_date'
    ];


    /**
     * @return BelongsTo
     */
    public function account(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function beneficiary(): BelongsTo
    {
        return $this->belongsTo(Beneficiary::class, 'beneficiary_id');
    }

    public function transactionType(): BelongsTo
    {
        return $this->belongsTo(TransactionType::class, 'type_id');
    }

    /**
     * @return HasOne
     */
    public function recharge(): HasOne
    {
        return $this->hasOne(Recharge::class, 'transaction_id');
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->invoice_id = Str::random('12');
        });
    }


}
