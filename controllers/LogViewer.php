<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class LogViewer extends CI_Controller
{
    protected $service;

    public function __construct()
    {
        parent::__construct();
        // Load the bootstrap library
        $this->load->library('Ci3LogViewer');
        $this->service = $this->ci3logviewer->getService();
        
        // Basic Authorization check
        $authCallback = $this->config->item('auth_callback', 'log_viewer');
        if (is_callable($authCallback)) {
            if (! call_user_func($authCallback)) {
                show_error('Unauthorized access to Log Viewer.', 403);
            }
        }
    }

    public function index()
    {
        // Renders the SPA view
        $assetsPublished = true; // Assumed deployed to assets directory
        $scriptVars = [
            'headers' => (object) [],
            'version' => '1.0.0',
            'apiPath' => site_url('log-viewer/api'),
        ];

        $this->load->view('log_viewer/index', [
            'assetsPublished' => $assetsPublished,
            'logViewerScriptVariables' => $scriptVars,
        ]);
    }

    public function get_files()
    {
        $files = $this->service->getFiles();
        $response = [];

        foreach ($files->all() as $file) {
            $response[] = [
                'identifier' => $file->identifier,
                'name' => $file->name,
                'size' => $file->size(),
                'path' => $file->displayPath,
            ];
        }

        $this->_json($response);
    }

    public function download_file($identifier)
    {
        $file = $this->service->getFile($identifier);
        if ($file) {
            $file->download();
        } else {
            show_404();
        }
    }

    public function delete_file($identifier)
    {
        $file = $this->service->getFile($identifier);
        if ($file && $file->delete()) {
            $this->_json(['success' => true]);
        } else {
            $this->_json(['success' => false], 400);
        }
    }

    protected function _json($data, $status = 200)
    {
        $this->output
            ->set_status_header($status)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($data));
    }
}
