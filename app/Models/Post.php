<?php

namespace App\Models;

use App\Accessors\DefaultAccessors;
use App\Events\PostCreated;
use App\Scopes\YearScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, DefaultAccessors;

    // protected $fillable = ['user_id', 'title', 'body', 'date']; // Remove user_id because PostObserve
    protected $fillable = ['title', 'body', 'date'];

    protected $casts = [
        // 'date' => 'date',
        'date' => 'datetime:d/m/Y',
        'active' => 'boolean'
    ];

    protected $dispatchesEvents = [
        //'created' => PostCreated::class,
    ];

    protected static function booted()
    {
        // static::addGlobalScope('year', function (Builder $builder) {
        //     $builder->whereYear('date', Carbon::now()->year);
        // });
        static::addGlobalScope(new YearScope);
    }

    public function scopeLastWeek($query)
    {
        return $this->whereDate('date', '>=', now()->subDays(2))
            ->whereDate('date', '<=', now()->subDays(1));

    }

    public function scopeToday($query)
    {
        return $this->whereDate('date', now());

    }

    public function scopeBetweenDays($query, $firstDate, $lastDate)
    {
        $firstDate = Carbon::make($firstDate)->format('Y-m-d');
        $lastDate = Carbon::make($lastDate)->format('Y-m-d');

        return $this->whereDate('date', '>=', $firstDate)
            ->whereDate('date', '<=', $lastDate);

    }

    // public function getTitleAttribute($value)
    // {
    //     return strtoupper($value);
    // }

    // public function getTitleAndBodyAttribute()
    // {
    //     return $this->title . ' - ' . $this->body;
    // }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = Carbon::make($value)->format('Y-m-d');
    }

    // public function getDateAttribute($value)
    // {
    //     return Carbon::make($value)->format('d/m/Y');
    // }
}
