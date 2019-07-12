<?php


namespace App\Containers\Debugger;



use Jenssegers\Agent\Facades\Agent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Output
{
    public $output = '';

    private $request;

    private $response;

    protected $responseDataCut;

    protected $tokenDataCut;

    public function __construct(Request $request, Response $response) {
        $this->response = $response;
        $this->request = $request;

        $this->responseDataCut = config('debugger.requests.response_show_first');
        $this->tokenDataCut = config('debugger.requests.token_show_first');
    }

    protected function set($text) {
        $this->output = $text;
    }

    public function get() {
        return $this->output;
    }

    public function clear() {
        $this->set('');
    }

    public function header($name) {
        $this->append("$name:\n");
    }

    public function newRequest() {
        $this->append("----------------- NEW REQUEST -----------------");
    }

    public function spaceLine() {
        return $this->append("\n \n");
    }

    public function endpoint() {
        $this->append(" * Endpoint：" . $this->request->fullUrl() . "\n");
        $this->append(" * Method：" . $this->request->getMethod() . "\n");
    }

    public function version() {
        if (method_exists($this->request, 'version')) {
            $this->append(" * Method：" . $this->request->version() . "\n");
        }
    }

    public function ip() {
        $this->append(" * IP: " . $this->request->ip() . "（Port：" . $this->request->getPort() . "）\n");
    }

    public function format() {
        $this->append(" * Format: " . $this->request->format() . "\n");
    }

    public function userInfo() {
        $authHeader = $this->request->header("Authorization");

        $user = $this->request->user() ? "ID：" . $this->request->user()->id
            . "（Name：" . $this->request->user()->name . "）" : "N/A";

        $browser = Agent::browser();

        $this->append(" * Access Token: " . substr($authHeader, 0,
                $this->tokenDataCut) . (!is_null($authHeader) ? "..." : "N/A") . "\n");

        $this->append(" * User: " . $user . "\n");
        $this->append(" * Device: " . Agent::device() . " (Platform: " . Agent::platform() . ") \n");
        $this->append(" * Browser: " . $browser . " (Version: " . Agent::version($browser) . ") \n");
        $this->append(" * Languages: " . implode(", ", Agent::languages()) . "\n");
    }

    public function requestData() {
        // Request Data
        $requestData = $this->request->all() ? http_build_query($this->request->all(), "", " + ") : "N/A";

        $this->append(" * " . $requestData . "\n");
    }

    public function responseData() {
        // Response Data
        $responseContent = ($this->response && method_exists($this->response,
                "getContent")) ? $this->response->getContent() : "N/A";

        $this->append(" * " . substr($responseContent, 0, $this->responseDataCut) . "..." . "\n");
    }

    public function append($output) {
        return $this->output .= $output;
    }
}