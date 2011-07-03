<h1>Lab equipment schedules List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Equipment</th>
      <th>Start time</th>
      <th>End time</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($lab_equipment_schedules as $lab_equipment_schedule): ?>
    <tr>
      <td><a href="<?php echo url_for('horario/show?id='.$lab_equipment_schedule->getId()) ?>"><?php echo $lab_equipment_schedule->getId() ?></a></td>
      <td><?php echo $lab_equipment_schedule->getEquipmentId() ?></td>
      <td><?php echo $lab_equipment_schedule->getStartTime() ?></td>
      <td><?php echo $lab_equipment_schedule->getEndTime() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('horario/new') ?>">New</a>
