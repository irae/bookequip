<?php

/**
 * BaseLabEquipmentSchedule
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $equipment_id
 * @property time $start_time
 * @property time $end_time
 * @property LabEquipment $LabEquipment
 * @property Doctrine_Collection $LabAppointment
 * 
 * @method integer              getEquipmentId()    Returns the current record's "equipment_id" value
 * @method time                 getStartTime()      Returns the current record's "start_time" value
 * @method time                 getEndTime()        Returns the current record's "end_time" value
 * @method LabEquipment         getLabEquipment()   Returns the current record's "LabEquipment" value
 * @method Doctrine_Collection  getLabAppointment() Returns the current record's "LabAppointment" collection
 * @method LabEquipmentSchedule setEquipmentId()    Sets the current record's "equipment_id" value
 * @method LabEquipmentSchedule setStartTime()      Sets the current record's "start_time" value
 * @method LabEquipmentSchedule setEndTime()        Sets the current record's "end_time" value
 * @method LabEquipmentSchedule setLabEquipment()   Sets the current record's "LabEquipment" value
 * @method LabEquipmentSchedule setLabAppointment() Sets the current record's "LabAppointment" collection
 * 
 * @package    BookEquip
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLabEquipmentSchedule extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lab_equipment_schedule');
        $this->hasColumn('equipment_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('start_time', 'time', null, array(
             'type' => 'time',
             'notnull' => true,
             ));
        $this->hasColumn('end_time', 'time', null, array(
             'type' => 'time',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('LabEquipment', array(
             'local' => 'equipment_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('LabAppointment', array(
             'local' => 'id',
             'foreign' => 'schedule_id'));
    }
}