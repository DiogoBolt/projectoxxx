<?php
/**
 * Created by PhpStorm.
 * User: Miguel
 * Date: 05/07/2016
 * Time: 16:50
 */

namespace App\Lib\Reports;


use App\Models\GitFile;
use App\Models\Project;
use Carbon\Carbon;
use PHPExcel;
use PHPExcel_Style_Border;
use PHPExcel_Style_Fill;
use PHPExcel_Writer_Excel2007;

/**
 * Class ReportCar
 * @package App\Lib\Reports
 *
 * @property Project project
 * @property string branch
 * @property int priority
 */
class ReportCar
{
    public $project;
    public $branch;
    public $priority;
    private $colors = [
        '0' => 'FFFFFF',
        '1' => '330000',
        '2' => 'CC0000',
        '3' => 'FF0000',
    ];
    private $backColors = [
        '0' => 'FFFFFF',
        '1' => '82D050',
        '2' => 'FFC000',
        '3' => 'C00000',
    ];

    public function __construct()
    {

    }

    public function save()
    {
        $projectId = $this->project->id;
        $filePath = storage_path('app/' . $this->project->name . '-' . Carbon::now()->toDateString() . '-Car.xlsx');

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0)->setTitle($this->project->name);

        // Get data
        $files = GitFile::query()
            ->select('path', 'description', 'version', 'owner', 'confidentiality', 'integrity', 'availability', 'accountability', 'priority as overall', 'hash')
            ->where('active', '=', 1)
            ->where('project_id', '=', $projectId)
            ->where('branch', '=', $this->branch)
            ->where('hash', '!=', "")
            ->where('priority', '>=', $this->priority)
            ->orderBy('type', 'desc')->orderBy('path')
            ->get();
        // Cabec
        $objPHPExcel->getActiveSheet()
            ->setCellValue('B2', 'Software Component')->setCellValue('C2', $this->project->name)
            ->setCellValue('B3', 'Description')->setCellValue('C3', 'Critical Components of the ' . $this->project->name)
            ->setCellValue('B4', 'Owner')->setCellValue('C4', 'jmiguelcouto')

            ->setCellValue('B5', 'Confidentiality')->setCellValue('C5', '3')
            ->setCellValue('B6', 'Integrity')->setCellValue('C6', '3')
            ->setCellValue('B7', 'Availability')->setCellValue('C7', '3')
            ->setCellValue('B8', 'Accountability')->setCellValue('C8', '3')
            ->setCellValue('B9', 'Overall Criticality Score')->setCellValue('C9', '3');

        $objPHPExcel->getActiveSheet()
            ->getStyle('B2:C3')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()
            ->getStyle('B9:C9')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()
            ->getStyle('C2:C9')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        $objPHPExcel->getActiveSheet()
            ->getStyle('B5')->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        $objPHPExcel->getActiveSheet()->getStyle('B2:B9')->applyFromArray([
                'borders' => [
                    'left'	=> ['style' => PHPExcel_Style_Border::BORDER_THIN],
                ],
                'fill' => [
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => ['argb' => 'CCCCCC']
                ]
            ]
        );
        $objPHPExcel->getActiveSheet()->getStyle('C5:C9')->applyFromArray([
                'alignment' => [
                    'horizontal'	=> 'center',
                ]
            ]
        );
        $objPHPExcel->getActiveSheet()->getStyle('C9')->applyFromArray([
                'font' => [
                    'bold' => true
                ],
                'fill' => [
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => ['argb' => 'FF0000']
                ]
            ]
        );

        $objPHPExcel->getActiveSheet()->getStyle('B11:K11')->applyFromArray([
                'borders' => [
                    'allborders'	=> ['style' => PHPExcel_Style_Border::BORDER_THIN],
                ],
                'fill' => [
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => ['argb' => 'CCCCCC']
                ]
            ]
        );

        $istart = 11;
        $i = $istart;
        $objPHPExcel->getActiveSheet()
            ->setCellValue('B' . $i, 'Path')
            ->setCellValue('C' . $i, 'Description')
            ->setCellValue('D' . $i, 'Version')
            ->setCellValue('E' . $i, 'Owner')
            ->setCellValue('F' . $i, 'Confidentiality')
            ->setCellValue('G' . $i, 'Integrity')
            ->setCellValue('H' . $i, 'Availability')
            ->setCellValue('I' . $i, 'Accountability')
            ->setCellValue('J' . $i, 'Overall')
            ->setCellValue('K' . $i, 'Hash');

        foreach ($files as $file) {
            $i++;
            $objPHPExcel->getActiveSheet()
                ->setCellValue('B' . $i, $file->path)
                ->setCellValue('C' . $i, $file->description)
                ->setCellValue('D' . $i, $file->version)
                ->setCellValue('E' . $i, $file->owner)
                ->setCellValue('K' . $i, $file->hash);

            $this->setPriority($objPHPExcel, 'F' . $i, $file->confidentiality);
            $this->setPriority($objPHPExcel, 'G' . $i, $file->integrity);
            $this->setPriority($objPHPExcel, 'H' . $i, $file->availability);
            $this->setPriority($objPHPExcel, 'I' . $i, $file->accountability);
            $this->setPriority($objPHPExcel, 'J' . $i, $file->overall, true);
        }

        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(60);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(50);
        foreach (['D','E','F','G','H','I','J','K'] as $col) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }

        $objPHPExcel->getActiveSheet()->getStyle('B'.($istart+1).':C'.$i)->applyFromArray([
                'alignment' => [
                    'vertical' => 'top',
                    'wrap' => true
                ]
            ]
        );
        $objPHPExcel->getActiveSheet()->getStyle('B'.($istart+1).':K'.$i)->applyFromArray([
                'borders' => [
                    'allborders'	=> ['style' => PHPExcel_Style_Border::BORDER_THIN],
                ]
            ]
        );

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($filePath);
    }

    /**
     * @param PHPExcel $objPHPExcel
     * @param $cell
     * @param $value
     * @return mixed
     */
    protected function setPriority(PHPExcel $objPHPExcel, $cell, $value, $back = false)
    {
        $arr = [
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center'
            ],
//            'font' => [
//                'color' => ['argb' => $this->colors[$value]]
//            ],
        ];
        if ($back) {
            $arr['fill'] = [
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => ['argb' => $this->backColors[$value]]
            ];
        }
        return $objPHPExcel->getActiveSheet()
            ->getCell($cell)->setValue($value)->getStyle()->applyFromArray($arr);
    }
}