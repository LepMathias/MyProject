<form name="form-schedules" action="" method="post">
    <tr class="text-center">
        <th scope="row" id="day"><?=$schedule->getDay()?></th>
        <td class="w-25">
            <input class="form-control text-center" type="text" name="startDej" id="startDej" value="<?=$schedule->getStartDej()?>">
            <input class="form-control text-center" type="text" name="endDej" id="endDej" value="<?=$schedule->getEndDej()?>">
        </td>
        <td class="w-25">
            <input class="form-control text-center" type="text" name="startDin" id="startDin" value="<?=$schedule->getStartDin()?>">
            <input class="form-control text-center" type="text" name="endDin" id="endDin" value="<?=$schedule->getEndDin()?>">
        </td>
        <td>
            <input type="hidden" name="id" id="id" value="<?=$schedule->getId()?>">
            <button class="btn btn-success" type="submit" id="schedules-btn">Mettre à jour</button>
        </td>
    </tr>
</form>