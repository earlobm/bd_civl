<?php

namespace poi\EntityClass;

use Illuminate\Database\Eloquent\Model;

class CustomerTypeDocument extends Model{
  //protected $connection = 'mysql-utf8';
    protected $table='customer_type_doc';
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
