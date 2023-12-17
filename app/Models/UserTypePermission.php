<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypePermission extends Model
{
    use HasFactory;

    public function user_types()
    {
        return $this->belongsTo(UserType::class, 'user_type_id');
    }

    public function permissions()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }

    public function hasRole($permissionId) {
        return $this->roles->where('id', $permissionId)->count() > 0;
    }
}
