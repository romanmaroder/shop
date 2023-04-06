<?php


namespace frontend\controllers\auth;


use core\forms\auth\LoginForm;
use core\services\auth\AuthService;
use DomainException;
use Yii;

class AuthController extends \yii\web\Controller
{
    private AuthService $service;

    /**
     * AuthController constructor.
     * @param $id
     * @param $module
     * @param AuthService $service
     * @param array $config
     */
    public function __construct($id, $module, AuthService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->service = $service;
    }

    /**
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $form = new LoginForm();
        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            try {
                $user = $this->service->auth($form);
                Yii::$app->user->login($user, $form->rememberMe ? 3600 * 24 * 30 : 0);
                return $this->goBack();
            } catch (DomainException $e) {
                Yii::$app->errorHandler->logException($e);
                Yii::$app->session->setFlash('error', $e->getMessage());
            }
        }

        return $this->render(
            'login',
            [
                'model' => $form,
            ]
        );
    }

    /**
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}