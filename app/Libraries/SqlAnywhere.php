<?php

namespace App\Libraries;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

/**
 * 
 */
class SqlAnywhere
{
	protected $obj = null;
	protected $page = null;
	protected $perpage = null;
	protected $startat = null;
	protected $selects = null;
	protected $paging_query = null;
	protected $q = null;
	protected $orderBy = null;
	protected $orderMethod = null;


	
	function __construct($obj)
	{
		# code...
		$this->obj = $obj;
		return $this;
	}

	public function select($selects = null)
	{
		$this->selects = $selects;
		return $this;
	}

	public function page($page = 1,$perpage = 20)
	{
		# code...

		$this->startat = (($page == null or $page == 1) ? 1 : ((($page - 1) * $perpage) + 1));
		$this->page = $page;
		$this->perpage = ($perpage == null ? 20 : $perpage);
		
		return $this;
	}

	public function listen()
	{

		try {

            $validator_param['q'] = 'string';
            $validator_param['page'] = 'integer';
            $validator_param['perpage'] = 'integer';
            $validator_param['orderby'] = 'string';
            $validator_param['ordermethod'] = 'string';
            
            $val = Validator::make($_GET,$validator_param);
            $validated = $val->validate();

        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => "Cannot Retrive Data",
                'errors' => $e->validator->errors()->all()
            ]);
            
        }
        if ($this->page == null)
        $this->page($_GET['page']??null,$_GET['perpage']??null);
        $this->q($_GET['q']??null);
        if (strstr($_GET['orderby']??null, '|')) {
        	$orderby = explode('|', $_GET['orderby']);
        	$this->orderBy($orderby[0],$orderby[1]);
        }
        else $this->orderBy($_GET['orderby']??null,$_GET['ordermethod']??null);
        return $this;
	}

	public function orderBy($by,$method = "asc")
	{
		$this->orderBy = $by;
		$this->orderMethod = $method;
		return $this;
	}

	public function getMeta(&$meta)
	{
		$obj = $this->obj;
		
		$q = str_replace('*', '%', $this->q);

        if(@$this->selects == null){
            $selectx = json_decode(json_encode($obj->select(DB::raw('TOP 1 *'))->get()),true) ;
            if(is_array(@$selectx[0])){
                foreach ($selectx[0] as $key => $value) {
                    $this->selects[] = $key;
                }
            }
            
            // die;
        }
        $s = $this->selects;

		$obj = $obj->where(function($query) use ($s,$q) {
                        if(is_array(@$s))
						foreach ($s as $k => $v) {
							if ($k == 0) 
								$query = $query->where($v, 'like', '%'.$q.'%');
							else
								$query = $query->orWhere($v, 'like', '%'.$q.'%');
						}
    				});
		if ($this->orderBy != null ) {
			$obj= $obj->orderBy($this->orderBy,$this->orderMethod??'asc');
		}
		$count = $obj->count();

		$meta = [
			'page' => $this->page??1,
			'perpage' => $this->perpage,
			'startat' => $this->startat,
			'lastpagenumber' => ceil($count/$this->perpage),
			'totalrow' => $count,
			'orderby' => $this->orderBy,
			'ordermethod' => $this->orderMethod
		];
		return $this;
	}

    function setPage() {
        
    }

	public function getObject()
	{

		
		$this->paging_query = "top ".$this->perpage." start at ".$this->startat;
		$s = $selects = $this->selects;

		if ($selects == null) {
			$this->obj = $this->obj->select(DB::raw($this->paging_query . ' *'));
		}
		else{
			$selects[0] = DB::raw($this->paging_query. ' ' .$selects[0]);
			$this->obj = $this->obj->select($selects);
		}
		$q = str_replace('*', '%', $this->q);
		$this->obj = $this->obj->where(function($query) use ($s,$q) {
            if(is_array(@$s))
						foreach ($s as $k => $v) {
							if ($k == 0) 
								$query = $query->where($v, 'like', '%'.$q.'%');
							else
								$query = $query->orWhere($v, 'like', '%'.$q.'%');
						}
    				});
		if ($this->orderBy != null ) {
			$this->obj= $this->obj->orderBy($this->orderBy,$this->orderMethod??'asc');
		}
		return $this->obj;
	}

	public function q($q)
	{
		$this->q = $q;
		return $this;
	}

    function prepare(&$meta){
        return $this->listen()->getMeta($meta)->getObject();
    }


}