<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use App\Constants\Status;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProductDetail extends Model
{
    use HasFactory, GlobalStatus, Searchable;

    public function product(){
        return $this->belongsTo(Product::class);
    } 

    public function scopeSold($query){
        return $query->where('is_sold', Status::YES);
    } 

    public function scopeUnSold($query){
        return $query->where('is_sold', Status::NO)->orderBy('id', 'ASC');
    } 

    public function statusBadge(): Attribute{
        return new Attribute(
            get: function(){
                $html = '';
                if ($this->is_sold == Status::YES) {
                    $html = '<span class="badge badge--success">' . trans('Sold') . '</span>';
                } else {
                    $html = '<span><span class="badge badge--primary">' . trans('Unsold') . '</span></span>';
                }
                return $html;
            }
        );
    }

}
