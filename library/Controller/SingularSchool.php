<?php

namespace Municipio\Controller;

use Municipio\Controller\Utils\SingularSchoolData;

/**
 * Class SingularSchool
 */
class SingularSchool extends \Municipio\Controller\Singular
{
    protected object $postMeta;

    public function init()
    {
        parent::init();
        $dataPreparer = new SingularSchoolData();
        $this->data   = $dataPreparer->prepareData($this->data);
    }
}