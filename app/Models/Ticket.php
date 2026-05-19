<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['title', 'description', 'category_id', 'user_id', 'status', 'priority'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    // Statuso lietuviški pavadinimai
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'new'         => 'Naujas',
            'in_progress' => 'Vykdomas',
            'resolved'    => 'Išspręstas',
            'closed'      => 'Uždarytas',
            default       => $this->status,
        };
    }

    // Statuso spalva (Bootstrap klasė)
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'new'         => 'primary',
            'in_progress' => 'warning',
            'resolved'    => 'success',
            'closed'      => 'secondary',
            default       => 'secondary',
        };
    }
}