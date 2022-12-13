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
                    '<a href="task/done/' . $row->id . '" class="edit btn btn-success btn-sm">Done</a>
                      <a href="task/delete/' . $row->id . '" class="task-delete btn btn-danger btn-sm">Delete</a>';
                }else{
                    $actionBtn =
                    '<a href="task/delete/' . $row->id . '" class="task-delete btn btn-danger btn-sm">Delete</a>';
                }

                return $actionBtn;
            })
            ->rawColumns(['action'])
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
