<?php
declare(strict_types=1);

namespace App\UI\Controller\Api\Deploy\Model;

use Swagger\Annotations as SWG;

/**
 * @SWG\Definition(
 *     required={"id"}
 * )
 */
class CoreShaRequestModel
{
    /**
     * Core submodule sha
     *
     * @var string
     */
    public $coreSha;
}
