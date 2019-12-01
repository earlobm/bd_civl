<?php

namespace poi\EntityClass;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model{
    protected $table='role_permission';
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
