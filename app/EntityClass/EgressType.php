<?php

namespace poi\EntityClass;

use Illuminate\Database\Eloquent\Model;

class EgressType extends Model{
    protected $table='egress_type';
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
