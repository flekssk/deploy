<?php

declare(strict_types=1);

namespace App\UI\Controller\EasyAdmin\Traits;

trait AccessAdminTrait
{
    /**
     * Method for control access to Entity
     */
    public function hasAccess()
    {
        $message = 'У вас нет доступа для просмотра содержимого этой страницы';
        $hasAccess = false;
        $entityName = $this->request->get('entity');
        $action = $this->request->get('action');

        switch ($entityName) {
            case 'Project':
                $hasAccess = $this->isGranted(static::ROLE_GUEST);
                break;
            case 'User':
                // Only user with role admin can set admin or supervisor role
                $userForm = $this->request->request->get('user');

                if ($userForm['roleRealName'] === static::ROLE_ADMIN) {
                    $hasAccess = $this->isGranted(static::ROLE_ADMIN);
                    $message = 'Роль Администратор или Супервизор может присвоить только Администратор';
                } else if ($action === 'delete') {
                    $hasAccess = $this->isGranted(static::ROLE_ADMIN);
                    $message = 'Удалить пользователя из системы может только Администратор';
                } else {
                    $hasAccess = $this->isGranted(static::ROLE_SUPERVISOR);
                }
                break;
        }

        if (!$hasAccess) {
            $this->addFlash('warning', $message);
        }

        return $hasAccess;
    }
}
