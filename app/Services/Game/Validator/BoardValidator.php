<?php

namespace App\Services\Game\Validator;

use Monolog\Logger;

class BoardValidator {

    /**
     * @var Logger
     */
    private $logger;

    public function __construct(
        Logger $logger
    ) {
        $this->logger = $logger;
    }

    /**
     *
     * This function allow us to determine if the data send to the API
     * is corrupted or not.
     *
     * @param $board
     */
    public function boardValidator($board) {
        $this->lineVerification($board);
        $this->columnVerification($board);
    }

    private function lineVerification($board) :void {
        if(count($board) !== 3) {
            $this->writeLog('Invalid number of lines, 3 lines expected');
        }
    }

    private function columnVerification($board) :void {
        for ($iterator = 0;$iterator < count($board); $iterator++) {
            if(count($board[$iterator]) !== 3) {
                $this->writeLog('Invalid number of columns, 3 columns expected');
            }
            $this->isPlayerOrBot($board[$iterator]);
        }
    }

    private function isPlayerOrBot($boardLine) :void {
        if (!in_array($boardLine, ['X', 'O', ''])) {
            $this->writeLog('Invalid content, expexted X, O or empty string');
        }
    }

    /**
     * @param $message
     */
    private function writeLog($message) {
        $this->logger->info($message);
    }
}