<?php
/**
 * Created by PhpStorm.
 * User: Miguel
 * Date: 05/07/2016
 * Time: 16:50
 */

namespace App\Lib\Reports;


use App\Models\ChangeLog;
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
class ReportChangeLog
{
    public $project;
    public $branch;
    public $priority;
    public $start;
    public $end;
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
        $filePath = storage_path('app/' . $this->project->name . '-' . Carbon::now()->toDateString() . '-ChangeLog.xlsx');

        $objPHPExcel = new PHPExcel();

        $objPHPExcel->setActiveSheetIndex(0)->setTitle($this->project->name);

        // Get data
        $files = ChangeLog::query()
            ->where('created', '>=', $this->start)
            ->where('created', '<', $this->end)
            ->get();

        // Cabec
        $objPHPExcel->getActiveSheet()
            ->setCellValue('B2', 'Change Log')->setCellValue('C2', $this->project->name)
            ->setCellValue('B3', 'Periodo')->setCellValue('C3', 'De ' . $this->start. ' até ' . $this->end);

        $objPHPExcel->getActiveSheet()->getStyle('B2:B3')->applyFromArray([
                'borders' => [
                    'left'	=> ['style' => PHPExcel_Style_Border::BORDER_THIN],
                ],
                'fill' => [
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => ['argb' => 'CCCCCC']
                ]
            ]
        );

        $objPHPExcel->getActiveSheet()->getStyle('B5:K5')->applyFromArray([
                'borders' => [
                    'allborders'	=> ['style' => PHPExcel_Style_Border::BORDER_THIN],
                ],
                'fill' => [
                    'type' => PHPExcel_Style_Fill::FILL_SOLID,
                    'color' => ['argb' => 'CCCCCC']
                ]
            ]
        );
        $objPHPExcel->getActiveSheet()->getStyle('B2:C3')->applyFromArray([
                'borders' => [
                    'allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
                ]
            ]
        );

        $istart = 5;
        $i = $istart;
        $objPHPExcel->getActiveSheet()
            ->setCellValue('B' . $i, 'Componente') //'Component
            ->setCellValue('C' . $i, 'Nome(s)') //'Component Name(s)
            ->setCellValue('D' . $i, 'RFC#') //'RFC#
            ->setCellValue('E' . $i, 'Criado Por') //'Raised By
            ->setCellValue('F' . $i, 'Aprovado Por') //'Approved By
            ->setCellValue('G' . $i, 'Data de Implementação') //'Implemented Date
            ->setCellValue('H' . $i, 'Revisto Por') //'QA Reviewed by
            ->setCellValue('I' . $i, 'Data de Revisão') //'QA Review date
            ->setCellValue('J' . $i, 'Ref') //'Ref
            ->setCellValue('K' . $i, 'Sumário'); //'Summary'

        foreach ($files as $file) {
            $i++;
            $fs = [];
            foreach ($file->files as $f){
                $fs[] = $f->path;
            }
            $files_text = join("\n", $fs);
            $objPHPExcel->getActiveSheet()
                ->setCellValue('B' . $i, $file->component)
                ->setCellValue('C' . $i, $files_text)
                ->setCellValue('D' . $i, $file->rfc)
                ->setCellValue('E' . $i, $file->raised)
                ->setCellValue('F' . $i, $file->aproved)
                ->setCellValue('G' . $i, $file->created)
                ->setCellValue('H' . $i, $file->reviewed)
                ->setCellValue('I' . $i, $file->reviewdate)
                ->setCellValue('J' . $i, $file->ref)
                ->setCellValue('K' . $i, $file->summary)
            ;

        }

        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(60);
        foreach (['D','E','F','G','H','I','J','K'] as $col) {
            $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
        }

        $objPHPExcel->getActiveSheet()->getStyle('B'.($istart+1).':C'.$i)->applyFromArray([
                'alignment' => [
                    'wrap' => true
                ]
            ]
        );
        $objPHPExcel->getActiveSheet()->getStyle('K'.($istart+1).':K'.$i)->applyFromArray([
                'alignment' => [
                    'wrap' => true
                ]
            ]
        );
        $objPHPExcel->getActiveSheet()->getStyle('B' . ($istart + 1) . ':K' . $i)->applyFromArray([
                'alignment' => [
                    'vertical' => 'top'
                ],
                'borders' => [
                    'allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN],
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