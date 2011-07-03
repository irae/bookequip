<h1>Lab equipments List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Slug</th>
      <th>Wiki page</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($lab_equipments as $lab_equipment): ?>
    <tr>
      <td><a href="<?php echo url_for('equipamento/show?id='.$lab_equipment->getId()) ?>"><?php echo $lab_equipment->getId() ?></a></td>
      <td><?php echo $lab_equipment->getName() ?></td>
      <td><?php echo $lab_equipment->getSlug() ?></td>
      <td><?php echo $lab_equipment->getWikiPage() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('equipamento/new') ?>">New</a>
