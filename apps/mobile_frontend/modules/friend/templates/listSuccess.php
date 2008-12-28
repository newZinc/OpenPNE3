<?php include_page_title('ﾌﾚﾝﾄﾞﾘｽﾄ') ?>

<center>
<?php echo pager_total($pager); ?>
</center>

<?php
$list = array();
foreach ($pager->getResults() as $member) {
  $list[] = link_to(sprintf('%s(%d)', $member->getName(), $member->countFriends()), 'member/profile?id='.$member->getId());
}
$options = array(
  'border' => true,
);
include_list_box('friendList', $list, $options);
?>

<?php echo pager_navigation($pager, 'friend/list?page=%d&id=' . $sf_params->get('id'), false); ?>

<?php echo link_to(__('ﾌﾚﾝﾄﾞ管理'), 'friend/manage') ?>
