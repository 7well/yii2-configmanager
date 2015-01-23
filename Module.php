<?php

namespace julatools\configmanager;

class Module extends \yii\base\Module
{

	/** @var array Model map */
	public $modelMap = [];
	
	
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    /**
     * @var string The prefix for user module URL.
     * @See [[GroupUrlRule::prefix]]
     */
    public $urlPrefix = 'configmanager';
    
    /** @var array The rules to be used in URL management. */
    public $urlRules = [
    		'<id:\d+>'                    => 'profile/show',
    		'<action:(login|logout)>'     => 'security/<action>',
    		'<action:(register|resend)>'  => 'registration/<action>',
    		'confirm/<id:\d+>/<code:\w+>' => 'registration/confirm',
    		'forgot'                      => 'recovery/request',
    		'recover/<id:\d+>/<code:\w+>' => 'recovery/reset',
    		'settings/<action:\w+>'       => 'settings/<action>'
    ];
}
