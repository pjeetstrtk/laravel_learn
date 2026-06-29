<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Task extends Model {
use HasFactory, SoftDeletes;
// Columns allowed for mass assignment (Task::create($data))
protected $fillable = [
'user_id', 'category_id', 'title', 'description',
'status', 'priority', 'due_date', 'is_archived',
];
// Cast columns to PHP types automatically
protected $casts = [
'due_date' => 'date',
'is_archived' => 'boolean',
];
// Relationships
public function user(): BelongsTo {
return $this->belongsTo(User::class);
}
public function comments(): HasMany {
return $this->hasMany(Comment::class);
}
public function tags(): BelongsToMany {
return $this->belongsToMany(Tag::class)->withTimestamps();
}
// Local scope — reusable query filter
public function scopeOpen($query) {
return $query->where('status', 'open');
}
// Usage: Task::open()->

}