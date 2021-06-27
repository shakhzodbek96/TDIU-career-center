<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'middlename',
        'birth_date',
        'phone',
        'group_id',
        'faculty_id',
        'status_id'
    ];

    public static function deepFilters(){

        $tiyin = [];

        $obj = new self();
        $request = request();

        $query = self::where('id','!=','0');

        foreach ($obj->fillable as $item) {
            //request operator key
            $operator = $item.'_operator';

            if ($request->has($item) && $request->$item != '')
            {
                if (isset($tiyin[$item])){
                    $select = $request->$item * 100;
                    $select_pair = $request->{$item.'_pair'} * 100;
                }else{
                    $select = $request->$item;
                    $select_pair = $request->{$item.'_pair'};
                }

                //set value for query
                if ($request->has($operator) && $request->$operator != '')
                {
                    if (strtolower($request->$operator) == 'between' && $request->has($item.'_pair') && $request->{$item.'_pair'} != '')
                    {
                        $value = [
                            $select,
                            $select_pair];

                        $query->whereBetween($item,$value);
                    }
                    elseif (strtolower($request->$operator) == 'wherein')
                    {
                        if (!is_array($select))
                            $value = explode(',',str_replace(' ','',$select));
                        else
                            $value = $select;
                        $query->whereIn($item,$value);
                    }
                    elseif (strtolower($request->$operator) == 'like')
                    {
                        if (strpos($select,'%') === false)
                            $query->where($item,'like','%'.$select.'%');
                        else
                            $query->where($item,'like',$select);
                    }
                    else
                    {
                        $query->where($item,$request->$operator,$select);
                    }
                }
                else
                {
                    $query->where($item,$select);
                }
            }
        }
        return $query;
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function fio():string
    {
        return ($this->lastname ?? '').($this->firstname ?? '').($this->middlename ?? '');
    }
}
