<?php

/**
 * community actions.
 *
 * @package    OpenPNE
 * @subpackage community
 * @author     Kousuke Ebihara <ebihara@tejimaya.com>
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class communityActions extends sfActions
{
  public function preExecute()
  {
    $this->id = $this->getRequestParameter('id');

    $this->isCommunityMember = CommunityMemberPeer::isMember($this->getUser()->getMemberId(), $this->id);
    $this->isAdmin = CommunityMemberPeer::isAdmin($this->getUser()->getMemberId(), $this->id);
    $this->isEditCommunity = $this->isAdmin;
  }

 /**
  * Executes joinlist action
  *
  * @param sfRequest $request A request object
  */
  public function executeJoinlist($request)
  {
    $memberId = $request->getParameter('member_id', $this->getUser()->getMemberId());

    $this->member = MemberPeer::retrieveByPK($memberId);
    $this->forward404Unless($this->member);

    $this->pager = CommunityPeer::getJoinCommunityListPager($memberId, $request->getParameter('page', 1));

    if (!$this->pager->getNbResults()) {
      return sfView::ERROR;
    }

    return sfView::SUCCESS;
  }
}
