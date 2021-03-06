<?php

/**
 * BaseLabAppointmentInfo
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $appointment_id
 * @property string $form_class
 * @property string $info_key
 * @property string $info_value
 * @property boolean $is_json
 * @property LabAppointment $LabAppointment
 * 
 * @method integer            getAppointmentId()  Returns the current record's "appointment_id" value
 * @method string             getFormClass()      Returns the current record's "form_class" value
 * @method string             getInfoKey()        Returns the current record's "info_key" value
 * @method string             getInfoValue()      Returns the current record's "info_value" value
 * @method boolean            getIsJson()         Returns the current record's "is_json" value
 * @method LabAppointment     getLabAppointment() Returns the current record's "LabAppointment" value
 * @method LabAppointmentInfo setAppointmentId()  Sets the current record's "appointment_id" value
 * @method LabAppointmentInfo setFormClass()      Sets the current record's "form_class" value
 * @method LabAppointmentInfo setInfoKey()        Sets the current record's "info_key" value
 * @method LabAppointmentInfo setInfoValue()      Sets the current record's "info_value" value
 * @method LabAppointmentInfo setIsJson()         Sets the current record's "is_json" value
 * @method LabAppointmentInfo setLabAppointment() Sets the current record's "LabAppointment" value
 * 
 * @package    BookEquip
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLabAppointmentInfo extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('lab_appointment_info');
        $this->hasColumn('appointment_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('form_class', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('info_key', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('info_value', 'string', 5000, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 5000,
             ));
        $this->hasColumn('is_json', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 0,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('LabAppointment', array(
             'local' => 'appointment_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}