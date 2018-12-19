<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Group $Group
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

    public $actsAs = array('Acl' => array('type' => 'requester'));

	public function beforeSave($options = array()) {
        $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        return true;
    }
    /*public $validate = array(
        'username' => array(
            'alphaNumeric' => array(
                'rule'     => 'alphaNumeric',
                'required' => true,
                'message'  => 'Alphabets and numbers only'
            ),
            'between' => array(
                'rule'    => array('between', 5, 15),
                'message' => 'Between 5 to 15 characters'
            ),
            'isUnique' => array(
                'rule'     => 'isUnique',
                'message' => 'Username is not available'
            )
        ),
        'email' => array(
            'email' => array(
                'rule'     => 'email',
                'required' => true,
                'message'  => 'Enter valid email'
            ),
            'isUnique' => array(
                'rule'     => 'isUnique',
                'message' => 'Email is already in use'
            )
        ),

        'password' => array(
            'rule'    => array('minLength', '5'),
            'message' => 'Minimum 5 characters long'
        )
    );*/
	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)/*,
        'Broker' => array(
			'className' => 'Group',
			'foreignKey' => 'broker_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*//*,
        'Portfolio' => array(
			'className' => 'Portfolio',
			'foreignKey' => 'broker_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)*/
	);




    	public function parentNode() {
       		 if (!$this->id && empty($this->data)) {
       		     return null;
       		 }
       		 if (isset($this->data['User']['group_id'])) {
       		     $groupId = $this->data['User']['group_id'];
       		 } else {
       		     $groupId = $this->field('group_id');
       		 }
       		 if (!$groupId) {
       		     return null;
       		 } else {
       		     return array('Group' => array('id' => $groupId));
       		 }
    	}


    public function bindNode($user) {
	    return array('model' => 'Group', 'foreign_key' => $user['User']['group_id']);
	}




}
