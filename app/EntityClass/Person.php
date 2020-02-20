<?php

namespace poi\EntityClass;

use Illuminate\Database\Eloquent\Model;

class Person extends Model{
  //protected $connection = 'mysql-utf8';
    protected $table='person';
    protected $primaryKey='idperson';
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
