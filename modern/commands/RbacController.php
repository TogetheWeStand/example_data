<?php

namespace app\commands;

use Yii;
use yii\console\Controller;

/**
 * Class RbacController
 * @package app\commands
 */
class RbacController extends Controller
{
    public function actionInit()
    {
        $authManager = Yii::$app->authManager;

        $schema = $authManager->db->schemaMap['pgsql']['defaultSchema'] . ".";

        $authManager->ruleTable = $schema . $authManager->ruleTable;
        $authManager->itemTable = $schema . $authManager->itemTable;
        $authManager->itemChildTable = $schema . $authManager->itemChildTable;
        $authManager->assignmentTable = $schema . $authManager->assignmentTable;

        $authManager->removeAll();

        // Create roles
        $user = $authManager->createRole('user');
        $userMy = $authManager->createRole('userMy');
        $userMyS = $authManager->createRole('userMyS');
        $userMyG = $authManager->createRole('userMyG');
        $userMyP = $authManager->createRole('userMyP');
        $operator = $authManager->createRole('operator');
        $moderator = $authManager->createRole('moderator');
        $admin  = $authManager->createRole('admin');

        // Add roles
        $authManager->add($user);
        $authManager->add($userMy);
        $authManager->add($userMyS);
        $authManager->add($userMyG);
        $authManager->add($userMyP);
        $authManager->add($operator);
        $authManager->add($moderator);
        $authManager->add($admin);

        // Create permissions
        $authentication = $authManager->createPermission('authentication');
        $authentication->description = 'Аутентификация на сайте';

        $viewAdminPage = $authManager->createPermission('viewAdminPage');
        $viewAdminPage->description = 'Просмотр админки';

        $updateNews = $authManager->createPermission('updateNews');
        $updateNews->description = 'Редактирование новости';

        $activityParticipation = $authManager->createPermission('activityParticipation');
        $activityParticipation->description = 'Участие в акции';

        $userAdvicing = $authManager->createPermission('userAdvicing');
        $userAdvicing->description = 'Консультирование пользователей';

        // Add permissions
        $authManager->add($authentication);
        $authManager->add($viewAdminPage);
        $authManager->add($updateNews);
        $authManager->add($activityParticipation);
        $authManager->add($userAdvicing);


        // Set permissions for roles
        $authManager->addChild($user, $authentication);

        $authManager->addChild($userMy, $user);
        $authManager->addChild($userMy, $activityParticipation);

        $authManager->addChild($userMyS, $userMy);

        $authManager->addChild($userMyG, $userMy);

        $authManager->addChild($userMyP, $userMy);

        $authManager->addChild($operator, $user);
        $authManager->addChild($operator, $userAdvicing);

        $authManager->addChild($moderator, $user);
        $authManager->addChild($moderator, $updateNews);

        $authManager->addChild($admin, $user);
        $authManager->addChild($admin, $updateNews);
        $authManager->addChild($admin, $viewAdminPage);
    }
}