<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdpostReport extends Model
{
    use HasFactory;
    public function PostDetails()
    {
        return $this->belongsTo(AdPost::class, 'post_id', 'id');
    }

    public function ReportOption()
    {
        return $this->belongsTo(reportOption::class, 'report_option_id', 'id');
    }

    public function UserName()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
