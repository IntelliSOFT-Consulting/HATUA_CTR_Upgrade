<?php
// App::uses('AppShell', 'Shell');
App::uses('Shell', 'Console');
App::uses('AppModel', 'Model');
class FriendShell  extends Shell {
    public function perform() {
      $this->initialize();
      $this->{array_shift($this->args)}();
    }

    public function findNewFriend() {
    	// $this->args == array('John Doe', 'Ghana')
    	$this->out('Hello world.');
      	$this->log('I am successful here @ login '.$this->args[0], 'test');
  	}
}
