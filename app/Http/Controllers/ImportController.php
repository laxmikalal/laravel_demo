<?php
namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;

class ImportController extends Controller
{

public function __construct()
{
    $this->middleware('auth');
}
    public function getImport()
    {
        return view('devices.import');
    }

    public function processImport(Request $request) {
    	// Validate request 
		$request->validate([
		  'import_file' => 'required|mimes:csv,txt',
		]);

    	$file = $request->file("import_file");
        $csvData = file_get_contents($file);

        $rows = array_map("str_getcsv", explode("\n", $csvData));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            if (isset($row[0])) {
                if ($row[0] != "") {
                    $row = array_combine($header, $row);

                    $deviceData = array(
                        "name" => $row["name"],
                        "type" => $row["type"],

                    );

                    $device = Device::create($deviceData);
                  
                }
            }
        }

    //Return our import finished message
      $message = 'Device data imported successfully'; //$this->returnMessage($validate, $request);
              return redirect()->route('devices.index')
                        ->with('success','Device imported successfully');
    }








}