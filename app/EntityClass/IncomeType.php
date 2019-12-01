<?php

namespace poi\EntityClass;

use Illuminate\Database\Eloquent\Model;

class IncomeType extends Model{
    protected $table='income_type';
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
