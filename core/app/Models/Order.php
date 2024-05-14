<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\GlobalStatus;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Constants\Status;

class Order extends Model
{
    use HasFactory, GlobalStatus, Searchable;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function deposit(){
        return $this->hasOne(Deposit::class);
    }

    public function scopePaid($query){
        return $query->where('status', Status::ORDER_PAID);
    }

    public function scopeUnpaid($query){
        return $query->where('status', Status::ORDER_UNPAID);
    }

    public function statusBadge(): Attribute{
        return new Attribute(function(){
            $html = '';
            if($this->status == Status::ORDER_PAID){
                $html = '<span class="badge badge--success">'.trans('Paid').'</span>';
            }
            else{
                $html = '<span class="badge badge--warning">'.trans('Unpaid').'</span>';
            }
            return $html;
        });
    }
    
}
   