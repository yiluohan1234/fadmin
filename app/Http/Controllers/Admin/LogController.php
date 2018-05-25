<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use App\Orgs\LogViewer;

class LogController extends Controller
{
    protected $data = [];
    /**
     * Lists all log files.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $this->data['files'] = LogViewer::getFiles(true);
        $this->data['title'] = trans('logmanager.log_manager');

        return view('fadmin.logmanager.logs', $this->data);
    }
    /**
     * Previews a log file.
     *
     * @throws \Exception
     */
    public function preview($file_name)
    {
        LogViewer::setFile(base64_decode($file_name));
        $logs = LogViewer::all();
        if (count($logs) <= 0) {
            abort(404, trans('logmanager.log_file_doesnt_exist'));
        }
        $this->data['logs'] = $logs;
        $this->data['title'] = trans('logmanager.preview').' '.trans('logmanager.logs');
        $this->data['file_name'] = base64_decode($file_name);
        return view('fadmin.logmanager.log_item', $this->data);
    }
    /**
     * Downloads a log file.
     *
     * @param $file_name
     *
     * @throws \Exception
     *
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function download($file_name)
    {
        return response()->download(LogViewer::pathToLogFile(base64_decode($file_name)));
    }
    /**
     * Deletes a log file.
     *
     * @param $file_name
     *
     * @throws \Exception
     *
     * @return string
     */
    public function delete($file_name)
    {
        if (app('files')->delete(LogViewer::pathToLogFile(base64_decode($file_name)))) {
            return 'success';
        }
        abort(404, trans('logmanager.log_file_doesnt_exist'));
    }
}
