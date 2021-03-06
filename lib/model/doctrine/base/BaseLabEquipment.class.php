<?php

/**
 * BaseLabEquipment
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $slug
 * @property string $wiki_page
 * @property string $calendar_url
 * @property LabAppointment $Appointments
 * @property Doctrine_Collection $LabEquipmentSchedule
 * 
 * @method string              getName()                 Returns the current record's "name" value
 * @method string              getSlug()                 Returns the current record's "slug" value
 * @method string              getWikiPage()             Returns the current record's "wiki_page" value
 * @method string              getCalendarUrl()          Returns the current record's "calendar_url" value
 * @method LabAppointment      getAppointments()         Returns the current record's "Appointments" value
 * @method Doctrine_Collection getLabEquipmentSchedule() Returns the current record's "LabEquipmentSchedule" collection
 * @method LabEquipment        setName()                 Sets the current record's "name" value
 * @method LabEquipment        setSlug()                 Sets the current record's "slug" value
 * @method LabEquipment        setWikiPage()             Sets the current record's "wiki_page" value
 * @method LabEquipment        setCalendarUrl()          Sets the current record's "calendar_url" value
 * @method LabEquipment        setAppointments()         Sets the current record's "Appointments" value
 * @method LabEquipment        setLabEquipmentSchedule() Sets the current record's "LabEquipmentSchedule" collection
 * 
 * @package    BookEquip
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLabEquipment extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lab_equipment');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('slug', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('wiki_page', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('calendar_url', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('LabAppointment as Appointments', array(
             'local' => 'id',
             'foreign' => 'equipment_id'));

        $this->hasMany('LabEquipmentSchedule', array(
             'local' => 'id',
             'foreign' => 'equipment_id'));
    }
}