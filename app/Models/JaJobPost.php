<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JaJobPost extends Model
{
    use HasFactory;
    protected $table = 'ja_job_posts';
    protected $fillable = [
        'user_id',
        'number_of_days',
        'total_cost',
        'zipcode',
        'area',
        'city',
        'project_type',
        'floor_maps_image',
        'description',
        'tags',
        'image_paths',
    ];

    protected $casts = [
        'image_paths' => 'array',
        'floor_maps_image' => 'array',
    ];

}
