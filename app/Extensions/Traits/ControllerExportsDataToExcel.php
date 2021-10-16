<?php

namespace App\Extensions\Traits;


use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

trait ControllerExportsDataToExcel
{

    /**
     * @param $data
     * @param $excel_export
     * @param  string  $filename
     * @return BinaryFileResponse
     */
    public function exportAndDownloadFromRequest($data, $excel_export, $filename = 'data.xlsx'): BinaryFileResponse
    {
        if ($data instanceof Collection) {
            if ($data) {
                return Excel::download(new $excel_export($data), $filename);
            } else {
                flash()->warning('Cannot export empty records');
            }
        }
    }

}
