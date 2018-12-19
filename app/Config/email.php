<?php
/**
 * This is email configuration file.
 *
 * Use it to configure email transports of CakePHP.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 2.0.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 *
 * Email configuration class.
 * You can specify multiple configurations for production, development and testing.
 *
 * transport => The name of a supported transport; valid options are as follows:
 *		Mail 		- Send using PHP mail function
 *		Smtp		- Send using SMTP
 *		Debug		- Do not send the email, just return the result
 *
 * You can add custom transports (or override existing transports) by adding the
 * appropriate file to app/Network/Email. Transports should be named 'YourTransport.php',
 * where 'Your' is the name of the transport.
 *
 * from =>
 * The origin email. See CakeEmail::from() about the valid values
 *
 */
class EmailConfig {

	public $default = array(
		'transport' => 'Mail',
		'from' => 'you@localhost',
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);

	public $smtp = array(
		'transport' => 'Smtp',
		'from' => array('info@stockbangladesh.com' => 'StockBangladesh OMO'),
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'info@stockbangladesh.com',
		'password' => 'd^w!T4uv;n+rVzm*kL!7HY=s',
		'client' => null,
		'log' => false,
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);
   /* public $gmail = array(
        'host' => 'ssl://smtp.gmail.com',
        'port' => 465,
        'username' => 'afmsohail@gmail.com',
        'password' => 'fazalmohammad',
        'transport' => 'Smtp'
    );*/
    public $gmail = array(
        'host' => 'smtp.gmail.com',
        'port' => 465,
        'username' => 'plabonraj@gmail.com',
        'password' => 'rajdeep983123',
        'transport' => 'Smtp',
        'tls' => true
    );
    public $test = array(
        'log' => true
    );
	public $fast = array(
		'from' => 'you@localhost',
		'sender' => null,
		'to' => null,
		'cc' => null,
		'bcc' => null,
		'replyTo' => null,
		'readReceipt' => null,
		'returnPath' => null,
		'messageId' => true,
		'subject' => null,
		'message' => null,
		'headers' => null,
		'viewRender' => null,
		'template' => false,
		'layout' => false,
		'viewVars' => null,
		'attachments' => null,
		'emailFormat' => null,
		'transport' => 'Smtp',
		'host' => 'localhost',
		'port' => 25,
		'timeout' => 30,
		'username' => 'user',
		'password' => 'secret',
		'client' => null,
		'log' => true,
		//'charset' => 'utf-8',
		//'headerCharset' => 'utf-8',
	);
    public $signMeUp = array(
        'activation_field' => 'activation_code',
        'useractive_field' => 'active',
        'login_after_activation' => false,
        'welcome_subject' => 'Welcome',
        'activation_subject' => 'Please Activate Your Account',
        'password_reset_field' => 'password_reset',
        'username_field' => 'username',
        'email_field' => 'email',
        'email_layout' => 'default',
        'password_field' => 'password',
        'from' => 'afmsohail@gmail.com',
        'layout' => 'default',
        'welcome_subject' => 'Welcome to MyDomain.com %username%!',
        'activation_subject' => 'Activate Your MyDomain.com Account %username%!',
        'sendAs' => 'html',
        'activation_template' => 'activate',
        'welcome_template' => 'welcome',
        'password_reset_template' => 'forgotten_password',
        'password_reset_subject' => 'Password Reset Request',
        'new_password_template' => 'recovered_password',
        'new_password_subject' => 'Your new Password'
    );

}
