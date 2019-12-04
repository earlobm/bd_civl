<?php

namespace poi\EntityClass;

use Illuminate\Database\Eloquent\Model;

class BookBox extends Model{
    protected $table='book_box';
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
