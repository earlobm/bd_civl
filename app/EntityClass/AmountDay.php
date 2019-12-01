<?php

namespace poi\EntityClass;

use Illuminate\Database\Eloquent\Model;

class AmountDay extends Model{
    protected $table='amount_day';
    protected $primaryKey='id';
    public $timestamps = false;
    const UPDATED_AT=NULL;
  /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded=[];
    //
}
