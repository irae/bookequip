<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $lab_equipment->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $lab_equipment->getName() ?></td>
    </tr>
    <tr>
      <th>Slug:</th>
      <td><?php echo $lab_equipment->getSlug() ?></td>
    </tr>
    <tr>
      <th>Wiki page:</th>
      <td><?php echo $lab_equipment->getWikiPage() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('equipamento/edit?id='.$lab_equipment->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('equipamento/index') ?>">List</a>
