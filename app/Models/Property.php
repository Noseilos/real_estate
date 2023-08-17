<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Property extends Model
{
    use HasFactory, Searchable;
    protected $guarded = [];

    public function type(){
        return $this->belongsTo(PropertyType::class, 'ptype_id', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'agent_id', 'id');
    }

    public function pstate(){
        return $this->belongsTo(State::class,'state','id');
    }

    public function schedule(){
        return $this->hasMany(Schedule::class, 'property_id', 'id');
    }

    public function toSearchableArray (){
        return [
            'property_name' => $this->property_name,
        ];
    }
    
}
