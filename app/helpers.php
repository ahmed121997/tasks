<?php

/**
 * function to get data using library "yajra/laravel-datatables-oracle"
 * you to install this library
 */
 function getDataTables($request, $data)
{
    if ($request->ajax()) {
        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                if($row->status == 'Not Done'){
                    $actionBtn =
                    '<a href="task/done/' . $row->id . '" class="mr-2"><i class="far fa-check-circle text-success"></i></a>
                    <a onClick="return confirm(\'Are you sure to delete ?\');" href="task/delete/' . $row->id . '" ><i class="far fa-trash-alt text-danger"></a>';
                }else{
                    $actionBtn =
                    '<a onClick="return confirm(\'Are you sure to delete ?\');" href="task/delete/' . $row->id . '" ><i class="far fa-trash-alt text-danger"></a>';
                }

                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}

function getDataTablesWithoutAction($request, $data)
{
    if ($request->ajax()) {
        return DataTables::of($data)
            ->addIndexColumn()
            ->make(true);
    }
}


/**
 * function to save multiple images
 * you to install this library
 */

function saveMultipleImages($request, $nameFile)
{
    if ($request->hasfile($nameFile)) {
        $i = 0;
        $data = [];
        foreach ($request->file($nameFile) as $image) {
            $name =  time() . '_' . $i . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/images/', $name);
            $data[] = $name;
            $i++;
        }
        return $data;
    }
}



?>
