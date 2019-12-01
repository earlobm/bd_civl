<?php

namespace poi\EntityClass;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model{
    protected $table='permission';
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
