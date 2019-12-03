<?php

namespace poi\EntityClass;

use Illuminate\Database\Eloquent\Model;

class TypeBusiness extends Model{
    protected $table='type_business';
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
