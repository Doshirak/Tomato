<?php
/**
 * CompilerService class file.
 */

/**
 * Class CompilerService represents compiler API
 */
abstract class CompilerService extends CApplicationComponent
{
    /**
     * Creates a new submission
     * @param string $sourceCode source code of the submission
     * @param string $input data that will be given to the program on stdin
     * @param string $language language identifier. Language identifiers can be retrieved by using the getLanguages method
     * @return mixed string error code or array
     */
    abstract function createSubmission($sourceCode, $input, $language);

    /**
     * Returns status and result of a submission
     * @param string $id identifier of the submission
     * @return mixed string error code or array
     */
    abstract function getSubmissionStatus($id);

    /**
     * @param string $id identifier of the submission
     * @param array $with of booleans with keys sourceCode, input, output, stderr and cmpinfo
     * @return mixed string error code or array
     */
    abstract function getSubmissionDetails($id, $with);

    /**
     * Returns a list of supported programming languages
     * @return mixed string error code or array
     */
    abstract function getLanguages();

    /**
     * For testing purposes
     * @return array
     */
    abstract function testFunction();
}