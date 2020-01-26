<?php

declare(strict_types=1);

namespace App\UI\Controller\EasyAdmin;

use App\UI\Controller\EasyAdmin\Traits\{UtilsAdminTrait};
use App\UI\Middleware\RestrictAccessFromPublic\AccessibleFromPublicInterface;
use App\UI\Controller\EasyAdmin\Traits\AccessAdminTrait;

use Symfony\Component\Serializer\SerializerInterface;

class EasyAdminController extends \EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController
    implements AccessibleFromPublicInterface
{
    use AccessAdminTrait;
    use UtilsAdminTrait;

    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_SUPERVISOR = 'ROLE_SUPERVISOR';
    const ROLE_MARKETER = 'ROLE_MARKETER';
    const ROLE_GUEST = 'ROLE_GUEST';

    const CHANGE_HISTORY = 'ChangeHistory';

    /**
     * EasyAdminController constructor.
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function listAction()
    {
        return $this->hasAccess()
            ? parent::listAction()
            : $this->redirectToBackendHomepage();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function showAction()
    {
        if (!$this->hasAccess()) {
            return $this->redirectToReferrer();
        }

        if ($this->request->get('entity') === static::CHANGE_HISTORY) {
            $easyadmin = $this->getEasyAdminAttribute();
            $classNameWithNamespace = $easyadmin['item']->getEntityName();
            $className = $this->getClassNameFromNamespace($classNameWithNamespace);

            $entityConfig = $this
                ->get('easyadmin.config.manager')
                ->getEntityConfig($className);

            $fields = $entityConfig['show']['fields'];

            $parameters = [
                'state' => [
                    'prevEntity' => $this->unserializeEntity($easyadmin['item']->getPrevEntityState(), $classNameWithNamespace),
                    'nextEntity' => $this->unserializeEntity($easyadmin['item']->getNextEntityState(), $classNameWithNamespace),
                ],
                'fields' => $fields,
            ];

            return $this->executeDynamicMethod('render<EntityName>Template', ['show', $this->entity['templates']['show'], $parameters]);
        }

        return parent::showAction();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function editAction()
    {
        $this->savePreviousEntityState();

        return $this->hasAccess()
            ? parent::editAction()
            : $this->redirectToReferrer();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    protected function deleteAction()
    {
        return $this->hasAccess()
            ? parent::deleteAction()
            : $this->redirectToReferrer();
    }

    /**
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    protected function newAction()
    {
        return $this->hasAccess()
            ? parent::newAction()
            : $this->redirectToReferrer();
    }

    /**
     * @param string $actionName
     * @param string $templatePath
     * @param array $parameters
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderTemplate($actionName, $templatePath, array $parameters = [])
    {
        $parameters = array_merge($parameters);
        return $this->render($templatePath, $parameters);
    }

    /**
     * @return object|void
     */
    protected function persistEntity($entity)
    {
    }

    /**
     * @param object $entity
     */
    protected function updateEntity($entity): void
    {
    }

    /**
     * @param object $entity
     */
    protected function removeEntity($entity)
    {
    }

    /**
     * @param $entityClass
     * @param $sortDirection
     * @param null $sortField
     * @param null $dqlFilter
     * @return \Doctrine\ORM\QueryBuilder
     */
    protected function createListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null)
    {
        return parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);
    }
}
