<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $lab_equipment_schedule->getId() ?></td>
    </tr>
    <tr>
      <th>Equipment:</th>
      <td><?php echo $lab_equipment_schedule->getEquipmentId() ?></td>
    </tr>
    <tr>
      <th>Start time:</th>
      <td><?php echo $lab_equipment_schedule->getStartTime() ?></td>
    </tr>
    <tr>
      <th>End time:</th>
      <td><?php echo $lab_equipment_schedule->getEndTime() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('horario/edit?id='.$lab_equipment_schedule->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('horario/index') ?>">List</a>
