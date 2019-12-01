<?php

namespace poi\EntityClass;

use Illuminate\Database\Eloquent\Model;

class Egress extends Model{
    protected $table='egress';
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
