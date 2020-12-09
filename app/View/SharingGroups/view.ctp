<div class="roles view">
<h2><?= __('Sharing Group %s', $sg['SharingGroup']['name']);?></h2>
<div class="row-fluid"><div class="span8" style="margin:0">
<?php
$tableData = [
    ['key' => __('ID'), 'value' => $sg['SharingGroup']['id']],
    ['key' => __('UUID'), 'value' => $sg['SharingGroup']['uuid'], 'value_class' => 'quickSelect'],
    ['key' => __('Name'), 'value' => $sg['SharingGroup']['name']],
    ['key' => __('Releasability'), 'value' => $sg['SharingGroup']['releasability']],
    ['key' => __('Description'), 'value' => $sg['SharingGroup']['description']],
    ['key' => __('Selectable'), 'boolean' => $sg['SharingGroup']['active']],
    ['key' => __('Created by'), 'html' => $this->OrgImg->getNameWithImg($sg)],
];
$eventsLink = $baseurl . '/events/index/searchsharinggroup:' . $sg['SharingGroup']['id'];
$tableData[] = [
    'key' => __('Events'),
    'html' => '<a href="' . $eventsLink . '">' . __n('%s event', '%s events', $sg['SharingGroup']['event_count'], $sg['SharingGroup']['event_count']) . '</a>',
];
if ($sg['SharingGroup']['sync_user_id']) {
    $tableData[] = [
        'key' => __('Synced by'),
        'html' => $this->OrgImg->getNameWithImg($sg),
    ];
}
echo $this->element('genericElements/viewMetaTable', ['table_data' => $tableData]);
?>
</div></div>
    <br />
    <div class="row" style="width:100%;">
    <?php
        if (isset($sg['SharingGroupOrg'])):
    ?>
        <div class="span6">
        <b><?php echo __('Organisations');?></b>
            <table class="table table-striped table-hover table-condensed">
                <tr>
                    <th><?= __('Name') ?></th>
                    <th><?= __('Is local') ?></th>
                    <th><?= __('Can extend') ?></th>
                </tr>
                <?php
                    foreach ($sg['SharingGroupOrg'] as $sgo):
                ?>
                <tr>
                    <td><a href="<?php echo $baseurl; ?>/organisations/view/<?php echo h($sgo['Organisation']['id']); ?>"><?php echo h($sgo['Organisation']['name']); ?></a></td>
                    <td><span class="<?= $sgo['Organisation']['local'] ? 'fas fa-check' : 'fas fa-times' ?>"></span></td>
                    <td><span class="<?= $sgo['extend'] ? 'fas fa-check' : 'fas fa-times' ?>"></span></td>
                </tr>
                <?php
                    endforeach;
                ?>
            </table>
        </div>
    <?php
        endif;
        if (!$sg['SharingGroup']['roaming']):
    ?>
        <div class="span6">
        <b>Instances</b>
            <table class="table table-striped table-hover table-condensed">
                <tr>
                    <th><?= __('Name') ?></th>
                    <th><?= __('URL') ?></th>
                    <th><?= __('All orgs') ?></th>
                </tr>
                <?php
                        foreach ($sg['SharingGroupServer'] as $sgs): ?>
                <tr>
                    <td><?= h($sgs['Server']['name']) ?></td>
                    <td><?= h($sgs['Server']['url']) ?></td>
                    <td><span class="<?= $sgs['all_orgs'] ? 'fas fa-check' : 'fas fa-times' ?>"></span></td>
                </tr>
                <?php
                        endforeach;
                ?>
            </table>
        </div>
    <?php
        endif;
    ?>
    </div>
</div>
<?= $this->element('/genericElements/SideMenu/side_menu', array('menuList' => 'globalActions', 'menuItem' => 'viewSG'));