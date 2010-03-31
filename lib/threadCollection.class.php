<?php
class ThreadCollection
{
 public $threads = array();
 public $waitstatus;
 public $spawncounter = 0;
 /* @method push
    @param object Thread to push.
    @description Pushes certain thread to the collection.
    @return void
 */
 public function push($thread)
 {
  ++$this->spawncounter;
  $thread->spawnid = $this->spawncounter;
  $this->threads[$thread->spawnid] = $thread;
 }
 /* @method start
    @description Starts the collected threads.
    @return void
 */
 public function start()
 {
  foreach ($this->threads as $thread)
  {
   $thread->start();
  }
 }
 /* @method stop
    @description Stops the collected threads.
    @return void
 */
 public function stop($kill = FALSE)
 {
  foreach ($this->threads as $thread)
  {
   $thread->stop($kill);
  }
 }
 /* @method getNumber
    @description Returns a number of collected threads.
    @return integer Number.
 */
 public function getNumber()
 {
  return sizeof($this->threads);
 }
 /* @method removeTerminated
    @param boolean Whether to check the threads using signal.
    @description Removes terminated threads from the collection.
    @return integer Number of removed threads.
 */
 public function removeTerminated($check = FALSE)
 {
  $n = 0;
  foreach ($this->threads as $k => &$t)
  {
   if ($t->terminated) {unset($this->threads[$k]);}
   elseif ($check && (!$thread->signal(SIGTTIN))) {unset($this->threads[$k]);}
   else {++$n;}
  }
  return $n;
 }
 /* @method signal
    @param integer Signal's number.
    @description Sends a signal to threads.
    @return void
 */
 public function signal($sig)
 {
  foreach ($this->threads as $thread)
  {
   $thread->signal($sig);
  }
 }
}
