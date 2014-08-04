<?php
/**
 * IdeoneService class file.
 */


/**
 * Class IdeoneService represents ideone.com API
 */
class IdeoneService extends CompilerService
 {
    /**
     * @var string the path of the PHP script that contains the configure data
     */
    public $configFile;

    public $soapClient;

    private $_url;
    private $_username;
    private $_password;

    public function init()
    {
        parent::init();

        if($this->configFile === null)
            $this->configFile = Yii::getPathOfAlias('application.config.ideone').'.php';
        $this->load();

        $this->soapClient = new SoapClient($this->_url
        /*
         * options?
         * , array(
            "trace" => true,
            "exceptions" => true
        )*/);
    }

    public function load()
    {
        $items = array();
        if(is_file($this->configFile))
            $items = require($this->configFile);

        foreach($items as $name => $item)
        {
            $attr = '_' . $name;
            $this->$attr = $item;
        }
    }

    public function createSubmission($sourceCode, $input, $language)
    {
        $answer = $this->soapClient->createSubmission($this->_username, $this->_password,
            $sourceCode, $language, $input,
            true, true);
        if ($answer['error'] !== 'OK')
            return $answer['error'];
        return array($answer['link']);
    }

    public function getSubmissionStatus($id)
    {
        $answer = $this->soapClient->getSubmissionStatus($this->_username, $this->_password, $id);
        if ($answer['error'] !== 'OK')
            return $answer['error'];

        unset($answer['error']);
        $answer['status'] = $this->statusToString((int) $answer['status']);
        $answer['result'] = $this->resultToString((int) $answer['result']);

        return $answer;

    }

    public function getSubmissionDetails($id, $with)
    {
        $withSource = (array_key_exists('sourceCode', $with)) ? $with['sourceCode'] : false;
        $withInput = (array_key_exists('input', $with)) ? $with['input'] : false;;
        $withOutput = (array_key_exists('output', $with)) ? $with['output'] : false;;
        $withStderr = (array_key_exists('stderr', $with)) ? $with['stderr'] : false;;
        $withCmpinfo = (array_key_exists('cmpinfo', $with)) ? $with['cmpinfo'] : false;;


        $answer = $this->soapClient->getSubmissionDetails($this->_username, $this->_password, $id,
            $withSource, $withInput, $withOutput, $withStderr, $withCmpinfo);
        if ($answer['error'] !== 'OK')
            return $answer['error'];

        unset($answer['error']);
        $answer['status'] = $this->statusToString((int) $answer['status']);
        $answer['result'] = $this->resultToString((int) $answer['result']);

        return $answer;
    }

    public function getLanguages()
    {
        $answer = $this->soapClient->getLanguages($this->_username, $this->_password);
        if ($answer['error'] !== 'OK')
            return $answer['error'];
        return $answer['languages'];
    }

    public function testFunction()
    {
        $answer = $this->soapClient->testFunction($this->_username, $this->_password);
        return $answer;
    }

    private function statusToString($status)
    {
        if ($status < 0)
            return 'waiting for compilation';
        elseif ($status === 0)
            return 'done';
        elseif ($status === 1)
            return 'compilation';
        elseif ($status === 3)
            return 'running';
        return 'unknown status';

    }

    private function resultToString($result)
    {
        if ($result === 0)
            return 'not running';
        elseif ($result === 11)
            return 'compilation   error';
        elseif ($result === 12)
            return 'runtime error';
        elseif ($result === 13)
            return 'time limit exceeded';
        elseif ($result === 15)
            return 'success';
        elseif ($result === 17)
            return 'memory limit exceeded';
        elseif ($result === 19)
            return 'illegal system call';
        elseif ($result === 20)
            return 'internal   error';
        return 'unknown result';
    }
}


