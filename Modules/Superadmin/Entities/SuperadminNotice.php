<?php

namespace Modules\Superadmin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SuperadminNotice extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'notice_message'];
    
    
}
