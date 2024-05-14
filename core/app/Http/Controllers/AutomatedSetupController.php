<?php

namespace App\Http\Controllers;

use ZipArchive;
use Illuminate\Http\Request;
use App\Models\AutomatedSetup;
use MHasnainJafri\Cpanel\Cpanel;
use Illuminate\Support\Facades\File;

class AutomatedSetupController extends Controller
{
    public function index()
    {
        $root_domain = 'openuniversity.ma';
        $subdomain = 'test.' . $root_domain;
        /* $x = $this->create_sub_domain($subdomain,$root_domain,'/'.$subdomain); 
        $createDB = $this->create_database($subdomain);*/
        $extract = $this->add_files_to_dir('myprof.openuniversity.ma');
        dd($extract);
    }

    public function create_sub_domain($sub_domain, $rootdomain, $dir)
    {
        $cpanel = new Cpanel();
        return  $cpanel->createSubDomain($sub_domain, $rootdomain, $dir);
    }

    public function create_database($db_name, $db_user = 'auto')
    {
        $cpanel = new Cpanel();
        $db_name = str_replace('.', '_', $db_name);
        $db_name = 'digiwink_' . $db_name;
        $db_user = 'digiwink_' . $db_user; // pass: !YErGdzS5j5@

        // create database
        $create_db = $cpanel->createDatabase($db_name);

        if ($create_db['status'] == "success") {
            $add_user = $cpanel->setAllPrivilegesOnDatabase($db_user, $db_name);
            if ($add_user['status']) {
                return [true];
            } else {
                return [false, $add_user['curl_response']['curl_response']];
            }
        } else {
            return [false, $create_db['curl_response']['curl_response']];
        }
    }

    public function add_files_to_dir($dir)
    {
        $zipFileName = 'application.zip';
        $sourceZipPath = '/home/digiwink/public_html/dossier_pro/' . $zipFileName; 
        $destinationDirectory = '/home/digiwink/public_html/'.$dir; 

        if (!file_exists($sourceZipPath)) {
            return "Source zip file does not exist.   ".$sourceZipPath;
        }

        // Ensure destination directory exists, create if it doesn't
        if (!is_dir($destinationDirectory)) {
           /*  mkdir($destinationDirectory, 0750, true); */
           return 'Source zip file does not exist';
        }

        // Extract the zip file
        $zip = new ZipArchive;
        if ($zip->open($sourceZipPath) === true) {
            $zip->extractTo($destinationDirectory);
            $zip->close();
            return "Zip file extracted successfully.";
        } else {
            return "Failed to extract zip file.";
        }
    }
}
