<?php
App::uses('AppController', 'Controller');
/**
 * Events Controller
 *
 * @property Event $Event
 * @property PaginatorComponent $Paginator
 */
class EventsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Event->recursive = 0;
		$this->set('events', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
		$this->set('event', $this->Event->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Event->create();
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}
		}
		$instruments = $this->Event->Instrument->find('list');
		$this->set(compact('instruments'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Event->exists($id)) {
			throw new NotFoundException(__('Invalid event'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Event->save($this->request->data)) {
				$this->Session->setFlash(__('The event has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The event could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
			$this->request->data = $this->Event->find('first', $options);
		}
		$instruments = $this->Event->Instrument->find('list');
		$this->set(compact('instruments'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Event->id = $id;
		if (!$this->Event->exists()) {
			throw new NotFoundException(__('Invalid event'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Event->delete()) {
			$this->Session->setFlash(__('The event has been deleted.'));
		} else {
			$this->Session->setFlash(__('The event could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
    public  function agm_egm()
    {
        App::uses('CakeTime', 'Utility');
        Configure::write('debug', 0);
        $allEvents = $this->Event->find('list');
       // pr($allEvents);

        //$options = array('conditions' => array('Event.event_date>'));
        $allEvents = $this->Event->find('all');
  //      pr($allEvents);

        $stockbangladesh = $this->Components->load('StockBangladesh');
        $metaList=$stockbangladesh->getMetaList();
     //   pr($metaList);
        $metaKeyArr=$stockbangladesh->getMetaKeyArr($metaList,'event_type');
        $eventTypeId=$metaKeyArr[0]['id'];
//pr($metaKeyArr);
        $newArr=array();
        $selectedDates=array();
        $selectedText=array();
    foreach($allEvents as $event)
    {
        $event_typeArr=Hash::extract($event, "EventInformation.{n}[meta_id=$eventTypeId]"); //find only event information related to event_type meta
        $event_type=$event_typeArr[0]['meta_value'];
     //   pr($event_type);
    //    exit;
        $date=$event['Event']['event_date'];
        $d = CakeTime::format('m/d/Y', $date);
        $newArr[$event_type][$d]=$event['Event']['event_title'];
        $newArr['ALL'][$d]=$event['Event']['event_title'];
        $selectedDates[$event_type][$d]=$d;
        $selectedText[$event_type][$d]=$event['Event']['event_title'];

    }

        //pr($newArr);
       // exit;
        $this->set('css_asset_compression_enable', false);
        $this->set('newArr',$newArr);
        $this->set('eventDate',json_encode($newArr));
        $this->set('selectedDates',json_encode($selectedDates));
        $this->set('selectedText',json_encode($selectedText));



/*
        $chart = $this->Components->load('Chart');
        $ca=$chart->getCorporateAction();

        $recordDate=Hash::extract($ca, '{n}.CorporateAction.record_date');
        $newArr=array();
        $selectedDates=array();
        $selectedText=array();
        foreach($ca as $action)
        {
            $date=$action['CorporateAction']['record_date'];
            $d = CakeTime::format('m/d/Y', $date);
            $newArr[$d]=$action['CorporateAction']['action'];
            $selectedDates[$d]=$d;
            $selectedText[$d]=$action['CorporateAction']['action'];
        }
//pr($newArr);

        $this->set('eventDate',json_encode($newArr));
        $this->set('selectedDates',json_encode($selectedDates));
        $this->set('selectedText',json_encode($selectedText));*/

       // exit;
    }
}
