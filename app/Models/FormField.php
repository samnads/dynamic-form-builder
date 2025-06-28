<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FormField extends Model
{
    use SoftDeletes;

    protected $fillable = ['form_id', 'field_type_id', 'label', 'data'];

    public function fieldType(): BelongsTo
    {
        return $this->belongsTo(FieldType::class, 'field_type_id');
    }
}
