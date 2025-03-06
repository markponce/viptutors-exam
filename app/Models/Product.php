<?php

namespace App\Models;

use App\Models\Scopes\DeletedScope;
use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([DeletedScope::class])]
#[ObservedBy([ProductObserver::class])]
class Product extends Model
{
    protected $fillable = [
        'title', 
        'body',
        'del_flag',
        // 'user_id'
    ];
    // use SoftDeletes;
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
