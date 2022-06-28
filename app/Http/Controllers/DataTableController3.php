<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DataTableController3 extends Controller
{
    public function getlist( Request $request)
    {
        $draw 				= 		$request->get('draw'); // Internal use
        $start 				= 		$request->get("start"); // where to start next records for pagination
        $rowPerPage 		= 		$request->get("length"); // How many recods needed per page for pagination
     
        $orderArray 	   = 		$request->get('order');
        $columnNameArray 	= 		$request->get('columns'); // It will give us columns array
                          
        $searchArray 		= 		$request->get('search');
        $columnIndex 		= 		$orderArray[0]['column'];  // This will let us know,
                                                           // which column index should be sorted 
                                                           // 0 = id, 1 = name, 2 = email , 3 = created_at
     
        $columnName 		= 		$columnNameArray[$columnIndex]['data']; // Here we will get column name, 
                                                                       // Base on the index we get
     
        $columnSortOrder 	= 		$orderArray[0]['dir']; // This will get us order direction(ASC/DESC)
        $searchValue 		= 		$searchArray['value']; // This is search value 
     
        $users = DB::table('products');
        $total = $users->count();
        
        $totalFilter = DB::table('products');
        if (!empty($searchValue)) {
            $totalFilter = $totalFilter->where('title','like','%'.$searchValue.'%');
            $totalFilter = $totalFilter->orWhere('price','like','%'.$searchValue.'%');
        }
        $totalFilter = $totalFilter->count();

        $arrData = DB::table('products');
        $arrData = $arrData->skip($start)->take($rowPerPage);
        $arrData = $arrData->orderBy($columnName,$columnSortOrder);

        if (!empty($searchValue)) {
            $arrData = $arrData->where('title','like','%'.$searchValue.'%');
            $arrData = $arrData->orWhere('price','like','%'.$searchValue.'%');

        }
        $arrData = $arrData->get();


        $response = array(
           "draw" => intval($draw),
           "recordsTotal" => $total,
           "recordsFiltered" => $totalFilter,
           "data" => $arrData,
        );
        return response()->json($response);
    }
}

