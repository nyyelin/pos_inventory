<?php

namespace App;

use App\Repositories\Court\CourtInterface;
use DataTables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

trait ModelService
{
    
    protected function optionsQuery($query, $options= [])
    {

        

        if (isset($options['limit'])) {
            $query = $query->limit($options['limit']);
        }

        if (isset($options['offset'])) {
            $query = $query->offset($options['offset']);
        }

       

        if (isset($options['order_by_id'])) {
            $query = $query->orderBy('id', $options['order_by_id']);
        }

        if(isset($options['create_range']) && !empty($options['create_range'])) {
            $filter = $options['create_range'];

            $query = $query->whereBetween('created_at',[Carbon::parse($filter['start_date'])->startOfDay(),Carbon::parse($filter['end_date'])->endOfDay()]);
        }


        return $query;
    }

    public function getDataByOptions(array $options = [])
    {
        return $this->optionsQuery($options)->get();
    }
}
