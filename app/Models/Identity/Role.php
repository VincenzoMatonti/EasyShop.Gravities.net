<?php

namespace App\Models\Identity;

use App\Enum\Identity\IdentityRole;
use App\Models\Identity\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    protected function casts(): array
    {
        return [
            'name' => IdentityRole::class,
        ];
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
