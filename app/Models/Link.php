<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Auth;
use App\Models\ActivityLog; 

class Link extends Model
{
    protected $fillable = ['title', 'url', 'category_id', 'user_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        static::created(function ($link) {
           
            $userId = Auth::id() ?? 1;
            $userName = Auth::user() ? Auth::user()->name : 'Système';

            ActivityLog::create([
                'user_id'     => $userId,
                'action'      => 'création',
                'description' => $userName . " a ajouté le lien: " . $link->title
            ]);
        });

        static::updated(function ($link) {
            $userId = Auth::id() ?? 1;
            $userName = Auth::user() ? Auth::user()->name : 'Système';

            ActivityLog::create([
                'user_id'     => $userId,
                'action'      => 'modification',
                'description' => $userName . " a modifié le lien: " . $link->title
            ]);
        });
    }
}