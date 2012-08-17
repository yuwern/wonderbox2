<?php
class CronsController extends AppController
{
    public $name = 'Crons';
    public function update_package()
    {
        $this->autoRender = false;
        App::import('Core', 'ComponentCollection');
        $collection = new ComponentCollection();
        App::import('Component', 'cron');
        $this->Cron = new CronComponent($collection);
        $this->Cron->update_package();
    }
}
?>