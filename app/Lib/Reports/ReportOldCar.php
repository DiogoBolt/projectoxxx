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
use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;

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

    public function __construct()
    {

    }

    public function save()
    {
        $projectId = $this->project->id;
        $filePath = storage_path('app/' . $this->project->name . 'Car.xlsx');
        $style = (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(15)
            ->setFontColor(Color::BLACK)
            ->setShouldWrapText()
            ->build();

        $writer = WriterFactory::create(Type::XLSX); // for XLSX files
        //$writer = WriterFactory::create(Type::CSV); // for CSV files
        //$writer = WriterFactory::create(Type::ODS); // for ODS files

        $writer->openToFile($filePath); // write data to a file or to a PHP stream
        //$writer->openToBrowser($fileName); // stream data directly to the browser
        $files = GitFile::query()
            ->select('path', 'description', 'version', 'owner', 'confidentiality', 'integrity', 'availability', 'accountability', 'overall', 'hash')
            ->where('active', '=', 1)
            ->where('project_id', '=', $projectId)
            ->where('branch', '=', $this->branch)
            ->where('hash', '!=', "")
            ->where('priority', '>=', $this->priority)
            ->orderBy('type', 'desc')->orderBy('path')
            ->get();

        $info1 = array("Description" => "Software Component", "Value" => $this->project->name);
        $info2 = array("Description" => "Description", "Value" => 'Critical Components of the ' . $this->project->name);
        $info3 = array("Description" => "Owner", "Value" => 'jmiguelcouto');
        $info4 = array("Description" => "Component Name",
            "Value" => 'Component Description',
            "Value2" => 'Version',
            "Value3" => 'Owner',
            "Value4" => 'Confidentiality',
            "Value5" => 'Integrity',
            "Value6" => 'Availablility',
            "Value7" => 'Accountability',
            "Value8" => 'Overall Criticality Score',
            "Value9" => 'Checksum / Digital Fingerprint');

        $array = json_decode(json_encode($files), true);
        $writer->addRowWithStyle($info1, $style);
        $writer->addRowWithStyle($info2, $style);
        $writer->addRowWithStyle($info3, $style);
        $writer->addrow(array('space' => ''));
        $writer->addRowWithStyle($info4, $style);
        $writer->addRows($array);

        $writer->close();
    }
}