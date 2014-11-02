<?php namespace NS\Employees;

use Auth;
use NS\Core\Entity;
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Employee extends Entity
{
    protected $table      = 'employees';
	protected $fillable   = ['firstName', 'lastName'];
	public $timestamps = false;
	
	 use SoftDeletingTrait;
	 protected $dates = ['deleted_at'];



}