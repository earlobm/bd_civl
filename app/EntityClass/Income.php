<?php

namespace poi\EntityClass;

use Illuminate\Database\Eloquent\Model;

class Income extends Model{
    protected $table='income';
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
