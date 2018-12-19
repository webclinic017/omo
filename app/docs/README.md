How to setup acl
==============================
1. first setup cakephp properly
2. import database_name.sql from D:\development\xampp\htdocs\script repository\cakephp_2.2.3_with_Auth_ACL_2.2.0\cakephp_2.2.3_with_Auth_ACL_2.2.0
3.  Copy acl plugin from D:\development\xampp\htdocs\script repository\cakephp_2.2.3_with_Auth_ACL_2.2.0\cakephp_2.2.3_with_Auth_ACL_2.2.0\app\Plugin
4. add Configure::write('Routing.prefixes', array('admin')); at core.php
5. add CakePlugin::load('Acl', array('bootstrap' => true));  at bootstrap.php
6. copy all model from D:\development\xampp\htdocs\script repository\cakephp_2.2.3_with_Auth_ACL_2.2.0\cakephp_2.2.3_with_Auth_ACL_2.2.0\app\Model
7. copy all controller from D:\development\xampp\htdocs\script repository\cakephp_2.2.3_with_Auth_ACL_2.2.0\cakephp_2.2.3_with_Auth_ACL_2.2.0\app\Controller
8. add $this->Auth->allow(); at function beforeFilter() at AppController.php
9. run http://localhost/stockbangladeshtmp/admin/acl
10.  Synchronize ACOs
11. remove or disable $this->Auth->allow(); at function beforeFilter() at AppController.php
12. Replace Security.salt by 'SherwinRoblesDotBlogspotDotComSherwinRobles@gmail.com' and  Security.cipherSeed by '092343323820923433238209234332382'
13. brows http://localhost/stockbangladeshtmp/users/ it will ask username password
14.user: sherwinrobles  pass : sherwinrobles

now you can develop your project based on this platform





related link
http://sherwinrobles.blogspot.com/2012/11/acl-220-plugin-for-cakephp-223.html
http://www.alaxos.net/blaxos/pages/view/plugin_acl_2.0

