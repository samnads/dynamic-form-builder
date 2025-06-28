<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormData extends Model
{
    use SoftDeletes;

    protected $fillable = ['form_submission_id', 'form_field_id', 'value'];
}
