<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Auditable as AuditableTrait;
class Task extends Model implements AuditableContract
{
    use AuditableTrait;
    use HasFactory;

    protected $fillable = [
        'title', 'status', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
